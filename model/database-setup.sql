
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS bloggers;
DROP TABLE IF EXISTS blogs;
DROP TABLE IF EXISTS blogger_to_blogs_junct;

CREATE TABLE users
(
  userId        INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
(email, password)
VALUES
('jschmoe@email.com', 'Password01'),
('jschmoe@email.com', 'Password01'),
('jschmoe@email.com', 'Password01'),
('jschmoe@email.com', 'Password01'),
('jschmoe@email.com', 'Password01'),
('jschmoe@email.com', 'Password01'),
('jschmoe@email.com', 'Password01');

INSERT INTO bloggers
VALUES
(1, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.'),
(2, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.'),
(3, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.'),
(4, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.'),
(5, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.'),
(6, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.'),
(7, 'jshmoe', 'Joe Schmoe Blogger', 0, 0, 'images/user.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.');

INSERT INTO blogs
(title, blogPost, datePosted)
VALUES
('The Mariners are losing again', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017'),
('Renovating my house', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017'),
('In the words of Abraham Lincoln', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017'),
('Title 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017'),
('Title 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017'),
('Title 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017'),
('Title 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                                sodales commodo.','5/19/2017');

INSERT INTO blogger_to_blogs_junct
VALUES
(1,1),
(1,2),
(1,3),
(2,4),
(3,5),
(4,6),
(5,7);
