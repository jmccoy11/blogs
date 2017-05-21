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
  require_once("includes/controller-logic.inc.php");
  
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
    
    loadNavbar($f3);
    createObjects($f3, "all");
    
    echo Template::instance()->render('view/home.html');
  });
  
  
  //define additional routes
  $f3->route('GET /user', function($f3) {
    
    loadNavbar($f3);
    $bloggers = createObjects($f3, "user");
    reversePosts($f3, $bloggers);
    
    echo Template::instance()->render('view/user.html');
  });
  
  
  $f3->route('GET /entry', function($f3) {
    
    loadNavbar($f3);
    getEntry($f3);
    
    echo Template::instance()->render('view/entry.html');
  });
  
  
  $f3->route('GET /about', function($f3) {
    
    loadNavbar($f3);
    
    echo Template::instance()->render('view/about.html');
  });
  
  
  $f3->route('GET /login', function($f3) {
    
    loadNavbar($f3);
    loginErrors($f3);
    
    echo Template::instance()->render('view/login.html');
  });
  
    
  $f3->route('POST /verify-login', function() {
      
    $route = verifyLogin();
    
    header("$route");
    exit();    
  });
  
  
  $f3->route('GET /new', function($f3) {
    
    loadNavbar($f3);
    newUserErrors($f3);
    
    echo Template::instance()->render('view/new-user.html');
  });
  
  
  $f3->route('POST /verify-new-user', function() {
    
    $route = verifyNewUser($f3);
    
    header("$route");
    exit();
  });
  
  
  $f3->route('GET /user-blogs', function($f3) {
    
    loadNavbar($f3);
    $bloggers = createObjects($f3, "user");
    reversePosts($f3, $bloggers);
    
    echo Template::instance()->render('view/user-blogs.html');
  });
  
  
  $f3->route('GET /create', function($f3) {
    
    loadNavbar($f3);
    
    echo Template::instance()->render('view/create.html');
  });
  
  
  $f3->route('POST /insert', function($f3)) {
    
    $route = insertToDatabase();
    
    header("$route");
    exit();
  }
  
  
  $f3->route('GET /edit', function($f3) {
    
    loadNavbar($f3);
    
    echo Template::instance()->render('view/edit.html');
  });
  
  $f3->route('GET /delete', function($f3) {
    
    
  });
  
  $f3->route('GET /logout', function($f3){
    
    unset($_SESSION['bloggerId']);
    $_SESSION['guest'] = true;
    header("Location: http://jmccoy.greenrivertech.net/328/blogs");
  });
  
  //Run fat-free
  $f3->run();