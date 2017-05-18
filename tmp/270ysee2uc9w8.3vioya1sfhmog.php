<!DOCTYPE html>
<html>
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: user.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
<!-- TODO: implement this
    <link rel="shortcut icon" href="images/heart-icon.png"> -->

    <title>The Blog Site - View User</title>
    <meta name="description" content="A blogging site for Green River College class IT328">
    <meta name="author" content="Jonnathon McCoy">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <!--Custom stylesheets -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/user.css">
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <!-- Navbar -->
    <?php echo $this->render('includes/navbar.inc.html',NULL,get_defined_vars(),0); ?>
    
    <div id="user-container" class="row col-md-10 col-xs-12">
      <div id="header">
        <h1><?= $user['name'] ?>'s Blogs</h1>
      </div>
      
      <div class="col-md-8">
        <div id="most-recent">
          <h4><a href="/328/blogs/entry?blogId=<?= $user['blogId'] ?>"><strong>My most recent blog:</strong></a></h4>
          <p><?= $user['latestPost'] ?></p>
        </div>
      
        <div id="my-blogs">
          <div  class="bottom-border extend">
            <h4><strong>My blogs:</strong></h4>
          </div>
          
          
          <div class="bottom-border extend">
            <h4><a href="/328/blogs/entry?blogId=1">In the words of Abraham Lincoln</a> - word count: 716 - 12/02/2007</h4>
            <p><?= $user['latestPost'] ?></p>
          </div>
          
          <div class="bottom-border extend">
            <h4><a href="/328/blogs/entry?blogId=1">Renovating my house</a> - word count: 202 - 09/10/2007</h4>
            <p><?= $user['latestPost'] ?></p>
          </div>
          
          <div class="bottom-border extend">
            <h4><a href="/328/blogs/entry?blogId=1">The Mariners are losing again</a> - word count: 998 - 05/04/2007</h4>
            <p><?= $user['latestPost'] ?></p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div id="profilePic">
          <img src="<?= $user['profilePic'] ?>" alt="profile pic" />
        </div>
        
        <div id="bio">
          <div class="center bottom-border extend">
            <h3><strong><?= $user['name'] ?></strong></h3>
          </div>
          <p>Bio: <?= $user['latestPost'] ?></p>
        </div>
      </div>
    </div>
  </body>
</html>