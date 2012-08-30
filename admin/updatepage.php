<?php 
include('../include/conf.php');
$loginid = $_POST['loginid'];
$spid = $_POST['spid'];
$areaid = $_POST['areaid'];

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$specilisation = $_POST['specilisation'];
$otherspecilisation = $_POST['otherspecilisation'];
$startoftime = $_POST['startoftime'];
$endoftime = $_POST['endoftime'];
$area = $_POST['area'];
$address = $_POST['address'];

mysql_query("UPDATE loginmaster SET name = '$name', email = '$email',password = '$password', phone = '$phone', gender = '$gender', address = '$address' WHERE loginmaster.id = '$loginid'")or die(mysql_error());

mysql_query("UPDATE specilisation SET spname = '$specilisation' WHERE specilisation.id = '$spid'  ")or die(mysql_error());

mysql_query("UPDATE area SET name = '$area' WHERE area.id = '$areaid'  ")or die(mysql_error());

mysql_query("UPDATE doctor SET otherspecilisation = '$otherspecilisation', startoftime = '$startoftime', endoftime = '$endoftime' WHERE doctor.loginid = '$loginid' ")or die(mysql_error());



header('location:index.php');  

?>