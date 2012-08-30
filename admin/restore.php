<?php 
include('../include/conf.php');
$loginid = $_GET['loginid'];
mysql_query("UPDATE loginmaster SET isactive = '1' WHERE id ='$loginid' ");
header('location:trashaccount.php');
?>