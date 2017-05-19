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
    
    function getDBContents()
    {
      //Define Query
      $query = "SELECT * FROM bloggers";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
      return $results;
    }
    
    function getBlogger($bloggerId)
    {
      //Define Query
      $query = "SELECT * FROM bloggers WHERE bloggerId = $bloggerId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
      return $results;
    }
    
    function getAllPosts($bloggerId)
    {
      //Define Query
      $query = "SELECT blogs.blogId, title, blogPost, datePosted FROM blogs
                  JOIN blogger_to_blogs_junct
                    ON blogs.blogId = blogger_to_blogs_junct.blogId
                  WHERE
                    bloggerId = $bloggerId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
      return $results;
    }
    
    
  }