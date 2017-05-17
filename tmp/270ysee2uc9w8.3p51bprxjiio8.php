<div id="navbar" class="col-sm-2">
  <nav>
    <h2>Blog Site</h2>
    <img src="images/trumpet.png" alt="trumpet.png" />
    <ul>
      <li><a href="/home">Home ></a></li>
      <?php if ($guest): ?>
        
          <li><a href="#">My Blogs ></a></li>
          <li><a href="#">Create Blog ></a></li>
        
        <?php else: ?>
          <li><a href="#">Become a Blogger ></a></li>
        
      <?php endif; ?>
      <li><a href="#">About Us ></a></li>
      <li><a href="#">Login ></a></li>
    </ul>
  </nav>
</div> <!-- navbar -->