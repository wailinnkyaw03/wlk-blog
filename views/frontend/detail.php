<?php 
// echo "<pre>";
// print_r($post);
// echo "</pre>";
// die;

?>
<div class="container my-5">
    <div class="head p-3">
        <img src="./assets/profiles/<?= $post['profile'] ?>" width="50px" height="50px" class="rounded-circle me-3" alt="">
        <a class="text-decoration-none text-dark" href="index.php?page=userprofile&id=<?= $post['created_by'] ?>"><b><?= $post['name'] ?></b></a>
        <span class="badge text-bg-secondary ms-3"><?= $post['post_status'] ?></span>
        <?php if(isset($_SESSION['user'])): ?>
        <?php if($_SESSION['user']['id']==$post['created_by']): ?>
        <div class="dropdown float-end">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?page=postedit&id=<?= $post['id'] ?>"><i class="fas fa-pen me-2"></i>Edit</a></li>
                <li class="dropdown-item">
                    <button class="btn px-0 delete_id" data-id="<?= $post['id'] ?>" data-bs-toggle="modal" data-bs-target="#deletepost"><i class="fas fa-trash me-2"></i>Delete</button>
                </li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Detail</a></li>
            </ul>
        </div>
        <?php endif ?>
        <?php endif ?>
        <a href="index.php" class="btn btn-sm btn-logo float-end"><i class="fas fa-arrow-left me-2"></i>Back</a>
        <p class="text-secondary" style="margin-left:70px;"><?= date("h:iA Y-m-d", strtotime($post['created_at'])) ?></p>
    </div>
    <div class="text px-3">
        <h5 class="pb-0 mb-0"><b><?= $post['title'] ?></b></h5>
        <p class="mt-0 pt-0"><?= $post["description"] ?></p>
                        
    </div>
    <?php if(isset($post['post_img'])): ?>
        <img src="./assets/posts/<?= $post['post_img'] ?>" alt="" class="img-fluid w-100">
    <?php endif ?>

</div>