<?php  
require 'db.inc.php';
$db = mysql_connect($db_host, $db_username, $db_password) or die ('not connected');
mysql_select_db($db_database) or die (mysql_error($db));

$query = 'INSERT INTO categories 
	(category_id,category_name)
	VALUES 
	("NULL", "C"),
	("NULL", "C++"),
	("NULL", "Php"),
	("NULL", "javascript")';
	mysql_query($query,$db)or die(mysql_error($db));

$query = 'INSERT INTO users 
	(user_id, user_name, password)
	VALUES 
	("1", "admin", "admin")';
	mysql_query($query,$db)or die(mysql_error($db));
echo 'success!'
?>