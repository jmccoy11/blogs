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
    
    function addUser($blogger, $email, $password)
    {
      /*
       * Insert into Users
       */
      //Define Query
      $query = "INSERT INTO users (username, email, password)
              VALUES (:username, :email, :password)";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':username', $blogger->getUsername(), PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', sha1($password), PDO::PARAM_STR);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $bloggerId = $this->_pdo->lastInsertId();
      
      /*
       * Insert into bloggers
       */
      $query = "INSERT INTO bloggers VALUES (:bloggerId, :username, :name, :blogCount,
        :mostRecentBlogId, :profilePicPath, :bio)";
        
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':bloggerId', $bloggerId, PDO::PARAM_INT);
      $statement->bindParam(':username', $blogger->getUsername(), PDO::PARAM_STR);
      $statement->bindParam(':name', $blogger->getName(), PDO::PARAM_STR);
      $statement->bindParam(':blogCount', $blogger->getBlogCount(), PDO::PARAM_INT);
      $statement->bindParam(':mostRecentBlogId', $blogger->getMostRecent(), PDO::PARAM_INT);
      $statement->bindParam(':profilePicPath', $blogger->getPath(), PDO::PARAM_STR);
      $statement->bindParam(':bio', $blogger->getBio(), PDO::PARAM_STR);
      
      //Execute Statement
      $statement->execute();
      
      return $bloggerId;
    }
    
    function getBloggerById($bloggerId)
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
    
    function getPostByID($blogId)
    {
      $query = "SELECT bloggers.bloggerId, blogs.blogId, blogs.title, blogs.blogPost,
          blogs.datePosted, bloggers.profilePicPath
            FROM blogs
            JOIN blogger_to_blogs_junct
              ON blogs.blogId = blogger_to_blogs_junct.blogId
            JOIN bloggers
              ON blogger_to_blogs_junct.bloggerId = bloggers.bloggerId
            WHERE blogs.blogId = $blogId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      
      return $results;
    }
    
    function checkUsername($username)
    {
      if($username == "" || $username == NULL)
      {
        //array( username, errorCode, userId )
        return array($username, -1, -1);
      }
      
      $query = "SELECT userId, username FROM users";
      
       //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      $valid = array($username, -2, -1);
      
      foreach($results as $row)
      {
        if($row['username'] == $username)
        {
          $valid = array($username, 0, $row['userId']);
        }
      }
      
      return $valid;
    }
    
    function checkPassword($bloggerId, $password)
    {
      $query = "SELECT userId, password FROM users WHERE userId = $bloggerId";
      
       //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      $dbPassword = $results[0]['password'];
      
      foreach($results as $row)
      {
        if($dbPassword == sha1($password))
        {
          return 0;
        }
      }
      
      /*
       *errorcode -1 is blank username,
       *errorcode -2 is incorrect username,
       *errorcode -3 is incorrect password
       */
      return -3; 
    }
  }