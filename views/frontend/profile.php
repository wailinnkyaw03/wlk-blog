<div class="mb-5">
    <div class="background-img">
        <img src="./assets/img/<?= $_SESSION['user']['background'] ?>" width="100%" height="200px" alt="">
    </div>
    <div class="profile z-index-1">
        <img src="./assets/profiles/<?= $_SESSION['user']['profile'] ?>" width="150px" height="150px" alt="" class="rounded-circle shadow" style="border: 5px solid white">
    </div>
    <div class="pt-2 pb-5 bg-grey shadow-sm" style="padding-left:200px">
        <p class="fa-2x mb-0 pb-0"><b class=""><?= $_SESSION['user']['name'] ?></b></p>
        <b class="my-2 py-0 d-block" style="text-transform: uppercase;"><i class="fas fa-briefcase me-2"></i><?= $_SESSION['user']['position'] ?></b>
        <small class="text-secondary "><i class="fas fa-location-dot me-2"></i><?= $_SESSION['user']['address'] ?></small>
        <span class="dropdown">
            <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis p-2 bg-grey rounded-circle"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <button class="dropdown-item" data-bs-target="#profile" data-bs-toggle="modal"><i class="fas fa-image me-2"></i>
                    Update Profile</button>
                </li>
                <li>
                    <button class="dropdown-item" data-bs-target="#background" data-bs-toggle="modal"><i class="fas fa-image me-2"></i>
                    Update Cover Photo</button>
                    <!-- <a class="dropdown-item" href="#"><i class="fas fa-image me-2"></i>Update Background</a> -->
                </li>
                <li>
                    <button class="dropdown-item" data-bs-target="#info" data-bs-toggle="modal"><i class="fas fa-user me-2"></i>
                    Update Info</button>
                </li>
                <li>
                    <button class="dropdown-item" data-bs-target="#changepassword" data-bs-toggle="modal">
                        <i class="fas fa-key me-2"></i>
                        Change Password
                    </button>
                </li>
            </ul>
        </span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                
                <div class="mt-4 p-3 bg-grey shadow">
                    <div class="contact">
                        <i class="fas fa-phone-volume me-2 text-secondary"></i>
                        <span><?= $_SESSION['user']['phone'] ?></span>
                    </div>
                    <div class="contact">
                        <i class="fas fa-envelope me-2 text-secondary"></i>
                        <span class="text-logo"><?= $_SESSION['user']['email'] ?></span>
                    </div>
                </div>
                <div class="mt-4">
                    <?php if(isset($_SESSION['expire'])){
                    $diff = time() - $_SESSION['expire'];
                        if($diff > 2){
                            unset($_SESSION['msg']);
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
                    <?php if(isset($_SESSION['msg'])){ ?>   
                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            <?php echo $_SESSION['msg'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-6">
        <?php foreach($posts as $post): ?>
            <div class="card my-3 shadow">
                <div class="head p-3">
                    <img src="./assets/profiles/<?= $post['profile'] ?>" width="30px" height="30px" class="rounded-circle me-3" alt="">
                    <a class="text-decoration-none text-dark" href="index.php?page=userprofile&id=<?= $post['created_by'] ?>"><b><?= $post['name'] ?></b></a>
                    <span class="badge text-bg-secondary ms-3"><?= $post['post_status'] ?></span>
                    <div class="dropdown float-end">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?page=postedit&id=<?= $post['id'] ?>"><i class="fas fa-pen me-2"></i>Edit</a></li>
                            <li class="dropdown-item"><button class="btn px-0 delete_id" data-id="<?= $post['id'] ?>" data-bs-toggle="modal" data-bs-target="#deletepost"><i class="fas fa-trash me-2"></i>Delete</button></li>
                            <li><a class="dropdown-item" href="index.php?page=detail&id=<?= $post['id'] ?>"><i class="fas fa-eye me-2"></i>Detail</a></li>
                        </ul>
                    </div>
                    <p class="text-secondary ms-5"><?= date("h:iA Y-m-d", strtotime($post['created_at'])) ?></p>
                </div>
                <div class="body">
                    <div class="text px-3">
                        <h5 class="pb-0 mb-0"><b><?= $post['title'] ?></b></h5>
                        <p class="mt-0 pt-0"><?php echo substr($post["description"], 0, 100)."..." ?><a href="index.php?page=detail&id=<?= $post['id'] ?>" class="text-dark">Read More</a></p>
                    </div>
                    <?php if(isset($post['post_img'])): ?>
                    <img src="./assets/posts/<?= $post['post_img'] ?>" alt="" class="img-fluid w-100">
                    <?php endif ?>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4">
                            <button class="w-100 btn"><i class="fas fa-heart me-2"></i>Like</button>
                        </div>
                        <div class="col-4">
                            <button class="w-100 btn"><i class="fas fa-message me-2"></i>Comment</button>
                        </div>
                        <div class="col-4">
                            <a href="index.php?page=detail&id=<?= $post['id'] ?>" class="w-100 btn"><i class="fas fa-eye me-2"></i>Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
            </div>
            <div class="col-md-3 mt-3 d-xl-block d-none">
            <?php if(isset($_SESSION['user'])): ?>
            <div class="card shadow p-3 mb-3">
                <p class="text-logo"><i class="fas fa-users me-2"></i><b>Friend Requests</b></p>
                <div class="list-group list-group-flush">
                <?php 
                foreach($users as $user):
                $id = $_SESSION['user']['id'];
                $fri_id = $user['id'];
                $requestfriends = $query->getAll("friends", "friends.*, t1.name as username, t1.profile as userprofile, t2.name as friendname, t2.profile as friendprofile", "INNER JOIN users t1 ON friends.user_id=t1.id INNER JOIN users t2 ON friends.friend_id=t2.id", "(friends.friend_status = 'pending') AND ((friends.user_id='$id' AND friends.friend_id='$fri_id') OR (friends.user_id='$fri_id' AND friends.friend_id=$id))", null);
                foreach($requestfriends as $requestfriend):
                    if($_SESSION['user']['id'] != $requestfriend['user_id']):
                ?>
                    <a href="index.php?page=userprofile&id=<?= $requestfriend['user_id'] ?>" class="list-group-item">
                        <img src="./assets/profiles/<?= $requestfriend['userprofile'] ?>" width="30px" height="30px" alt="" class="rounded-circle me-1">
                        <span><?= $requestfriend['username'] ?></span>
                        
                        <form class="d-inline" action="./controllers/FriendController.php" method="post">
                            <input type="hidden" name="id" value="<?= $requestfriend['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                            <input type="hidden" name="friend_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="friend_status" value="confirm">
                            <input type="hidden" name="action" value="confirmfriend">
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-1 float-end">Accept</button>
                        </form>
                    </a>
                    <?php endif ?>
                    <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="card shadow p-3 mb-3">
                <p class="text-logo"><i class="fas fa-users me-2"></i><b>My Friends</b></p>
                <div class="list-group list-group-flush">
                <?php 
                foreach($users as $user):
                $id = $_SESSION['user']['id'];
                $fri_id = $user['id'];
                $confirmfriends = $query->getAll("friends", "friends.*, t1.name as username, t1.profile as userprofile, t2.name as friendname, t2.profile as friendprofile", "INNER JOIN users t1 ON friends.user_id=t1.id INNER JOIN users t2 ON friends.friend_id=t2.id", "(friends.friend_status = 'confirm') AND ((friends.user_id='$id' AND friends.friend_id='$fri_id') OR (friends.user_id='$fri_id' AND friends.friend_id=$id))", null);
                foreach($confirmfriends as $confirmfriend):
                    if($_SESSION['user']['id'] != $confirmfriend['user_id']):
                ?>
                    <a href="index.php?page=userprofile&id=<?= $confirmfriend['user_id'] ?>" class="list-group-item">
                        <img src="./assets/profiles/<?= $confirmfriend['userprofile'] ?>" width="30px" height="30px" alt="" class="rounded-circle me-1">
                        <span><?= $confirmfriend['username'] ?></span>
                        
                        <form class="d-inline" action="./controllers/FriendController.php" method="post">
                            <input type="hidden" name="id" value="<?= $confirmfriend['id'] ?>">
                            <input type="hidden" name="friend_status" value="pending">
                            <input type="hidden" name="action" value="confirmfriend">
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-1 float-end">Unfriend</button>
                        </form>
                    </a>
                    <?php else: ?>
                        <a href="index.php?page=userprofile&id=<?= $confirmfriend['friend_id'] ?>" class="list-group-item">
                            <img src="./assets/profiles/<?= $confirmfriend['friendprofile'] ?>" width="30px" height="30px" alt="" class="rounded-circle me-1">
                            <span><?= $confirmfriend['friendname'] ?></span>
                            
                            <form class="d-inline" action="./controllers/FriendController.php" method="post">
                                <input type="hidden" name="id" value="<?= $confirmfriend['id'] ?>">
                                <input type="hidden" name="friend_status" value="pending">
                                <input type="hidden" name="action" value="confirmfriend">
                                <button type="submit" class="btn btn-sm btn-outline-primary ms-1 float-end">Unfriend</button>
                            </form>
                        </a>
                    <?php endif ?>
                    <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>     
            
            <?php endif ?>
        </div>
        </div>
        
    </div>
    
</div>





<!-- Modal -->
<div class="modal fade" id="profile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-image me-2"></i>Update Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="./controllers/UserController.php" method="post" enctype="multipart/form-data">
            <input type="file" class="form-control" name="profile" accept="image/png, image/gif, image/jpeg">
            <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
            <input type="hidden" name="action" value="profile">
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-grey">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="background">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-image me-2"></i>Update Cover Photo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="./controllers/UserController.php" method="post" enctype="multipart/form-data">
            <input type="file" class="form-control" name="background" accept="image/png, image/gif, image/jpeg">
            <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
            <input type="hidden" name="action" value="background">
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-grey">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="info">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-user me-2"></i>Update Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="./controllers/UserController.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $_SESSION['user']['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="text" name="email" id="email" class="form-control" value="<?= $_SESSION['user']['email'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div class="mb-3">
                    <input type="radio" class="" id="male" name="gender" value="Male" <?= $_SESSION['user']['gender']=="Male" ? "checked" : null ?>>
                    <label for="male" class="form-label me-3">Male</label>
                    <input type="radio" class="" id="female" name="gender" value="Female" <?= $_SESSION['user']['gender']=="Female" ? "checked" : null ?>>
                    <label for="female" class="form-label">Female</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= $_SESSION['user']['phone'] ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="<?= $_SESSION['user']['address'] ?>">
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="<?= $_SESSION['user']['position'] ?>">
            </div>

            <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
            <input type="hidden" name="action" value="info">
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-grey">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="changepassword">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-key me-2"></i>Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="./controllers/UserController.php" method="post">
            <div class="mb-3">
                <label for="oldpassword" class="form-label">Old Password</label>
                <input type="password" name="oldpassword" id="oldpassword" class="form-control" value="">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" value="">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="" id="newpassword" onclick="myFunction()">
                    <label class="form-check-label" for="newpassword">
                        Show Password
                    </label>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
            <input type="hidden" name="action" value="changepassword">
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-grey">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>