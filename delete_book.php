<?php
include("data.php");
$delete_book_id = $_GET['delete_book_id'];
$obj = new data();
$obj->set_connection();
$obj->delete_book($delete_book_id);
?>