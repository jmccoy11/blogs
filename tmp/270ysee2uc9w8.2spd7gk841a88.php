<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
    <title>The Blog Site - My Blogs</title>
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
    <link rel="stylesheet" href="styles/home.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  </head>
  <body>
    <div class="container-fluid">
      <div class="row content">
        <!-- Navbar -->
        <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
    
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
                  <?php foreach (($posts?:[]) as $post): ?>
                    <tr>
                      <td><?= $post->getTitle() ?></td>
                      <td><a href="/328/blogs/edit?blogId=<?= $post->getBlogId() ?>">
                        <span class="glyphicon glyphicon-wrench"></span></a></td>
                      <td><a href="/328/blogs/delete?blogId=<?= $post->getBlogId() ?>">
                        <span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                  <?php endforeach; ?>
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
