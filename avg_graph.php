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
$d=array();
$subject="";
$hhh=array();
$year=0;
$i=0;
$j=0;
$g=0;
//$temp='';
$sheetname=array();
$sheetname[0]=$sheetname[1]=$sheetname[2]="na";
$d[0]=$d[1]=$d[2]=0;
$a[0]=$a[1]=$a[2]=0;
$query="SELECT * FROM `subject`";
	$ex=mysqli_query($con,$query);
	while($row = mysqli_fetch_array($ex,MYSQL_ASSOC))
	{
		$subject=$row['subject'];
	}
	//echo $subject;
	
	
	
$find="SELECT * FROM `name`";
$result2 = mysqli_query($con,$find);

while($row = mysqli_fetch_array($result2,MYSQL_ASSOC))
{
	$year=(int)substr($row['Name'],6,4);
	$prefix=substr($row['Name'],0,6);
	
	}
for($i=0;$i<3;$i++)
{
	$name=$prefix.$year;
	$hhh[$i]=$name;
	$year=$year-1;
	//echo $hhh[$i];
}


	for($i=0;$i<3;$i++)
	{
		$query="show tables";
	$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
{
	if($hhh[$i]==$row['Tables_in_analysis'])
	{
		$sheetname[$i]=$hhh[$i];
	}
}

	}
//	echo $sheetname[0],$sheetname[1],$sheetname[2];
	
	
	
	for($i=0;$i<3;$i++)
	{
		if($sheetname[$i]!="na")
		{
		$query="show columns from `$sheetname[$i]`";
	$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
{
	
	if($subject==$row['Field'])
	{
		$d[$i]=1;
	}

	}
	
	}}	
	//echo $d[2]."<br>";
	
for($i=2;$i>=0;$i--)
{
	if($sheetname[$i]!="na")
	{
	if($d[$i]==1)
	{
	$query="select avg(`$subject`) as avg from `$sheetname[$i]`";
	$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
{
	$d[$i]=round($row['avg'],2);
	$a[$j]=$d[$i];
	
	//echo $row['avg']."<br>";
}
	//echo $d[$i]."<br>";

}	
	
	
	
}
$j++;
}
//echo $a[2];
}
 }
    


	

mysqli_close($con);
$tad=array_sum($a);




$datay=array();
 $graph = new Graph(500,450);
$graph->SetScale('textlin');

$graph->SetShadow();
$graph->SetMargin(40,30,20,40);

 


$bplot = new BarPlot($a);
 $bplot->SetLegend("Average marks");


$n=array($year+1,$year+2,$year+3);
$m=array(0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95);
//$graph->Add($bplot2);
	//$bplot->value->Show();
	$bplot->SetFillColor('darkgreen');
 $graph->title->Set('Average marks for subject '.$subject);
$graph->xaxis->title->Set('Years');
$graph->yaxis->title->Set('Marks');
 $graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$gbplot=$bplot;
 $graph->xaxis->SetTickLabels($n);

$graph->yaxis->SetTickPositions(array(0,10,20,30,40,50,60,70,80,90),array(5,15,25,35,45,55,65,75,85,95));
$graph->Add($gbplot);
$gbplot->value->Show();

 $graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->scale->SetGrace(10);
$graph->legend->SetFrameWeight(1);
$graph->legend->SetColumns(6);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->SetMarkAbsSize(10);

 $graph->Stroke();









?>