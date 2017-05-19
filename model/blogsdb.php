<?php

  class BlogsDB
  {
    private $_pdo;
    
    function __construct()
    {
        //Require configuration file
        require_once '/home/jmccoy/blogs-config.php';
        
        try {
            //Establish database connection
            $this->_pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            
            //Keep the connection open for reuse to improve performance
            $this->_pdo->setAttribute( PDO::ATTR_PERSISTENT, true );
            
            //Throw an exception whenever a database error occurs
            $this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $e) {
            die( "Error!: " . $e->getMessage());
        }
    }
  }