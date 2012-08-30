<?php
include('../include/conf.php');
$loginid = $_GET['loginid'];

$result = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.email,loginmaster.password,loginmaster.phone,loginmaster.gender,loginmaster.address,specilisation.spname,doctor.spid,doctor.startoftime,doctor.endoftime,doctor.otherspecilisation, area.id,area.name from loginmaster INNER JOIN doctor on loginmaster.id = doctor.loginid INNER JOIN area on area.id = doctor.areaid INNER JOIN specilisation on doctor.spid = specilisation.id where loginmaster.id = $loginid ")or die(mysql_error());
if($row = mysql_fetch_array($result)){

//print_r($row);die;
	
 $name = $row['1'];
 $email = $row['email'];
 $password = $row['password'];
 $phone = $row['phone'];
 $gender = $row['gender'];
 $specilisation = $row['spname'];
 $startoftime = $row['startoftime'];
 $endoftime = $row['endoftime'];
 $otherspecilisation = $row['otherspecilisation']; 
 $area = $row['name'];
 $address = $row['address'];
 $spid = $row['spid'];
 $areaid = $row['id'];
 
}

?>


<html>
<head>
<title>
Update Your Data
</title>
</head>
<body>
<form action="updatepage.php" method="post" >
 <table> 
 <tr><td>
Name: <input type="text" name="name" value="<?php echo $name; ?>">
 </tr></td> <tr><td>
Email: <input type="text" name="email" value="<?php echo $email; ?>">
 </tr></td> <tr><td>
Password: <input type="password" name="password" value="<?php echo $password; ?>" />
</tr></td> <tr><td>
Phone: <input type="text" name="phone" value="<?php echo $phone; ?>" />
</tr></td> <tr><td>
Gender: <input type="radio" name="gender" value="M" <?php if($gender=='M'){ ?> checked="checked" <?php }?>  /> Male
		<input type="radio" name="gender"  value="F"  <?php if($gender=='F'){?> checked="checked" <?php }?>  /> Female
</tr></td> <tr><td>
Specialization: <input type="text" name="specilisation" value="<?php echo $specilisation; ?>" /><br />
</tr></td> <tr><td>
Other Specialization: <input type="text" name="otherspecilisation" value="<?php echo $otherspecilisation; ?>" /><br />
</tr></td> <tr><td>
Start of Time: <input type="text" name="startoftime" value="<?php echo $startoftime; ?>" /><br />
</tr></td> <tr><td>
End of Time: <input type="text" name="endoftime" value="<?php echo $endoftime ; ?>" /><br />
</tr></td> <tr><td>
Area: <input type="text" name="area" value="<?php echo $area; ?>" /><br />
</tr></td> <tr><td>
Address: <input type="text" name="address" value="<?php echo $address; ?>" />
</tr></td> <tr><td>


<input type="hidden" name="loginid" value="<?php echo $loginid; ?>" />
<input type="hidden" name="spid" value="<?php echo $spid; ?>" />
<input type="hidden" name="areaid" value="<?php echo $areaid; ?>" />
<input type="submit" value="update"/>
</tr></td>
</form>

</body>

</html> 