<!DOCTYPE html>
<html lang="en">
  <head>
    <title>New Blog Entry</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!--Custom stylesheets -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/create.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  </head>
  <body>
    <div class="container-fluid">
      <div class="row content">
        <!-- Navbar -->
        <?php echo $this->render('includes/navbar.inc.html',NULL,get_defined_vars(),0); ?>
    
        <div class="col-sm-9">
          <div class="block">
            <img src="images/writing.png" alt="profile pic" />
            <h1><strong>What's on your mind?</strong></h1>
            <br />
            <h3></h3>
          </div>
          
          <div class="block">
            <form class="form-horizontal" action="#" method="POST">
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <label class= "control-label col-sm-2 box" for="title">Title</label>
              </div>
              
              <div class="box title-box center">
                <p>Blog Entry</p>
              </div>
              
              <div>
                <textarea id="blog-entry"></textarea>
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