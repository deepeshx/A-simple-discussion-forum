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
<title>Discussion forum </title>
</head>

<body>
<?php if(isset($_POST['topic'])) { 
$topic = $_POST['topic'];
$category_id = $_POST['category_id'];
$sql = "INSERT INTO topics (topic_id, topic_content, category_id, user_id) VALUES ('', '$topic', '$category_id', '$user_id');";
$rsd = mysql_query($sql);
echo "<br/>Thanks for submitting your topic $topic in $category_id <br/>"; 

           } 
else {
?>
<form action="#" method="post" name="topic_form">
 <label>Topic</label><br /> <textarea name="topic" cols="100" rows="5"></textarea><br />
  <label>Category</label>
  <select name="category_id">
  <?php $sql = "SELECT * FROM  categories;";
                             $rsd = mysql_query($sql);
                             while($rs = mysql_fetch_array($rsd)) {
	                        $category_id = $rs['category_id'];
							$category_name = $rs['category_name'];
							 
							echo "<option value=\"$category_id\">$category_name</option>";
							}
 ?> 
 </select><br />
  <input name="submit" type="submit" value="submit" />
  
  </form>
<?php } 
echo"<h3>Submitted Topics:</h3>";
$sql = "SELECT * FROM  topics ORDER BY  topic_id DESC;";
$topics = mysql_query($sql);
while ($row = mysql_fetch_array($topics, MYSQL_ASSOC )){
		$topic_content = $row['topic_content'];
		$topic_id = $row['topic_id'];
		echo "<h3>$topic_content</h3>";
			$sql = "SELECT * FROM  replies where topic_id = $topic_id;";
			$replies = mysql_query($sql);
			while($row = mysql_fetch_array($replies, MYSQL_ASSOC )) {
		    $reply_content = $row['reply_content']; 
			echo "<p> $reply_content</p>";
																} // end of while
		echo "<br /><a href=\"reply.php?topic_id=$topic_id\">reply</a><br />";
}

?>
  </body>
</html>
