<?php 
session_start(); 
if(!isset($_SESSION['user_name'])) {
header("location:index.php");
}
else {
$user_name = $_SESSION["user_name"];
$user_id = $_SESSION["user_id"];
echo "Welcome $user_name ";
echo "<a href=\"log_out.php\">Log out</a>";
include('db.inc.php'); 
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Discussion forum</title>
</head>

<body>
<?php if(isset($_POST['reply'])) { 
$reply = $_POST['reply'];
$topic_id = $_POST['topic_id'];

$sql = "INSERT INTO replies (reply_id, reply_content, topic_id, reply_user_id) VALUES (NULL, '$reply', '$topic_id', '$user_id');";
$rsd = mysql_query($sql);
if($rsd) {
echo "Thanks for submitting your reply $reply. <a href=\"discuss.php\">Return Back</a> to view it. "; }
else {
echo "Error, reply submission fail";
}

           } 
else {
  $topic_id = $_GET['topic_id'];
  $topic_id= stripslashes($topic_id);
  $topic_id = mysql_real_escape_string($topic_id);
echo"<h3>Reply:</h3>";
$sql = "SELECT * FROM  topics where topic_id = $topic_id;";
$topics = mysql_query($sql);
$row = mysql_fetch_array($topics, MYSQL_ASSOC );
		$topic_content = $row['topic_content'];
		
		echo "<h3>$topic_content</h3>"; ?>
		<form action="#" method="post" name="reply_form">
		<label>Reply</label><br /> 
		<textarea name="reply" cols="100" rows="5"></textarea><br />
		<input type="hidden" name="topic_id" value="<?php echo"$topic_id" ?>" />
		<input name="submit" type="submit" value="reply" />
		</form>
<?php }
?>
  </body>
</html>
