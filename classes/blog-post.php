<?php

class BlogPost
{
  private $_blogId,
    $_title,
    $_blogPost,
    $_datePosted;
    
    function __construct($blogId=0, $title="", $blogPost="", $datePosted="")
    {
      $this->_blogId = $blogId;
      $this->_title = $title;
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
    
    function getTitle()
    {
      return $this->_title;
    }
    
    function setTitle($title)
    {
      $this->_title = $title;
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