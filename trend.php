<?php
echo"
<html>
<head>
<meta http-equiv=Content-Type content=text/html; charset=utf-8' />

<link rel='stylesheet' href='assets/css/bootstrap.min.css' type='text/css' />
<link rel='stylesheet' href='style.css' type='text/css' />
<style>
body {margin:0;}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #008749;
}

ul.topnav li {float: left;}

ul.topnav li a {
  display: inline-block;
  color: #FFFFFF;
  text-align: center;
  padding: 15px 40px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 25px;
}

.diviq{
	
	width:20%;
  height:12%;
  top:0%;
  position:absolute;
	overflow: hidden;
  background-color: #008749;
}
.diviw{
	
	width:40%;
	height:12%;
	left:18%;
	top:0%;
	position:absolute;

	overflow: hidden;
  background-color: #008749;
}
.divie{
	
	width:40%;
	height:12%;
	left:45%;
	top:0%;
	position:absolute;

	overflow: hidden;
  background-color: #008749;
}

.divit{
	
	width:30%;
	height:12%;
	left:70%;
	top:0%;
	position:absolute;

	overflow: hidden;
  background-color:#008749;
}


.diviz{
	
	width:100%;
	height:80%;
	position:absolute;
}

.diviq a{

}
.diviq a button{
	background-color: #008749;
	border:solid #008749;
	display: inline-block;
	display: inline-block;
	text-align: center;
	top:20%;
	height:50%;
	width:80%;
	left:7%;
position:absolute;
	color:#FFFFFF;
  font-size: 25px;
   cursor: pointer;
}
.diviw a{

}
.diviw a button{
		background-color: #008749;
	border:solid #008749;
	display: inline-block;
	text-align: center;
	 text-decoration: none;
    display: inline-block;
	top:20%;
	height:50%;
	width:80%;
	left:5%;
position:absolute;
	color: 	#FFFFFF;
  font-size: 25px;
   cursor: pointer;

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
	top:20%;
	height:50%;
	width:80%;
	left:5%;
position:absolute;
	color:	#FFFFFF;
  font-size: 25px;
   cursor: pointer;
}


.divit a{

}
.divit a button{
	background-color: #008749;
	border:solid #008749;
	display: inline-block;
	text-align: center;
	 text-decoration: none;
    display: inline-block;
	top:20%;
	height:50%;
	width:80%;
	left:40%;
position:absolute;
	color: 	#FFFFFF;
  font-size: 25px;
   cursor: pointer;
}

.divy{
	position:absolute;
	top:11%;
	height:85%;
	width:100%;
	left:0%;
	overflow-x:hidden;
overflow-y:hidden;
}

.divi3{
 border:solid 0.5px #000000;
	left:34%;
top:15%;
  height:5.5%;
  width:20%;
 position:absolute;
 }
 .divi3 select{
       border:solid 0.5px #000000;
	left:0%;
top:0%;
  height:100%;
  width:100%;
 position:absolute;
 }
  .divi4{
  
	left:54%;
top:15%;
  height:17.5%;
  width:10%;
 position:absolute;
 }
.divi4 button{
	border:solid 0.5px #222d32;
	 background-color: #dd4b39;

	width:100%;
	height:32%;
	display: inline-block;
  color: #FFFFFF;
}
.divi1
{
	top:30%;
	left:0%;
	width:100%;
	height:20%
	 position:absolute;
}
.divi2
{   
     border:solid 0.5px #000000;
	top:28%;
	left:5%;
	width:39.2%;
	height:72%;
	 position:absolute;
}
.divi5
{   
    border:solid 0.5px #000000;
	top:28%;
	left:55%;
	width:39.2%;
	height:72%;
	 position:absolute;
}
.divi6
{   
   border:solid 0.5px #000000;
	top:50%;
	left:0%;
	width:100%;
	height:50%;
}


ul.topnav li.icon {display: none;}


</style>
</head>
<body style='background-color:#ecf0f5'>
<div class='diviz'>
<div class='diviq'>
<a  href='main3.php'><button>Statistics</button></a></div>
<div class='diviw'>
<a href='history.php' target='_self'><button>Student History</button></a></div>

<div class='divie'>
<a class='active' href='trend.php'><button>Subject Trends</button></a></div>



<div class='divit'>
<a href='logout.php'><button>Logout</button></a></div>
</div>
<ul class='topnav' id='myTopnav'>

  <li class='icon'>
    <a href='javascript:void(0);' style='font-size:15px;' onclick='myFunction()'>☰</a>
  </li>
</ul>


";

session_start();
$con = mysqli_connect("localhost","root","","analysis");
if(!$con)
{
 die("Could not connect".mysqli_error($con));
}
else{
$sheetname="";
$subject="";

$n="Select * FROM `name`";
$result=mysqli_query($con,$n);
while ($row = mysqli_fetch_assoc($result)){
	
		$sheetname = $row['Name'];

}

$bz="SELECT COUNT(*) AS `total` FROM information_schema.columns WHERE table_name='$sheetname' ";
$ba=mysqli_query($con,$bz);
$zz=mysqli_fetch_assoc($ba);


	$nvn="SHOW COLUMNS FROM `$sheetname`";
$res=mysqli_query($con,$nvn);
while ($x = mysqli_fetch_assoc($res)){
	
		$fields[] = $x['Field'];
		}
		
		
	$c="Grand.Total";
for($tt=3;$tt<$zz['total'];$tt++)
{
	if(($fields[$tt]=="Total") ||($fields[$tt]==$c) || ($fields[$tt]=="Percentage")|| ($fields[$tt]=="Class"))
	{
		$g=$tt;
		//echo "this is".$g;
		break;
	}

}	
echo"
<div class=divi3 >
<form method='post' id='form' action='' >
 
   <select name='dropdown' placeholder='select subject'><option></option>";
				
				for($t=3;$t<$g;$t++)
{
	echo "<option>".$fields[$t]."</option>";
}
echo"</select>
				
             
			   
</div>
<div class=divi4>
 <button name='submit' type='submit'  target='_self'>submit</button>
</div>



";
if(isset($_POST['submit']))
{
	$subject=$_POST['dropdown'];
	
	
	$query1="create table subject(subject varchar(255))";
	$result1=mysqli_query($con,$query1);
	$query2="delete from subject";
	$result2=mysqli_query($con,$query2);
	$query3="insert into subject(subject) values ('$subject')";
	$result3=mysqli_query($con,$query3);
	
	
	
	
	
	


echo" <div class=divi2><img src='avg_graph.php' /></div>";	


echo" <div class= divi5><img src='pass_perc.php' /></div>";	

}












		
}
echo"
</form>
</body>
</html>";
mysqli_close($con);
?>
