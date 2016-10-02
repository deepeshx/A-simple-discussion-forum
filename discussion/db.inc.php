<?php 
$db_host='localhost';
$db_database='discussion';
$db_username='root';
$db_password='';
$connection = mysql_connect($db_host, $db_username, $db_password);
if (!$connection){ die("Could not connect to the database: <br />". mysql_error( )); } 
// Select the database
$db_select = mysql_select_db($db_database); if (!$db_select){
die ("Could not select the database: <br />". mysql_error( )); }


?>