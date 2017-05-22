
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS bloggers;
DROP TABLE IF EXISTS blogs;
DROP TABLE IF EXISTS blogger_to_blogs_junct;

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

INSERT INTO users
(username, email, password)
VALUES
('jshmoe1', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531'),
('jshmoe2', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531'),
('jshmoe3', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531'),
('jshmoe4', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531'),
('jshmoe5', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531'),
('jshmoe6', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531'),
('jshmoe7', 'jschmoe@email.com', 'c464af817287343305cbd6493c593885695df531');

INSERT INTO bloggers
VALUES
(1, 'jshmoe1', 'Joe Schmoe Blogger 1', 3, 3, '2017-5-19 12:00:00', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(2, 'jshmoe2', 'Joe Schmoe Blogger 2', 1, 4, '2017-5-19 12:00:01', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(3, 'jshmoe3', 'Joe Schmoe Blogger 3', 1, 5, '2017-5-19 12:00:02', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(4, 'jshmoe4', 'Joe Schmoe Blogger 4', 1, 6, '2017-5-19 12:00:03', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(5, 'jshmoe5', 'Joe Schmoe Blogger 5', 1, 7, '2017-5-19 12:00:04', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(6, 'jshmoe6', 'Joe Schmoe Blogger 6', 0, 0, '2017-5-19 12:00:05', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(7, 'jshmoe7', 'Joe Schmoe Blogger 7', 0, 0, '2017-5-19 12:00:06', 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.');

INSERT INTO blogs
(title, blogPost, datePosted, wordCount)
VALUES
('The Mariners are losing again', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.', '2017-05-19', 14),
('Renovating my house', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','2017-05-19', 14),
('In the words of Abraham Lincoln', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.','2017-05-19', 14),
('Title 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','2017-5-19', 14),
('Title 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','2017-5-19', 14),
('Title 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','2017-5-19', 14),
('Title 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','2017-5-19', 14);

INSERT INTO blogger_to_blogs_junct
VALUES
(1,1),
(1,2),
(1,3),
(2,4),
(3,5),
(4,6),
(5,7);
