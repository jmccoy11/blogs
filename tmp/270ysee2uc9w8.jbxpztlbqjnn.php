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
    
    <title>The Blog Site - New Blogger</title>
    <link rel="shortcut icon" href="images/trumpet.png">
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
    <link rel="stylesheet" href="styles/new-blogger.css">
    
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
        <img src="images/writing.png" alt="Blog Logo" />
        <h1><strong>Become a Blogger!</strong></h1>
        <br />
        <h3>Create a new account below</h3>
      </div>
      
      <div class="block">
        <form action="/328/blogs/verify-new-user" method="POST">
            <div id="left-column" class="col-xs-6">
              <!--consider using this 
              <div class="form-group form-inline">
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="username">
                </div>
                <label class="control-label col-sm-2" for="username">Username</label>
              </div>
              -->
              <div class="form-input-group">
                <div class="form-input-field">
                  <input id="name" name="name" placeholder="<?= $nameErr ?>" type="text"
                         value="<?= $name ?>" class="col-xs-7" tabindex=1 autocomplete="off">
                  <label for="name" class="col-xs-5">Name</label>
                </div>
                <div class="form-input-field">
                  <input id="username" name="username" placeholder="<?= $usernameErr ?>"
                         value="<?= $username ?>" type="text" class="col-xs-7" tabindex=1
                         autocomplete="off">
                  <label for="username" class="col-xs-5">Username</label>
                </div>
                <div class="form-input-field">
                  <input id="email" name="email" placeholder="<?= $emailErr ?>" type="text"
                         value="<?= $email ?>" class="col-xs-7" tabindex=1 autocomplete="off">
                  <label for="email" class="col-xs-5">Email</label>
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
            </div >
            
            <div id="right-column" class="col-xs-6">
              <div class="form-input-group">
                <div class="form-input-field">
                  <input id="profilePic" name="profilePic" placeholder=""
                         type="text" class="col-xs-8" tabindex=1 autocomplete="off">
                  <label for="profilePic" class="col-xs-4">Upload Portait</label><br />
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
                  
                  <textarea id="bio" name="bio"></textarea>
                </div>
              </div>
            </div>

          <div id="submit-div">
            <input id="submit-button" type="submit"
                 value="Start Blogging!" />
          </div>
          
        </form>
      </div>
    </div>
  </body>
</html>