
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS bloggers;
DROP TABLE IF EXISTS blogs;

CREATE TABLE users
(
  userId        INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
  password      VARCHAR(50)   NOT NULL,
);

CREATE TABLE bloggers
(
  bloggerId         INT NOT NULL PRIMARY KEY,
  username          VARCHAR(40)   NOT NULL,
  email             VARCHAR(255)  NOT NULL,
  blogCount         INT,
  mostRecentBlogId  INT,
  profilePicPath    VARCHAR(255),
  bio               VARCHAR(1000),
  
  FOREIGN KEY (bloggerId) REFERENCES users(userId)
);

CREATE TABLE blogs
(
  blogId      INT   NOT NULL AUTO_INCREMENT PRIMARY KEY,
  blogPost    VARCHAR(1000),
  datePosted  CHAR(10)
);

CREATE TABLE blogger_to_blogs_junct
(
  bloggerId   INT,
  blogId      INT,
  
  FOREIGN KEY (bloggerId) REFERENCES bloggers(bloggerId),
  FOREIGN KEY (blogId) REFERENCES blogs(blogId)
);