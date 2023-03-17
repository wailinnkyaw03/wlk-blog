<?php 
session_start();
include("../app/DB.php");
include("../app/QueryBuilder.php");

$db = new DB();
$connection = $db->connect();
$user = new QueryBuilder($connection);

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if($name == "" | $email == "" | $password == ""){
        if($name == ""){
            $_SESSION['v-name'] = "*Username Must Not Be Empty";
        }
        if($email == ""){
            $_SESSION['v-email'] = "*Email Must Not Be Empty";
        }
        if($password == ""){
            $_SESSION['v-password'] = "*Password Must Not Be Empty";
        }
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        unset($_SESSION['v-name']);
        unset($_SESSION['v-email']);
        unset($_SESSION['v-password']);

        $datas = [
            'name' => $name,
            'email' => $email, 
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'status' => 'approved',
            'role_id' => 2
        ];

        if($_POST['action']=="add"){
            $register = $user->create('users', $datas);
            if($register){
                $_SESSION['msg'] = "Registered Success";
                $_SESSION['expire'] = time();
                header("location: ../login.php");
            }
        }
    }
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($email == "" | $password == ""){
        if($email == ""){
            $_SESSION['v-email'] = "*Email Must Not Be Empty";
        }
        if($password == ""){
            $_SESSION['v-password'] = "*Password Must Not Be Empty";
        }
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        unset($_SESSION['v-email']);
        unset($_SESSION['v-password']);

        if($_POST['action']=="login"){
            $login = $user->login($email, $password);
            if(password_verify($password, $login['password'])){
                $_SESSION['user'] = $login;
                $_SESSION['msg'] = "Login Success!";
                $_SESSION['expire'] = time();
                if($login['value']==1){
                    header("location: ../views/backend/admin.php");
                }else{
                    header("location: ../index.php");
                }
                
            }else{
                $_SESSION['error'] = "Email or Password was wrong";
                $_SESSION['expire'] = time();
                header("location: ".$_SERVER["HTTP_REFERER"]);
            }
            
        }
    }
}
if($_GET['action']=="logout"){
    unset($_SESSION['user']);
    header("location: ../login.php");
}

?>