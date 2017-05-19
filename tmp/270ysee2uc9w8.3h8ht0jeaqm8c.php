<!DOCTYPE html>
<html>
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: home.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
<!-- implement this
    <link rel="shortcut icon" href="images/heart-icon.png"> -->
    <title>The Blog Site</title>
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
    <link rel="stylesheet" href="styles/home.css">
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <!-- Navbar -->
    <?php echo $this->render('includes/navbar.inc.html',NULL,get_defined_vars(),0); ?>
    
    <!-- Blog cards -->
    <div class="row col-md-9 col-xs-12 page-container"> <!-- separates cards from nav --> 
      
      <!-- THIS WILL NEED TO BE CHANGED TO LOOP THROUGH THE ARRAY RECIEVED BY THE DATABASE -->
      <?php for ($i = 0;$i < 6;$i++): ?>
        <div class="card-box col-md-4 col-sm-6"> <!-- card outer boxes to add margins -->
          <div class="card"> <!-- card inner boxes -->
          
            <img src="<?= $loop['profilePic'] ?>" />
            <p class="center"><?= $loop['name'] ?></p>
            
            <p class="top-bottom-border extend"><a href="/328/blogs/user?id=<?= $loop['id'] ?>">view blogs</a>
              <span class="pull-right">Total: <?= $loop['postsCount'] ?></span></p>
            
            <p>Something from my latest blog:</p>
            <p><?= $loop['latestPost'] ?></p>
            
          </div> <!-- card -->
        </div> <!-- card box -->
      <?php endfor; ?>
    </div> <!-- blogger-container -->
    
  </body>
</html>