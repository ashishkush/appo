
<?php
  include("include/conf.php");
 ?>

<html>
<head>
<title>appointment </title>
<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value;
self.location='index.php?cat=' + val ;  
}

function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.specilaziation.options[form.specilaziation.options.selectedIndex].value; 
self.location='index.php?cat=' + val + '&cat3=' + val2 ; 
}

function reload4(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.specilaziation.options[form.specilaziation.options.selectedIndex].value; 
var val3=form.docl.options[form.docl.options.selectedIndex].value; 						
self.location='index.php?cat=' + val + '&cat3=' + val2 +  '&cat4=' + val3;  
}

function reload5(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.specilaziation.options[form.specilaziation.options.selectedIndex].value; 
var val3=form.docl.options[form.docl.options.selectedIndex].value; 						
var val4=form.date.options[form.date.options.selectedIndex].text; 		
self.location='index.php?cat=' + val + '&cat3=' + val2 +  '&cat4=' + val3 + '&cat5=' +val4;  
}


</script>
</head>
<body>

<?php

//++++++++++++++++++++++++++++++++Getting the data from Mysql table for first drop down++++++++++++++++++++
$areaq = mysql_query("select distinct * from area ")or die(mysql_error());
//++++++++++++++++++++++++++++++++End of query for first drop down+++++++++++++++++++++++++++++++++++++++++


@$cat=protect($_GET['cat']);  //area id
//++++++++++++++++++++++++++++++++Getting the data for specilaziation drop down++++++++++++++++++++++++++++
if(isset($cat) and strlen($cat) > 0){
	$spec = mysql_query("select distinct doctor.spid,specilisation.spname from specilisation INNER JOIN doctor on specilisation.id = doctor.spid  where doctor.areaid = $cat ");
		}
//++++++++++++++++++++++++++++++++End of query for specilaziation drop down+++++++++++++++++++++++++++++++++++++		
		
		
@$cat3=protect($_GET['cat3']);  //spid
//++++++++++++++++++++++++++++++++Getting the data for doctor drop down+++++++++++++++++++++++++++++++++++++++++
if(isset($cat3) and strlen($cat3) > 0){
$doc = mysql_query("select distinct loginmaster.name,doctor.loginid from loginmaster INNER JOIN doctor on loginmaster.id = doctor.loginid  where doctor.spid = $cat3 ");
	}		
//++++++++++++++++++++++++++++++++End of query for doctor drop down++++++++++++++++++++++


@$cat4 = protect($_GET['cat4']);  //docid
if(isset($cat4) and strlen($cat4) > 0){
//$time = mysql_query("select doctor.startoftime,doctor.endoftime from loginmaster INNER JOIN doctor on loginmaster.id = doctor.loginid  where doctor.spid = $cat3 ");
$time = mysql_query("select startoftime,endoftime from doctor where loginid = $cat4 ");
     	while($querval = mysql_fetch_array($time)) {
		@$startoftime = $querval[startoftime];
		@$endoftime = $querval[endoftime];
		
			} 
}		

echo "<h1>"."Search Doctor" ."<br>"."<br>"."</h1>";
echo "<b>"."City :"."   "."Noida" ;
echo "<form action='registration.php' method='get'>";

//++++++++++++++++++++++++++++++++area Drop Down+++++++++++++++++++++++++++++++++++++++++
echo "Area:  <select name='cat' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
while($arealist = mysql_fetch_array($areaq)) { 
if($arealist['id']==@$cat){echo "<option selected value='$arealist[id]'>$arealist[name]</option>"."<BR>";}
else{echo  "<option value='$arealist[id]'>$arealist[name]</option>";}
}
echo "</select><br />";
//++++++++++++++++++++++++++++++++End of area Drop Down++++++++++++++++++++++++++++++++++


//++++++++++++++++++++++++++++++++Specilaztion Drop Down+++++++++++++++++++++++++++++++++
echo "Specilization:  <select name='specilaziation' onchange=\"reload3(this.form)\"> <option value=''>Select one</option>";
if(isset($spec))  {
while($speclist = mysql_fetch_array($spec)) {
if($speclist['spid']==@$cat3)
	{
	echo "<option selected value='$speclist[spid]'>$speclist[spname]</option>"."<BR>";
	}else
		{  
	echo  "<option value='$speclist[spid]'>$speclist[spname]</option>";
		}  
}	
}
echo "</select><br />";
//++++++++++++++++++++++++++++++++End Specilaztion Drop Down++++++++++++++++++++++++++++++


//++++++++++++++++++++++++++++++++Doctor Drop Down++++++++++++++++++++++++++++++++++++++++
echo "Doctor: <select name='docl' onchange=\"reload4(this.form)\"><option value=''>Select one</option>";  
if(isset($spec))  {
while($doclist = mysql_fetch_array($doc)) {
if($doclist['loginid']==@$cat4)
	{
	echo  "<option selected value='$doclist[loginid]'>$doclist[name]</option>";
	}else
		{  
	echo  "<option value='$doclist[loginid]'>$doclist[name]</option>";
	}
}
}
echo "</select><br />";
//++++++++++++++++++++++++++++++++End doctor Drop Down+++++++++++++++++++++++++++++++++++++


