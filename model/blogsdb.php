<?php
  /**
   * Provides CRUD access to My Dating Website Database
   *
   * PHP version 5
   *
   * Table creation sql query:
   *
    CREATE TABLE users
    (
      userId        INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
      username      VARCHAR(40)  NOT NULL,
      email         VARCHAR(255)  NOT NULL,
      password      VARCHAR(50)   NOT NULL
    );
    
    CREATE TABLE bloggers
    (
      bloggerId           INT NOT NULL PRIMARY KEY,
      username            VARCHAR(40)   NOT NULL,
      name                VARCHAR(40)   NOT NULL,
      blogCount           INT,
      mostRecentBlogId    INT,
      mostRecentBlogDate  DATE,
      profilePicPath      VARCHAR(255),
      bio                 VARCHAR(1000),
      
      FOREIGN KEY (bloggerId) REFERENCES users(userId)
    );
    
    CREATE TABLE blogs
    (
      blogId      INT   NOT NULL AUTO_INCREMENT PRIMARY KEY,
      title       VARCHAR(255),
      blogPost    VARCHAR(1000),
      datePosted  DATE,
      wordCount   INT
    );
    
    CREATE TABLE blogger_to_blogs_junct
    (
      bloggerId   INT,
      blogId      INT,
      
      FOREIGN KEY (bloggerId) REFERENCES bloggers(bloggerId),
      FOREIGN KEY (blogId) REFERENCES blogs(blogId)
    );
    
    
   * @category   CategoryName
   * @package    PackageName
   * @author     Jonnathon McCoy <jmccoy11@mail.greenriver.edu>
   * @copyright  2017
   * @version    1.0
   */
   */
  class BlogsDB
  {
    /**
     * PHP Data Object
     */
    private $_pdo;
    
    // {{{ __construct()
    
    /**
     * Constructor for the DatingDB Class
     *
     * @access public
     */
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
    
    //}}}
    
    //{{{ getDBContents()
    
    /**
     * Retrieve the bloggers from the database and order them by the
     * most recent posting date
     *
     * @return Array  Returns all the bloggers from the database ordered
     * by the most recent posting date
     * @access public
     */
    function getDBContents()
    {
      //Define Query
      $query = "SELECT * FROM bloggers ORDER BY mostRecentBlogDate DESC";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Retrieve Results
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
      return $results;
    }
    
    //}}}
    
    //{{{ addUser()
    
    /**
     * Adds a new user to the users table and inserts a new Blogger into
     * the bloggers table
     *
     * @param  Blogger   $blogger      Blogger object with the necessary data to create a new
     *                                 default blogger object in the database
     * @param  string    $email        Email address for the user
     * @param  string    $password     unencrypted password
     * @return int       The ID created by the database for the new Blogger
     * @access public
     */
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
        :mostRecentBlogId, :mostRecentBlogDate, :profilePicPath, :bio)";
        
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':bloggerId', $bloggerId, PDO::PARAM_INT);
      $statement->bindParam(':username', $blogger->getUsername(), PDO::PARAM_STR);
      $statement->bindParam(':name', $blogger->getName(), PDO::PARAM_STR);
      $statement->bindParam(':blogCount', $blogger->getBlogCount(), PDO::PARAM_INT);
      $statement->bindParam(':mostRecentBlogId', $blogger->getMostRecent(), PDO::PARAM_INT);
      $statement->bindParam(':mostRecentBlogDate', $blogger->getMostRecentBlogDate(),
                            PDO::PARAM_STR);
      $statement->bindParam(':profilePicPath', $blogger->getPath(), PDO::PARAM_STR);
      $statement->bindParam(':bio', $blogger->getBio(), PDO::PARAM_STR);
      
      //Execute Statement
      $statement->execute();
      
      return $bloggerId;
    }
    
    //}}}
    
    //{{{ addBlog()
    
    /**
     * Add a new Blog to the blogs table and add to the bloggers_to_blogs_junct table
     *
     * @param   int       $bloggerId      Blogger Id.
     * @param   BlogPost  $blogPost       BlogPost Object with the necessary data
     * @access public
     */
    function addBlog($bloggerId, $blogPost)
    {
      $query = "INSERT INTO blogs (title, blogPost, datePosted, wordCount)
        VALUES (:title, :blogPost, :datePosted, :wordCount)";
        
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':title', $blogPost->getTitle(), PDO::PARAM_STR);
      $statement->bindParam(':blogPost', $blogPost->getPost(), PDO::PARAM_STR);
      $statement->bindParam(':datePosted', $blogPost->getDatePosted(), PDO::PARAM_STR);
      $statement->bindParam(':wordCount', $blogPost->getWordCount(), PDO::PARAM_INT);
      
      //Execute Statement
      $statement->execute();
      
      $blogId = $this->_pdo->lastInsertId();
      
      $query = "INSERT INTO blogger_to_blogs_junct VALUES (:bloggerId, :blogId)";
        
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':bloggerId', $bloggerId, PDO::PARAM_INT);
      $statement->bindParam(':blogId', $blogId, PDO::PARAM_INT);
      
      //Execute Statement
      $statement->execute();
      
      $query = "UPDATE bloggers SET
        mostRecentBlogDate = :blogDate,
        blogCount = blogCount +1
        WHERE bloggerId = $bloggerId";
        
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':blogDate', $blogPost->getDatePosted(), PDO::PARAM_STR);
      
      //Execute Statement
      $statement->execute();
    }
    
    //}}}
    
    //{{{ updateBlog()
    
    /**
     * Update the blogPost with a new title and/or blog data.
     *
     * @param   BlogPost    $blogPost     The new blogPost object that contains the necessary data
     * @access public
     */
    function updateBlog($blogPost) {
      
      $query = "UPDATE blogs SET
        title = :title,
        blogPost = :blogPost
        WHERE blogId = :blogId";
        
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Bind Parameters
      $statement->bindParam(':title', $blogPost->getTitle(), PDO::PARAM_STR);
      $statement->bindParam(':blogPost', $blogPost->getPost(), PDO::PARAM_STR);
      $statement->bindParam(':blogId', $blogPost->getBlogId(), PDO::PARAM_INT);
      
      //Execute Statement
      $statement->execute();
    }
    
    //}}}
    
    //{{{ getBloggerId()
    
    /*
     * Get the blogger by the blogger's id.
     *
     * @param   int    $bloggerId      Blogger's Id.
     * @return  Array  Row data that matches the blogger
     * @access public
     */    
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
    
    //}}}
    
    //{{{ getAllPosts()
    
    /**
     * Get all the posts that belong to a blogger.
     *
     * @param     int     $bloggerId      Blogger's Id
     * @return    Array   Returns rows of posts that match the blogger's Id
     * @access public
     */
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
    
    //}}}
    
    //{{{ getPostById
    
    /**
     * Get Post that matches it's blogId.
     *
     * @param     int     $blogId      The BlogPost's Id
     * @return    Array   The Row that matches the Blog's Id.
     * @access public
     */    
    function getPostByID($blogId)
    {
      //Define query
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
    
    //}}}
    
    //{{{ deleteBlog()
    
    /**
     * Delete blog by it's blog id.
     *
     * @param   int     $blogId     Blog's Id
     * @access public 
     */
    function deleteBlog($blogId)
    {
      //Define query
      $query = "DELETE FROM blogs WHERE blogId = $blogId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Define query
      $query = "SELECT bloggerId FROM blogger_to_blogs_junct WHERE blogId = $blogId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      $results = $statement->fetch(PDO::FETCH_ASSOC);
      
      $bloggerId = $results['bloggerId'];
      
      //Define query
      $query = "UPDATE bloggers SET
      blogCount = blogCount -1,
      mostRecentBlogDate = '0000-00-00' WHERE bloggerId = $bloggerId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
      
      //Define query
      $query = "DELETE FROM blogger_to_blogs_junct WHERE blogId = $blogId";
      
      //Prepare statement
      $statement = $this->_pdo->prepare($query);
      
      //Execute Statement
      $statement->execute();
    }
    
    //}}}
    
    //{{{ checkUsername()
    
    /**
     * Check that the username is not blank or NULL. If username is blank or null,
     * return an array with the username, an error code of -1, and a -1 for the userId.
     *
     * Then check if the username equals one in the database. If this check returns true,
     * return an array with the username, the error code of 0, and the userId.
     *
     * Otherwise, return the username, an error Code of -2, and a -1 for the userId.
     *
     * These two error codes can be evaluated to mean username is empty, null, or does
     * not exist in the database.
     *
     * @param   string    $username    the username to search the database for
     * @return  Array     Returns the username, an error code of 0, -1, or -2, and the userId
     *                    which may be -1 if username was empty or wasn't found in the database
     * @access public
     */
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
    
    //}}}
    
    //{{{ checkPassword()
    
    /**
     * Checks that the password matches the one stored for the bloggerId
     *
     * @param   int     $bloggerId     bloggerId of the blogger attempting to sign in
     * @param   string  $password      the password to be checked
     * @return  int     if the password matches the one in the database for the
     *                  bloggerId, return a zero, else return a -3.
     * @access public
     */
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
      
      //compare the passwords and encrypt the password with sha1
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
    
    //}}}
  }