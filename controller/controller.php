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
  
  //set some session variables
  $f3->set('guest', false);
  
  //declare and instantiate the database model
//TODO: database connection after model is created.

  //Define a default route
  $f3->route('GET /', function($f3) {
    
    /* TEMPORARY VARIABLE: BE SURE TO DELETE OR CHANGE!!! */
    $f3->set('loop', array( 'id' =>
                              1,
                            'name' =>
                              'Joe Schmoe Blogger',
                            'postsCount' =>
                              10,
                            'profilePic' =>
                              'images/user.png',
                            'latestPost' =>
                              'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
                                pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
                                Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
                                Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
                                eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
                                magna. Curabitur convallis auctor lectus, quis tincidunt mauris.')
            );
    
    echo Template::instance()->render('view/home.html');
  });
  
  //define additional routes
  $f3->route('GET /user', function($f3) {
    $f3->set('user', array( 'id' =>
                              $_GET['id'],
                            'name' =>
                              'Joe Schmoe',
                            'postsCount' =>
                              10,
                            'profilePic' =>
                              'images/user.png',
                            'latestPost' =>
                              'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
                                pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
                                Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
                                Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
                                eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
                                magna. Curabitur convallis auctor lectus, quis tincidunt mauris.')
            );
    
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
                              $_GET['blogid'],
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
  
  //Run fat-free
  $f3->run();