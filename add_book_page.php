<?php
include("data.php");
$bookname = $_POST['bookname'];
$bookauthor = $_POST['bookauthor'];
$bookquantity = $_POST['bookquantity'];
$obj = new data();
$obj->set_connection();
$obj->add_book($bookname, $bookauthor, $bookquantity);
?>