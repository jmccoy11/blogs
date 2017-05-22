<?php
  /* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
  
  /**
   * File defines the class for creating Blog Post objects that contain
   * the id, title, post, date posted, and word count.
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
   * Class for creating a Blog Post
   *
   * Blog Posts will consist of the blog Id, the title of the Blog, the
   * actual post from the user, the date it was posted, and its word
   * count which is populated on creation of a BlogPost object.
   *
   * @category   CategoryName
   * @package    PackageName
   * @author     Jonnathon McCoy <jmccoy11@mail.greenriver.edu>
   * @copyright  2017
   * @version    1.1
   */
class BlogPost
{
  //{{{ properties
 
  private $_blogId,
    $_title,
    $_blogPost,
    $_datePosted,
    $_wordCount;
    
    //}}}
    
    //{{{ __construct()
    
    /**
     * Constructor for the BlogPost Class.
     *
     * @param int     $blogId     Blog Id Post in database
     * @param string  $title      Blog title
     * @param string  $blogPost   The User's post
     * @param string  $datePosted  Date when posted to database
     *
     * @access public
     */
    function __construct($blogId=0, $title="", $blogPost="", $datePosted="")
    {
      $this->_blogId = $blogId;
      $this->_title = $title;
      $this->_blogPost = $blogPost;
      $this->_datePosted = date('Y/m/d', strtotime($datePosted));
      $this->_wordCount = str_word_count($blogPost);
    }
    
    //}}}
    
    //{{{ getBlogId()
    
    /**
     * Retrieve the Blog's Id number.
     *
     @return int  The blog Id in the database
     @access public
     */
    function getBlogId()
    {
      return $this->_blogId;
    }
    
    //}}}
    
    //{{{ getTitle()
    
    /**
     *  Getter for the title.
     *  
     * @return string  Blog title
     * @access public
     */
    function getTitle()
    {
      return $this->_title;
    }
    
    //}}}
    
    //{{{ setTitle()
    
    /**
     * Setter for title
     *
     * @param string  $title  new title
     * @access public
     */
    function setTitle($title)
    {
      $this->_title = $title;
    }
    
    //}}}
    
    //{{{ getPost()
    
    /**
     * Getter for the post data
     *
     * @return  string  the user's post
     * @access public
     */ 
    function getPost()
    {
      return $this->_blogPost;
    }
    
    //}}}
    
    //{{{ getPost()
    
    /**
     * Setter for Post
     *
     * @param  string  $blogPost  New data for post
     * @access public
     */
    function setPost($blogPost)
    {
      $this->_blogPost = $blogPost;
    }
    
    //}}}
    
    //{{{ getDatePosted()
    
    /**
     * Getter for the date blog was posted.
     *
     * @return  string  Date posted. From database this
     * is formated as YYYY-mm-dd
     * @access public
     */
    function getDatePosted()
    {
      return $this->_datePosted;
    }
    
    //}}}
    
    //{{{ setDatePosted()
    
    /**
     * Setter for date posted
     *
     * @param string  $datePosted   New date for posted. Will update if
     * blog has been edited. Format needs to be YYY-mm-dd
     * @access pulic
     */
    function setDatePosted($datePosted)
    {
      $this->_datePosted = $datePosted;
    }
    
    //}}}
    
    //{{{ getWordCount
    
    /**
     * Getter for Word Count.
     *
     @return  int returns the word count of the blog post
     @access public
     */
    function getWordCount()
    {
      return $this->_wordCount;
    }
}