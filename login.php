<?php
	session_start();
	$db=mysqli_connect("localhost","root","","myresume") or die("Could not connect to database");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(login-bg.jpg); background-repeat: no-repeat; background-size:cover; z-index: 0;">
	<?php
		if(array_key_exists('valid', $_SESSION) && $_SESSION['valid']==true)
			header('Location: index.php');
		if(isset($_POST['login']))
		{
			$email = $_POST['email'];
	        $query = $db->query("SELECT * FROM user_details WHERE email = '$email'");
		    $result = $query->fetch_assoc();
			if(empty($result['pwd']) || empty($result['type']))
			{
				$msg='<div class="alert alert-warning alert-dismissible fade show"><strong>Warning!</strong> Please enter a valid value in all the required fields before proceeding.<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
				echo $msg;
			}
			else if($_POST['pwd']==$result['pwd'])
			{
				$_SESSION['valid'] = true;
	          	$_SESSION['email'] = $result['email'];
	          	$_SESSION['pwd'] = $result['pwd'];
				$_SESSION['type'] = $result['type'];
				mysqli_close($db);
	          	header('Location: index.php');
          		exit();
			}
			else
			{
				$msg='<div class="alert alert-warning alert-dismissible fade show"><strong>Warning!</strong> Wrong Email ID or Password<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
				echo $msg;
			}
		}
		mysqli_close($db);
	?>
	<div class="container-fluid">
		<div class="row" style="padding : 5%">
	        <div class="col-12">
	        	<img src="myresume_logo.jpg" class="rounded-circle mx-auto d-block" alt="Resume Logo">       
	        </div>
	    </div>
	    <div class="border border-dark rounded-pill" style="margin:0% 20% 3% 20%; z-index: 1; background-color: white;">
	    	<div style="padding:5% 0% 2% 10%">
	    		<form class="form-horizontal" action = <?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method = "post">
	    			<br>
					    <div class="form-group">
					      	<label class="control-label col-sm-2" for="email"><strong style="font-size: large;">Email:</strong></label>
					    	<div class="col-sm-10">
					        <input type="email" class="form-control" style="background-color: #f2f2f2" id="email" placeholder="Enter email" name="email">
					    </div>
				    </div>
				    <br>
					    <div class="form-group">
					    	<label class="control-label col-sm-2" for="pwd"><strong style="font-size: large;">Password:</strong></label>
					      	<div class="col-sm-10">          
					        <input type="password" class="form-control" style="background-color: #f2f2f2" id="pwd" placeholder="Enter password" name="pwd">
					    </div>
				    </div>
				    <br>
					    <div class="form-group text-center">        
					      	<div class="col-sm-offset-2 col-sm-10">
					        <button type="submit" name="login" class="btn btn-primary btn-lg">Submit</button>
					    </div>
				    </div>
					    <div class="form-group text-center">        
					      	<div class="col-sm-offset-2 col-sm-10">
					      	<a href="signup.php" style="color: blue">Don't have an account? Sign up</a>
					    </div>
				    </div>
				</form>
	    	</div>
	    </div>
	</div>
</body>
</html>