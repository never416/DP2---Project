
<?php 
//if SESSION is set as $login_user variable and pass it to request.php
if(isset($_SESSION['$login_user'])){
header("location: request.php");
}


// define variables and set to empty values
$LoginNumber = $LoginPassword = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $LoginNumber= isset($_POST['staffno']) ? $_POST['staffno'] : "";
    $LoginPassword = isset($_POST['lpassword']) ? $_POST['lpassword'] : "";
  }

?>

<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0"/>
<meta charset="utf-8" />

<meta name="author" content="Jinsu Park" />
<title>Report Page</title>
<link href="styles/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<H1>Report</H1>
<br/>
<button id="month">Monthly Sales report</button><button id="week">Weekly Sales report</button><button id="day">Daily Sales report</button>

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
</HTML>
