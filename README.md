Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
Project Name: Blogs Assignment
Date: 5/22/2017



Purpose:
Create a blog site for demonstrating knowledge of the Fat-Free Framework.

Database Creation:

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
  mostRecentBlogDate  DATETIME,
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