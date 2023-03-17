<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
  <div class="container">
    <a class="navbar-brand" href="#">WLK-BLOG</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <?php if(!isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <a class="btn btn-outline-dark mx-2" href="register.php"><i class="fas fa-user-pen me-2"></i>Register</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-dark" href="login.php"><i class="fas fa-unlock me-2"></i>Login</a>
        </li>
        <?php endif ?>
        <?php if(isset($_SESSION['user'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['user']['name'] ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>User Profile</a></li>
            <li><a class="dropdown-item" href="../../../controllers/UserController.php?action=logout"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
          </ul>
        </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>