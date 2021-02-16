 <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <?php
          $link = $_SERVER['PHP_SELF'];
          $link_array = explode('/',$link);
          $page = end($link_array);
      ?>
      <li class="nav-item">
        <div class="nav-link">
          <span><u>Management</u></span>
        </div>
      </li>
      <li <?php if($page=="index.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?> >
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li <?php if($page=="manage_sellers.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_sellers.php">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Manage Sellers</span></a>
      </li>
      <li <?php if($page=="validate_sellers.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="validate_sellers.php">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Validate Sellers</span></a>
      </li>
      <li <?php if($page=="manage_products.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_products.php">
          <i class="fas fa-fw fa-box-open"></i>
          <span>Manage Products</span></a>
      </li>
      <li <?php if($page=="validate_products.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="validate_products.php">
          <i class="fas fa-fw fa-boxes"></i>
          <span>Validate Products</span></a>
      </li>
      <li <?php if($page=="manage_bookings.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_bookings.php">
          <i class="fas fa-fw fa-ticket-alt"></i>
          <span>Bookings</span></a>
      </li>
      <li <?php if($page=="manage_orders.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_orders.php">
          <i class="fas fa-fw fa-truck"></i>
          <span>Orders</span></a>
      </li>
      <li <?php if($page=="manage_users.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_users.php">
          <i class="fas fa-fw fa-users"></i>
          <span>Manage Users</span></a>
      </li>
      <li <?php if($page=="category_add.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="category_add.php">
          <i class="fas fa-fw fa-stream"></i>
          <span>Manage Category</span></a>
      </li>
      <li <?php if($page=="enquiries.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="enquiries.php">
          <i class="fas fa-fw fa-comments"></i>
          <span>Seller Enquiries</span></a>
      </li>
      <li <?php if($page=="user_enquiries.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="user_enquiries.php">
          <i class="fas fa-fw fa-comments"></i>
          <span>User Enquiries</span></a>
      </li>
      <li <?php if($page=="newsletters_subscriptions.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="newsletters_subscriptions.php">
          <i class="fas fa-fw fa-file"></i>
          <span>Newsletters</span></a>
      </li>
      <li <?php if($page=="add_blogs.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="add_blogs.php">
          <i class="fas fa-fw fa-newspaper"></i>
          <span>Add Blogs</span></a>
      </li>
      <li <?php if($page=="manage_blogs.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_blogs.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Manage Blogs</span></a>
      </li>
      <li <?php if($page=="pincode.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="pincode.php">
          <i class="fas fa-fw fa-map-marker-alt"></i>
          <span>Pincodes</span></a>
      </li>
      <li <?php if($page=="waitlist.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="waitlist.php">
          <i class="fas fa-fw fa-clock"></i>
          <span>Waitlist</span></a>
      </li>
      <hr>
      <li <?php if($page=="home.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <div class="nav-link">
          <span><u>Website Settings</u></span>
        </div>
      </li>
      <li <?php if($page=="slider_items.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="slider_items.php">
          <i class="fas fa-fw fa-plus"></i>
          <span>Slider Items</span></a>
      </li>
      <li <?php if($page=="deals.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="deals.php">
          <i class="fas fa-fw fa-plus"></i>
          <span>Deals of the Day</span></a>
      </li>
      <li <?php if($page=="featured.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="featured.php">
          <i class="fas fa-fw fa-plus"></i>
          <span>Featured Products</span></a>
      </li>
    </ul>