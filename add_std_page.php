<?php
include("data.php");
$addname = $_POST['addname'];
$addemail = $_POST['addemail'];
$addpass = $_POST['addpass'];

$obj = new data();
$obj->set_connection();
$obj->add_std($addname, $addemail, $addpass);
?>