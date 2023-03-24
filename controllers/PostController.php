<?php 
session_start();
include("../app/DB.php");
include("../app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$post = new QueryBuilder($connection);

if(isset($_POST['title'])){
    $title = $_POST['title'];
    $post_status = $_POST['post_status'];
    $description = $_POST['description'];
    if($title == "" | $post_status == "" | $description == ""){
        if($title == ""){
            $_SESSION['v-title']="Title Must Not Be Empty";
        }
        if($post_status == ""){
            $_SESSION['v-post_status']="Post Status Must Not Be Empty";
        }
        if($description == ""){
            $_SESSION['v-description']="Description Must Not Be Empty";
        }
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        unset($_SESSION['v-title']);
        unset($_SESSION['v-post_status']);
        unset($_SESSION['v-description']);

         //image
        $image_arr = $_FILES['post_img']['name'];
        $tmp_name = $_FILES['post_img']['tmp_name'];
        $folder = "../assets/posts/";
        $post_img = uniqid("blog").$image_arr;
        move_uploaded_file($tmp_name, $folder.$post_img);

        if($_POST['action']=="add"){
            if($image_arr != null){
                $datas = [
                    'title' => $title,
                    'post_img' => $post_img,
                    'post_status' => $post_status,
                    'description' => $description,
                    'created_by' => $_POST['created_by']
                ];
                $postcreate = $post->create('posts', $datas);
                if($postcreate){
                    $_SESSION['msg']="Post has been created successfully.";
                    $_SESSION['expire']=time();
                    header("location: ../index.php?page=home");
                }
            }else{
                $datas = [
                    'title' => $title,
                    'post_status' => $post_status,
                    'description' => $description,
                    'created_by' => $_POST['created_by']
                ];
                $postcreate = $post->create('posts', $datas);
                if($postcreate){
                    $_SESSION['msg']="Post has been created successfully.";
                    $_SESSION['expire']=time();
                    header("location: ../index.php?page=home");
                }
            }
        }elseif($_POST['action']=="update"){
            $id = $_POST['id'];
            if($image_arr != null){
                $datas = [
                    'title' => $title,
                    'post_img' => $post_img,
                    'post_status' => $post_status,
                    'description' => $description,
                    'created_by' => $_POST['created_by']
                ];
                $postupdate = $post->update('posts', $datas, $id);
                if($postupdate){
                    $_SESSION['msg']="Post has been updated successfully.";
                    $_SESSION['expire']=time();
                    header("location: ../index.php?page=home");
                }
            }else{
                $datas = [
                    'title' => $title,
                    'post_status' => $post_status,
                    'description' => $description,
                    'created_by' => $_POST['created_by']
                ];
                $postcreate = $post->update('posts', $datas, $id);
                if($postcreate){
                    $_SESSION['msg']="Post has been updated successfully.";
                    $_SESSION['expire']=time();
                    header("location: ../index.php?page=home");
                }
            }
        }
    }
}

if($_POST['action']=="delete"){
    $id = $_POST['id'];
    $postdelete = $post->delete("posts", $id);
    if($postdelete){
        $_SESSION['msg']="Post has been deleted successfully.";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}

?>