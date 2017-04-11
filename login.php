
<?php 

if(isset($_SESSION['$login_user'])){
header("location: request.php");
}
$error="";

// define variables and set to empty values

 $nameErr = $passErr = $emailErr = $phoneErr = $cpassErr = "";
$LoginNumber = $LoginPassword = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST['custno'])) {
    $nameErr = "Customer Number is required";
    //echo $nameErr;
  } else {
    $LoginNumber=isset($_POST['custno']) ? $_POST['custno'] : "";
  }

  if (empty($_POST['lpassword'])) {
    $passErr = "Password is required";
    //echo $passErr;
  } else {
     $LoginPassword = isset($_POST['lpassword']) ? $_POST['lpassword'] : "";
  }

  

}
?>



<H1>ShipOnline System Registration Page</H1>
<br/>

<form action="" method="post">
  Customer Number: <input type="text" name="custno"><span class="error">* <?php echo $nameErr;?></span> <br/> 
  Password: <input type="text" name="lpassword"> <span class="error">* <?php echo $passErr;?></span> <br/> 
  
  <input type="submit" value="Login" /> <br/>
</form>


<?php 
session_start(); //Starting a session

//if (isset($_POST['submit'])) {
  //if (empty($_POST['custno']) || empty($_POST['password'])) {
    //$error = "Customer Number or Password is empty";
    //}
//else

if (!empty($LoginNumber) && !empty($LoginPassword))
{
  //$custno = $_POST['custno'];
  //$password = $_POST['password'];

  $servername = "feenix-mariadb.swin.edu.au";
  $username = "s414581x";
  $password = "141083";
  $dbname = "s414581x_db";

  // Create connection
  $conn = mysql_connect($servername, $username, $password);
  
  $db = mysql_select_db($dbname, $conn);

  //$custno = stripslashes($custno);
  //$lpassword = stripslashes($lpassword);
  //$custno = mysql_real_escape_string($custno);
  //$lpassword = mysql_real_escape_string($lpassword);

  

  $query = mysql_query("SELECT * FROM customer where customer_number='$LoginNumber' and password='$LoginPassword'", $conn) ;
  $rows = mysql_num_rows($query);
  if ($rows == 1) {
  $_SESSION['$login_user']=$LoginNumber; // Initializing Session
  header("location: request.php"); // Redirecting To Other Page
  } else {
  echo "Customer Number or Password is invalid";
  }
  mysql_close($conn); // Closing Connection

}


 
 
  


?>
</HTML>
