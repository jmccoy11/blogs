<?php

class BlogPost
{
  private $_blogId,
    $_title,
    $_blogPost,
    $_datePosted,
    $_wordCount;
    
    function __construct($blogId=0, $title="", $blogPost="", $datePosted="")
    {
      $this->_blogId = $blogId;
      $this->_title = $title;
      $this->_blogPost = $blogPost;
      $this->_datePosted = date('Y/m/d', strtotime($datePosted));
      $this->_wordCount = str_word_count($blogPost);
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
    
    function getPost()
    {
      return $this->_blogPost;
    }
    
    function setPost($blogPost)
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
    
    function getWordCount()
    {
      return $this->_wordCount;
    }
}