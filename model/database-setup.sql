
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
  bloggerId         INT NOT NULL PRIMARY KEY,
  username          VARCHAR(40)   NOT NULL,
  name              VARCHAR(40)   NOT NULL,
  blogCount         INT,
  mostRecentBlogId  INT,
  profilePicPath    VARCHAR(255),
  bio               VARCHAR(1000),
  
  FOREIGN KEY (bloggerId) REFERENCES users(userId)
);

CREATE TABLE blogs
(
  blogId      INT   NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(255),
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
(1, 'jshmoe1', 'Joe Schmoe Blogger', 3, 3, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(2, 'jshmoe2', 'Joe Schmoe Blogger', 1, 4, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(3, 'jshmoe3', 'Joe Schmoe Blogger', 1, 5, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(4, 'jshmoe4', 'Joe Schmoe Blogger', 1, 6, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(5, 'jshmoe5', 'Joe Schmoe Blogger', 1, 7, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(6, 'jshmoe6', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.'),
(7, 'jshmoe7', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.');

INSERT INTO blogs
(title, blogPost, datePosted)
VALUES
('The Mariners are losing again', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','5/19/2017'),
('Renovating my house', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','5/19/2017'),
('In the words of Abraham Lincoln', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortorsodales commodo.','5/19/2017'),
('Title 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','5/19/2017'),
('Title 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','5/19/2017'),
('Title 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','5/19/2017'),
('Title 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor sodales commodo.','5/19/2017');

INSERT INTO blogger_to_blogs_junct
VALUES
(1,1),
(1,2),
(1,3),
(2,4),
(3,5),
(4,6),
(5,7);
