<?php
//if SESSION is set as $login_user variable and pass it to request.php
if(isset($_SESSION['$login_user'])) {
	header("location: request.php");
}

// define variables and set to empty values
$LoginNumber = $LoginPassword = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$LoginNumber= isset($_POST['staffno']) ? $_POST['staffno'] : "";
		$LoginPassword = isset($_POST['lpassword']) ? $_POST['lpassword'] : "";
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta name="viewport" content="width=device-width; initial-scale=1.0"/>
	<meta charset="utf-8" />
	<meta name="author" content="Thao Nguyen" />
	<title>Login Page</title>
	<link href="css/login.css" rel="stylesheet" />
</head>
<body>
	<div class="container">
		<div><img class="profile-img-card" src="img/logo.png" alt="Company Logo" /></div>
		<div class="card card-container">
			<form class="form-signin" action="" method="post">
				<span id="reauth-email" class="reauth-email"></span>
				<input type="text" id="inputNumber" class="form-control" placeholder="Staff Number" required autofocus><span class="error">* <?php echo $nameErr;?></span>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" required><span class="error">* <?php echo $passErr;?></span>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
			</form>
		</div>
	</div>

<?php
//Starting a session
session_start();

//if fields are not empty, execute
if (!empty($LoginNumber) && !empty($LoginPassword))
{
	$servername = "feenix-mariadb.swin.edu.au";
	$username = "s414581x";
	$password = "";
	$dbname = "s414581x_db";

	// Create connection
	$conn = mysql_connect($servername, $username, $password);
	$db = mysql_select_db($dbname, $conn);

	//SQL query to select the correct table row where the customer number and password match
	$query = mysql_query("SELECT * FROM staff where staff_id='$LoginNumber' and password='$LoginPassword'", $conn) ;
	$rows = mysql_num_rows($query);
	if ($rows == 1) {
		$_SESSION['$login_user']=$LoginNumber; // Initializing Session
		header("location: records.php"); // Redirecting to records.php
	}
	else {
		//If no user is found, show error message
		echo "Staff Number or Password is invalid";
	}
	mysql_close($conn); // Closing Connection
}
?>
</body>
</html>
