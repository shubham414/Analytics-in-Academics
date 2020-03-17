<?php


$con = mysqli_connect("localhost","root","","analysis");
 
 if(!$con) 
 {      
   die("Could not connect".mysqli_error($con)); 
  }

else
{
session_start();  
$email =$_SESSION['ding'];

$sdd ="SELECT * FROM users where userEmail = '$email' ";

$comments = mysqli_query($con,$sdd);

while($row = mysqli_fetch_array($comments, MYSQL_ASSOC))
{
  $email = $row['userEmail'];
  $pass = $row['userPass'];
  $name=  $row['userName'];
  $roll = $row['userRoll'];
  $addr = $row['userAddr'];
  $mobile = $row['userMobile'];
  $zip = $row['userZip'];
  $age = $row['userAge'];
  $gender = $row['userGender'];
  $marks10= $row['user10marks'];
  $marks12 = $row['user12marks'];
  
  $email = htmlspecialchars($row['userEmail'],ENT_QUOTES);
  $pass = htmlspecialchars($row['userPass'],ENT_QUOTES);
  $name = htmlspecialchars($row['userName'],ENT_QUOTES);
  $roll = htmlspecialchars($row['userRoll'],ENT_QUOTES);
  $mobile = htmlspecialchars($row['userMobile'],ENT_QUOTES);
  $addr = htmlspecialchars($row['userAddr'],ENT_QUOTES);
  $zip = htmlspecialchars($row['userZip'],ENT_QUOTES);
  $age = htmlspecialchars($row['userAge'],ENT_QUOTES);
  $gender = htmlspecialchars($row['userGender'],ENT_QUOTES);
  $marks10= htmlspecialchars($row['user10marks'],ENT_QUOTES);
  $marks12 = htmlspecialchars($row['user12marks'],ENT_QUOTES);
}
$semError = " ";
  $error = false;
 if ( isset($_POST['btn-sem']) ) {
	 $semester = trim($_POST['semester']);
  $semester = strip_tags($semester);
  $semester = htmlspecialchars($semester);
  
 
   if (empty($semester)) {
   $error = true;
   $semError = "Previous Result Semester .";
  } else if (strlen($semester)!= 10 ) {
   $error = true;
   $semError = "Invalid Input";
  }

  if( !$error ) {
   
   $query = "UPDATE users SET `lastsemester` = '$semester' WHERE userEmail = '$email'" ;
   $res = mysqli_query($con,$query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Submitted";
 
	unset($semester);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }  
  
 }
  
  ?>
   <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
h5{
		  color:white;
}
</style>
</head>
<body style='background-color:#222d32'>
<div class="container">

 <div id="login-form">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
  <div class="col-md-12">
        
        <!--<div class="form-group">
             <h2 class="">Student Details.</h2>
            </div>-->
		
			     <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span><b>Roll</b></span></span>
             <input type="text" name="roll" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $roll ?>" />
               </div>
			   </div>
              
			     <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $name ?>" />
               </div>
			   </div>
               
			   	  <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="text" name="email" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $email ?>" />
               </div>
			      </div>
             
		    <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
             <input type="text" name="mobile" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $mobile ?>" />
               </div>
			      </div>
             
			   <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
             <input type="text" name="addr" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $addr ?>" />
               </div>
			      </div>
               
			   	  <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-fire"></span></span>
             <input type="text" name="zip" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $zip ?>" />
               </div>
			      </div>
             
	
			      	  <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="age" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $age ?>" />
               </div>
			      </div>
            
			   	  <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span><b>10th</b></span></span>
             <input type="text" name="marks10" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $marks10 ?>" />
               </div>
			      </div>
              
			   	  <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span><b>12th</b></span></span>
             <input type="text" name="marks12" class="form-control" readonly="readonly" maxlength="50" value="<?php echo $marks12 ?>" />
               </div>
			      </div>
             
			  
			<?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
		
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
             <input type="text" name="semester" class="form-control" placeholder="Enter Previous Result Semester" maxlength="10" />
                </div>
                <span class="text-danger"><?php echo $semError; ?></span>
           
			
			
			
			 
             <div class="input-group">
               <h5>
				Note:
			 format for result :- Class+Sem+Year eg(fesem12015)
		    <h5>
			</div>
			
			 
			 
			<div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-sem">Submit</button>
            </div>
			
		
			
		</div>	
		 </form>
		</div> 
  </div> 
  
 <?php

}

mysqli_close($con);

?>