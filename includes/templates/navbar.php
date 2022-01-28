<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand">eCommerce</a>
    <button class="icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <!-- <span class="navabr-toggler-icon"></span> -->
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mb-2  mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashoard.php"><?php echo Lang('HOME_ADMIN')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php"><?php echo Lang('CATEGORIES')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="items.php"><?php echo Lang('ITEMS')?></a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="memmbers.php?do=Mange"><?php echo Lang('MEMBERS')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comments.php"> <?php echo Lang('COMMENTS')?></a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#"> <?php echo Lang('STATISTICS')?></a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="#"> <?php echo Lang('LOGS')?></a>
        </li> -->
      </ul>
      <ul class="navbar-nav ml-auto">
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
         Ali Mohammad
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a href="../index.php" class="dropdown-item">Visti Shop</a></li>
            <li><a class="dropdown-item" href="memmbers.php?do=Edit&userid=<?php
            echo $_SESSION['ID']?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>




















