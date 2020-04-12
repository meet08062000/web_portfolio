<?php
	session_start();
	$db = mysqli_connect("localhost","root","","myresume") or die("Could not connect to database");
	$query_overview = $db->query("SELECT * FROM overview");
	$result_overview = $query_overview->fetch_assoc();
	if(isset($_POST['edit_name']))
	{
		$newname = $_POST['name'];
		$query_update_name = $db->query("UPDATE overview SET name='$newname'");
	}
	header('Location: edit.php');
?>