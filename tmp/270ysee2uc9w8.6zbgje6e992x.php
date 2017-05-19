<!DOCTYPE html>
<html>
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: about.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
<!-- TODO: implement this
    <link rel="shortcut icon" href="images/heart-icon.png"> -->

    <title>The Blog Site - About Us</title>
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
    <link rel="stylesheet" href="styles/about.css">
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <!-- Navbar -->
    <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
    
    <!-- Blog entry -->
    <div class="row col-sm-9 page-container">
      <div class="about">
        <img src="images/blog_logo.png" alt="Blog Logo" />
        <h1><strong>The Blog site</strong></h1>
        <br />
        <h3>Your one-stop shop for Internet blogs</h3>
      </div>
      
      <div class="about">
        <h4><strong>The Internet is abuzz with our blog content.</strong></h4>
        
        <div class="top-bottom-border extend">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
            sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
            pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
            Nullam vel sollicitudin lorem. Sed ullamcorper pulvinar odio, at luctus odio iaculis aliquet.
            Curabitur in odio egestas, venenatis dui efficitur, tincidunt sem. Mauris tempor rutrum purus
            eu convallis. Nam eget tellus a nunc rhoncus consequat eget non sapien. Nulla suscipit malesuada
            magna. Curabitur convallis auctor lectus, quis tincidunt mauris.</p>
        </div>
        
        <div>
          <h4><strong>Hear what others are saying about us!</strong></h4>
          <div>
            <p class="quote">"Lorem ipsum dolor sit amet, consectetur adipispcing elit. Nuc ut porta dui. Nam maximus
              et marius eu tempor." - long time user Sally Nguyen</p>
            <p class="quote">"Lorem ipsum dolor sit amet, consectetur..." - blog contributer Terry Stone</p>
          </div>
        </div>
        
      </div>
    </div>
  </body>
</html>