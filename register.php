<?php 
session_start();
include "./views/frontend/layouts/head.php";
?>

<div class="container-fluid" id="back">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card p-5 shadow my-5">
                <?php if(isset($_SESSION['expire'])){
                    $diff = time() - $_SESSION['expire'];
                    if($diff > 2){
                        // unset($_SESSION['msg']);
                        unset($_SESSION['error']);
                        unset($_SESSION['expire']);
                    }
                }
                ?>
                <?php if(isset($_SESSION['error'])){ ?>   
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    <?php echo $_SESSION['error'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }?>
                
                <h4 class="mb-4"><i class="fas fa-user me-2"></i>Register Now</h4>
                <form action="./controllers/UserController.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name">
                        <label for="name"><i class="fas fa-user me-2"></i>Username</label>
                        <?php 
                        if(isset($_SESSION['v-name'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-name'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                        <?php 
                        if(isset($_SESSION['v-email'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-email'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password"><i class="fas fa-key me-2"></i>Password</label>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="myFunction()">
                            <label class="form-check-label" for="flexCheckDefault">
                                Show Password
                            </label>
                        </div>
                        <?php 
                        if(isset($_SESSION['v-password'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-password'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form mb-3">
                        <label for="gender" class="form-label d-block">Gender</label>
                        <div class="male d-inline me-4">
                            <input type="radio" name="gender" id="male" class="form-radio" value="Male">
                            <label for="male" class="form-label">Male</label>
                        </div>
                        <div class="female d-inline">
                            <input type="radio" name="gender" id="female" class="form-radio" value="Female">
                            <label for="female" class="form-label">Female</label>
                        </div>
                        <?php 
                        if(isset($_SESSION['v-gender'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-gender'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="name@example.com">
                        <label for="phone"><i class="fas fa-phone-volume me-2"></i>Phone</label>
                        <?php 
                        if(isset($_SESSION['v-phone'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-phone'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="address" class="form-control" id="address" name="address" placeholder="name@example.com">
                        <label for="address"><i class="fas fa-location-dot me-2"></i>Address</label>
                        <?php 
                        if(isset($_SESSION['v-phone'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-phone'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="position" class="form-control" id="position" name="position" placeholder="name@example.com">
                        <label for="position"><i class="fas fa-briefcase me-2"></i>Position(Student/Job)</label>
                        <?php 
                        if(isset($_SESSION['v-position'])):
                        ?>
                        <p class="text-danger"><?= $_SESSION['v-position'] ?></p>
                        <?php 
                        endif
                        ?>
                    </div>
                    <div class="text-end">
                        <input type="hidden" name="action" value="add">
                        <button class="btn btn-dark" type="submit"><i class="fas fa-user me-2"></i>Register</button>
                        <button class="btn btn-dark" type="reset"><i class="fas fa-rotate me-2"></i>Reset</button>
                    </div>
                    <p class="mt-4">Already have an account? <a href="login.php" class="text-dark">Login Now</a></p>
                </form>
            </div>
            
        </div>
    </div>
</div>



<?php 
include "./views/frontend/layouts/script.php";
?>