if(isset($cat4) and strlen($cat4) > 0){
$timezone = new DateTimeZone("Asia/Kolkata" );
$date = new DateTime();
$date->setTimezone($timezone );
$datet = $date->format( 'D, M jS, Y' );
$tomorrow = date("D, M jS, Y", strtotime($datet. '+ 1 day'));
$datomorrow = date("D, M jS, Y", strtotime($tomorrow. '+ 1 day'));
$ddatomorrow = date("D, M jS, Y", strtotime($datomorrow. '+ 1 day'));
}

//++++++++++++++++++++++++++++++++Date drop down++++++++++++++++++++++++++++++++++++++++++++
	@$cat5 = protect($_GET['cat5']);
	
	if($cat4 == null){
		echo "Select Date <select name='date'>";		
		echo "<option value=''>Select one</option>";
		echo "</select><br />"; 
	}
	else{
	echo "Select Date <select name='date' onchange=\"reload5(this.form)\">";		
	echo "<option value=''>Select one</option>";
	if($tomorrow  == $cat5){ echo  "<option selected value='$tomorrow'>$tomorrow</option>";}else {
	echo  "<option value='$tomorrow'>$tomorrow</option>";}
	if($datomorrow  == $cat5){ echo  "<option selected value='$datomorrow'>$datomorrow</option>";}else {
	echo  "<option value='$datomorrow'>$datomorrow</option>";}
	if($ddatomorrow  == $cat5){ echo  "<option selected value='$ddatomorrow'>$ddatomorrow</option>";}else {
	echo  "<option value='$ddatomorrow'>$ddatomorrow</option>";}
	echo "</select><br />"; 
	}
	
	

//++++++++++++++++++++++++++++++++End of date drop down+++++++++++++++++++++++++++++++++++++++


	$explode = (explode(",",$cat5));
	$sunday = $explode[0];
	if($sunday == @Sun){
	echo "Chutti hai , Please choose different day";
	echo "<br>";
	echo "<br>";
	die; 
	}


//++++++++++++++++++++++++++++++++Calculate total time in minutes+++++++++++++++++++++++++++++++++++
if(isset($cat4) and strlen($cat4) > 0){
  
FUNCTION getTimeDiff($dtime,$atime){
 
 $nextDay=$dtime>$atime?1:0;
 $dep=EXPLODE(':',$dtime);
 $arr=EXPLODE(':',$atime);
 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
 $hours=FLOOR($diff/(60*60));
 $mins=FLOOR(($diff-($hours*60*60))/(60));
 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
 IF(STRLEN($hours)<2){$hours="0".$hours;}
 IF(STRLEN($mins)<2){$mins="0".$mins;}
 IF(STRLEN($secs)<2){$secs="0".$secs;}
 //RETURN $hours.':'.$mins.':'.$secs;
 return $totalmins = ($hours*60) + $mins ;
}
 $mins = getTimeDiff($startoftime,$endoftime); 
 $timeslot = $mins /30 ;
 }
//++++++++++++++++++++++++++++++++End of calculate total time in minutes+++++++++++++++++++++++++++++++++++


$result = array();
if(isset($cat5) ) {
$cat5 = date("Y-m-d", strtotime($cat5));
$comparedatetime = mysql_query("select time from patient where doctorid = '$cat4' && date =  '$cat5' ")or die(mysql_error());
	while($rttimeval = mysql_fetch_array($comparedatetime)) {
		@$ttime = $rttimeval[time];
		array_push($result, $ttime);
		}		
 	}

	
//++++++++++++++++++++++++++++++++Time drop down++++++++++++++++++++++++++++++++++++
	
	if(isset($cat4) and strlen($cat4) > 0){
	$interval =array();
	for($i=1;$i<= $timeslot;$i++)
	{ 
	$startoftime = date('H:i:s', strtotime($startoftime) );		
	array_push($interval, $startoftime);
	$startoftime = date('H:i:s', strtotime($startoftime.'+ 30 min') );		
	}
	
	$difftime=array_diff($interval,$result);
}
	
	echo "Select Time <select name='time' ><option value=''>Select one</option>";  
	if(isset($spec))  {
	foreach($difftime as $value ){
	echo  "<option value='$value'>$value</option>";  
		} 
	}
	echo "</select>";
	

//++++++++++++++++++++++++++++++++End of time drop down++++++++++++++++++++++++++++++++++++
  

echo "<br>";
echo "<br>";
echo "<input type=submit name='s' value=Submit>";
echo "</ br>";
echo "</form>";
echo "<A href='login.php'>If already registered</A>";
?>
</body>

</html>

