<?php
include("data.php");
$delete_std_id = $_GET['delete_std_id'];
$obj = new data();
$obj->set_connection();
$obj->delete_std($delete_std_id);
?>