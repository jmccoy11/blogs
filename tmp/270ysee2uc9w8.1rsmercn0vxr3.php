<!--
      Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
      Date: 5/18/2017
      Filename: navbar-user.inc.html
      Description: Side Nav bar for a logged in user
  -->

<div class="col-sm-3 sidenav">
  <div id="navbar" class="nav nav-pills nav-stacked">
    <nav>
      <h2>Blog Site</h2>
      <img src="images/trumpet.png" class="visible-sm visible-md visible-lg" alt="trumpet.png" />
      <ul>
        <li><a href="/328/blogs">Home ></a></li>
          <li><a href="/328/blogs/user-blogs?bloggerId=<?= $bloggerId ?>">My Blogs ></a></li>
          <li><a href="/328/blogs/create?bloggerId=<?= $bloggerId ?>">Create Blog ></a></li>
        <li><a href="/328/blogs/about">About Us ></a></li>
        <li><a href="/328/blogs/logout">Logout ></a></li>
      </ul>
    </nav>
  </div> <!-- navbar -->
</div>