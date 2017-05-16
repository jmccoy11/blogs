<?php
  
  /*
   * Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
   * Date: 5/16/2017
   * Description: Controller for jmccoy.greenrivertech.net/328/blogs
   */
  
  //require the autoload file
  require_once("vendor/autoload.php");
  
  //start the session in case we need it
  session_start();
  
  //Create an instance of the Base class
  $f3 = Base::instance();
  
  //set the debug level
  $f3->set('DEBUG', 3);
  
  //declare and instantiate the database model
//TODO: database connection after model is created.

  //Define a default route
  $f3->route('GET /', function() {
    $view = new View;
    echo $view->render
      ('view/home.html');
  });
  
  //define additional routes
  
  //Run fat-free
  $f3->run();