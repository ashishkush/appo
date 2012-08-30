
<?php
include('../include/conf.php');

if(empty($_SESSION['name'])){
header('location:../index.php');
}

$name =$_SESSION['name'];
echo 'Welcome:'.' '.$name.'<br />';

?>

<a href="../include/logout.php">Logout here</a>

<html>

<body>
<h1 align="center"> Details </h1>

 <table>
  
	<tr>
 <td><a href="trashaccount.php">Trashed Account</a></td> 
 <td><a href="registerdoctor.php">Register Doctor</a></td></tr>
 </table>
 
<table align="center">
<tr>
<td width="3%"><b>Name</b></td>
<td width="3%"><b>Email Id</b></td>
<td width="3%"><b>Password</b></td>
<td width="3%"><b>Phone</b></td>
<td width="3%"><b>Specialization</b></td>
<td width="3%"><b>startoftime</b></td>
<td width="3%"><b>endoftime</b></td>
<td width="3%"><b>Other Specilisation</b></td>
<td width="3%"><b>Address</b></td> 

</tr>

<?php
$result = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.email,loginmaster.password,loginmaster.phone,loginmaster.address,specilisation.spname,doctor.otherspecilisation,doctor.startoftime,doctor.endoftime from loginmaster INNER JOIN doctor on loginmaster.id = doctor.loginid INNER JOIN specilisation on doctor.spid = specilisation.id  where loginmaster.isactive = 1")or die(mysql_error());
while($row = mysql_fetch_array($result)){

	$loginid = $row['id'];
	$name = $row['name'];
	$email = $row['email'];
	$password = $row['password'];
	$phone = $row['phone'];
	$specilization = $row['spname'];
	$startoftime = $row['startoftime'];
	$endoftime = $row['endoftime'];
	$otherspecilisation = $row['otherspecilisation'];
	$address = $row['address'];

?>

<tr>
<td width="9%"><?php echo $name;?></td>
<td width="3%"><?php echo $email;?></td>
<td width="3%"><?php echo $password;?></td>
<td width="3%"><?php echo $phone;?></td>
<td width="3%"><?php echo $specilization;?></td>
<td width="3%"><?php echo $startoftime;?></td>
<td width="3%"><?php echo $endoftime;?></td>
<td width="3%"><?php echo $otherspecilisation;?></td>
<td width="20%"><?php echo $address;?></td>

<td width="10%"><a href="update.php?loginid=<?php echo $loginid;?>">Edit</a></td>
<td width="10%"><a href="trash.php?loginid=<?php echo $loginid;?>">Delete</a></td>

</tr>

<?php
}
?>
</table>
</body>
</html>

