<?php
  
  //for each line in the in the query
  foreach($dbResults as $blogger)
  {
    //create a new blogger object from the data
    $dbBlogger = new Blogger($blogger['bloggerId'], $blogger['username'], $blogger['name'],
                           $blogger['blogCount'], $blogger['mostRecentBlogId'],
                           $blogger['mostRecentBlogDate'], $blogger['profilePicPath'],
                           $blogger['bio']);
  
    //get the posts from that user from blogs database
    $postsResults = $GLOBALS['blogsDB']->getAllPosts($dbBlogger->getId());
    
    //for each post by this blogger
    foreach($postsResults as $post)
    {
      //create a new blog object from the data
      $dbBlogger->addPost(new BlogPost($post['blogId'], $post['title'], $post['blogPost'],
                                       $post['datePosted']));
    }
    
    if(!empty($dbBlogger->getPostsArray()))
    {
      //set the most Recent blog to the last one in the Blogger _posts array
      $dbBlogger->setMostRecent(end($dbBlogger->getPostsArray())->getPost());
    }
    
    //push the $dbBlogger object into $bloggers array
    array_push($bloggers, $dbBlogger);
  }