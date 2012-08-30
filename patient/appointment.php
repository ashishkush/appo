
<?php

include_once("../include/conf.php");
if(empty($_SESSION['name'])){
header('location:../patient/index.php');
}
$loginid = $_GET['loginid'];
$doctorid = $_GET['docl'];
//$date = $_GET['date'];
$time = $_GET['time'];

$originalDate = $_GET['date'];
 
//$originalDate = "2010-03-21"; 
$date = date("Y-m-d", strtotime($originalDate)); 

echo "Mail is sent to Doctor shortly you will receive a reply from doctor. Please check your mail";


 
   /*   if(isset($_POST['s']))
        {
		  	 
          $emailid=$_POST['emailid'];
          $password=$_POST['password'];
		  $name=$_POST['name'];	
          $gender=$_POST['gender'];
          $phone=$_POST['phone'];
          $address=$_POST['address'];
		  
	//	 print_r($emailid);
	//	print_r($password);
		
		 
		 
		  
				$from_email="test00455@gmail.com";
				$from_name="Ashish";
				
				$to_email=$emailid;
				$to_fullname=$name;
				
				$subject="Doctor Appointment ";
				
				$body="Dear $name,<br/><br/>";
				$body.="You've sign up for appointment with Doctor. <br/>";
				$body.="your login id = '$emailid'>.<br/>";
				$body.="your password = '$password</a>";
				$body.="<br/><br/>Regards,<br/>Ashish<br/>(Web Administrator)";
				
				include("./PHPMailer_5.2.1/class.phpmailer.php");
				try{
				$mail = new PHPMailer ();
				$mail->IsSMTP ();
				$mail->SMTPAuth   = true;
				$mail->SMTPSecure = "ssl";
				$mail->Host = "smtp.gmail.com";
				$mail->Port  = 465;
				$mail->Mailer= "smtp";
				$mail->Username= 'test00455@gmail.com';
				$mail->Password = "Admin@1234";
				$mail->AddReplyTo ($from_email, $from_name);
				$mail->From = $from_email;
				$mail->FromName = $from_name;
				$mail->Subject = $subject;
				$mail->Body = $body;
				$mail->WordWrap = 50;
				$mail->AddAddress ($to_email, $to_fullname);
				$mail->IsHTML (true);
				if(!$mail->Send())
				{
    					$info= "Message was not sent <br />PHP Mailer Error: " . $mail->ErrorInfo;
						die("Server Error :Sorry, cannot register ");
				}
				else
					$info= "<h3><center><font color='green'>Message has been sent</font></center></h3><br/>";
				unset($mail);
				}
				catch(Exceptions $e)
				{
					echo $e->getMessage();	
				}   
							

    
       */
	  
	   $query = "INSERT INTO patient values('','$loginid','$doctorid','$date','$time','1')";	   
	    mysql_query($query) or die(mysql_error());
	 
        
 
         
       ?>
