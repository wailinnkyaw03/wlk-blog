                    <div class="container-fluid mt-4 px-4">
                        <h2 class=""><i class="fas fa-list me-2"></i>Post List</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Post List</li>
                        </ol>
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Post Lists
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-hovered table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Post Status</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Post Status</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($posts as $post): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $post['title'] ?></td>
                                                <td><span class="badge text-bg-success"><?= $post['post_status'] ?></span></td>
                                                <td><?= $post['name'] ?></td>
                                                <td><?= date("d-M-Y (h:iA)", strtotime($post['created_at'])) ?></td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-danger delete_id" data-id="<?= $post['id'] ?>" data-bs-target="#deletepost" data-bs-toggle="modal"><i class="fas fa-user-xmark"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<!-- Modal -->
<div class="modal fade" id="deletepost">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-warning text-danger fa-2x mb-3"></i>
        <h1 class="modal-title fs-5" id="deleteModalLabel">Are you sure "Delete"?</h1>
      </div>
      <div class="modal-footer m-auto">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>Cancle</button>
        <form action="../../controllers/PostController.php" method="POST">
            <input type="hidden" name="id" id="delete_id" value="">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-success" type="submit"><i class="fas fa-check me-2"></i>Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>