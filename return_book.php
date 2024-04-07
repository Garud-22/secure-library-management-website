<?php
include("data.php");
$issue_id = $_GET['issueid'];
$obj = new data();
$obj->set_connection();
$obj->return_book($issue_id);
?>