<?php 
include('../include/conf.php');
$loginid = protect($_GET['loginid']);
mysql_query("UPDATE loginmaster SET isactive = '0' WHERE id ='$loginid'");
header('location:index.php');
?>