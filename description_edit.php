<?php
	session_start();
	$db = mysqli_connect("localhost","root","","myresume") or die("Could not connect to database");
	$query_overview = $db->query("SELECT * FROM overview");
	$result_overview = $query_overview->fetch_assoc();
	if(isset($_POST['edit_description']))
	{
		$newdesc = $_POST['description'];
		$query_update_desc = $db->query("UPDATE overview SET description='$newdesc'");
	}
	header('Location: edit.php');
?>