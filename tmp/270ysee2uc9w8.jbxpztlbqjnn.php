<!DOCTYPE html>
<html>
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: new-user.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
    <title>The Blog Site - New Blogger</title>
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
    <link rel="stylesheet" href="styles/new-user.css">
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!--Custom javaScript-->
    <script src="js/blogs.js"></script>
    
  </head>
  <body>
      <!-- Navbar -->
      <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
      
      <!-- Bloger entry -->
    
      <div class="row col-sm-9 page-container">
        <div class="block">
          <img src="images/writing.png" alt="Blog Logo" />
          <h1><strong>Become a Blogger!</strong></h1>
          <br />
          <h3>Create a new account below</h3>
        </div>
        
        <div class="block">
          <form action="/328/blogs/verify-new-user" method="POST" enctype="multipart/form-data">
            <div id="left-column" class="col-md-6 col-xs-12">
              <div class="form-input-group">
                <div class="form-input-field">
                  <input id="name" name="name" placeholder="<?= $nameErr ?>" type="text"
                         value="<?= $name ?>" class="col-xs-8" tabindex=1 autocomplete="off">
                  <label for="name" class="col-xs-4">Name</label>
                </div>
                <div class="form-input-field">
                  <input id="username" name="username" placeholder="<?= $usernameErr ?>"
                         value="<?= $username ?>" type="text" class="col-xs-8" tabindex=1
                         autocomplete="off">
                  <label for="username" class="col-xs-4">Username</label>
                </div>
                <div class="form-input-field">
                  <input id="email" name="email" placeholder="<?= $emailErr ?>" type="text"
                         value="<?= $email ?>" class="col-xs-8" tabindex=1 autocomplete="off">
                  <label for="email" class="col-xs-4">Email</label>
                </div>
              </div>
              
              <div class="separator">
                <p></p>
              </div>
              
              <div class="form-input-group">
                <div class="form-input-field">
                  <input id="password1" name="password1" placeholder="<?= $passwordErr ?>"
                         type="password" class="col-xs-8" tabindex=1 autocomplete="off">
                  <label for="password1" class="col-xs-4">Password</label>
                </div>
                <div class="form-input-field">
                  <input id="password2" name="password2" placeholder=""
                         type="password" class="col-xs-8" tabindex=1 autocomplete="off">
                  <label for="password2" class="col-xs-4">Verify</label>
                </div>
              </div>
            </div > <!-- END left-column -->
            
            <div id="right-column" class="col-md-6 col-xs-12">
              <div class="form-input-group">
                <div class="form-input-field center-block">
                  <input id="filePath" name="filePath" value=""
                         type="text" class="col-xs-8" tabindex=1 autocomplete="off" readonly>
                  <input class="hidden" id="profilePic" name="profilePic" placeholder=""
                         type="file" class="col-xs-8" tabindex=1 autocomplete="off"
                         onchange="updateFilePath();">
                  <div>
                    <label id="profilePicLabel" for="profilePic" class="col-xs-4">Upload Portait</label><br />
                  </div>
                  
                </div>
              </div>
              
              <div class="separator">
                <p></p>
              </div>
              
              <div class="form-input-group">
                <div class="form-input-field">
                  <label id="quick-bio" for="bio">Quick Biography</label><br />
                  
                  <div class="separator">
                    <p></p>
                  </div>
                  
                  <textarea id="bio" name="bio" tabindex=1></textarea>
                </div>
              </div>
            </div> <!-- END right-column -->
  
            <div id="submit-div">
              <input id="submit-button" type="submit" value="Start Blogging!" />
            </div>
          </form> <!-- END form -->
        </div> <!-- END .block -->
      </div> <!-- END page-container -->
  </body>
</html>