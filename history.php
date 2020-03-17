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
  color: #f2f2f2;
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

.divi0
   {
    text-align:center;
	background-color:#222d32;
 border:solid 0.5px #000000;
  left:0;
  top:22%;
  height:78%;
  width:30%;
 position:absolute;
  }
  .divi1
   {
	   border:solid 0.5px #000000;
	 background-color:#ecf0f5;
left:30%;
  top:9.5%;
  height:72%;
  width:70%;
 position:absolute; 
 overflow-x: scroll;
overflow-y: hidden;
  }
 .divi2
 {
	  font-family:    Arial, Helvetica, sans-serif;
                font-size:      14px;
                font-weight:    bold;
	 background-color:#ffbb78;
  border:solid 0.5px #000000;
   left:30%;
  top:82%;
  height:18%;
  width:70%;
   overflow-x: scroll;
overflow-y: scroll;
 position:absolute;
 }
 .divi3{
	 border:solid 0.5px #000000;
background-color:#222d32;
	left:3%;
top:12%;
  height:70%;
  width:60%;
 position:absolute;
 }
  .divi4{
background-color:#222d32;
	left:63%;
top:12%;
  height:70%;
  width:33%;
 position:absolute;
 }
.divi4 button{
	border:solid 0.5px #222d32;
	 background-color: #dd4b39;
	width:100%;
	height:50%;
	display: inline-block;
  color: #f2f2f2;
}
.divi5{
	    text-align:center;
	background-color:#222d32;
 border:solid 0.5px #000000;
  left:0%;
  top:9.5%;
  height:13%;
  width:30%;
 position:absolute;
  }
}

</style>
</head>
<body style='background-color:#FFFFFF'>
<div class='diviz'>
<div class='diviq'>
<a  href='main3.php'><button>Statistics</button></a></div>
<div class='diviw'>
<a class='active' href='history.php' target='_self'><button>Student History</button></a></div>

<div class='divie'>
<a href='trend.php'><button>Subject Trends</button></a></div>



<div class='divit'>
<a href='logout.php'><button>Logout</button></a></div>
</div>
<ul class='topnav' id='myTopnav'>

  <li class='icon'>
    <a href='javascript:void(0);' style='font-size:15px;' onclick='myFunction()'>☰</a>
  </li>
</ul>
<div class=divi5>
<div class=divi3 >
<form method='post' name='Form' action='' >
 

            
               <b><input type='text' style='font-size:14pt;height:100%' name='stud' class='form-control' maxlength='50' placeholder='Enter student name' /></b>
            
			   
	
	
</div>
<div class=divi4>
  <button name='ss' type='submit'  onClick='return validateForm()'  >Search</button>
  <button name='clear' type='submit'  target='_self'>Clear</button>
</div>
 </div>
 

 <script type='text/javascript'>
    function validateForm()
    {
    var a=document.forms['Form']['stud'].value;
  
          if (a==null || a=='')
      {
      alert('Please Enter a Name');
      return false;
      }
    }
	<script>
