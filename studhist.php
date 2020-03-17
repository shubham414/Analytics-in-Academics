<?php






require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_line.php');

session_start();
 include_once 'dbconnect.php';
$email=$_SESSION['dong'];

$sdd ="SELECT * FROM users where userEmail = '$email' ";
$con = mysqli_connect("localhost","root","","analysis");
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
$flag=0;
if(!$con)
{
 die("Could not connect".mysqli_error($con));
}
else
	

{
	

	

	
//$stud = mysqli_real_escape_string($con, $_POST['stud']);
//$_SESSION['stud'] = $stud;
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

$exist="select 1 from `hist`";
    $checktableexists=mysqli_query($con,$exist);
	
  if($checktableexists==FALSE)
	  {
		   
	   $createtable = "CREATE TABLE `hist`(name varchar(255))";
   $result = mysqli_query($con,$createtable);  

	  }
$xx1="DELETE FROM `hist`";
$xx2="INSERT INTO `hist` VALUES('$name')";
$ex1=mysqli_query($con,$xx1);
$ex2=mysqli_query($con,$xx2);
$find="SELECT * FROM `users` where userName like '$name'";

$result2 = mysqli_query($con,$find);

while($row = mysqli_fetch_array($result2,MYSQL_ASSOC))
{
	//echo $row['lastsemester'];
	if($row['lastsemester']!=NULL || $row['lastsemester']!="")
	{
		$flag=1;
		//echo "hello";
	$year=(int)substr($row['lastsemester'],6,4);
	if(substr($row['lastsemester'],0,2)=='fe')
	{
		
	if(substr($row['lastsemester'],2,4)=='sem1')	
	{
		//$hhh[$i]="fesem1".$year;
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	 
	}
	}
	else if(substr($row['lastsemester'],2,4)=='sem2')
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
	else if(substr($row['lastsemester'],0,2)=='se')
	{
		
	
		$kk="fesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  echo $hhh[$i]; $i++;
	 
	}
		$kk="fesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}
			if(substr($row['lastsemester'],2,4)=='sem2')	{
						$kk="sesem1".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	  $i++;
	}			
			$kk="sesem2".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;
	  	}
			}
		else if(substr($row['lastsemester'],2,4)=='sem1')
		{
						$kk="sesem1".$year;		$r="SHOW TABLES LIKE '$kk'";		$rr = mysqli_query($con,$r);
		    if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;
	  	}
		}
		
	}

	
	else if(substr($row['lastsemester'],0,2)=='te')
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

		if(substr($row['lastsemester'],2,4)=='sem2')
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
		else if(substr($row['lastsemester'],2,4)=='sem1')
		{
			//$hhh[$i]="tesem1".$year;
			$kk="tesem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	
	}
		}
		
	}
	
	else if(substr($row['lastsemester'],0,2)=='be')
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

		if(substr($row['lastsemester'],2,4)=='sem2')
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
		else if(substr($row['lastsemester'],2,4)=='sem1')
		{
			$kk="besem1".$year;$r="SHOW TABLES LIKE '$kk'";$rr = mysqli_query($con,$r);
		   if($rr->num_rows == 1) 	{
      $hhh[$i]=$kk;	
	}
		}
		
	}
	}
}
if($flag==1)
	{
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


$sql[$p]="SELECT * FROM `$hhh[$p]` WHERE `Name` LIKE '$name'";

$result[$p] = mysqli_query($con,$sql[$p]);
 

{
//echo "Student Name:".$stud."<br>";
while($row = mysqli_fetch_array($result[$p],MYSQL_ASSOC))
{
	//$fields[] = $x['Field'];
	echo "Name:".$row['Name']."</br>";
echo "
	<tr>"."<td> Semester".($p+1)."<br><td style='width:30%'>"."Roll No:"."</td><td style='width:35%'>".$row['Roll']."</td><br>";
	
	for($x=3;$x<$g;$x++)
	{
		
	echo"<td style='width:35%'>".$fields[$p][$x].":&nbsp".$row[$fields[$p][$x]]."&nbsp&nbsp&nbsp</td>";
	
	}
	
	echo" </tr><br>	<br>

";

}
}

}
	}
}
if($flag==1)
	{
	echo "
	<form action='#' method='POST'>



	<input type='radio' name='opt' value='a'> Rank
 <input type='radio' name='opt' value='b'>Percentage
<button type='submit' name='submit' value='Display'>Display</button>
 
	</form>
	";
/*if(!isset($_POST['submit']))
  echo" <img src='newqq.php' />";*/
if(isset($_POST['submit']))
{
if($_POST['opt']=='' | $_POST['opt']==NULL )	
echo "<script> alert('Select');</script>";
if($_POST['opt']=='a')
  echo" <img src='rank.php' />";
if($_POST['opt']=='b')
  echo" <img src='newqq.php' />";
}
	}
	else
		echo"<script>alert('Recent semester name not entered');</script>";
mysqli_close($con);
?>