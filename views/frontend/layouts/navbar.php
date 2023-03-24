<nav class="navbar navbar-expand-md bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img class="me-2" src="./assets/img/logo.png" width="50px" alt="">
      <span class="text-success"><b class="text-danger">SOCIAL </b>WORLD</span>
    </a>

    <form class="d-lg-block d-none" role="search" action="index.php?page=postsearch" method="post">
        <div class="input-group">
          <input type="search" class="form-control" placeholder="Search" name="search">
          <button class="btn btn-sm btn-outline-logo" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">BLOG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">CONTACT</a>
        </li> -->
        <?php if(!isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="btn btn-outline-logo me-2" href="login.php">Register/Login</a>
        </li>
        <?php endif ?>
        <?php if(isset($_SESSION['user'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./assets/profiles/<?= $_SESSION['user']['profile'] ?>" width="30px" height="30px" alt="" class="rounded-circle me-2">
            <?= $_SESSION['user']['name'] ?>
          </a>
          <ul class="dropdown-menu">
            <?php if($_SESSION['user']['value'] == 1 || $_SESSION['user']['value']==3): ?>
              <li><a href="views/backend/admin.php" class="dropdown-item"><i class="fas fa-home-user me-2"></i>Admin Panel</a></li>
            <?php endif ?>
            <li><a class="dropdown-item" href="index.php?page=profile"><i class="fas fa-user me-2"></i>User Profile</a></li>
            <li><a class="dropdown-item" href="./controllers/UserController.php?action=logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
          </ul>
        </li>
        <?php endif ?>
      </ul>
    </div>
    
  </div>
</nav>
<nav class="navbar bg-grey">
  <ul class="container nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=home"><i class="fas fa-home text-logo"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=blog"><i class="fas fa-blog text-logo"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=about"><i class="fas fa-globe text-logo"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=contact"><i class="fas fa-phone-volume text-logo"></i></a>
    </li>
  </ul>
</nav>

<div class="offcanvas offcanvas-start" id="offcanvasExample" style="width: 100%;">
    <div class="offcanvas-header">
        <a class="navbar-brand" style="font-size: 20px;" href="./index.php">
          <img class="me-1" src="./assets/img/logo.png" width="50px" alt="">
          <span class="text-success"><b class="text-danger">SOCIAL </b>WORLD</span>
        </a>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if(isset($_SESSION['user'])): ?>
            <div class="mb-3">
              <a class="card w-100 p-3 text-decoration-none shadow" href="index.php?page=profile">
                <div>
                  <img src="./assets/profiles/<?= $_SESSION['user']['profile'] ?>" width="30px" height="30px" alt="" class="rounded-circle me-3">
                  <span class="text-logo"><?= $_SESSION['user']['name'] ?></span>
                </div>
              </a>
              
            </div>
        
        <div class="row">
          <div class="col-6">
            <a href="" class="card p-3 text-decoration-none shadow text-logo">
              <i class="fas fa-users"></i>
              <p class="pb-0 mb-0">Friends</p>
            </a>
          </div>
          <div class="col-6">
            <a href="" class="card p-3 text-decoration-none shadow text-logo">
              <i class="fas fa-heart"></i>
              <p class="pb-0 mb-0">Favorite</p>
            </a>
          </div>
        </div>
        <?php endif ?>
        <div class="divider"><hr></div>
        <form class="" role="search">
          <div class="input-group">
            <input type="search" class="form-control" placeholder="Search">
            <button class="btn btn-sm btn-outline-logo" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
        <div class="divider"><hr></div>
        <?php if(!isset($_SESSION['user'])): ?>
          <a href="login.php" class="btn btn-logo w-100">Register/Login</a>
        <?php endif ?>
        <?php if(isset($_SESSION['user'])): ?>
          <a href="./controllers/UserController.php?action=logout" class="btn btn-logo w-100"><i class="fa-solid fa-right-from-bracket me-2 text-light"></i>Logout</a>
        <?php endif ?>
        <div class="p-3 mt-3 bg-grey text-center">
                <p class="mb-0">All Rights Reserved @2023</p>
                <p class="mb-0">&copy;Copyright by <a href="https://wlktech.github.io" target="__blank" class="text-dark">WLK-TECH</a></p>
            </div>
    </div>
</div>