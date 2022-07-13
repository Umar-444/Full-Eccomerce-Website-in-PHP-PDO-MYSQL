<?php 
include "auth.php";
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}else{
    $cuser=new auth();
    $result=$cuser->session_user($_SESSION['username']);
    $_SESSION['id'] = $result['id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['address'] = $result['address'];
    $_SESSION['phone'] = $result['phone'];
    
}



?>