<?php
include("data.php");
$std_id = $_GET['stdid'];
$book_id = $_GET['bookid'];
$obj = new data();
$obj->set_connection();
$obj->request_book($std_id, $book_id);
?>