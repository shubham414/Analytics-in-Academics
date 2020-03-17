<?php
 ob_start();
 session_start();
 /*if( isset($_SESSION['user'])!="" ){
  header("Location: home.php");
 }*/
 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  
  $roll = trim($_POST['roll']);
  $roll = strip_tags($roll);
  $roll = htmlspecialchars($roll);
  
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  $mobile = trim($_POST['mobile']);
  $mobile = strip_tags($mobile);
  $mobile = htmlspecialchars($mobile);
  
  $addr = trim($_POST['addr']);
  $addr = strip_tags($addr);
  $addr = htmlspecialchars($addr);
  
  $zip = trim($_POST['zip']);
  $zip = strip_tags($zip);
  $zip = htmlspecialchars($zip);
  
  $gender = trim($_POST['gender']);
  $gender = strip_tags($gender);
  $gender = htmlspecialchars($gender);
  
    $marks10 = trim($_POST['marks10']);
  $marks10 = strip_tags($marks10);
  $marks10 = htmlspecialchars($marks10);
  
     $marks12 = trim($_POST['marks12']);
  $marks12 = strip_tags($marks12);
  $marks12 = htmlspecialchars($marks12);
  
    $age = trim($_POST['age']);
  $age = strip_tags($age);
  $age = htmlspecialchars($age);
   $exist="select 1 from users";
    $checktableexists=mysql_query($exist);
	
  if($checktableexists==FALSE)
	  {
		   
	   $createtable = "create table users(userId int AUTO_INCREMENT,userRoll int,userName varchar(255),userEmail varchar(255),userPass varchar(255),userMobile bigint,userAddr varchar(255),userZip int,userGender varchar(15),userAge int,user10marks int,user12marks int,lastsemester varchar(255),PRIMARY KEY (userID)) ";
   $result = mysql_query($createtable);  

	  }
  
  
  if (empty($addr)) {
   $error = true;
   $addrError = "Please provide address.";
  } 
    if (!isset($_POST['gender'])) {
   $error = true;
   $genderError = "Please select gender.";
  } 
  
   if (empty($age)) {
   $error = true;
   $ageError = "Please enter Age.";
  } else if (strlen($age)!= 2 ) {
   $error = true;
   $ageError = "Invalid age";
  } else if (!preg_match("/^[0-40]+$/",$age)) {
   $error = true;
   $ageError = "Invalid age";
  }
  
  
  
  if (empty($marks10)) {
   $error = true;
   $mark1Error = "Please enter 10th percentage.";
  } 
  else if (!preg_match("/^[0-9]+\.[0-9]+$/",$marks10)) {
   $error = true;
   $mark1Error = "Please provide percentage upto 2 decimal";
  }
  
  if (empty($marks12)) {
   $error = true;
   $mark2Error = "Please enter 12th/Diploma percentage.";
  } 
  else if (!preg_match("/^[0-9]+\.[0-9]+$/",$marks12)) {
   $error = true;
   $mark2Error = "Please provide percentage upto 2 decimal";
  }
  
  if (empty($zip)) {
   $error = true;
   $zipError = "Please enter Zip-Code.";
  } else if (strlen($zip) !=6 ) {
   $error = true;
   $zipError = " Zip-Code must contain 6 digits.";
  } else if (preg_match("/^[a-zA-Z ]+$/",$zip)) {
   $error = true;
   $zipError = "Zip-Code must contain digits";
  }
  
  
  if (empty($roll)) {
   $error = true;
   $rollError = "Please enter your Roll Number.";
  } else if (strlen($roll) !=7 ) {
   $error = true;
   $rollError = "Roll number must contain 7 digits.";
  } else if (preg_match("/^[a-zA-Z ]+$/",$roll)) {
   $error = true;
   $rollError = "Roll number must contain digits";
  }
  
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name as per marksheet.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
  if (empty($mobile)) {
   $error = true;
   $mobileError = "Please enter your full mobile number.";
  } else if (strlen($mobile) != 10) {
   $error = true;
   $mobileError = "mobile number must have  10 digits.";
  } else if (preg_match("/^[a-zA-Z ]+$/",$mobile)) {
   $error = true;
   $mobileError = "mobile number must contain digits.";
  }
  // if there's no error, continue to signup
  if( !$error ) {
	
	  
   $query = "INSERT INTO users(userRoll,userName,userEmail,userPass,userMobile,userAddr,userZip,userGender,userAge,user10marks,user12marks) VALUES('$roll','$name','$email','$password','$mobile','$addr','$zip','$gender','$age','$marks10','$marks12')";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
	unset($mobile);
	unset($roll);
	unset($addr);
	unset($zip);
	unset($gender);
	unset($marks10);
	unset($marks12);
	unset($age);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
   
  }
  
  
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Details</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Student Details.</h2>
            </div>
        
         <div class="form-group">
             <hr />
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
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="roll" class="form-control" placeholder="Enter Roll Number" maxlength="50" value="<?php echo $name ?>" />
                </div>
                <span class="text-danger"><?php echo $rollError; ?></span>
            </div>
			
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
			
			     <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
             <input type="text" name="addr" class="form-control" placeholder=" Address" maxlength="50" value="<?php echo $addr ?>"/>
                </div>
                <span class="text-danger"><?php echo $addrError; ?></span>
            </div> 
			   
			 <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
             <input type="text" name="mobile" class="form-control" placeholder="Enter mobile no" maxlength="15" value="<?php echo $mobile ?>" />
                </div>
                <span class="text-danger"><?php echo $mobileError; ?></span>
            </div>
			
				 <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-fire"></span></span>
             <input type="text" name="zip" class="form-control" placeholder="Zip-Code" maxlength="15" value="<?php echo $zip ?>"/>
                </div>
                <span class="text-danger"><?php echo $zipError; ?></span>
            </div>
            
			
					 <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-fire"></span></span>
             <input type="text" name="marks10" class="form-control" placeholder="Enter 10th percentage" maxlength="15" value="<?php echo $marks10 ?>" />
                </div>
                <span class="text-danger"><?php echo $mark1Error; ?></span>
            </div>
			
				 <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-fire"></span></span>
             <input type="text" name="marks12" class="form-control" placeholder="Enter 12th percentage" maxlength="15"  value="<?php echo $marks12 ?>" />
                </div>
                <span class="text-danger"><?php echo $mark2Error; ?></span>
            </div>
			
			<div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="age" class="form-control" placeholder="Enter age" maxlength="15" value="<?php echo $age?>"/>
                </div>
                <span class="text-danger"><?php echo $ageError; ?></span>
            </div>
			
			<div class="form-group">
             <div class="input-group">
			   <input type="radio" name="gender" value="female" >Female
                    <input type="radio" name="gender" value="male">Male
                </div>
                <span class="text-danger"><?php echo $genderError; ?></span>
            </div>
			
			
			
			
			
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Submit</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>
<?php ob_end_flush(); ?>