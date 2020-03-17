<?php
 ob_start();
 session_start();

 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  
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
  
  $gender = trim($_POST['gender']);
  $gender = strip_tags($gender);
  $gender = htmlspecialchars($gender);
  
  $age = trim($_POST['age']);
  $age = strip_tags($age);
  $age = htmlspecialchars($age);
   $exist="select 1 from teachers";
   $checktableexists=mysql_query($exist);
	
 if($checktableexists==FALSE)
	  {
	  
	   $createtable = "create table teachers(userId int AUTO_INCREMENT,userName varchar(255),userEmail varchar(255),userPass varchar(255),userMobile bigint,userGender varchar(15),userAge Bigint,PRIMARY KEY (userID))";
   $result = mysql_query($createtable);  

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
  } else if (!preg_match("/^[0-60]+$/",$age)) {
   $error = true;
   $ageError = "Invalid age";
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
  /* $query = "SELECT userEmail FROM teachers WHERE userEmail='$email'";
   $result1 = mysql_query($query);
 $count = mysql_num_rows($result1);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }*/
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
	
	  
   $query = "INSERT INTO teachers(userName,userEmail,userPass,userMobile,userGender,userAge) VALUES('$name','$email','$password','$mobile','$gender','$age')";
   $res = mysql_query($query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
	unset($mobile);
	unset($gender);
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
             <h2 class="">Teacher Details.</h2>
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
                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
             <input type="text" name="mobile" class="form-control" placeholder="Enter mobile no" maxlength="10" value="<?php echo $mobile ?>"/>
                </div>
                <span class="text-danger"><?php echo $mobileError; ?></span>
            </div>
			
			
           <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="age" class="form-control" placeholder="Enter age" maxlength="15" value="<?php echo $age ?>"/>
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