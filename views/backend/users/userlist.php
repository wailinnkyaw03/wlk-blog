                    <div class="container-fluid mt-4 px-4">
                        <h2 class=""><i class="fas fa-users me-2"></i>User List</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">User List</li>
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
                                User Lists
                                
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-hovered table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($users as $user): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $user['name'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td><?= $user['gender'] ?></td>
                                                <td><?= $user['phone'] ?></td>
                                                <td><?= $user['address'] ?></td>
                                                <td>
                                                    <?php if($user['status']=="Approve"): ?>
                                                        <span class="badge text-bg-success mb-2">Active</span>
                                                        <form class="d-inline" action="../../controllers/UserController.php" method="post">
                                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                            <input type="hidden" name="status" value="Ban">
                                                            <input type="hidden" name="action" value="userstatus">
                                                            <button type="submit" class="btn btn-sm btn-warning" ><i class="fas fa-user-slash"></i></button>
                                                        </form>
                                                    <?php elseif($user['status']=="Ban"): ?>
                                                        <span class="badge text-bg-warning mb-2">Ban</span>
                                                        <form class="d-inline" action="../../controllers/UserController.php" method="post">
                                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                            <input type="hidden" name="status" value="Approve">
                                                            <input type="hidden" name="action" value="userstatus">
                                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-user-check"></i></button>
                                                        </form>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <?php if($user['value']==1): ?>
                                                    <span class="badge text-bg-secondary"><?= $user['roleName'] ?></span>
                                                    
                                                    <?php elseif($user['value']==3): ?>
                                                    <span class="badge text-bg-dark"><?= $user['roleName'] ?></span>
                                                    <?php elseif($user['value']==2): ?>
                                                    <span class="badge text-bg-success"><?= $user['roleName'] ?></span>
                                                    <form action="../../controllers/UserController.php" method="post">
                                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                        <input type="hidden" name="action" value="changeRole">
                                                        <select class="form-select mt-2" name="role_id" id="role_id">
                                                            <?php foreach($roles as $role): ?>
                                                            <option class="<?php if($role['id']==3){ echo 'd-none'; } ?>" value="<?= $role['id'] ?>" <?= $user['role_id']==$role['id'] ? "selected" : null ?>><?= $role['roleName'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <button class="btn btn-sm btn-primary mt-2" type="submit">Change</button>
                                                    </form>
                                                    <?php endif ?>
                                                </td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-danger delete_id" data-id="<?= $user['id'] ?>" data-bs-target="#userdelete" data-bs-toggle="modal"><i class="fas fa-user-xmark"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<!-- Modal -->
<div class="modal fade" id="userdelete">
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
        <form action="../../controllers/UserController.php" method="GET">
            <input type="hidden" name="id" id="delete_id" value="">
            <input type="hidden" name="action" value="delete">
            <button class="btn btn-success" type="submit"><i class="fas fa-check me-2"></i>Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>