<?php 
session_start();
include "../../app/DB.php";
include "../../app/QueryBuilder.php";

$db = new DB();
$connection = $db->connect();
$userDB = new QueryBuilder($connection);

if(!isset($_SESSION['user'])){
    header("location: ../../login.php");
}

include("./layouts/head.php");
include("./layouts/navbar.php");
include("./layouts/sidebar.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "dashboard"){
        $admins = $userDB->getAll("users", "*", null,"role_id = 1", null);
        $users = $userDB->getAll("users", "*", null,"role_id = 2", null);
        include "dashboard.php";
    }
}else{
    $admins = $userDB->getAll("users", "*", null,"role_id = 1", null);
    $users = $userDB->getAll("users", "*", null,"role_id = 2", null);
    include "dashboard.php";
}


include("./layouts/footer.php");

?>
