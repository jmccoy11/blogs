<?php

class Blogger
{
  private $_name,
    $_email,
    $_blogCount,
    $_mostRecentBlogId,
    $_bio;
    
  private $_blogs=array("blogId" => "blogPost");
  
  function __construct($name = "", $blogCount=0, $_mostRecent=0, $bio="", $email="")
  {
    $this->_name = $name;
    $this->_blogCount = $blogCount;
    $this->_mostRecentBlogId = $mostRecent;
    $this->_bio = $bio;
    $this->_email = $email;
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
  
  function setMostRecentBlogId($mostRecentBlogId)
  {
    $this->_mostRecentBlogId = $mostRecentBlogId;
  }
  
  function getBio()
  {
    return $this->_bio;
  }
  
  function setBio($bio)
  {
    $this->_bio = $bio;
  }
  
  function getEmail()
  {
    return $this->_email;
  }
  
  function setEmail($email)
  {
    $this->_email = $email;
  }
}