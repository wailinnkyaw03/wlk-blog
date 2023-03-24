<?php 
session_start();
include("./app/DB.php");
include("./app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

include("./views/frontend/layouts/head.php");
include("./views/frontend/layouts/navbar.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "home"){
        $users = $query->getAll("users", "*", null, null, null);
        $posts = $query->getAll('posts', 'posts.*, users.name, users.profile', 'INNER JOIN users on posts.created_by = users.id',"posts.post_status='public'", "posts.created_at DESC");
        $allposts = $query->getAll('posts', 'posts.*, users.name, users.profile', 'INNER JOIN users on posts.created_by = users.id',null, "posts.created_at DESC");
        include("./views/frontend/home.php");
    }elseif($page == "detail"){
        $id = $_GET['id'];
        $post = $query->get("posts", "posts.*, users.name, users.profile", "INNER JOIN users on posts.created_by = users.id", "posts.id=$id");
        include ("./views/frontend/detail.php");
    }elseif(isset($_SESSION['user'])){
        if($page == "profile"){
            $id = $_SESSION['user']['id'];
            $posts = $query->getAll('posts', 'posts.*, users.name, users.profile', 'INNER JOIN users on posts.created_by = users.id',"posts.created_by=$id", "posts.created_at DESC");
            $users = $query->getAll("users", "*", null, null, null);
            include("./views/frontend/profile.php");
        }elseif($page == "userprofile"){
            $id = $_GET['id'];
            $posts = $query->getAll('posts', 'posts.*, users.name, users.profile', 'INNER JOIN users on posts.created_by = users.id',"posts.created_by=$id", "posts.created_at DESC");
            $user = $query->get("users", "users.*, roles.roleName, roles.value", "INNER JOIN roles on users.role_id=roles.id", "users.id = $id");
            $users = $query->getAll("users", "*", null, null, null);
            include("./views/frontend/userprofile.php");
        }elseif($page == "postcreate"){
            include ("./views/frontend/posts/postcreate.php");
        }elseif($page == "postsearch"){
            $users = $query->getAll("users", "*", null, null, null);
            include ("./views/frontend/postsearch.php");
        }elseif($page == "postedit"){
            $id = $_GET['id'];
            $post = $query->get("posts", "*", null, "id=$id");
            include ("./views/frontend/posts/postedit.php");
        }elseif($page == "detail"){
            $id = $_GET['id'];
            $post = $query->get("posts", "posts.*, users.name, users.profile", "INNER JOIN users on posts.created_by = users.id", "posts.id=$id");
            include ("./views/frontend/detail.php");
        }
    }else{
        header("location: ./login.php");
    }
}else{
    $users = $query->getAll("users", "*", null, null, null);
    $posts = $query->getAll('posts', 'posts.*, users.name, users.profile', 'INNER JOIN users on posts.created_by = users.id',"posts.post_status='public'", "posts.created_at DESC");
    $allposts = $query->getAll('posts', 'posts.*, users.name, users.profile', 'INNER JOIN users on posts.created_by = users.id',null, "posts.created_at DESC");
    include("./views/frontend/home.php");
}














include("./views/frontend/layouts/script.php");

?>