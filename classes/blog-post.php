<?php

class BlogPost
{
  private $_blogId,
    $_blogPost,
    $_datePosted;
    
    function __construct($blogId=0, $blogPost="", $datePosted="")
    {
      $this->_blogId = $blogId;
      $this->_blogPost = $blogPost;
      $this->_datePosted = $datePosted;
    }
    
    function getBlogId()
    {
      return $this->_blogId;
    }
    
    function setBlogId($blogId)
    {
      $this->_blogId = $blogId;
    }
    
    function getBlogPost()
    {
      return $this->_blogPost;
    }
    
    function setBlogPost($blogPost)
    {
      $this->_blogPost = $blogPost;
    }
    
    function getDatePosted()
    {
      return $this->_datePosted;
    }
    
    function setDatePosted($datePosted)
    {
      $this->_datePosted = $datePosted;
    }
}