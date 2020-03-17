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




$fields = array();
$fields2 = array();
$a=array();
$b=array();
$y=array();
$topper=array();
$sum=0;
$cc=0;
$data = array();
$data2 = array();
$d=array();
$percent2=0;
$subject="";
$percent=0;
$hhh=array();
$year=0;
$i=0;
$j=0;
$value=0;
$value2=0;
$g=0;
//$temp='';
$sheetname[0]=$sheetname[1]=$sheetname[2]="na";
$d[0]=$d[1]=$d[2]=0;
$a[0]=$a[1]=$a[2]=0;
$b[0]=$b[1]=$b[2]=0;
$y[0]=$y[1]=$y[2]=0;

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
for($i=2;$i>=0;$i--)
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
	
	
for($i=0;$i<3;$i++)
{
	if($sheetname[$i]!="na")
	{
		if($d[$i]==1)
		{
	$query="select max(`$subject`) as max from `$sheetname[$i]`";
	$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
{
	
	$y[$j]=$row['max'];	
}
	//echo $d[$i]."<br>";
}	
}	
$j++;
}	
//echo $d[0],$d[1],$d[2];
//echo $y[0],$y[1],$y[2];
	
for($i=0;$i<3;$i++)
{
	if($sheetname[$i]!="na")
	{
		if($d[$i]==1)
		{
	if($y[$i]>50)
	{
		$query5="select count(`$subject`) as pass from `$sheetname[$i]` where `$subject`>=40";

	}
	else if($y[$i]>25 && $y[$i]<=50)
	{
		$query5="select count(`$subject`) as pass from `$sheetname[$i]` where `$subject`>=20";
	}
	else if($y[$i]<=25)
	{
		$query5="select count(`$subject`) as pass from `$sheetname[$i]` where `$subject`>=10";
		
	}
	$result5 = mysqli_query($con,$query5);

while($row5 = mysqli_fetch_array($result5,MYSQL_ASSOC))
{
	$a[$i]=$row5['pass'];
}

$query6="select count(*) as total from `$sheetname[$i]`";
	$result6 = mysqli_query($con,$query6);
while($row6 = mysqli_fetch_array($result6,MYSQL_ASSOC))
{
	$b[$i]=$row6['total'];
		}}
}	
}	
	//echo "<br>".$a[0],$a[1],$a[2]."<br>";
	//echo $b[0],$b[1],$b[2];
	
	
for($i=0;$i<3;$i++)
{
if($d[$i]==1)
{
$a[$i]=round((($a[$i]/$b[$i])*100),2);
//echo $a[$i]."<br>";	
}
else
$a[$i]=0;	
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
 $bplot->SetLegend("Percentage");
$year=$year+1;

$n=array($year,$year+1,$year+2);
$m=array(0,5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95);
//$graph->Add($bplot2);
	//$bplot->value->Show();
	$bplot->SetFillColor('darkgreen');
 $graph->title->Set('Pass Percentage for subject '.$subject);
$graph->xaxis->title->Set('Years');
$graph->yaxis->title->Set('Percentage');
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