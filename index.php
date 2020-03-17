<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// it will never let you open index(login) page if session is set
/*	if ( isset($_SESSION['user'])!="" ) {
		header("Location: home.php");
		exit;
	}*/
	$email="";
	$pass="";
	$error = false;
	
if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		$_SESSION['dong'] = $email;
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
			$row=mysql_fetch_array($res);
			 echo $row['userPass'];
			$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
			
			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				header("Location: studpro.php");
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
		
	}

	if( isset($_POST['btn-loging']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		$_SESSION['dong'] = $email;
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysql_query("SELECT userId, userName, userPass FROM teachers WHERE userEmail='$email'");
			$row=mysql_fetch_array($res);
			 echo $row['userPass'];
			$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
			
			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				header("Location: main3.php");
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
.divi0{
	 border:solid 0.5px #000000;
	 background-color:#222d32;
	 left:32%;
top:20%;
  height:50%;
  width:40%;
 position:absolute;
}
  .divi1{
	  border:solid 0.5px #000000;
background-color:#222d32;
	left:3%;
top:95%;
  height:20%;
  width:45%;
 position:absolute;
 }
.divi1 button{
	
	
	width:100%;
	height:100%;
	display: inline-block;
  color: #f2f2f2;
}
  .divi2{
	  border:solid 0.5px #000000;
background-color:#222d32;
	left:52%;
top:95%;
  height:20%;
  width:45%;
 position:absolute;
 }
.divi2 button{

	
	
	width:100%;
	height:100%;
	display: inline-block;
  color: #f2f2f2;
}
  .divi3{

	left:10%;
top:120%;
  height:10%;
  width:35%;
 position:absolute;
 }
   .divi4{

	left:62%;
top:120%;
  height:10%;
  width:35%;
 position:absolute;
 }
 .divi5{
	 background-color: #B9E0F6;
	  font-family:   "Trebuchet MS", Helvetica, sans-serif;
                font-size:     40px;
      
		left:16%;
top:0%;
  height:20%;
  width:84%;
 position:absolute;
 }
  .divi6{

		left:3%;
 background-color: #B9E0F6;
  height:20%;
  width:12%;
 position:absolute;
 }
 .divi7{

		left:0%;
 background-color: #B9E0F6;
  height:20%;
  width:3%;
 position:absolute;
 }
 .divi8{

		left:15%;
 background-color: #B9E0F6;
  height:20%;
  width:1%;
 position:absolute;
 }
  h2 {
	  color:white;
	  }
.divi9{

		left:0%;
  background-color:#ecf0f5;
  top:20%;
  height:80%;
  width:32%;
 position:absolute;
 }
 .divi10{

		left:72%;
 background-color:#ecf0f5;
   top:20%;
  height:80%;
  width:28%;
 position:absolute;
 }
 .divi11{
top:70%;
left:32%;
 background-color:#ecf0f5;
  height:30%;
  width:40%;
 position:absolute;
 }
</style>
</head>
<body>
<div class="divi7">
</div>
<div class="divi6">
<img src="MITCOE.png" alt="Logo" width="100%" height="100%">
</div>
<div class="divi8">
</div>
<div class="divi9">
</div>
<div class="divi10">
</div>
<div class="divi11">
</div>
<div class= "divi5">
MITCOE's<br>
DEPARTMENT OF INFORMATION TECHNOLOGY
</div>
<div class = divi0>


	
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            <div class=divi1>
          
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In As Student</button>
              
			  </div>
			  <div class=divi2>
            	<button type="submit" class="btn btn-block btn-primary" name="btn-loging">Sign In As Teacher</button>
            </div>
            
     
            
            <div class=divi3>
            	<a href="home.php">Sign Up For Students...</a>
            </div>
			
			   <div class=divi4>
            	<a href="home1.php">Sign Up For Teachers...</a>
            </div>
        
        </div>
   
    </form>
    


</div>
</body>
</html>
<?php ob_end_flush(); ?>