function myFunction() {
    var x = document.getElementById('myTopnav');
    if (x.className === 'topnav') {
        x.className += ' responsive';
    } else {
        x.className = 'topnav';
    }

    </script>

";


$email="";
$pass="";
$name="";
$roll="";
$addr="";
$mobile="";
$zip="";
$age="";
$gender="";
$marks10="";
$marks12="";
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_line.php');
//session_start();
$con = mysqli_connect("localhost","root","","analysis");
if(!$con)
{
 die("Could not connect".mysqli_error($con));
}
else
	if(isset($_POST['ss'])) 
	{

echo "<br><br><br>";
{
$stud = mysqli_real_escape_string($con, $_POST['stud']);
$_SESSION['stud'] = $stud;
$sdd ="SELECT * FROM users where userName = '$stud' ";

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

echo"

<div class='container'>
<div class='divi0'>
 <div id='login-form'>
  <form method='post' name='f'>
  <div class='col-md-12'>
        
        <!--<div class='form-group'>
             <h2 class=''>Student Details.</h2>
            </div>-->
		
			     <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span><b>Roll</b></span></span>
             <input type='text' name='roll' class='form-control' readonly='readonly' maxlength='50' value='$roll' />
               </div>
			   </div>
              
			     <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span class='glyphicon glyphicon-user'></span></span>
             <input type='text' name='name' class='form-control' readonly='readonly' maxlength='50' value=' $name ' />
               </div>
			   </div>
               
			   	  <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span class='glyphicon glyphicon-envelope'></span></span>
             <input type='text' name='email' class='form-control' readonly='readonly' maxlength='50' value=' $email ' />
               </div>
			      </div>
             
		    <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span class='glyphicon glyphicon-earphone'></span></span>
             <input type='text' name='mobile' class='form-control' readonly='readonly' maxlength='50' value=' $mobile ' />
               </div>
			      </div>
             
			   <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span class='glyphicon glyphicon-home'></span></span>
             <input type='text' name='addr' class='form-control' readonly='readonly' maxlength='50' value='  $addr ' />
               </div>
			      </div>
               
			   	  <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span class='glyphicon glyphicon-fire'></span></span>
             <input type='text' name='zip' class='form-control' readonly='readonly' maxlength='50' value=' $zip ' />
               </div>
			      </div>
             
	
			      	  <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span class='glyphicon glyphicon-user'></span></span>
             <input type='text' name='age' class='form-control' readonly='readonly' maxlength='50' value=' $age ' />
               </div>
			      </div>
            
			   	  <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span><b>10th</b></span></span>
             <input type='text' name='marks10' class='form-control' readonly='readonly' maxlength='50' value='$marks10' />
               </div>
			      </div>
              
			   	  <div class='form-group'>
             <div class='input-group'>
                <span class='input-group-addon'><span><b>12th</b></span></span>
             <input type='text' name='marks12' class='form-control' readonly='readonly' maxlength='50' value=' $marks12 ' />
               </div>
			      </div>
             
			
		
			
		</div>	
		 </form>
		</div> 
  </div> 
  </div>

";

echo"<div class=divi1>";
echo" <img src='qq.php' />";
echo"</div>";
echo"<div class=divi2>";
//echo $stud;
$fields = array();
$fields2 = array();
$sum=0;
$data = array(11,3,8,12,5,1,9,13,5,7);
$ww=array();
$hhh=array();
$year=0;
$i=0;
$j=0;
$g=0;
//$temp='';

$xx1="DELETE FROM `student`";
$xx2="INSERT INTO `student` VALUES('$stud')";
$ex1=mysqli_query($con,$xx1);
$ex2=mysqli_query($con,$xx2);
$find="SELECT * FROM `name`";
$result2 = mysqli_query($con,$find);

while($row = mysqli_fetch_array($result2,MYSQL_ASSOC))
{
	$year=(int)substr($row['Name'],6,4);
	if(substr($row['Name'],0,2)=='fe')
	{
	if(substr($row['Name'],2,4)=='sem1')	
	{
		//$hhh[$i]="fesem1".$year;
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	 
	}
	}
	else if(substr($row['Name'],2,4)=='sem2')
	{
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="fesem2".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  
	}
		/*$hhh[$i]="fesem1".$year;
			$i++;
			$hhh[$i]="fesem2".$year;*/
	}
	}
	else if(substr($row['Name'],0,2)=='se')
	{
		
		
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="fesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
			if(substr($row['Name'],2,4)=='sem2')	{
						$kk="sesem1".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}			
			$kk="sesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;
	  	}
			}
		else if(substr($row['Name'],2,4)=='sem1')
		{
						$kk="sesem1".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;
	  	}
		}
		
	}

	
	else if(substr($row['Name'],0,2)=='te')
	{
		
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="fesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
	$kk="sesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="sesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		//$temp=substr($row['Name'],3,6);		//$hhh[$i]="fesem1".$year;		//$i++;		//$hhh[$i]="fesem2".$year;		//$i++;		//$hhh[$i]="sesem1".$year;				//$i++;		//$hhh[$i]="sesem2".$year;
				//$i++;

		if(substr($row['Name'],2,4)=='sem2')
		{
				
			$kk="tesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="tesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	 
	}
			/*
			$hhh[$i]="tesem1".$year;
			$i++;
			$hhh[$i]="tesem2".$year;*/
			
		}
		else if(substr($row['Name'],2,4)=='sem1')
		{
			//$hhh[$i]="tesem1".$year;
			$kk="tesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	
	}
		}
		
	}
	
	else if(substr($row['Name'],0,2)=='be')
	{
		
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="fesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
	$kk="sesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="sesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
			}
			$kk="tesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="tesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
			}

		if(substr($row['Name'],2,4)=='sem2')
		{
				
			$kk="besem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
		$kk="besem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	 
	}
		}
		else if(substr($row['Name'],2,4)=='sem1')
		{
			$kk="besem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	
	}
		}
		
	}
	
}

for($p=0;$p<=$i;$p++)
{
	
	$bz="SELECT COUNT(*) AS `total` FROM information_schema.columns WHERE table_name='$hhh[$p]' ";
$ba=mysqli_query($con,$bz);
$zz=mysqli_fetch_assoc($ba);
	$nvn[$p]="SHOW COLUMNS FROM `$hhh[$p]`";
$res[$p]=mysqli_query($con,$nvn[$p]);
while ($x = mysqli_fetch_assoc($res[$p])){
	//if(i==0)
  $fields[$p][] = $x['Field'];
//else if(i==1)
	//$fields2[] = $x['Field'];
}
  $c="Grand.Total";
for($tt=3;$tt<$zz['total'];$tt++)
{
	if(($fields[$p][$tt]=="Total") ||($fields[$p][$tt]==$c) || ($fields[$p][$tt]=="Percentage")|| ($fields[$p][$tt]=="Class"))
	{
		$g=$tt;
		//echo "this is".$g;
		break;
	}

}


$sql[$p]="SELECT * FROM `$hhh[$p]` WHERE `Name` LIKE '$stud'";

$result[$p] = mysqli_query($con,$sql[$p]);
 if(mysqli_num_rows($result[$p])==0)
 {
	echo "<script> alert('Not found');</script>";
exit();
 }
else
{
//echo "Student Name:".$stud."<br>";
while($row = mysqli_fetch_array($result[$p],MYSQL_ASSOC))
{
	//$fields[] = $x['Field'];
	echo " Name: ".$row['Name']."</br>";
echo "
	<tr>"."<td> Semester " .($p+1). "<br><td style='width:30%'>"."Roll No: "."</td><td style='width:35%'>".$row['Roll']."</td><br>";
	
	for($x=3;$x<$g;$x++)
	{
		
	echo"<td style='width:35%'>".$fields[$p][$x].":&nbsp".$row[$fields[$p][$x]]."&nbsp&nbsp&nbsp</td>";
	
	}
	
	echo" </tr>";
	
    echo"<br>_________</br>";

}
}

}

}




  echo"</div>";
}
else               
{
if(isset($_POST['clear']))  
{	}
}
echo" </body>
 </html>";
mysqli_close($con);
?>