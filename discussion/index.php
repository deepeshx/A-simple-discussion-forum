<?php session_start(); 
if(isset($_POST['submit'])) { 
include('db.inc.php');
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$user_name = stripslashes($user_name);
$password = stripslashes($password);
$user_name = mysql_real_escape_string($user_name);
$password = mysql_real_escape_string($password);
$sql="SELECT * FROM users WHERE user_name='$user_name' and password='$password'";
$result=mysql_query($sql); // execute query

// mysql_num_row is a function used to count number of results we get from the above query
$count=mysql_num_rows($result);

// If result matched $user_name and $password, table row must be 1 row
if($count==1){
$sql="SELECT user_id FROM users WHERE user_name='$user_name'";
$result=mysql_query($sql); // execute query
$user_id_array = mysql_fetch_array($result);	
$user_id = $user_id_array['user_id'];
// Register $user_name and $user_id and redirect to file "discuss.php"
$_SESSION['user_name'] = $user_name;
$_SESSION['user_id'] = $user_id;
header("location:discuss.php");
}
else {
echo "Please enter correct username and password";
}

           } 
 ?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Discussion forum</title>
</head>

<body>

<form action="#" method="post" name="topic_form">
 <label>Username</label><br /> <input name="user_name" type="text" />
<br />
  <label>Password</label><br />
  <input name="password" type="text" /><br />
  <input name="submit" type="submit" value="submit" />
  
  </form>
  <p>New Users <a href="sign_up.php">Sign up now</a></p>

  </body>
</html>
