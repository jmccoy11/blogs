<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <title>The Blog Site - Edit</title>
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
            <h3></h3>
          </div>
          
          <div class="block">
            <form class="form-horizontal" action="/328/blogs/update" method="POST">
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title"
                         value="<?= $blogPost->getTitle() ?>">
                </div>
                <label class= "control-label col-sm-2 box" for="title">Title</label>
              </div>
              
              <div class="box title-box center">
                <p>Blog Entry</p>
              </div>
              
              <div>
                <textarea id="blogEntry" name="blogEntry"><?= $blogPost->getPost() ?></textarea>
              </div>
              
              <input type="hidden" id="blogId" name="blogId" value="<?= $blogPost->getBlogId() ?>" />
              <input type="hidden" id="datePosted" name="datePosted" value="<?= $blogPost->getDatePosted() ?>" />
              
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
