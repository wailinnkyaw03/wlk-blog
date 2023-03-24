<?php 
// echo "<pre>";
// print_r($posts);
// echo "</pre>";
// die;
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 mt-3">
            <?php if(isset($_SESSION['user'])): ?>
            <div class="card shadow p-3 d-xl-block d-none">
                <p class="text-logo"><i class="fas fa-users me-2"></i><b>Make Friends With Them</b></p>
                <div class="list-group list-group-flush">
                    <?php 
                    foreach($users as $user): 
                    
                    ?>
                    <a href="index.php?page=userprofile&id=<?= $user['id'] ?>" class="list-group-item <?php if(isset($_SESSION['user'])){ 
                        if($_SESSION['user']['id']==$user['id']){
                            echo "d-none";
                        }
                     } ?>">
                        <img src="./assets/profiles/<?= $user['profile'] ?>" width="30px" height="30px" alt="" class="rounded-circle me-1">
                        <span><?= $user['name'] ?></span>
                        <?php if(isset($_SESSION['user'])): ?>
                        <form class="d-inline" action="./controllers/FriendController.php" method="post">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                            <input type="hidden" name="friend_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="friend_status" value="pending">
                            <input type="hidden" name="action" value="addfriend">
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-1 float-end"><i class="fas fa-user-plus"></i></button>
                        </form>
                        <?php endif ?>
                    </a>
                    <?php endforeach ?>
                </div>
            </div>
            <?php endif ?>
            <div class="p-3 mt-3 bg-grey d-xl-block d-none">
                <p class="mb-0">All Rights Reserved @2023</p>
                <p class="mb-0">&copy;Copyright by <a href="https://wlktech.github.io" target="__blank" class="text-dark">WLK-TECH</a></p>
            </div>
        </div>
        <div class="col-md-6">
            <?php if(isset($_SESSION['expire'])){
                $diff = time() - $_SESSION['expire'];
                if($diff > 2){
                    unset($_SESSION['msg']);
                    unset($_SESSION['expire']);
                }
            }
            ?>
            <?php if(isset($_SESSION['msg'])){ ?>   
                <div class="alert alert-success alert-dismissible fade show py-3" role="alert">

            <?php echo $_SESSION['msg'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }?>

            <?php if(isset($_SESSION['user'])): ?>
            <a href="index.php?page=postcreate" class="card p-3 text-decoration-none text-dark mt-3 shadow">
                <div class="row ">
                    <div class="col-2">
                        <img src="./assets/profiles/<?= $_SESSION['user']['profile'] ?>" width="30px" height="30px" style="border-radius:50%;" alt="">
                    </div>
                    <div class="col-8">
                        <p class="mb-0 pb-0">Would you like to share your moments?</p>
                    </div>
                    <div class="col-2">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
            <?php endif ?>
        <?php if(!isset($_SESSION['user'])): ?>
            <?php foreach($posts as $post): ?>
            <div class="card my-3 shadow">
                <div class="head p-3">
                    <img src="./assets/profiles/<?= $post['profile'] ?>" width="30px" height="30px" class="rounded-circle me-3" alt="">
                    <a class="text-decoration-none text-dark" href="index.php?page=userprofile&id=<?= $post['created_by'] ?>"><b><?= $post['name'] ?></b></a>
                    <span class="badge text-bg-secondary ms-3"><?= $post['post_status'] ?></span>
                    
                    <p class="text-secondary ms-5"><?= date("h:iA Y-m-d", strtotime($post['created_at'])) ?></p>
                </div>
                <div class="body">
                    <div class="text px-3">
                        <h5 class="pb-0 mb-0"><b><?= $post['title'] ?></b></h5>
                        <p class="mt-0 pt-0"><?php substr($post["description"], 0, 100)."..." ?></p>
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
        <?php else: ?>
            <?php foreach($allposts as $allpost): ?>
            <div class="card my-3 shadow">
                <div class="head p-3">
                    <img src="./assets/profiles/<?= $allpost['profile'] ?>" width="30px" height="30px" class="rounded-circle me-3" alt="">
                    <a class="text-decoration-none text-dark" href="index.php?page=userprofile&id=<?= $allpost['created_by'] ?>"><b><?= $allpost['name'] ?></b></a>
                    <span class="badge text-bg-secondary ms-3"><?= $allpost['post_status'] ?></span>
                    <div class="dropdown float-end">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <?php if($_SESSION['user']['id']==$allpost['created_by']): ?>
                            <li><a class="dropdown-item" href="index.php?page=postedit&id=<?= $allpost['id'] ?>"><i class="fas fa-pen me-2"></i>Edit</a></li>
                            <li class="dropdown-item"><button class="btn px-0 delete_id" data-id="<?= $allpost['id'] ?>" data-bs-toggle="modal" data-bs-target="#deletepost"><i class="fas fa-trash me-2"></i>Delete</button></li>
                            <?php endif ?>
                            <li><a class="dropdown-item" href="index.php?page=detail&id=<?= $allpost['id'] ?>"><i class="fas fa-eye me-2"></i>Detail</a></li>
                        </ul>
                    </div>
                    <p class="text-secondary ms-5"><?= date("h:iA Y-m-d", strtotime($allpost['created_at'])) ?></p>
                </div>
                <div class="body">
                    <div class="text px-3">
                        <h5 class="pb-0 mb-0"><b><?= $allpost['title'] ?></b></h5>
                        <p class="mt-0 pt-0"><?php echo substr($allpost["description"], 0, 100)."..." ?><a href="index.php?page=detail&id=<?= $allpost['id'] ?>" class="text-dark">Read More</a></p>
                    </div>
                    <?php if(isset($allpost['post_img'])): ?>
                    <img src="./assets/posts/<?= $allpost['post_img'] ?>" alt="" class="img-fluid w-100">
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
                            <a href="index.php?page=detail&id=<?= $allpost['id'] ?>" class="w-100 btn"><i class="fas fa-eye me-2"></i>Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        <?php endif ?>
        </div>
        <div class="col-md-3 mt-3 d-xl-block d-none">
            <?php if(isset($_SESSION['user'])): ?>
            <div class="card shadow p-3">
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



