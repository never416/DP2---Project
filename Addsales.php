
<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<body>
<H1>Add ssales record</H1>
<br/>

<form>
  Product code: <input type="text" name="pcode"> <br/>
  Description: <input type="text" name="description"> <br/>
  Quantity: <input type="text" name="quantity"> <br/>
  RRP: <input type="email" name="rrp"> <br/>
  Total: <input type="text" name="total"> <br/><br/>
  <input type="submit" value="Submit" /> <br/>
</form>
</body> 
<?php 
   $servername = "feenix-mariadb.swin.edu.au";
$username = "s414581x";
$password = "141083";
$dbname = "s414581x_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  if(isset($_GET['name']) && isset($_GET['password']))
  {
    $RegisterName = $_GET['name'];
    $RegisterPassword = $_GET['password'];
    $RegisterEmail = $_GET['email'];
    $RegisterPhone = $_GET['phone'];

$sql = "INSERT INTO customer (name, password, email, phone)
VALUES ('$RegisterName', '$RegisterPassword', '$RegisterEmail', '$RegisterPhone')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
  }
  //else {
  //  echo "<p>Please enter your name and phone number and click the Register button.</p>";
  //}
?>
</HTML>
