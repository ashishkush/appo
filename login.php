<?php
include('include/conf.php');
$error = '';
if(!empty($_POST['Submit'])){
	$emailid = protect($_POST['email']);
	$password = protect($_POST['password']);
	if($emailid==''){
		$error .= 'please enter email id<br>';
	}
	if($password==''){
		$error .= 'please enter password';
	}
	if(empty($error)){
		
		$sql = "select * from loginmaster where email='$emailid' and password='$password'";
		
		$result = mysql_query($sql)or die(mysql_error());
		if(mysql_num_rows($result)){
			$rec = mysql_fetch_assoc($result);
			
			
			$userid=$rec['userid'];
			$_SESSION['userid']=$rec['userid'];
			$_SESSION['id']=$rec['id'];
            $_SESSION['name']=$rec['name'];
			if($userid==1)
          		{
            			header("location:./admin/index.php");
          		}
      			if($userid==2)
         		{
            			header("location:./doctor/index.php");
         		}
			if($userid==3)
         		{
            			header("location:./patient/index.php");
         		}
		}else{
			$error = "Invalid username/password.";
		}
	}
}
?>

<html>
	<head><title>Login here</title>
		<script language="javascript">
			function validateLogin(){
			var form = document.frm_login;
			if(form.username.value==''){
				alert("please enter username");
				document.getElementById('username').focus();
				return false;
				}
			if(form.password.value==''){
				alert("please enter password");
				form.password.focus();
				return false;
				}
			}
		</script>
	</head>
    <body>
	
         <h1 text align="center"><font color="blue">Patient Registration and Appointment</font></h1>
       <form name="frm_login" onsubmit="return  validateLogin()" method="post" action="" >
          <table align="center">
            <tr>
          	<td colspan="2" align="left">
            		<h2>Enter your mail id and password to login</h2>
	  		<h4><font color="red"><?php echo $error; ?></h4></td>
      	   </tr>
	   <tr>
           	<td><font color="green">Email id:</font></td>
           	<td><input type="text" name="email" id="emailid"></td>
          </tr>

           <tr>
           	<td><font color="green">Password:</font></td>
           	<td><input type="password" name="password" id="password"></td>
          </tr>

          <tr>
           	<td><input type="submit"   name="Submit" value="Submit"></td>
          </td>
         </tr>

         

     </table>
   </form>


</body>
</html>

