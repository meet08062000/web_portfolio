<?php 
	session_start();
	$db = mysqli_connect("localhost","root","","myresume") or die("Could not connect to database");
	$query_overview = $db->query("SELECT * FROM overview");
	$result_overview = $query_overview->fetch_assoc();
	$query_personal = $db->query("SELECT * FROM personal_details");
	$result_personal = $query_personal->fetch_assoc();
	$query_previous = "SELECT * FROM previous_education ORDER BY year DESC";
	$result_previous = mysqli_query($db, $query_previous);
	$query_skills = "SELECT * FROM skills";
	$result_skills = mysqli_query($db, $query_skills);
	$query_projects = "SELECT * FROM projects";
	$result_projects = mysqli_query($db, $query_projects);
	$query_extra = "SELECT * FROM extra";
	$result_extra = mysqli_query($db, $query_extra);
	mysqli_close($db);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile-Meet Shah</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
<body>
	<?php if(isset($_SESSION['valid'])):?>
        <div class="container">
            <nav class="navbar navbar-default bg-primary mb-4">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand text-light"><h2>MyResume</h2></a>
                    </div>
                    <ul class="nav navbar-nav">
                        <div class="row">
                            <?php if($_SESSION['type']=='admin'): ?>
                                <div class="col">
                                    <li><a class="text-light" href="edit.php"><h5>Edit Profile</h5></a></li>
                                </div>
                            <?php endif; ?> 
                            <div class="col">
                                <li><a class="text-light" href=<?php echo $result_overview['linkedin'] ?>><h5>LinkedIn</h5></a></li>
                            </div>
                            <div class="col">
                                <li><a class="text-light" href=<?php echo $result_overview['github'] ?>><h5>GitHub</h5></a></li>
                            </div>
                            <div class="col">
                                <li><a class="text-light" href=<?php echo $result_overview['hackerrank'] ?>><h5>Hackerrank</h5></a></li>
                            </div>
                            <div class="col">
                                <li><a class="text-light" href="logout.php"><h5>Logout</h5></a></li>
                            </div>
                        </div>
                    </ul>
                </div>
            </nav>
            <div class="row mb-5">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h1 class="text-left"><?php echo $result_overview['name'] ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5><p class="text-left"><br><?php echo $result_overview['description'] ?></p></h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <img src=<?php echo $result_overview['photo'] ?> class="img-thumbnail" align="right">
                </div>
            </div>
            <?php if($_SESSION['type']=='recruiter' || $_SESSION['type']=='admin'): ?>
                <button type="button" class="btn btn-primary dropdown-toggle mb-4" data-toggle="collapse" data-target="#personal_details" style="width: 100%; font-size: 150%;">Personal details<span class="caret"></span></button>
                <div class="collapse mb-3" id="personal_details">
                    <div class="row">
                        <div class="col">Email ID: <?php echo $result_personal['email'];?></div>
                        <div class="col">Phone: <?php echo $result_personal['phone']?></div>
                    </div>
                    <div class="row">
                        <div class="col">DOB: <?php echo $result_personal['dob']?></div>
                        <div class="col">Gender: <?php echo $result_personal['gender']?></div>
                    </div>
                    <div class="row">
                        <div class="col">Address: <?php echo $result_personal['address']?></div>
                        <div class="col">Marital status: <?php echo $result_personal['marital_status']?></div>
                    </div>
                </div>
            <?php endif; ?>
            <button type="button" class="btn btn-primary dropdown-toggle mb-4" data-toggle="collapse" data-target="#previous_education" style="width: 100%; font-size: 150%;">Previous Education</button>
            <div class="collapse mb-3" id="previous_education">
				<table align="center" border="2" cellpadding="5">
					<tr>
						<td><strong>Year</strong></td>
						<td><strong>Qualification</strong></td>
						<td><strong>Institute</strong></td>
						<td><strong>Percentage/CGPI</strong></td>
					</tr>
					<?php 
						while($row = mysqli_fetch_array($result_previous))
							echo "<tr><td>" . $row['year'] . "</td><td>" . $row['qualification'] . "</td><td>" . $row['institute'] . "</td><td>" . $row['percent'] . "</td></tr>"; 
					?>
				</table>
            </div>
            <button type="button" class="btn btn-primary dropdown-toggle mb-4" data-toggle="collapse" data-target="#skills" style="width: 100%; font-size: 150%;">Technical Skills</button>
            <div class="collapse mb-3" id="skills">
				<?php
					$column = array();
					while($row = mysqli_fetch_array($result_skills))
						$column[] = $row['skill'];
					$i = 0;
					while($i<count($column))
					{
						echo "<div class=\"row\">";
						echo "<div class=\"col\">".$column[$i]."</div>";
						if($i!=count($column)-1)
						{
							$i=$i+1;
							echo "<div class=\"col\">".$column[$i]."</div>";
							$i=$i+1;
						}
						echo "</div>";
					}
				?>
            </div>
            <button type="button" class="btn btn-primary dropdown-toggle mb-4" data-toggle="collapse" data-target="#experience" style="width: 100%; font-size: 150%;">Experience</button>
            <div class="collapse mb-3" id="experience">
                <div class="row">
					<div class="col"></div>
					<div class="col"></div>
				</div>
				<div class="row">
					<div class="col"></div>
					<div class="col"></div>
				</div>
				<div class="row">
					<div class="col"></div>
					<div class="col"></div>
				</div>
            </div>
            <button type="button" class="btn btn-primary dropdown-toggle mb-4" data-toggle="collapse" data-target="#projects" style="width: 100%; font-size: 150%;">Projects</button>
            <div class="collapse mb-3" id="projects">
				<?php 
					while($row = mysqli_fetch_array($result_projects))
					{
						echo "<strong>".$row['title']."</strong><br>";
						echo $row['description']."<br><br>";
					}
				?>
            </div>
            <button type="button" class="btn btn-primary dropdown-toggle mb-4" data-toggle="collapse" data-target="#extra" style="width: 100%; font-size: 150%;">Extra curricular & Co-curricular</button>
            <div class="collapse mb-3" id="extra">
			<?php
				$column = array();
				while($row = mysqli_fetch_array($result_extra))
					$column[] = $row['activity'];
				$i = 0;
				while($i<count($column))
				{
					echo $column[$i]."<br><br>";
					$i=$i+1;
				}
			?>
            </div>
        </div>
	<?php
		else:
			mysqli_close($db);
			header('Location: login.php');
	?>
	<?php endif; ?>
</body>
</html>