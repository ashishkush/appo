<?php
include('../include/conf.php');
@$id = protect($_GET['id']);


	$timezone = new DateTimeZone("Asia/Kolkata" );
	$date = new DateTime();
	$date->setTimezone($timezone );
	$datet = $date->format( 'D, M jS, Y' );
	$current = date("Y-m-d", strtotime($datet)); 

$comparedate = mysql_query("select loginmaster.id,loginmaster.name,patient.loginid,patient.doctorid,patient.date,patient.time,patient.isactive from patient INNER JOIN loginmaster on loginmaster.id = patient.loginid  where loginmaster.id = '$id' and patient.date < '$current' order by date ");
while($activelist = mysql_fetch_array($comparedate)) {  
 $activel = $activelist['isactive']; 
 echo $activel;
if($activel == 0) { 
echo "<table align='center'>";
echo "<tr>
	<td width=\"3%\"><b>Name</b></td>
	<td width=\"3%\"><b>Doctor Name</b></td>
	<td width=\"3%\"><b>Date</b></td>
	<td width=\"3%\"><b>Time</b></td>
	</tr>";
	
	
while($compare = mysql_fetch_array($comparedate)) { 
	@$pid = $compare['id'];
	@$pname = $compare['name'];
	@$did = $compare['doctorid'];
	//@$pdate = $compare['date'];
	@$pdate = date("D, M jS, Y", strtotime($compare['date']));
	@$ptime = $compare['time'];
	$doctor = mysql_query("SELECT name FROM loginmaster where id = '$did' ");
	while($doctorlist = mysql_fetch_array($doctor)) { 
	@$doctorname = $doctorlist['name'];
	
	echo "<tr>";
	echo "<td width=\"3%\"> $pname</td>";
	echo "<td width=\"3%\"> $doctorname</td>";
	echo "<td width=\"3%\"> $pdate</td>";
	echo "<td width=\"3%\"> $ptime</td>";
	echo "</tr>";
	}
}
echo "</table>";
}
}
echo "No Record found";

?>