<?php 
session_start();

if(!isset($_SESSION['user'])){
    header("location: ../../login.php");
}

include("./layouts/head.php");
include("./layouts/navbar.php");
include("./layouts/sidebar.php");

if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == "dashboard"){
        include "dashboard.php";
    }
}else{
    include "dashboard.php";
}


include("./layouts/footer.php");

?>
