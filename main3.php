<!DOCTYPE html>
<html>
<head>
<style>
body {margin:0;}
ul.topnav {
  list-style-type: none;
 
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #008749;

}


.divzz{
	
	
	  left:2%;
	  font-size: 25px;
    transition: 0.3s;
	height:87%;
  width:15%;
  position:absolute;
 top:10%;
 
	 display: inline-block;

     
  
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
	width:50%;
	left:50%;
position:absolute;
	color: 	#FFFFFF;
  font-size: 25px;
   cursor: pointer;
}

.divy{
	position:absolute;
	top:9.5%;
	height:90%;
	width:85%;
	left:15%;
	overflow-x:hidden;
overflow-y:hidden;
}



ul.topnav li {float: left;
}

ul.topnav li a {

  display: inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 5% 50%;
  text-decoration: none;
  transition: 0.3s;
  font-size: 25px;
}

.diviq a button:hover{
	  background-color: #008749; /* Green */
    color: White ;
}


.diviw a button:hover{
	  background-color: #008749; /* Green */
    color: White;
}

.divie a button:hover{
	  background-color: #008749; /* Green */
    color: White;
}
.divir a button:hover{
	  background-color: #008749; /* Green */
    color: White ;
}
.divit a button:hover{
	  background-color: #008749; /* Green */
    color: white ;
}




ul.topnav li.icon {display: none;}

</style>
</head>
<body style='background-color:#222d32'>
<div class="diviz">
<div class="diviq">
<a class="active" href="#home"><button>Statistics</button></a></div>
<div class="diviw">
<a href="history.php"><button>Student History</button></a></div>

<div class="divie">
<a href="trend.php"><button>Subject Trends</button></a></div>



<div class="divit">
<a href="logout.php"><button>Logout</button></a></div>
</div>
<ul class="topnav" id="myTopnav">
  
  
  <li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
  </li>
</ul>

  <div class="divzz">
   <iframe src='viewtab1.php' frameborder='0' scrolling='no' width='100%' height='100%' align='center'></iframe>
   </div>	

 <div class="divy" >
 <iframe src="http://127.0.0.1:7114/" width="99.9%" height="100%"></iframe>
</div>

<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

</body>
</html>