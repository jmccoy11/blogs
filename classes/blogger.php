<?php

class Blogger
{
  private
    $_bloggerId,
    $_username,
    $_name,
    $_blogCount,
    $_mostRecentBlogId,
    $_profilePicPath,
    $_bio;
    
  private $_posts=array();
  
  function __construct($bloggerId=0, $username="", $name="", $blogCount=0,
                       $mostRecent=0, $profilePic="", $bio="")
  {
    
    $this->_bloggerId = $bloggerId;
    $this->_username = $username;
    $this->_name = $name;
    $this->_blogCount = $blogCount;
    $this->_mostRecentBlogId = $mostRecent;
    $this->_profilePicPath = $profilePic;
    $this->_bio = $bio;
    
  }
  
  function getId()
  {
    return $this->_bloggerId;
  }
  
  function setId()
  {
    return $this->_bloggerId;
  }
  
  function getUsername()
  {
    return $this->_username;
  }
  
  function getName()
  {
    return $this->_name;
  }
  
  function getBlogCount()
  {
    return $this->_blogCount;
  }
  
  function incrementBlogCount()
  {
    $this->_blogCount++;
  }
  
  function decrementBlogCount()
  {
    $this->_blogCount--;
  }
  
  function getMostRecent()
  {
    return $this->_mostRecentBlogId;
  }
  
  function setMostRecent($mostRecentBlogId)
  {
    $this->_mostRecentBlogId = $mostRecentBlogId;
  }
  
  function getPath()
  {    
    return $this->_profilePicPath;
  }
  
  function setPath($profilePicPath)
  {
    $this->_profilePicPath = $profilePicPath;
  }
  
  function getBio()
  {
    return $this->_bio;
  }
  
  function setBio($bio)
  {
    $this->_bio = $bio;
  }
  
  function getPostsArray()
  {
    return $this->_posts;
  }
  
  function addPost($blogPost)
  {
    array_push($this->_posts, $blogPost);
  }
}