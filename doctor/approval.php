<?php

include('../include/conf.php');
echo @$id = $_GET['id'];
echo @$pdate = date("Y-m-d", strtotime($_GET['date']));
echo @$time = $_GET['time'];

mysql_query("UPDATE patient SET isactive = '0' WHERE loginid='$id' and date = '$pdate' and time = '$time' ")or die(mysql_error());



header("location:./index.php");



?>