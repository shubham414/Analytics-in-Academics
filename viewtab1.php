

<?php
$dbname = 'analysis';
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'analysis');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }

$sheet="";
$error = false;
$sheetError="";
if( isset($_POST['btn-login']) ){
	$sheet = trim($_POST['sheet']);
		$sheet = strip_tags($sheet);
		$sheet = htmlspecialchars($sheet);
	if(empty($sheet)){
			$error = true;
			$sheetError = "Please Enter Sheet name .";
		}
	
	if (!$error) {
$output			= "";
$table 			= ""; // Enter Your Table Name
$gg 			= mysql_query("select * from $sheet");
$columns_total 	= mysql_num_fields($gg);

// Get The Field Name

for ($i = 1; $i < $columns_total; $i++) {
	$heading	=	mysql_field_name($gg, $i);
	$output		.= '"'.$heading.'",';
}
$output .="\n";

// Get Records from the table

while ($rowz = mysql_fetch_array($gg)) {
for ($i = 1; $i < $columns_total; $i++) {
$output .='"'.$rowz["$i"].'",';
}
$output .="\n";
}

// Download the file

$filename =  "myFile.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;
	}
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
echo "<br><font color='white'>Table</font>\n";    
while ($row = mysql_fetch_row($result)) {
echo "<br><font color='white'>{$row[0]}</font>\n";
}

mysql_free_result($result);
?>

<!DOCTYPE html>
<html>
<head>
<style>
.divi3{

	left:0%;
top:87%;
  height:10%;
  width:70%;
 position:absolute;
 }
  .divi4{

	left:0%;
top:93%;
  height:10%;
  width:70%;
 position:absolute;
 }
 .divi5{
	 
 }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body style='background-color:#222d32'>

<div class=divi5>
<div class=divi3 >
	
    <form method="post">
    
    <input type="text" name="sheet" class="form-control" maxlength='15' placeholder="Sheet Name" value="<?php echo $sheet; ?>" maxlength="40" />
               
                <span class="text-danger"><?php echo $sheetError; ?></span>
     </div>      
            
           
         
     <div class=divi4>       
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Download Sheet</button>
            </div>
		</div>	
			
  <div>          
          
            
           
        
       
   
    </form>




</body>
</html>
