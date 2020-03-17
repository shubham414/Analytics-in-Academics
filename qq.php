<?php






require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_line.php');
require_once ('jpgraph/src/jpgraph_mgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');
session_start();
$con = mysqli_connect("localhost","root","","analysis");
if(!$con)
{
 die("Could not connect".mysqli_error($con));
}
else
	
	{


{

$fields = array();
$fields2 = array();
$a=array();
$b=array();
$topper=array();
$sum=0;
$cc=0;
$data = array();
$data2 = array();
$d=array();
$percent2=0;
$name="";
$percent=0;
$hhh=array();
$year=0;
$i=0;
$j=0;
$value=0;
$value2=0;
$g=0;
//$temp='';


$ret="SELECT * FROM `student`";
	$ex=mysqli_query($con,$ret);
	while($row = mysqli_fetch_array($ex,MYSQL_ASSOC))
	{
		$name=$row['name'];
	}
$find="SELECT * FROM `name`";
$result2 = mysqli_query($con,$find);

while($row = mysqli_fetch_array($result2,MYSQL_ASSOC))
{
	$year=(int)substr($row['Name'],6,4);
	if(substr($row['Name'],0,2)=='fe')
	{
	if(substr($row['Name'],2,4)=='sem1')	
	{
		$hhh[$i]="fesem1".$year;
	}
	else if(substr($row['Name'],2,4)=='sem2')
	{
		$hhh[$i]="fesem1".$year;
			$i++;
			$hhh[$i]="fesem2".$year;
	}
	}
	else if(substr($row['Name'],0,2)=='se')
	{
		
		
		$kk="fesem1".$year;
		$r="SHOW TABLES LIKE '$kk'";
		$rr = mysqli_query($con,$r);
		
    if($rr->num_rows == 1) 
	{
      $hhh[$i]=$kk;
	  $i++;
	}
		
		
		if(substr($row['Name'],2,4)=='sem2')
		{
				$hhh[$i]="sesem1".$year;
			$i++;
			$hhh[$i]="sesem2".$year;
					}
		else if(substr($row['Name'],2,4)=='sem1')
		{
			$hhh[$i]="sesem1".$year;
			//$i++;
		}
		
	}
	
	else if(substr($row['Name'],0,2)=='te')
	{
		if(substr($row['Name'],2,4)=='sem2')
		{
					$hhh[$i]="tesem1".$year;
			$i++;
			$hhh[$i]="tesem2".$year;
			
		}
		else if(substr($row['Name'],2,4)=='sem1')
		{
			$hhh[$i]="tesem1".$year;
					}
		
	}
	
	else if(substr($row['Name'],0,2)=='be')
	{
		
		if(substr($row['Name'],2,4)=='sem2')
		{
						$hhh[$i]="besem1".$year;
			$i++;
			$hhh[$i]="besem2".$year;
			}
		else if(substr($row['Name'],2,4)=='sem1')
		{
			$hhh[$i]="besem1".$year;
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

  $fields[$p][] = $x['Field'];

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
 if(mysqli_num_rows($result[$p])>0)
{
while($row = mysqli_fetch_array($result[$p],MYSQL_ASSOC))
{
	

	for($x=3;$x<$g;$x++)
	{
		
	//echo"<td style='width:35%'>".$fields[$p][$x].":&nbsp".$row[$fields[$p][$x]]."&nbsp&nbsp&nbsp</td>";

	{
		
	$data[]=$row[$fields[$p][$x]];
	$d[$p][]=$row[$fields[$p][$x]];
	if($p==0)
	{
	$value+=$row[$fields[$p][$x]];
	$percent=$value/7.5;
	}
	else
	{
			$value+=$row[$fields[$p][$x]];
			$percent=$value/15;
	}
	
	}
	
	}
	
	$a[]=$percent;
	
}
}
else  if(mysqli_num_rows($result[$p])==0)
	exit(0);




$sql3[$p]="SELECT avg(percentage) AS AVG FROM `$hhh[$p]`";
$result3[$p] = mysqli_query($con,$sql3[$p]);

while($row = mysqli_fetch_array($result3[$p],MYSQL_ASSOC))
{
$percent2=$row['AVG'];
$b[]=$percent2;
}


$sql3[$p]="SELECT max(percentage) AS MAX FROM `$hhh[$p]`";
$result3[$p] = mysqli_query($con,$sql3[$p]);
while($row = mysqli_fetch_array($result3[$p],MYSQL_ASSOC))
{
$percent2=$row['MAX'];
$topper[]=$percent2;
}




}
}
 }
            

mysqli_close($con);
$tad=array_sum($a);
	/*$ydata = array(11,3,8,12,5,1,9,13,5,7);
$line=array();
 $per=array();
$graph = new Graph(600,300);
$graph->SetScale('textlin');
$lineplot=new LinePlot($data);
$lineplot->SetColor('blue');
for($t=0;$t<=$i;$t++)
{
	
	$line[$t]=new LinePlot($d[$t]);
	$graph->Add($line[$t]);
	//$graph->xaxis->SetTickLabels($a1[$t]);
}
$graph->Stroke();
*/

$datay=array();
 $graph = new Graph(500,450);
$graph->SetScale('intlin');

$graph->SetShadow();
$graph->SetMargin(40,30,20,40);
$data1y=array(70);
$data2y=array(70,14,40);
 

  $bplot2 = new BarPlot($b);
  $bplot2->SetLegend("Average");
$bplot = new BarPlot($a);
 $bplot->SetLegend("Student");
  $bplot3 = new BarPlot($topper);
  $bplot3->SetLegend("Highest");

$n=array("SEM1","SEM2","SEM3","SEM4");
$m=array(0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95);
//$graph->Add($bplot2);
	//$bplot->value->Show();
	$bplot->SetFillColor('darkgreen');
 $graph->title->Set('Percentage Graph');
$graph->xaxis->title->Set('Semesters');
$graph->yaxis->title->Set('Percentage');
 $graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$gbplot = new GroupBarPlot(array($bplot2,$bplot,$bplot3));
 $graph->xaxis->SetTickLabels($n);
 //$graph->yaxis->SetTickLabels($m);
$graph->yaxis->SetTickPositions(array(0,10,20,30,40,50,60,70,80,90),array(5,15,25,35,45,55,65,75,85,95));
$graph->Add($gbplot);

//	$gbplot->value->Show();
 $graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->scale->SetGrace(10);
$graph->legend->SetFrameWeight(1);
$graph->legend->SetColumns(6);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->SetMarkAbsSize(10);

 $graph->Stroke();









// Add the plot to the graph





/*

	$graph = new Graph(450,250);
$graph->SetScale('textlin');
$lineplot=new LinePlot($d[0]);
$lineplot->SetColor('red');
 $graph->Add($lineplot);
 $graph->Stroke();
 */
/*
$mgraph = new MGraph();
$mgraph->SetImgFormat('jpeg',60);
$mgraph->SetMargin(2,2,2,2);
$mgraph->SetFrame(true,'darkgray',2);
if($i==1)
	
$mgraph->AddMix($graph2,0,20,85);
$mgraph->AddMix($graph,0,250,85);

$mgraph->Stroke();
/*$handle1=$graph->Stroke(_IMG_HANDLER);

$handle2=$graph2->Stroke(_IMG_HANDLER);
$image = imagecreatetruecolor(600,1000);
imagecopy($image, $handle1,0, 0, 0, 0, 600,100);
imagecopy($image, $handle2,0,500,0,0,600,800);
header("Content-type: image/png");
imagepng ($image);*/
?>