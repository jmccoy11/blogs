<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!--Custom stylesheets -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/home.css">
    
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
            <img src="images/user.png" alt="profile pic" />
            <h1><strong>Your Blogs</strong></h1>
          </div>
          
          <div class="block col-sm-8">
            <div class="">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Blog</th><th>Update</th><th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>The Words of Abraham Lincoln</td>
                    <td><span class="glyphicon glyphicon-wrench"></span></td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                  </tr>
                  <tr>
                    <td>Renovating my house</td>
                    <td><span class="glyphicon glyphicon-wrench"></span></td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                  </tr>
                  <tr>
                    <td>The Mariners are losing again!</td>
                    <td><span class="glyphicon glyphicon-wrench"></span></td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                  </tr>
                  <tr>
                    <td>Starbucks isn't what it used to be</td>
                    <td><span class="glyphicon glyphicon-wrench"></span></td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                  </tr>
                  <tr>
                    <td>Taking a breather at work today</td>
                    <td><span class="glyphicon glyphicon-wrench"></span></td>
                    <td><span class="glyphicon glyphicon-remove"></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="block col-sm-4">
            <p>Bio: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum quam et tortor
                sodales commodo. Nam sit amet elit et quam hendrerit tincidunt. Donec placerat justo eget justo
                pulvinar, ut ultrices libero congue. Nunc non leo malesuada, varius odio eget, iaculis tellus.
                Nullam vel sollicitudin lorem. </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
