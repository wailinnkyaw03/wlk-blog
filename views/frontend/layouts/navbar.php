<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img class="me-2" src="./assets/img/logo.png" width="50px" alt="">
      <span class="text-success"><b class="text-danger">SOCIAL </b>WORLD</span>
    </a>

    <form class="d-lg-block d-none" role="search">
        <div class="input-group">
          <input type="search" class="form-control" placeholder="Search">
          <button class="btn btn-sm btn-outline-logo" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">BLOG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">CONTACT</a>
        </li>
        <?php if(!isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="btn btn-outline-logo me-2" href="login.php">Register/Login</a>
        </li>
        <?php endif ?>
        <?php if(isset($_SESSION['user'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./assets/profiles/<?= $_SESSION['user']['profile'] ?>" width="30px" alt="" class="rounded-circle me-2">
            <?= $_SESSION['user']['name'] ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>User Profile</a></li>
            <li><a class="dropdown-item" href="./controllers/UserController.php?action=logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
          </ul>
        </li>
        <?php endif ?>
      </ul>
    </div>
    
  </div>
</nav>
<div class="offcanvas offcanvas-start" id="offcanvasExample" style="width: 100%;">
    <div class="offcanvas-header">
        <a class="navbar-brand" style="font-size: 20px;" href="./index.php">
          <img class="me-1" src="./assets/img/logo.png" width="40px" alt="">
          <span class="text-success"><b class="text-danger">SOCIAL </b>WORLD</span>
        </a>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php if(isset($_SESSION['user'])): ?>
            <div class="dropdown mb-3">
              <a class="btn btn-outline-logo dropdown-toggle w-100 text-start" href="#" role="button" data-bs-toggle="dropdown">
                <img src="./assets/profiles/<?= $_SESSION['user']['profile'] ?>" width="30px" alt="" class="rounded-circle me-2">
                <?= $_SESSION['user']['name'] ?>
              </a>
              <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2 text-logo"></i>User Profile</a></li>
                <li><a class="dropdown-item" href="./controllers/UserController.php?action=logout"><i class="fa-solid fa-right-from-bracket me-2 text-logo"></i>Logout</a></li>
              </ul>
            </div>
        <?php endif ?>
        <div class="list-group list-group-flush">
            <a href="#home" class="list-group-item"><i class="fas fa-blog text-logo me-2"></i>BLOG</a>
            <a href="#about" class="list-group-item"><i class="fas fa-globe text-logo me-2"></i>ABOUT</a>
            <a href="#contact" class="list-group-item"><i class="fas fa-address-book text-logo me-2"></i>CONTACT</a>
        </div>
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
        
    </div>
</div>