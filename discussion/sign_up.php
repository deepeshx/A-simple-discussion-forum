<?php session_start(); 
if(isset($_POST['submit'])) { 
include('db.inc.php');
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$user_name = stripslashes($user_name);
$password = stripslashes($password);
$repassword = stripslashes($repassword);
$user_name = mysql_real_escape_string($user_name);
$password = mysql_real_escape_string($password);
$repassword = mysql_real_escape_string($repassword);
// check for errors
if($user_name == '' || $password == '' || $repassword =='') {
echo "Please fill correct username and password";
}
else if($password != $repassword) {
echo "password does not match , please try again";
}
 
else {
		$sql="SELECT * FROM users WHERE user_name='$user_name'";
		$result=mysql_query($sql); // execute query

		// mysql_num_row is a function used to count number of results we get from the above query
		$count=mysql_num_rows($result);

		// if user name does not exist than register this user in our database and redirect him to discussion forum
		if($count==1){
						echo "User name has been already taken, please try again!";
						}
		else {
					$sql = "INSERT INTO users (user_id, user_name, password) VALUES (NULL, '$user_name', '$password');";
					$result=mysql_query($sql); // execute query
					if($result) {
					
					// Register $user_name,$user_id and redirect to file "discuss.php"
					// find out user id
					$sql="SELECT user_id FROM 'users' WHERE user_name='$user_name'";
					$result=mysql_query($sql); // execute query
					$user_id_array = mysql_fetch_array($result);	
					$user_id = $user_id_array['user_id'];
					$_SESSION['user_name'] = $user_name;
					$_SESSION['user_id'] = $user_id;
					header("location:discuss.php");
								}
					else {
					echo "Error, please try again";
						}
			} // end of inner else

     } // end of outer else
}
		   
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sign up</title>
</head>

<body>

<form action="#" method="post" name="topic_form">
 <label>Username</label><br /> <input name="user_name" type="text" />
<br />
  <label>Password</label><br />
  <input name="password" type="text" /><br />
  <label>Re-enter Password</label><br /><input name="repassword" type="text" /><br />
  <input name="submit" type="submit" value="submit" />
  
  </form>
  <p>Already Registered <a href="index.php">Sign in</a></p>

  </body>
</html>
