
<?php

		include_once("../include/conf.php");
      if(isset($_POST['s'])) {		  
         $emailid=$_POST['emailid'];
          $password=$_POST['password'];	
		  $name=$_POST['name'];	 		  
          $gender=$_POST['gender'];
          $phone=$_POST['phone'];
		  $address=$_POST['address'];
			$spid=$_POST['specialization'];	
		  $otherspecialization=$_POST['otherspecialization'];
		  $areaid=$_POST['area'];
		  $startoftime=$_POST['startoftime'];
		  $endoftime=$_POST['endoftime'];
          

    
			
			mysql_query("INSERT INTO loginmaster values('','2','$emailid','$password','$name','$gender','$phone','$address','1')") or die(mysql_error());
			$loginid = mysql_insert_id();
		//	mysql_query("INSERT INTO area values('','$arealist')") or die(mysql_error());
		//	$areaid = mysql_insert_id();
		//	mysql_query("INSERT INTO specilisation values('','$specvalue')") or die(mysql_error());
		//	$spid = mysql_insert_id();
			mysql_query("INSERT INTO doctor values('','$loginid','$areaid','$spid','$startoftime','$endoftime','$otherspecialization')") or die(mysql_error());
      
			
	 
		header('location:index.php');  
         }  
       ?>
<html>
     <body>
        <form action="" method="post">
           <table>  

			<tr>
          	<td colspan="2" align="left">
            		<h2>Doctor Registration</h2></td>
	  		
      	   </tr>
		   
		   <tr>
             <td>Name:</td>
              <td><input type="text" size="20" name="name"></td>
         </tr>
		 
		 <tr>
               <td>E-Mail Id:</td>
                <td><input type="text" name="emailid"></td>
         </tr>

         <tr>
             <td>Password:</td>
              <td><input type="password" name="password"></td>
          </tr>         

            <tr>
                 <td>Gender:</td>
                 <td><input type="radio" name="gender" value="M">Male
                  <input type="radio" name="gender" value="F">Female</td
            </tr>
			
			<tr>			
             <td>Phone:</td>
              <td><input type="text" size="20" name="phone"></td>
			</tr>
			
			<tr>
             <td>Specialization:</td>
              <td>
			  <?php
				echo "<select name='specialization'> <option value=''>Select one</option>";
				$spec = mysql_query("SELECT * FROM specilisation  "); 
				while($specvalue = mysql_fetch_array($spec)) {					
				  echo "<option value='$specvalue[id]';>$specvalue[spname] </option> ";
				    }						
			 echo "</select>";   ?>
			  </td>
			  </tr>
			  		 
		 <tr>
             <td>Other Specialization:</td>
              <td><input type="text" size="20" name="otherspecialization"></td>
         </tr>

		 <tr>
             <td>Start Time:</td>
              <td><input type="text" size="20" name="startoftime"></td>
         </tr>
		 
		  <tr>
             <td>End Time:</td>
              <td><input type="text" size="20" name="endoftime"></td>
         </tr>
		 		 
		 <tr>
             <td>Area:</td>
              <td>
			  <?php
				echo "<select name='area'> <option value=''>Select one</option>";
			  $areaq = mysql_query("select * from area ") ;
			  while($arealist = mysql_fetch_array($areaq)) { 
				echo "<option value='$arealist[id]';>$arealist[name]</option>" ;}
				 echo "</select>";   ?>
			  </td>
         </tr>
              
             
             <tr>
                  <td>Address:</td>
                  <td><textarea name="address" row="10" col="30"></textarea></td>
             </tr>

              <tr>
                   <td><input type="submit" name="s"  value="submit"></td>
				   <td><input type="reset"  value="Reset"></td>
              </tr>
          </table>
       </form>
     </body>
</html>

