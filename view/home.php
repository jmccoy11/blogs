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
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <!-- Navbar -->
    <div class="col-md-2 col-xs-12">
      <include href="includes/navbar.inc.html" />
    </div>
    
    <!-- Blog cards -->
    <div id="blogger-container" class="row col-md-10 col-xs-12"> <!-- separates cards from nav --> 
      <div class="card-box col-md-4 col-sm-6"> <!-- card outer boxes to add margins -->
        <div class="card"> <!-- card inner boxes -->
          <img src="images/user.png" />
          <p class="center">Joe Shmoe Blogger</span>
          
          <p class="cell"><a href="#">view blogs</a>
            <span class="pull-right">Total: 10</span></p>
          
          <p>Something from my latest blog:</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
          sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
          pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
          Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
          Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
          eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
          magna. Curabitur convallis auctor lectus, quis tincidunt mauris.</p>
        </div> <!-- card -->
      </div> <!-- card box -->
      
      <div class="card-box col-md-4 col-sm-6">
        <div class="card">
          <img src="images/user.png" />
          <p class="center">Joe Shmoe Blogger</p>
          
          <p class="cell"><a href="#">view blogs</a>
            <span class="pull-right">Total: 10</span></p>
          
          
          <p>Something from my latest blog:</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
          sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
          pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
          Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
          Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
          eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
          magna. Curabitur convallis auctor lectus, quis tincidunt mauris.</p>
        </div> <!-- card -->
      </div> <!-- card box -->
      
      <div class="card-box col-md-4">
        <div class="card">
          <img src="images/user.png" />
          <p class="center">Joe Shmoe Blogger</p>
          
          <p class="cell"><a href="#">view blogs</a>
            <span class="pull-right">Total: 10</span></p>
          
          <p>Something from my latest blog:</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
          sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
          pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
          Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
          Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
          eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
          magna. Curabitur convallis auctor lectus, quis tincidunt mauris.</p>
        </div> <!-- card -->
      </div> <!-- card-box -->
    </div> <!-- blogger-container -->
  </body>
</html>