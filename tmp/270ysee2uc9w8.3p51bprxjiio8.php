<div class="col-sm-3 sidenav">
  <div id="navbar" class="nav nav-pills nav-stacked">
    <nav>
      <h2>Blog Site</h2>
      <img src="images/trumpet.png" class="visible-sm visible-md visible-lg" alt="trumpet.png" />
      <ul>
        <li><a href="/328/blogs">Home ></a></li>
        <?php if ($guest): ?>
          
            <li><a href="/328/blogs/new">Become a Blogger ></a></li>
          
          <?php else: ?>
            <li><a href="#">My Blogs ></a></li>
            <li><a href="#">Create Blog ></a></li>
          
        <?php endif; ?>
        <li><a href="/328/blogs/about">About Us ></a></li>
        <li><a href="/328/blogs/login">Login ></a></li>
      </ul>
    </nav>
  </div> <!-- navbar -->
</div>