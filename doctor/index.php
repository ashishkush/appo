<?php
include('../include/conf.php');
 if(empty($_SESSION['name'])){
header('location:../index.php');
}

$name =$_SESSION['name'];
echo 'Welcome:'.' '.$name.'<br />';
$id = $_SESSION['id'];
echo "<br>";
?>
<html> <font id="ur" size="5" face="Trebuchet MS, Verdana, Arial, sans-serif" color="#DAD3B7"></font> 
<head>
<title>appointment </title>
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.date.options[form.date.options.selectedIndex].value;
self.location='index.php?cat=' + val ;  }

function reload1(form)
{
var val=form.approve.options[form.approve.options.selectedIndex].value;
self.location='index.php?approve=' + val ;  }


function UR_Start() 
{
	UR_Nu = new Date;
	UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes()) + ":" + showFilled(UR_Nu.getSeconds());
	document.getElementById("ur").innerHTML = UR_Indhold;
	setTimeout("UR_Start()",1000);
}
function showFilled(Value) 
{
	return (Value > 9) ? "" + Value : "0" + Value; alert(UR_Nu);
}

</script>


</script>
<META HTTP-EQUIV="refresh" CONTENT="15">
</head>



<?php
///echo "<body onload='UR_Start()'> ";
//echo '<script>UR_Start();</script>';

	echo "<align='right'>";
	echo "<a href='../include/logout.php'>Logout here</a>";
	echo "</right>";
	
	echo "<form action='' method='get'>";
	$timezone = new DateTimeZone("Asia/Kolkata" );
	$date = new DateTime();
	$date->setTimezone($timezone );
	$datet = $date->format( 'D, M jS, Y' );
	$tomorrow = date("D, M jS, Y", strtotime($datet. '+ 1 day'));
	$datomorrow = date("D, M jS, Y", strtotime($tomorrow. '+ 1 day'));
	$ddatomorrow = date("D, M jS, Y", strtotime($datomorrow. '+ 1 day'));
	
	$datet1 =date("Y-m-d", strtotime($datet));	
	$tomorrow1 =date("Y-m-d", strtotime($tomorrow));	
	$datomorrow1 =date("Y-m-d", strtotime($datomorrow));	
	$ddatomorrow1 =date("Y-m-d", strtotime($ddatomorrow));	

	$timezone = new DateTimeZone("Asia/Kolkata" );
	$time = new DateTime();
	$time->setTimezone($timezone );
	echo $timec = $time->format('H:i:s');
	if($timec === '20:54:00' ){
	mysql_query("UPDATE patient SET isactive = '0' WHERE date='$datet1'")or die(mysql_error());
	
	}
	
	echo "<h1 align='center'>Details </h1>";	
	echo "<table align='center'>";
	
	
	
	
	
	echo "<br>";
    @$cat = $_GET['cat'];
	$cat = date("Y-m-d", strtotime($cat)); 
	echo "<tr>";
	echo "<td>";
	echo "Select Date <select name='date' onchange=\"reload(this.form)\">";		
	echo "<option value=''>Select one</option>";
	if($datet1  === $cat){ 
	echo  "<option selected value='$datet'>$datet</option>";
	$comparedate = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.phone,patient.loginid,patient.date,patient.time,patient.isactive from patient INNER JOIN loginmaster on loginmaster.id = patient.loginid where patient.doctorid = '$id' and patient.date = '$cat' ");
	}	else {
	echo  "<option value='$datet'>$datet</option>"; 
	$comparedate = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.phone,patient.loginid,patient.date,patient.time,patient.isactive from patient INNER JOIN loginmaster on loginmaster.id = patient.loginid where patient.doctorid = '$id' and patient.date >= '$datet1' order by date ");
	} 	
	if($tomorrow1  === $cat){ echo  "<option selected value='$tomorrow'>$tomorrow</option>";
	$comparedate = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.phone,patient.loginid,patient.date,patient.time,patient.isactive from patient INNER JOIN loginmaster on loginmaster.id = patient.loginid where patient.doctorid = '$id' and patient.date = '$cat' ");
	} else {
	echo  "<option value='$tomorrow'>$tomorrow</option>"; }
	if($datomorrow1  === $cat){ echo  "<option selected value='$datomorrow'>$datomorrow</option>";
	$comparedate = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.phone,patient.loginid,patient.date,patient.time,patient.isactive from patient INNER JOIN loginmaster on loginmaster.id = patient.loginid where patient.doctorid = '$id' and patient.date = '$cat' ");
	}else {
	echo  "<option value='$datomorrow'>$datomorrow</option>"; }
	if($ddatomorrow1  === $cat){ echo  "<option selected value='$ddatomorrow'>$ddatomorrow</option>";
	$comparedate = mysql_query("select loginmaster.id,loginmaster.name,loginmaster.phone,patient.loginid,patient.date,patient.time,patient.isactive from patient INNER JOIN loginmaster on loginmaster.id = patient.loginid where patient.doctorid = '$id' and patient.date = '$cat' ");
	}else {
	echo  "<option value='$ddatomorrow'>$ddatomorrow</option>"; }  
	echo "</select><br />"; 
	echo "</td>";
	
	echo "<td>";
	//echo "<input type=\"button\" onclick=\"myfunc()\" value=\"Click!\" />";
	echo "</td>";
	
	echo "</tr>";

	
	echo "<tr>
	<td width=\"3%\"><b>Name</b></td>
	<td width=\"3%\"><b>Phone</b></td>
	<td width=\"3%\"><b>Date</b></td>
	<td width=\"3%\"><b>Time</b></td>
	<td width=\"3%\"><b>Status</b></td>
	</tr>";
		
	
	while($compare = mysql_fetch_array($comparedate)) { 
	@$pid = $compare['id'];
	@$pname = $compare['name'];
	@$phone = $compare['phone'];
	//@$pdate = $compare['date'];
	@$pdate = date("D, M jS, Y", strtotime($compare['date']));
	@$ptime = $compare['time'];
	@$pisactive = $compare['isactive'];
	if($pisactive == '0'){
	$status = "Approved"; }
	
	if($pisactive == '1'){
	$status = "Pending Approval"; }
	
	
	echo "<tr>";
	echo "<td width=\"3%\"><a href=\"viewpatient.php?id=$pid&date=$pdate&time=$ptime\"> $pname</a></td>";
	echo "<td width=\"3%\"> $phone</td>";
	echo "<td width=\"3%\"> $pdate</td>";
	echo "<td width=\"3%\"> $ptime</td>";
	echo "<td width=\"3%\"> $status</td>";
	
	if($pisactive == 1 ) {
	echo "<td width=\"3%\"><a href=\"approval.php?id=$pid&date=$pdate&time=$ptime\">edit approval</a></td>"; }
	echo "</tr>"; 
	}
	

echo "</table>";
echo "</form>";
?>

</body>
</html> 
