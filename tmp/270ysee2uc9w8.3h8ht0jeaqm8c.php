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
    <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
    
    <!-- Blog cards -->
    <div class="row col-md-9 col-xs-12 page-container"> <!-- separates cards from nav --> 
      
      <?php foreach (($bloggers?:[]) as $value): ?>
        <div class="card-box col-md-4 col-sm-6"> <!-- card outer boxes to add margins -->
          <div class="card"> <!-- card inner boxes -->
          
            <img src="<?= $value->getPath() ?>" />
            <p class="center"><?= $value->getName() ?></p>
            
            <p class="top-bottom-border extend">
              <a href="/328/blogs/user?id=<?= $value->getId() ?>">view blogs</a>
              <span class="pull-right">Total: <?= $value->getBlogCount() ?></span></p>
            
            <p>Something from my latest blog:</p>
            <p><?php if (empty($value->getPostsArray())): ?>
                  I haven't posted anything, yet.
                  <?php else: ?><?= end($value->getPostsArray())->getPost() ?>
               <?php endif; ?></p>
            
          </div> <!-- card -->
        </div> <!-- card box -->
      <?php endforeach; ?>
    </div> <!-- blogger-container -->
    
  </body>
</html>