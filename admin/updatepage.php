<?php 
include('../include/conf.php');
$loginid = protect($_POST['loginid']);
$spid = protect($_POST['spid']);
$areaid = protect($_POST['areaid']);

$name = protect($_POST['name']);
$email = protect($_POST['email']);
$password = protect($_POST['password']);
$phone = protect($_POST['phone']);
$gender = protect($_POST['gender']);
$specilisation = protect($_POST['specilisation']);
$otherspecilisation = protect($_POST['otherspecilisation']);
$startoftime = protect($_POST['startoftime']);
$endoftime = protect($_POST['endoftime']);
$area = protect($_POST['area']);
$address = protect($_POST['address']);

mysql_query("UPDATE loginmaster SET name = '$name', email = '$email',password = '$password', phone = '$phone', gender = '$gender', address = '$address' WHERE loginmaster.id = '$loginid'")or die(mysql_error());

mysql_query("UPDATE specilisation SET spname = '$specilisation' WHERE specilisation.id = '$spid'  ")or die(mysql_error());

mysql_query("UPDATE area SET name = '$area' WHERE area.id = '$areaid'  ")or die(mysql_error());

mysql_query("UPDATE doctor SET otherspecilisation = '$otherspecilisation', startoftime = '$startoftime', endoftime = '$endoftime' WHERE doctor.loginid = '$loginid' ")or die(mysql_error());



header('location:index.php');  

?>