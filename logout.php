<?php
   session_start();
   unset($_SESSION["email"]);
   unset($_SESSION["pass"]);
   
   //echo 'You have cleaned session';
   header('Refresh: 2; URL = index.php');
?>