<?php
  
  /*
   * Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
   * Date: 5/16/2017
   * Description: Controller for jmccoy.greenrivertech.net/328/blogs
   */
  
  //set the debug level
  error_reporting('E_ALL');
  
  //require the autoload file
  require_once("vendor/autoload.php");
  
  //start the session
  session_start();
  
  //Create an instance of the Base class
  $f3 = Base::instance();
  
  //Declare and instantiate the DB
  $blogsDB = new BlogsDB();
  
  //set some session variables
  $_SESSION['guest'];
  $usernav = 'includes/navbar-user.inc.html';
  $guestnav = 'includes/navbar-guest.inc.html';
  
  //Define a default route
  $f3->route('GET /', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
     
    //create the bloggers array to be pushed into
    $bloggers = array();
    
    //pull contents from the blogger database
    $dbResults = $GLOBALS['blogsDB']->getDBContents();
    
    include("includes/objectCreation.inc.php");
    
    //set $bloggers array as an f3 variable
    $f3->set('bloggers' , $bloggers);
    
    echo Template::instance()->render('view/home.html');
  });
  
  
  //define additional routes
  $f3->route('GET /user', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    //will be populated by following include
    $bloggers = array();
    
    //pull contents from the blogger database
    $dbResults = $GLOBALS['blogsDB']->getBloggerById($_GET['id']);
    
    include("includes/objectCreation.inc.php");
    
    //reverse order the posts so they can be easily iterated through
    $revPosts = array();
    if(!empty($bloggers[0]->getPostsArray())){
      $posts = $bloggers[0]->getPostsArray();
      for($i = count($posts)-1; $i >= 0; $i--){
        array_push($revPosts, $posts[$i]);
      }
    }
    
    $f3->set('blogger', $bloggers[0]);
    $f3->set('posts', $revPosts);
    
    echo Template::instance()->render('view/user.html');
  });
  
  
  $f3->route('GET /entry', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    $dbResults = $GLOBALS['blogsDB']->getPostById($_GET['blogId']);
    
    foreach($dbResults as $row){
      $post = new BlogPost($row['blogId'], $row['title'], $row['blogPost'],
                           $row['datePosted']);
    }
    
    $f3->set('profilePic', $dbResults[0]["profilePicPath"]);
    $f3->set('post', $post);
    
    echo Template::instance()->render('view/entry.html');
  });
  
  
  $f3->route('GET /about', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    echo Template::instance()->render('view/about.html');
  });
  
  
  $f3->route('GET /login', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    if(isSet($_SESSION['loginErr'])) {
      if($_SESSION['loginErr']['loginErr'] == -1) {
        $f3->set('usernameErr', 'Username cannot be blank.');
      } else if($_SESSION['loginErr']['loginErr'] == -2) {
        $f3->set('usernameErr', 'Username was incorrect.');
      } else {
        $f3->set('usernameErr', ' * username * ');
      }
      
      if($_SESSION['loginErr']['loginErr'] == -3) {
        $f3->set('passwordErr', 'Password was incorrect.');
      } else {
        $f3->set('passwordErr', ' * password * ');
      }
    }
    
    unset($_SESSION['loginErr']);
    
    echo Template::instance()->render('view/login.html');
  });
  
    
  $f3->route('POST /verify', function() {
      
    
    $loginToken = $GLOBALS['blogsDB']->checkUsername(trim
                                                     (strip_tags
                                                      (htmlspecialchars
                                                       (stripslashes
                                                        ($_POST['username'])))));
    
    if(isSet($loginToken)){
      if (isSet($loginToken[0])) {
        //Check error codes
        if($loginToken[2] < 0) {
          $loginErr = array("username" => $loginToken[0],
                            "password" => $loginToken[1],
                            "loginErr" => $loginToken[2]);
          $_SESSION['loginErr'] = $loginErr;
          
          header("Location: http://jmccoy.greenrivertech.net/328/blogs/login");
          exit();
        }
        
        $passwordCheck = $GLOBALS['blogsDB']->checkPassword($loginToken[3],(trim
                                                            (strip_tags
                                                             (htmlspecialchars
                                                              (stripslashes($_POST['password']))))));
        if (isSet($passwordCheck)) {
          if($passwordCheck == 0) {
            $_SESSION['guest'] = false;
          
            header("Location: http://jmccoy.greenrivertech.net/328/blogs");
            exit();
          }
        //}else{
        //  echo "<pre>";
        //  echo "something";
        //  echo var_dump($loginToken);
        //  echo "</pre>";
          $loginErr = array("username" => $loginToken[0],
                            "password" => $loginToken[1],
                            "loginErr" => $passwordCheck);
          $_SESSION['loginErr'] = $loginErr;
          header("Location: http://jmccoy.greenrivertech.net/328/blogs/login");
          exit();
        }
      }
    }
  });
  
  
  $f3->route('GET /new', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    echo Template::instance()->render('view/new-user.html');
  });
  
  
  $f3->route('GET /user-blogs', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    echo Template::instance()->render('view/user-blogs.html');
  });
  
  
  $f3->route('GET /create', function($f3) {
    
    //set guest to session variable because F3 doesn't do it will
    //and won't work without cache enabled
    if(isSet($_SESSION['guest']) && $_SESSION['guest'] == false){
      $f3->set('navbar', $GLOBALS['usernav']);
    }else{
      $f3->set('navbar', $GLOBALS['guestnav']);
    }
    
    echo Template::instance()->render('view/create.html');
  });
  
  
  $f3->route('GET /logout', function($f3){
    
    $_SESSION['guest'] = true;
    header("Location: http://jmccoy.greenrivertech.net/328/blogs");
  });
  
  //Run fat-free
  $f3->run();