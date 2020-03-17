<?php
session_start();  
$email=$_SESSION['dong'];
$_SESSION['ding'] = $email;
echo"
<html>
<head>
<title>
Student Profile
</title>


<style>
body {margin:0;}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
 
}

.divi0
   {
	   
    text-align:center;
  solid #000000;

  top:10%;
  height:95%;
  width:27%;
  position:absolute;
  }
  


.diviq{
	  text-align:center;
	  font-family:   'Comic Sans MS', cursive, sans-serif;
     font-size:    23px;
	 color:white;
	width:28%;
  height:10%;
  top:0%;
  position:absolute;
	overflow: hidden;
  background-color: #008749;
}
.diviw{
	  text-align:center;
	  font-family:   'Comic Sans MS', cursive, sans-serif;
     font-size:    23px;
	 color:white;
	 left:28%;
	width:62%;
  height:10%;
  top:0%;
  position:absolute;
	overflow: hidden;
  background-color: #008749;
}
  
  .divie{
	
	width:11%;
	height:10%;
	left:89%;
	top:0%;
	position:absolute;

	overflow: hidden;
  background-color: #008749;
}
  .divie a{

}
.divie a button{
	background-color: #008749;
	border:solid #008749;
	display: inline-block;
	text-align: center;
	 text-decoration: none;
    display: inline-block;
	top:0%;
	height:100%;
	width:100%;
	left:0%;
position:absolute;
	color:	#FFFFFF;
  font-size: 25px;
   cursor: pointer;
}

  .divtemp{
	
	left:27%;
	
	
	  font-size: 25px;
    height:95%;
  width:72.7%;
  position:absolute;
 top:10%;

  
  }




ul.topnav li.icon {display: none;}
</style>
</head>
<body>


 <div class=diviq>
   <p><b>My Profile</b><p>
 </div>
 <div class=diviw>
  <p><b>History</b><p>
  </div>
   <div class=divie>
   <a href='logout.php'><button>Logout</button></a>
   </div>
  
   
 <div class=divtemp>
   <iframe src='studhist.php' frameborder='0' scrolling='yes' width='100%' height='100%' align='right'></iframe>
   </div>	
 <div class=divi0>
   <iframe src='getdetails1.php' frameborder='0' scrolling='no' width='100%' height='100%'></iframe>
</div>

</div>
</body>
</html>";
?>