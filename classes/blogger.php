<?php
  /* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
  
  /**
   * File defines the class for creating Blogger objects
   *
   * File defines the class for creating Blogger objects that contain
   * the bloggerId, username, name, blog count, most recent blog id,
   * the most recent blog date, filepath for the profile picture, and
   * the biography.
   *
   * PHP version 5
   *
   * @category   CategoryName
   * @package    PackageName
   * @author     Jonnathon McCoy <jmccoy11@mail.greenriver.edu>
   * @copyright  2017
   * @version    1.1
   */
  
  /**
   * Class for creating Blogger objects
   *
   * Class for creating Blogger objects that contain
   * the bloggerId, username, name, blog count, most recent blog id,
   * the most recent blog date, filepath for the profile picture, and
   * the biography.
   *
   * @category   CategoryName
   * @package    PackageName
   * @author     Jonnathon McCoy <jmccoy11@mail.greenriver.edu>
   * @copyright  2017
   * @version    1.1
   */
  class Blogger
  {
    //{{{ properties
    
    private
      $_bloggerId,
      $_username,
      $_name,
      $_blogCount,
      $_mostRecentBlogId,
      $_mostRecentBlogDate,
      $_profilePicPath,
      $_bio;
      
    private $_posts=array();
    
    //}}}
    
    //{{{ __construct()
    
    /**
     * Constructor for the Blogger Class.
     *
     * @param int     $bloggerId            Blogger Id from the database
     * @param string  $username             Blogger's username
     * @param string  $age                  Blogger's name
     * @param int     $blogCount            How many blogs the Blogger has made
     * @param int     $mostRecent           The Id of the most recent blog the Blogger has made
     * @param string  $mostRecentBlogDate   The date the most recent blog was made
     * @param string  $profilePic           The path name for the profile picture
     * @param bio     $bio                  The biography of the blogger
     * @access public
     */  
    function __construct($bloggerId=0, $username="", $name="", $blogCount=0,
                         $mostRecent=0, $mostRecentBlogDate = "0000-00-00", $profilePic="",
                         $bio="")
    {
      
      $this->_bloggerId = $bloggerId;
      $this->_username = $username;
      $this->_name = $name;
      $this->_blogCount = $blogCount;
      $this->_mostRecentBlogId = $mostRecent;
      $this->_mostRecentBlogDate = $mostRecentBlogDate;
      $this->_profilePicPath = $profilePic;
      $this->_bio = $bio;
      
    }
    
    //}}}
    
    //{{{ getId()
    
    /**
     * Getter for bloggerId.
     *
     * @return int  The blogger Id from the database
     * @access public
     */
    function getId()
    {
      return $this->_bloggerId;
    }
    
    //}}}
    
    //{{{ getUsername()
    
    /**
     * Getter for username
     *
     * @return string   The blogger's username.
     * @access public
     */    
    function getUsername()
    {
      return $this->_username;
    }
    
    //}}}
    
    //{{{ getName()
    
    /**
     * Getter for name
     *
     * @return string   Blogger name.
     * @access public
     */
    function getName()
    {
      return $this->_name;
    }
    
    //}}}
    
    //{{{ getBlogCount()
    
    /**
     * Getter for blog count.
     *
     * @return int    How many blogs this blogger has made
     * @access public
     */    
    function getBlogCount()
    {
      return $this->_blogCount;
    }
    
    //}}}
    
    //{{{incrementBlogCount()
    
    /**
     * Increment Blog count by one
     *
     * @access public
     */
    function incrementBlogCount()
    {
      $this->_blogCount++;
    }
    
    //}}}
    
    //{{{ decrementBlogCount
    
    /**
     * Decrease blog count by one
     *
     * @access public
     */
    function decrementBlogCount()
    {
      $this->_blogCount--;
    }
    
    //}}}
    
    //{{{ getMostRecent()
    
    /**
     * Get the blogId for the most recent post made by this blogger
     *
     * @return int    the blog id for the most recent post made by this blogger
     * @access public
     */    
    function getMostRecent()
    {
      return $this->_mostRecentBlogId;
    }
    
    //}}}
    
    //{{{ setMostRecent
    
    /**
     * Setter the most recent post made by this blogger to the id passed to the function
     *
     * @param int   $mostRecentBlogId   Blog id for the most recent post made by this blogger
     * @access public
     */
    function setMostRecent($mostRecentBlogId)
    {
      $this->_mostRecentBlogId = $mostRecentBlogId;
    }
    
    //}}}
    
    //{{{ getMostRecentBlogDate()
    
    /**
     * Getter the date for the most recent blog made. Format is returned as YYYY-mm-dd.
     *
     * @return string   The date for the most recent post made by this blogger
     * retruns as a string with the following format 'YYYY-mm-dd'
     *@access public
     */
    function getMostRecentBlogDate()
    {
      return $this->_mostRecentBlogDate;
    }
    
    //}}}
    
    //{{{ getPath()
    
    /**
     * Getter for the file path for the blogger's profile picture
     *
     * @return string   The file path for the blogger's profile pic
     * @access public
     */
    function getPath()
    {    
      return $this->_profilePicPath;
    }
    
    //}}}
    
    //{{{ setPath()
    
    /**
     * Setter for the file path for the blogger's profile picture
     *
     * @param string  $profilePicPath     filepath name for the blogger's profile picture
     * @access public
     */
    function setPath($profilePicPath)
    {
      $this->_profilePicPath = $profilePicPath;
    }
    
    //}}}
    
    //{{{ getBio()
    
    /**
     * Getter for the blogger's biography
     *
     * @return  string    The blogger's biography
     * @access public
     */
    function getBio()
    {
      return $this->_bio;
    }
    
    //}}}
    
    //{{{ setBio()
    
    /**
     * Setter for the blogger's biography
     *
     * @param string   $bio   The new blogger's biography
     */
    function setBio($bio)
    {
      $this->_bio = $bio;
    }
    
    //}}}
    
    //{{{ getPostsArray()
    
    /**
     * Getter for the posts array that stores all the posts this
     * blogger has made (yes, terrible design, I know but this is
     * a toy project)
     *
     * @return Array  Array of posts made by this blogger
     * @access public
     */
    function getPostsArray()
    {
      return $this->_posts;
    }
    
    //}}}
    
    //{{{ addPost()
    
    /**
     * Add post to the posts array
     *
     * @param BlogPost  $blogPost     Blog post to push to the posts array.
     * @access public
     */
    function addPost($blogPost)
    {
      array_push($this->_posts, $blogPost);
    }
    
    //}}}
  }