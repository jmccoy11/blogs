<!DOCTYPE html>
<html lang="en">
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: create.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <title>The Blog Site - Create A New Blog</title>
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
    <link rel="stylesheet" href="styles/create.css">
     
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <div class="container-fluid">
      <div class="row content">
        <!-- Navbar -->
        <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
    
        <div class="col-sm-9">
          <div class="block">
            <img src="images/writing.png" alt="profile pic" />
            <h1><strong>What's on your mind?</strong></h1>
            <br />
            <br />
          </div>
          
          <div class="block">
            <form class="form-horizontal" action="/328/blogs/insert" method="POST">
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <label for="title">Title</label>
              </div>
              
              <div class="box title-box center">
                <p>Blog Entry</p>
              </div>
              
              <div>
                <textarea id="blogEntry" name="blogEntry"></textarea>
              </div>
              
              <div id="submit-div" class="center">
                <input id="submit-button" type="submit" value="Save" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
