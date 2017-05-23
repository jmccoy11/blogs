<!DOCTYPE html>
<html>
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: entry.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <title>The Blog Site - View Blog Entry</title>
    <link rel="shortcut icon" href="images/trumpet.png">
    <meta name="description" content="A blogging site for Green River College class IT328">
    <meta name="author" content="Jonnathon McCoy">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    
    <!--Custom stylesheets -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/entry.css">
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  
  <body>
    <!-- Navbar -->
    <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
    
    <!-- Blog entry -->
    <div class="row col-sm-8 page-container">
      <div id="entry">
        <img src="<?= $profilePic ?>" alt="profile pic" />
        <h1 class="center"><strong><?= $post->getTitle() ?></strong></h1>
        <br />
        <p><?= $post->getPost() ?></p>
      </div>
    </div>
  </body>
</html>
    