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
    foreach($postsResults as $post) {
      if(strlen($post['blogPost']) > 150) {
        $truncated = nl2br(substr($post['blogPost'], 0, 150) . "...");
        $post['blogPost'] = $truncated;
      } else {
        $post['blogPost'] = nl2br($post['blogPost']);
      }
      
      $testStr = $post['blogPost'];
      $brCount = 0;
      $brCountThreshold = 5;
      $breakPos;
      $tagLen = strlen("<br />");
      
      $tagPosition = stripos($testStr, '<br />');
      while(true) {
        //if the position found starts at index zero of the string
        if($tagPosition === 0) {
          //if the new breakPosition doesn't go beyond the length of the string
          if($breakPos + $tagLen < strlen($testStr)) {
            //increase the $breakPosition by the length of the tag
            $breakPos = $breakPos + $tagLen;
            //restructure the testString to only be the rest of the string
            $testStr = substr($testStr, $tagLen, strlen($testStr)-1);
            //Increase the <br> tag count
            $brCount++;
            //rerun the strpos
            $tagPosition = stripos($testStr, '<br />');
          }
          //else make the breakPosition equal to the length of the string
          else {
            $breakPos = strlen($testStr)-1;
            break;
          }
        }
        //else if the tag is somewhere else in the string
        else if($tagPosition !== false) {
          //increase the breakPosition by the position of the tagPosition
          $breakPos = $breakPos + $tagPosition;
          //restructure the testString to only be the rest of the string
          $testStr = substr($testStr, $tagPosition, strlen($testStr)-1);
          //Increase the <br> tag count
          $brCount++;
          //rerun the strpos
          $tagPosition = stripos($testStr, '<br />');
        }
        //if neither of these two thing happened, then there are no more
        //occurences of the tag
        else {
          //if the breakCount wasn't increased beyond the threshold then
          //make the breakPosition equal to the length of the string
          if ($brCount < $brCountThreshold) {
            $breakPos = strlen($testStr)-1;
            break;
          }
        }
        if ($brCount >= $brCountThreshold) {
          break;
        }
      }
      
      if($breakPos > 0 && $breakPos < strlen($post['blogPost'])) {
        $post['blogPost'] = substr($post['blogPost'], 0, $breakPos) . "...";
      } else {
        $post['blogPost'] = substr($post['blogPost'], 0, $breakPos);
      }
      
      //create a new blog object from the data
      $dbBlogger->addPost(new BlogPost($post['blogId'], $post['title'], $post['blogPost'],
                                       $post['datePosted']));
    }
    
    if(!empty($dbBlogger->getPostsArray())) {
      //set the most Recent blog to the last one in the Blogger _posts array
      $dbBlogger->setMostRecent(end($dbBlogger->getPostsArray())->getPost());
    }
    
    //push the $dbBlogger object into $bloggers array
    array_push($bloggers, $dbBlogger);
  }