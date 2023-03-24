<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="">
                <h3 class="text-logo mb-4"><i class="fas fa-pen-to-square me-2"></i>Post Edit 
                <a href="index.php?page=home" class="btn btn-sm btn-logo float-end"><i class="fas fa-arrow-left me-2"></i>Back</a></h3>
            <form action="./controllers/PostController.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title:" value="<?= $post['title'] ?>">
                    <?php if(isset($_SESSION['v-title'])): ?>
                        <p class="text-danger">*<?= $_SESSION['v-title'] ?></p>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="post_img" class="form-label">Post Image (Optional)</label>
                    <input type="file" class="form-control" name="post_img" id="post_img">
                </div>
                <div class="mb-3">
                    <label for="post_status" class="form-label">Post Status</label>
                    <select name="post_status" id="post_status" class="form-select">
                        <option value="">Select Post Status</option>
                        <option <?php if($post['post_status']=="Public"){ echo "selected"; } ?> value="Public">Public</option>
                        <option <?php if($post['post_status']=="Friend"){ echo "selected"; } ?> value="Friend">Friend</option>
                    </select>
                    <?php if(isset($_SESSION['v-post_status'])): ?>
                        <p class="text-danger">*<?= $_SESSION['v-post_status'] ?></p>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= $post['description'] ?></textarea>
                    <?php if(isset($_SESSION['v-description'])): ?>
                        <p class="text-danger">*<?= $_SESSION['v-description'] ?></p>
                    <?php endif ?>
                </div>
                <div class="mb-3 text-end">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                    <input type="hidden" name="created_by" value="<?= $_SESSION['user']['id'] ?>">
                    <input type="hidden" name="action" value="update">
                    <button class="btn btn-outline-logo" type="submit"><i class="fas fa-pen-to-square me-2"></i>Edit Post</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>