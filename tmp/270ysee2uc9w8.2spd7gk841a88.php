<!DOCTYPE html>
<html lang="en">
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: user-blogs.html
      Description: A blogging site for Green River College class IT328
  -->
  
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    
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
            <img src="<?= $bloggers[0]->getPath() ?>" alt="profile pic" />
            <h1><strong>Your Blogs</strong></h1>
          </div>
          
          <div class="extend-left col-sm-8">
            <div class="block extend">
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Blog</th><th>Update</th><th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (($posts?:[]) as $post): ?>
                    <tr>
                      <td><a href="/328/blogs/entry?blogId=<?= $post->getBlogId() ?>"><?= $post->getTitle() ?></a></td>
                      <td><a href="/328/blogs/edit?blogId=<?= $post->getBlogId() ?>">
                        <span class="glyphicon glyphicon-wrench"></span></a></td>
                      <td><a href="/328/blogs/delete?blogId=<?= $post->getBlogId() ?>"
                        onclick="return confirm('Are you sure you would like to delete this post? This cannot be reversed.');">
                        <span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> <!-- END table -->
            </div>
          </div> <!-- END .block -->
          
          <div class="block col-sm-4">
            <p>Bio: <?= $bloggers[0]->getBio() ?></p>
          </div>
        </div>
      </div> <!-- END row -->
    </div> <!-- END container -->
  </body>
</html>
