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
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $position = $_POST['position'];
    
    if($name == "" | $email == "" | $password == "" | $gender == "" | $phone == "" | $address == "" | $position == ""){
        if($name == ""){
            $_SESSION['v-name'] = "*Username Must Not Be Empty";
        }
        if($email == ""){
            $_SESSION['v-email'] = "*Email Must Not Be Empty";
        }
        if($password == ""){
            $_SESSION['v-password'] = "*Password Must Not Be Empty";
        }
        if($gender == ""){
            $_SESSION['v-gender'] = "*Gender Must Not Be Empty";
        }
        if($phone == ""){
            $_SESSION['v-phone'] = "*Phone Must Not Be Empty";
        }
        if($address == ""){
            $_SESSION['v-address'] = "*Address Must Not Be Empty";
        }
        if($position == ""){
            $_SESSION['v-position'] = "*Position Must Not Be Empty";
        }
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        unset($_SESSION['v-name']);
        unset($_SESSION['v-email']);
        unset($_SESSION['v-password']);
        unset($_SESSION['v-gender']);
        unset($_SESSION['v-phone']);
        unset($_SESSION['v-address']);
        unset($_SESSION['v-position']);

        $datas = [
            'name' => $name,
            'email' => $email, 
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'gender' => $gender, 
            'phone' => $phone, 
            'address' => $address, 
            'position' => $position, 
            'role_id' => 2
        ];

        if($_POST['action']=="add"){
            $register = $user->create('users', $datas);
            
            if($register){
                $_SESSION['msg'] = "Registered Success";
                $_SESSION['expire'] = time();
                header("location: ../login.php");
            }else{
                $_SESSION['error']="Account has already taken!";
                $_SESSION['expire'] = time();
                header("location: ".$_SERVER["HTTP_REFERER"]);
            }
        }
    }
}

//login
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
                if($login['value']==1 || $login['value']==3){
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
//profile Update
if($_POST['action']=="profile"){
    //image
    $image_arr = $_FILES['profile']['name'];
    $tmp_name = $_FILES['profile']['tmp_name'];
    $folder = "../assets/profiles/";
    $profile = uniqid("user").$image_arr;

    move_uploaded_file($tmp_name, $folder.$profile);
    $id = $_POST['id'];
    $datas=[
        'profile' => $profile
    ];
    $profileupdate = $user->update('users', $datas, $id);
    if($profileupdate){
        $_SESSION['msg']="Profile Updated Successfully.";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        $_SESSION['error'] = "Profile Update Failed!";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
    
}

//background update
if($_POST['action']=="background"){
    //image
    $image_arr = $_FILES['background']['name'];
    $tmp_name = $_FILES['background']['tmp_name'];
    $folder = "../assets/img/";
    $background = uniqid("back").$image_arr;

    move_uploaded_file($tmp_name, $folder.$background);
    $id = $_POST['id'];
    $datas=[
        'background' => $background
    ];
    $coverphotoupdate = $user->update('users', $datas, $id);
    if($coverphotoupdate){
        $_SESSION['msg']="Background Updated Successfully.";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        $_SESSION['error'] = "Background Update Failed!";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}

//updateinfo
if($_POST['action']=="info"){
    $id = $_POST['id'];
    $datas = [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'position' => $_POST['position'],
    ];
    $updateinfo = $user->update("users", $datas, $id);
    if($updateinfo){
        $_SESSION['msg']="User Info Updated Successfully.";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }else{
        $_SESSION['error'] = "User Info Update Failed!";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}
//user status change
if($_POST['action']=="userstatus"){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $datas = [
        'status' => $status
    ];
    $userstatus = $user->update("users", $datas, $id);
    if($userstatus){
        if($status=="Approve"){
            $_SESSION['msg']="User Permission Approved Successfully.";
            $_SESSION['expire'] = time();
            header("location: ".$_SERVER["HTTP_REFERER"]);
        }else{
            $_SESSION['msg']="User Permission Banned Successfully.";
            $_SESSION['expire'] = time();
            header("location: ".$_SERVER["HTTP_REFERER"]);
        }
    }else{
        $_SESSION['error']="User Permission Change Fail!";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}

//change role
if($_POST['action']=="changeRole"){
    $id = $_POST['id'];
    $role_id = $_POST['role_id'];
    $datas = [
        'role_id' => $role_id
    ];
    $changeRole = $user->update("users", $datas, $id);
    if($changeRole){
        if($role_id==1){
            $_SESSION['msg']="Changed To Admin Role Successfully.";
            $_SESSION['expire'] = time();
            header("location: ../views/backend/admin.php?page=adminlist");
        }else{
            $_SESSION['msg']="Changed To User Role Successfully.";
            $_SESSION['expire'] = time();
            header("location: ../views/backend/admin.php?page=userlist");
        }
    }
}
//change password
if($_POST['action']=="changepassword"){
    $id = $_POST['id'];
    $oldpassword = $_POST['oldpassword'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $datas = [
        'password' => $password
    ];
    if(password_verify($oldpassword, $_SESSION['user']['password'])){
        $changepassword = $user->update("users", $datas, $id);
        if($changepassword){
            $_SESSION['msg']="You have been changed new password";
            $_SESSION['expire']=time();
            header("location: ".$_SERVER["HTTP_REFERER"]);
        }
    }else{
        $_SESSION['error']="Your old password was wrong, Please Try Again!";
        $_SESSION['expire']= time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}

if($_GET['action']=="delete"){
    $id = $_GET['id'];
    $userdelete = $user->delete("users", $id);
    if($userdelete){
        $_SESSION['msg']="User has been deleted successfully.";
        $_SESSION['expire'] = time();
        header("location: ".$_SERVER["HTTP_REFERER"]);
    }
}


if($_GET['action']=="logout"){
    unset($_SESSION['user']);
    header("location: ../index.php");
    // header("location: ".$_SERVER["HTTP_REFERER"]);
}

?>