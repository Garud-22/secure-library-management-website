<?php
include("data.php");
$book_name = $_GET['bookname'];
$std_name = $_GET['stdname'];
$borrow_date = date("Y-m-d");
$num_days = $_GET['numdays'];
$return_date = Date('Y-m-d', strtotime('+'.$num_days.'days'));
$req_id = $_GET['reqid'];
$obj = new data();
$obj->set_connection();
$obj->approve_book_requests($book_name, $std_name, $num_days, $borrow_date, $return_date, $req_id);
?>