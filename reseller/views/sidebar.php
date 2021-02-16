 <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <?php
        $link = $_SERVER['PHP_SELF'];
        $link_array = explode('/',$link);
        $page = end($link_array);
      ?>
      <li <?php if($page=="index.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?> >
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li <?php if($page=="add_products.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?> >
        <a class="nav-link" href="add_products.php">
          <i class="fas fa-fw fa-box"></i>
          <span>Add Products</span></a>
      </li>
      <li <?php if($page=="restock.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?> >
        <a class="nav-link" href="restock.php">
          <i class="fas fa-fw fa-box-open"></i>
          <span>Manage Products</span></a>
      </li>
      <li <?php if($page=="manage_orders.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?>>
        <a class="nav-link" href="manage_orders.php">
          <i class="fas fa-fw fa-truck"></i>
          <span>Orders</span></a>
      </li>
      <hr>
      <li <?php if($page=="contact.php") { ?>  class="active nav-item" <?php } else { ?>  class="nav-item" <?php } ?> >
        <a class="nav-link" href="contact.php">
          <i class="fas fa-fw fa-user-cog"></i>
          <span>Contact Buzztro</span></a>
      </li>
    </ul>