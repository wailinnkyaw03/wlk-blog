<?php 
session_start();
include "../../app/DB.php";
include "../../app/QueryBuilder.php";

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

if(!isset($_SESSION['user'])){
    header("location: ../../login.php");
}
if($_SESSION['user']['value']==2){
    header("location: ../../index.php");
}

include("./layouts/head.php");
include("./layouts/navbar.php");
include("./layouts/sidebar.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "dashboard"){
        $admins = $query->getAll("users", "*", null,"role_id = 1", null);
        $users = $query->getAll("users", "*", null,"role_id = 2 && status != 'Ban'", null);
        $banusers = $query->getAll("users", "*", null,"role_id = 2 && status = 'Ban'", null);
        $posts = $query->getAll("posts", "*", null, null, null);
        include "dashboard.php";
    }elseif($page == "userlist"){
        $roles = $query->getAll("roles", "*", null, null, null);
        $users =  $query->getAll("users", "users.*, roles.roleName, roles.value", "INNER JOIN roles on users.role_id=roles.id", "role_id = 2 && status!='Ban'", "users.id DESC");
        include("./users/userlist.php");
    }elseif($page == "userban"){
        $users =  $query->getAll("users", "users.*, roles.roleName, roles.value", "INNER JOIN roles on users.role_id=roles.id", "role_id = 2 && status='Ban'", "users.id DESC");
        include("./users/userban.php");
    }elseif($page == "adminlist"){
        $roles = $query->getAll("roles", "*", null, null, null);
        $admins =  $query->getAll("users", "users.*, roles.roleName, roles.value", "INNER JOIN roles on users.role_id=roles.id", "role_id = 1", "users.id DESC");
        include("./users/adminlist.php");
    }elseif($page == "postlist"){
        $posts = $query->getAll('posts', 'posts.*, users.name', 'INNER JOIN users on posts.created_by = users.id',null, "posts.created_at DESC");
        include("./posts/postlist.php");
    }
}else{
    $admins = $query->getAll("users", "*", null,"role_id = 1", null);
    $users = $query->getAll("users", "*", null,"role_id = 2 && status != 'Ban'", null);
    $banusers = $query->getAll("users", "*", null,"role_id = 2 && status = 'Ban'", null);
    $posts = $query->getAll("posts", "*", null, null, null);
    include "dashboard.php";
}


include("./layouts/footer.php");

?>
