<div class="col-md-2 col-xs-12">
  <div id="navbar" class="">
    <nav>
      <h2>Blog Site</h2>
      <img src="images/trumpet.png" alt="trumpet.png" />
      <ul>
        <li><a href="/328/blogs">Home ></a></li>
        <?php if ($guest): ?>
          
            <li><a href="#">My Blogs ></a></li>
            <li><a href="#">Create Blog ></a></li>
          
          <?php else: ?>
            <li><a href="#">Become a Blogger ></a></li>
          
        <?php endif; ?>
        <li><a href="/328/blogs/about">About Us ></a></li>
        <li><a href="#">Login ></a></li>
      </ul>
    </nav>
  </div> <!-- navbar -->
</div>