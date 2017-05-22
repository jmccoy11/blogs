<?php

  /*
   * Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
   * Date: 5/18/2017
   * Description: Controller logic for jmccoy.greenrivertech.net/328/blogs
   */
  
  //{{{ GENERIC FUNCTIONS (functions used by more than one page)
  
  /**
   * Loads the navbar based on whether the user is a guest or not
   *
   * @param   Base    $f3   Fat-Free Framework Object
   * @access public
   */
  function loadNavbar($f3) {
    
    //set guest to session variable because F3 doesn't do it well
    //and F3 SESSION does not work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('bloggerId', $_SESSION['bloggerId']);
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
  }
  
  /**
   * Blitz the createArray from either the Login page or the create a new
   * user page.
   */
  function unsetFormData() {
    if(isSet($_SESSION['createArr']) || isSet($_SESSION['loginErr'])) {
      unset($_SESSION['createArr']);
      unset($_SESSION['createErr']);
      unset($_SESSION['loginErr']);
    }
  }
  
  /**
   * Scrub the data to prevent injection.
   *
   * @param     string    $data   Scrubs the data to prevent injection
   */
  function scrubData($data) {
    $data = trim(strip_tags(htmlspecialchars(stripslashes($data))));
    return $data;
  }
  
  //}}}
  
  //{{{ root, /user-blogs, AND /user FUNCTIONS
  
  /**
   * Creates both Blogger and BlogPost objects.
   *
   * @param   Base    $f3     Fat-Free Framework Object
   * @param   string  $what   'all' or 'user' Create all objects from the database or just
   *                          a single user.
   * @return  Array   Return the array of blogger(s)
   * @access public
   */
  function createObjects($f3, $what) {
    
    //will be populated by following include
    $bloggers = array();
    
    if($what == 'all') {
      $dbResults = $GLOBALS['blogsDB']->getDBContents();
    } else if ($what == 'user') {
      //pull contents from the blogger database
      $dbResults = $GLOBALS['blogsDB']->getBloggerById(scrubData($_GET['bloggerId']));
    }
    
    //create Blogger and BlogPost objects
    include_once("includes/objectCreation.inc.php");
    
    //set $bloggers array as an f3 variable
    $f3->set('bloggers' , $bloggers);
    
    return $bloggers;
  }
  
  //}}}
  
  //{{{ /entry SPECIFIC FUNCTIONS
  
  /**
   * Get an entry by its blog Id.
   *
   * @param   Base    $f3   Fat-Free Framework Object
   * @access public
   */
  function getEntry($f3) {
    
    //retrieve post for the entry at blogId
    $dbResults = $GLOBALS['blogsDB']->getPostById(scrubData($_GET['blogId']));
    
    foreach($dbResults as $row){                      //new line (\n) to break (<br>)
      $post = new BlogPost($row['blogId'], $row['title'], nl2br($row['blogPost']),
                           $row['datePosted']);
    }
    
    //set $f3 variables
    $f3->set('profilePic', $dbResults[0]["profilePicPath"]);
    $f3->set('post', $post);
  }
  
  //}}}
  
  //{{{ /user SPECIFIC FUNCTIONS
  
  /**
   * Reverses the posts so that they can be reported in order from most recent
   * to least. (Yes, I'm aware, well after the fact, that I could have just done
   * an ORDER BY ASC statement from my database)
   *
   * @param   Base      $f3         Fat-Free Framework Object
   * @param   Blogger   $blogger    Blogger to reverse the posts of
   * @access public
   */
  function reversePosts($f3, $blogger) {
    
    $revPosts = array();
    if(!empty($blogger[0]->getPostsArray())){
      $posts = $blogger[0]->getPostsArray();
      for($i = count($posts)-1; $i >= 0; $i--){
        $postStr = $posts[$i]->getPost();
        if (strlen($postStr) > 300) {
          $truncated = nl2br(substr($postStr, 0, 300) . "...");
          $posts[$i]->setPost($truncated);
          array_push($revPosts, $posts[$i]);
        } else {
          $posts[$i]->setPost(nl2br($posts[$i]->getPost()));
          array_push($revPosts, $posts[$i]);
        }
      }
    }
      
    $f3->set('blogger', $blogger[0]);
    $f3->set('posts', $revPosts);
  }
  
  //}}}
  
  //{{{ /login AND /verify-login FUNCTIONS
  
  /**
   * Searches through the loginErr SESSION variable and sets $f3 variables to be used
   * as values on the login.html page.
   * 
   * @param   Base      $f3         Fat-Free Framework Object
   * @access public
   */
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
  }
  
  /**
   * Verifies login and generates errors to be placed in the loginErr SESSION variable if
   * tests fail.
   *
   * @return    string    return the route based from what kind of errors are generated
   * @access public
   */
  function verifyLogin() {
    
    //create a loginToken from the POST data
    $loginToken = $GLOBALS['blogsDB']->checkUsername(scrubData($_POST['username']));
    
    //if the query was successful
    if(isSet($loginToken)){
      if (isSet($loginToken[0])) {
        //Check error codes
        if($loginToken[2] < 0) {
          $loginErr = array("username" => $loginToken[0],
                            "loginErr" => $loginToken[1],
                            "userId" => $loginToken[2]);
          //add loginErr to the SESSION variable
          $_SESSION['loginErr'] = $loginErr;
          //return to /login
          $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/login";
          return $route;
        }
        
        //check the password
        $passwordCheck = $GLOBALS['blogsDB']->checkPassword($loginToken[2],
                                                            scrubData($_POST['password']));
        //if the query was successful
        if (isSet($passwordCheck)) {
          //if $passwordCheck == 0, the login was successful
          if($passwordCheck == 0) {
            
            //add the bloggerId to a SESSION variable to be used while blogger is signed in
            $_SESSION['bloggerId'] = $loginToken[2];
            //set guest to false (for navbar generation purposes)
            $_SESSION['guest'] = false;
            //reroute to user-blogs
            $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/user-blogs?bloggerId=".$loginToken[2];
            return $route;
          }
          //else the login was unsuccessful
          $loginErr = array("username" => $loginToken[0],
                            "password" => $loginToken[1],
                            "loginErr" => $passwordCheck);
          //add loginErr to the SESSION variable
          $_SESSION['loginErr'] = $loginErr;
          //return to /login
          $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/login";
          return $route;
        }
      }
    }
  }
  
  //}}}
  
  //{{{ /new AND /verify-new-user FUNCTIONS
  
  /**
   * Verifies new user and generates errors to be placed in the createErr SESSION variable if
   * tests fail.
   *
   * @param   Base      $f3         Fat-Free Framework Object
   * @access public
   */
  function newUserErrors($f3) {
    
    //blitz the FILES array in case /verify-new-users was unsuccessful in uploading the file
    //given
    unset($_FILES);
    
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
    } else { //SESSION createErr has not been intialized
      $f3->set('emailErr', '* email *');
      $f3->set('usernameErr', '* username *');
      $f3->set('passwordErr', '* password *');
      $f3->set('nameErr', '* name *');
    }
  }
  
  /**
   * verifies the new User, scrubs any data from the entry fields, and generates errors if
   * any tests fail to be used by /new
   *
   * @param   Base      $f3         Fat-Free Framework Object
   * @return  string                the reroute path
   * @access public
   */
  function verifyNewUser($f3) {
    
    $createErr = array();
    $createArr = array();
    $okToCreate = 0;
    $threshold = 4;
    
    //scrub any data
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
    
    //create the Array to pass template variables to
    $_SESSION['createArr'] = $createArr;
    
    $newUserToken = $GLOBALS['blogsDB']->checkUsername($username);
    
    if(isSet($newUserToken)){
      if (isSet($newUserToken[0])) {
        $createErr = array("username" => $newUserToken[0],
                           "createErr" => $newUserToken[1],
                           "userId" => $newUserToken[2]);
        
        // insert newUserToken in the SESSION createErr
        $_SESSION['createErr'] = $createErr;
        
        //complete the following checks. each passing test increases okToCreate by one
        if ($name == "") { //name is blank
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
    
    //if okToCreate has met the threshold
    if($okToCreate == $threshold) {
      
      //set the target directory
      $target_dir = "user-images/$username/";
      
      //set the full filePath to include the name of the file
      $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
      
      //upload flag
      $uploadOk = 1;
      
      //grab filetype
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["profilePic"]["tmp_name"]);
          if($check !== false) {
              //echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
              //echo "File is not an image.";
              $uploadOk = 0;
          }
      }
      
      //directory flag
      $dir_exists = true;
      //create the username's directory
      if (!is_dir($target_dir)) {
        mkdir('./user-images/' . $username, 0777, true);
      }
      // Check if file already exists
      if (file_exists($target_file)) {
          //echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["profilePic"]["size"] > 500000) {
          //echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
          //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          //echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["profilePic"]["name"]). " has been uploaded.";
            
            //create a new blogger object
            $newBlogger = new Blogger(0, $username, $name, 0, 0, '0000-00-00', $target_file, $bio);
            
            //pass the new blogger with email and password to Database
            $newId = $GLOBALS['blogsDB']->addUser($newBlogger, $email, $password1);
            
            //set guest to false
            $_SESSION['guest'] = false;
            
            //set session variable bloggerId to the Id of the new Blogger
            $_SESSION['bloggerId'] = $newId;
            
            //set route to /user-blogs
            $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/user-blogs?bloggerId=".$newId;
          } else {
              //echo "Sorry, there was an error uploading your file.";
              
              //remove the directory
              rmdir('./user-images/' . $username);
              
              //go back to the create new
              $route = "Location: http://jmccoy.greenrivertech.net/328/blogs/new";
          }
      }
    }
     
     return $route;
  }
  
  //}}}
    
  //{{{ /create, /insert, /edit, AND /delete FUNCTIONS
  
  /**
   * Create a new blog and insert it into the database
   *
   * @return        return the reroute path
   * @access public
   */
  function createBlog() {
    
    //scrub the data
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
    
    //grab the bloggerId
    $bloggerId = $_SESSION['bloggerId'];
    $blogPost = new BlogPost(0, $title, $blogEntry, date('Y-m-d H:i:s'));
    
    //send the bloggerId and the BlogPost object to the database
    $GLOBALS['blogsDB']->addBlog($bloggerId, $blogPost);
    
    //return to /user-blogs
    $route="Location: http://jmccoy.greenrivertech.net/328/blogs/user-blogs?bloggerId=$bloggerId";
    
    return $route;
  }
  
  /**
   * Delete blog by blogId.
   *
   * @param   int   blog's id
   * @access public
   */
  function deleteBlog($blogId) {
    if(isSet($blogId)) {
      $title = scrubData($blogId);
    }
    
    $GLOBALS['blogsDB']->deleteBlog($blogId);
  }
  
  /**
   * Get the Post Data of a specific blog by Id.
   * 
   * @param   Base      $f3         Fat-Free Framework Object
   * @param   int       $blogId     Blog's Id
   * @access public
   */
  function GetBlogPostData($f3, $blogId) {
    
    //scrub the data
    if(isSet($blogId)){
      $blogId = scrubData($blogId);
    }
    
    $results = $GLOBALS['blogsDB']->getPostById($blogId);
    
    $blogPost = new BlogPost($blogId, $results[0]['title'], $results[0]['blogPost'],
                             $results[0]['datePosted']);

    $f3->set('blogPost', $blogPost);
  }
  
  //}}}
  
  //{{{
  
  /**
   * @param   int      $blogId      Blog's Id
   * @param   string   $title       Blog's new title
   * @param   string   $blogEntry   Blog's new Post data
   * @access public
   */
  function updateBlog($blogId, $title, $blogEntry) {
    
    //scrub the data
    if(isSet($_POST['title'])) {
      $title = scrubData($title);
    } 
    if(isSet($_POST['blogEntry'])) {
      $blogEntry = scrubData($blogEntry);
    }
    
    //create BlogPost
    $blogPost = new BlogPost($blogId, $title, $blogEntry, date('Y-m-d H:i:s'));
  
    //send to database
    $GLOBALS['blogsDB']->updateBlog($blogPost);
  }
  
  //}}}
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  