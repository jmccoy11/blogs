<!DOCTYPE html>
<html>
  <!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/16/2017
      Filename: user.html
      Description: A blogging site for Green River College class IT328
  -->
  
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
    <title>The Blog Site - Blogger</title>
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
    <link rel="stylesheet" href="styles/user.css">
    
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <!-- Navbar -->
    <?php echo $this->render($navbar,NULL,get_defined_vars(),0); ?>
    
    <div class="row content col-sm-9">
      <div class="block">
        <div id="header">
          <h1><?= $blogger->getName() ?>'s Blogs</h1>
        </div>
        
        <div class="col-sm-8">
          <div id="most-recent">
            <?php if (!empty($posts)): ?>
              
                <h4><a href="/328/blogs/entry?blogId=<?= $posts[0]->getBlogId() ?>">
                <strong>My most recent blog:</strong></a></h4>
              
            <?php endif; ?>
            
            <p>
              <?php if (empty($posts)): ?>
                
                  I haven't posted anything, yet.
                
                <?php else: ?>
                  <?= $posts[0]->getPost().PHP_EOL ?>
                
              <?php endif; ?>
            </p>
          </div>
        
          <div id="my-blogs">
            <div  class="bottom-border extend">
              <h4><strong>My blogs:</strong></h4>
            </div>
            
            <?php if (empty($posts)): ?>
                
                  I haven't posted anything, yet.
                
                <?php else: ?>
                  <?php foreach (($posts?:[]) as $value): ?>
                    <div class="bottom-border extend">
                      <h4><a href="/328/blogs/entry?blogId=<?= $value->getBlogId() ?>"><?= $value->getTitle() ?></a>
                        - word count: <?= $value->getWordCount() ?> -
                        <?= date('m/d/Y', strtotime($value->getDatePosted())) ?></h4>
                      <p><?= $value->getPost() ?></p>
                    </div>
                  <?php endforeach; ?>
                
             <?php endif; ?>
          </div>
        </div>
        
        <div class="col-sm-4">
          <div class="center" id="profilePic">
            <img src="<?= $blogger->getPath() ?>" alt="profile pic" />
          </div>
          
          <div id="bio">
            <div class="center bottom-border extend">
              <h3><strong><?= $blogger->getName() ?></strong></h3>
            </div>
            <p>Bio: <?= $blogger->getBio() ?></p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>