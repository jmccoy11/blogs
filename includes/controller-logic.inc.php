<?php

  function loadNavbar($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('bloggerId', $_SESSION['bloggerId']);
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
  }
  
  function getEntry($f3) {
    
    $dbResults = $GLOBALS['blogsDB']->getPostById($_GET['blogId']);
    
    foreach($dbResults as $row){
      $post = new BlogPost($row['blogId'], $row['title'], $row['blogPost'],
                           $row['datePosted']);
    }
    
    $f3->set('profilePic', $dbResults[0]["profilePicPath"]);
    $f3->set('post', $post);
  }
  
  function createObjects($f3, $what) {
    
    //will be populated by following include
    $bloggers = array();
    
    if($what == 'all') {
      $dbResults = $GLOBALS['blogsDB']->getDBContents();
    } else if ($what == 'user') {
      //pull contents from the blogger database
      $dbResults = $GLOBALS['blogsDB']->getBloggerById($_GET['bloggerId']);
    }
    
    //create Blogger and BlogPost objects
    include("includes/objectCreation.inc.php");
    
    //set $bloggers array as an f3 variable
    $f3->set('bloggers' , $bloggers);
    
    return $bloggers;
  }
  
  function reversePosts($f3, $bloggers) {
    
    $revPosts = array();
      if(!empty($bloggers[0]->getPostsArray())){
        $posts = $bloggers[0]->getPostsArray();
        for($i = count($posts)-1; $i >= 0; $i--){
          array_push($revPosts, $posts[$i]);
        }
      }
      
    $f3->set('blogger', $bloggers[0]);
    $f3->set('posts', $revPosts);
  }
  
  function loginErrors($f3) {
    
    if(isSet($_SESSION['loginErr'])) {
      if($_SESSION['loginErr']['loginErr'] == -1) {
        $f3->set('usernameErr', 'Username cannot be blank');
      } else if($_SESSION['loginErr']['loginErr'] == -2) {
        $f3->set('usernameErr', 'Username was incorrect');
      } else {
        if ($_SESSION['loginErr']['loginErr'] == -3) {
          $f3->set('validUsername', $_SESSION['loginErr']['username']);
        } else {
          $f3->set('usernameErr', ' * username * ');
        }
      }
      
      if($_SESSION['loginErr']['loginErr'] == -3) {
        $f3->set('passwordErr', 'Password was incorrect');
      } else {
        $f3->set('passwordErr', ' * password * ');
      }
    } else {
      $f3->set('usernameErr', ' * username * ');
      $f3->set('passwordErr', ' * password * ');
    }
    
    unset($_SESSION['loginErr']);
  }
  
  function verifyLogin() {
    
    $loginToken = $GLOBALS['blogsDB']->checkUsername(scrubData($_POST['username']));
      
    if(isSet($loginToken)){
      if (isSet($loginToken[0])) {
        //Check error codes
        if($loginToken[2] < 0) {
          $loginErr = array("username" => $loginToken[0],
                            "loginErr" => $loginToken[1],
                            "userId" => $loginToken[2]);
          $_SESSION['loginErr'] = $loginErr;
          
          $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/login";
          return $route;
        }
        
        $passwordCheck = $GLOBALS['blogsDB']->checkPassword($loginToken[2],
                                                            scrubData($_POST['password']));
        
        if (isSet($passwordCheck)) {
          if($passwordCheck == 0) {
            $_SESSION['bloggerId'] = $loginToken[2];
            $_SESSION['guest'] = false;
            $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/user-blogs?bloggerId=".$loginToken[2];
            return $route;
          }
          $loginErr = array("username" => $loginToken[0],
                            "password" => $loginToken[1],
                            "loginErr" => $passwordCheck);
          $_SESSION['loginErr'] = $loginErr;
          $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/login";
          return $route;
        }
      }
    }
  }
  
  function newUserErrors($f3) {
    
    //Check error codes
    if(isSet($_SESSION['createErr'])) {
      
      //check the username
      if(isSet($_SESSION['createErr']['usernameExists'])) {
          $f3->set('usernameErr', 'Username unavailable');
      } else if (isSet($_SESSION['createErr']['usernameBlank'])) {
        $f3->set('usernameErr', 'Cannot be blank');
      } else {
        if(isSet($_SESSION['createArr'])) {
          if(isSet($_SESSION['createArr']['username'])) {
            $f3->set('username', $_SESSION['createArr']['username']);
          }
        } else{
          $f3->set('usernameErr', '* username *');
        }
      }
      
      //check name
      if(isSet($_SESSION['createErr']['nameBlank'])) {
          $f3->set('nameErr', 'Cannot be blank');
      } else {
        if(isSet($_SESSION['createArr'])) {
          if(isSet($_SESSION['createArr']['name'])) {
            $f3->set('name', $_SESSION['createArr']['name']);
          }
        } else{
          $f3->set('nameErr', '* name *');
        }
      }
      
      //check the email
      if (isSet($_SESSION['createErr']['emailBlank'])) {
        $f3->set('emailErr', 'Cannot be blank');
      } else if (isSet($_SESSION['createErr']['invalidEmail'])) {
        $f3->set('emailErr', 'Invalid email');
      } else {
        if(isSet($_SESSION['createArr'])) {
          if(isSet($_SESSION['createArr']['email'])) {
            $f3->set('email', $_SESSION['createArr']['email']);
          }
        }else{
          $f3->set('emailErr', '* email *');
        }
      }
      
      //check the passwords
      if (isSet($_SESSION['createErr']['passwordBlank'])) {
        $f3->set('passwordErr', 'Cannot be blank');
      }else if (isSet($_SESSION['createErr']['passwordMismatch'])) {
        $f3->set('passwordErr', 'Password mismatch');
      }     
    } else {
      $f3->set('emailErr', '* email *');
      $f3->set('usernameErr', '* username *');
      $f3->set('passwordErr', '* password *');
      $f3->set('nameErr', '* name *');
    }
    
    unset($_SESSION['createErr']);
    unset($_SESSION['createArr']);
  }
  
  function verifyNewUser($f3) {
    
    $createErr = array();
    $createArr = array();
    $okToCreate = 0;
    $threshold = 4;
    
    if(isSet($_POST['username'])) {
      $username = scrubData($_POST['username']);
      $createArr['username'] = $username;
    }
    if(isSet($_POST['email'])) {
      $email = scrubData($_POST['email']);
      $createArr['email'] = $email;
    }
    if(isSet($_POST['name'])) {
      $name = scrubData($_POST['name']);
      $createArr['name'] = $name;
    }
    if(isSet($_POST['password1'])) {
      $password1 = scrubData($_POST['password1']);
    }
    if(isSet($_POST['password2'])) {
      $password2 = scrubData($_POST['password2']);
    }
    if(isSet($_POST['profilePicPath'])) {
      $imagePath = trim(htmlspecialchars($_POST['profilePicPath']));
    } else {
      $imagePath = trim(htmlspecialchars("images/user.png"));
    }
    if(isSet($_POST['bio'])) {
      $bio = scrubData($_POST['bio']);
    }
    
    $_SESSION['createArr'] = $createArr;
    
    $newUserToken = $GLOBALS['blogsDB']->checkUsername($username);
    
    if(isSet($newUserToken)){
      if (isSet($newUserToken[0])) {
        $createErr = array("username" => $newUserToken[0],
                           "createErr" => $newUserToken[1],
                           "userId" => $newUserToken[2]);
        $_SESSION['createErr'] = $createErr;
        
        if ($name == "") {
          $_SESSION['createErr']['nameBlank'] = true;
        } else {
          $okToCreate++;
        }
        
        if($newUserToken[1] == 0) { //already exists
          $_SESSION['usernameExists'] = true;
        } else if ($newUserToken[1] == -1) { //username field is blank
          $_SESSION['createErr']['usernameBlank'] = true;
        } else {
          $okToCreate++;
        }
        
        if ($email == "") { //email field is blank
          $_SESSION['createErr']['emailBlank'] = true;
        } else if (!filter_var($_POST['email'])) { //invalid email
          $_SESSION['createErr']['invalidEmail'] = true;
        } else {
          $okToCreate++;
        }
        
        if ($password1 == "" || $password2 == "") { //paswords are blank
          $_SESSION['createErr']['passwordBlank'] = true;
        } else if ($password1 != $password2) { //mismatch passwords
          $_SESSION['createErr']['passwordMismatch'] = true;
        } else {
          $okToCreate++;
        }
      }
    }
    
    if($okToCreate == $threshold) {
      $newBlogger = new Blogger(0, $username, $name, 0, 0, '0000-00-00', $imagePath, $bio);
      
      $newId = $GLOBALS['blogsDB']->addUser($newBlogger, $email, $password1);
      
      $_SESSION['guest'] = false;
      $_SESSION['bloggerId'] = $newId;
      $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/user-blogs?bloggerId=".$newId;
    } else {
      $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/new";
    }
     
     return $route;
  }
  
  function createBlog() {
    
    if(isSet($_POST['title'])) {
      $title = scrubData($_POST['title']);
    } else {
      $title = "";
    }
    if(isSet($_POST['blogEntry'])) {
      $blogEntry = scrubData($_POST['blogEntry']);
    } else {
      $blogEntry = "";
    }
    
    $bloggerId = $_SESSION['bloggerId'];
    $blogPost = new BlogPost(0, $title, $blogEntry, date("Y-m-d"));
    
    $GLOBALS['blogsDB']->addBlog($bloggerId, $blogPost);
    
    $route="Location: http://jmccoy.greenrivertech.net/328/blogs/user-blogs?bloggerId=$bloggerId";
    
    return $route;
  }
  
  function deleteBlog($blogId) {
    if(isSet($blogId)) {
      $title = scrubData($blogId);
    }
    
    $GLOBALS['blogsDB']->deleteBlog($blogId);
  }
  
  function GetBlogPostData($f3, $blogId) {
    if(isSet($blogId)){
      $blogId = scrubData($blogId);
    }
    
    $results = $GLOBALS['blogsDB']->getPostById($blogId);
    
    $blogPost = new BlogPost($blogId, $results[0]['title'], $results[0]['blogPost'],
                             $results[0]['datePosted']);

    
    $f3->set('blogPost', $blogPost);
  }
  
  function updateBlog($blogId, $title, $blogEntry) {
    if(isSet($_POST['title'])) {
      $title = scrubData($title);
    } 
    if(isSet($_POST['blogEntry'])) {
      $blogEntry = scrubData($blogEntry);
    }
    
    $blogPost = new BlogPost($blogId, $title, $blogEntry, date('Y-m-d'));
  
    $GLOBALS['blogsDB']->updateBlog($blogPost);
  }
  
  function scrubData($data) {
    $data = trim(strip_tags(htmlspecialchars(stripslashes($data))));
    return $data;
  }