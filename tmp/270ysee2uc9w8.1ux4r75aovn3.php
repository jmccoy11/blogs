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

    <title>The Blog Site - Login</title>
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
    <link rel="stylesheet" href="styles/login.css">
    
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
      <div class="block">
        <img src="images/lock.png" alt="Blog Logo" />
        <h1><strong>Welcome Back!</strong></h1>
        <br />
        <h3>Please login below</h3>
      </div>
      <div class="block">
        <div id="form" >
          <form action="/328/blogs/verify" method="POST">
            <div id="form-input-group">
              <div class="form-input-field">
                <input id="username" name="username" placeholder="<?= $usernameErr ?>"
                       type="text" class="col-xs-9" tabindex=1 autocomplete="off">
                <label for="username" class="col-xs-3">Username</label><br />
              </div>
              
              <div class="form-input-field">
                <input id="password" name="password" placeholder="<?= $passwordErr ?>"
                       type="password" class="col-xs-9" tabindex=2
                       autocomplete="new-password">
                <label for="password" class="col-xs-3">Password</label><br />
              </div>
            </div>
            
            <div>
              <input id="submit-button" class="center-block" type="submit"
                     value="Log In" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>