<?php 
session_start();
include("../app/DB.php");
include("../app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$friend = new QueryBuilder($connection);

if($_POST['action'] == "addfriend"){
    $datas = [
        'user_id' => $_POST['user_id'],
        'friend_id' => $_POST['friend_id'],
        'friend_status' => $_POST['friend_status']
    ];
    $addfriend = $friend->create("friends", $datas);
    if($addfriend){
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}else if($_POST['action']=="confirmfriend"){
    $id = $_POST['id'];
    $datas = [
        'friend_status' => $_POST['friend_status']
    ];
    $confirmfriend = $friend->update("friends", $datas, $id);
    if($confirmfriend){
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}




?>