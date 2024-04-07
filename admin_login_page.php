<?php
include("data.php");
$login_email = $_GET['login_email'];
$login_pass = $_GET['login_pass'];
if($login_email==null || $login_pass==null){
    $email_msg="";
    $pass_msg="";
    if($login_email==null){
        $email_msg="Email cannot be left empty";
    }
    if($login_pass==null){
        $pass_msg="Password cannot be left empty";
    }
    header("Location:index.php?admin_email_msg=$email_msg&admin_pass_msg=$pass_msg");
}
elseif($login_email!=null && $login_pass!=null){
    $obj = new data();
    $obj->set_connection();
    $obj->admin_login($login_email, $login_pass);
}
?>