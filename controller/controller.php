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
  $f3->set('guest', false);

  //Define a default route
  $f3->route('GET /', function($f3) {
    
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

    //will be populated by following include
    $bloggers = array();
    
    //pull contents from the blogger database
    $dbResults = $GLOBALS['blogsDB']->getBlogger($_GET['id']);
    
    include("includes/objectCreation.inc.php");
    
    //reverse order the posts so they can be easily iterated through
    $revPosts = array();
    if(!empty($bloggers[0]->getPosts()))
    {
      $posts = $bloggers[0]->getPosts();
      for($i = count($posts)-1; $i >= 0; $i--)
      {
        array_push($revPosts, $posts[$i]);
      }
    }
    
    $f3->set('blogger', $bloggers[0]);
    $f3->set('posts', $revPosts);
    
    //echo '<pre>';
    //  //echo print_r(end($dbBlogger->getPosts()));
    //  var_dump($revPosts);
    //  echo '</pre>';
    
    
    echo Template::instance()->render('view/user.html');
  });
  
  $f3->route('GET /entry', function($f3)
  {
    $f3->set('entry', array('id' =>
                              1,
                            'name' =>
                              'Joe Schmoe',
                            'profilePic' =>
                              'images/user.png',
                            'blogId' =>
                              $_GET['blogId'],
                            'blogTitle' =>
                              'In the words of Abraham Lincoln',
                            'entryData' =>
                              'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
                                pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
                                Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
                                Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
                                eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
                                magna. Curabitur convallis auctor lectus, quis tincidunt mauris.')
             );
    
    
    echo Template::instance()->render('view/entry.html');
  });
  
  $f3->route('GET /about', function($f3)
  {
    echo Template::instance()->render('view/about.html');
  });
  
  $f3->route('GET /login', function($f3)
  {
    echo Template::instance()->render('view/login.html');
  });
  
  $f3->route('GET /new', function($f3)
  {
    echo Template::instance()->render('view/new-user.html');
  });
  
  $f3->route('GET /user-blogs', function($f3)
  {
    echo Template::instance()->render('view/user-blogs.html');
  });
  
  $f3->route('GET /create', function($f3)
  {
    echo Template::instance()->render('view/create.html');
  });
  
  //Run fat-free
  $f3->run();