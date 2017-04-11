<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<body>
<?php 

// define variables and set to empty values
session_start();
  

 $idescErr = $paddressErr = $psuburbErr = $pdateErr = $ptimeErr = $rnameErr = $raddressErr = $rsuburbErr = $pdateErr = $ptimeErr = "";
$idesc = $weight = $paddress = $psuburb = $day = $month = $year = $pdate = $phour = $pminute = $ptime = $rname = $raddress = $rsuburb = $rstate = $pmonth = $pday = $pyear = $currentdate = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST['idesc'])) {
    $idescErr = "Item Description is required";
    //echo $nameErr;
  } else {
    $idesc=isset($_POST['idesc']) ? $_POST['idesc'] : "";
  }

  $weight=isset($_POST['weight']) ? $_POST['weight'] : "";
  
  if (empty($_POST['paddress'])) {
    $paddressErr = "Pickup address is required";
    //echo $nameErr;
  } else {
    $paddress=isset($_POST['paddress']) ? $_POST['paddress'] : "";
  }

  if (empty($_POST['psuburb'])) {
    $psuburbErr = "Pickup Suburb is required";
    //echo $nameErr;
  } else {
    $psuburb=isset($_POST['psuburb']) ? $_POST['psuburb'] : "";
  }

  $pday = isset($_POST['pday']) ? $_POST['pday'] : "";
  $pmonth=isset($_POST['pmonth']) ? $_POST['pmonth'] : "";
  $pyear=isset($_POST['pyear']) ? $_POST['pyear'] : "";

  $pday = strval($pday);
  $pmonth = strval($pmonth);

  $phour = isset($_POST['phour']) ? $_POST['phour'] : "";

  if (empty($_POST['pminute'])) {
    $pminute = "00";
  } else {
    $pminute = isset($_POST['pminute']) ? $_POST['pminute'] : "";
  }

  $ptime = date('H:i', mktime($phour, $pminute)); 

  if(strtotime($ptime) < strtotime("07:30") OR strtotime($ptime) > strtotime("20:30") ){
    $ptimeErr = "Time is out of business hours. Must be between 7:30 - 20:30";
  } 

  if (empty($ptimeErr)) {
 $pdate = date('Y-m-d H:i:s', mktime($_POST['phour'], $pminute, 0, $_POST['pmonth'], $_POST['pday'], $_POST['pyear'])); 

}

  if(strtotime($pdate) < strtotime('+24 hours')){
  $pdateErr = "Pickup date must be atleast 24 hours from current date";
}
  //else {
    //echo "Time is damn fine";
  //}
  //$pdate = date('F jS, Y g:i:s a', mktime($_POST['phour'], $_POST['pminute'], 0, $_POST['pmonth'], $_POST['pday'], $_POST['pyear']));
 
  
  
//else{
  //echo "Time must be atleast 24 hours from this date and time";
//}
  

if (empty($_POST['rname'])) {
    $rnameErr = "Reciever Name is required";
    //echo $nameErr;
  } else {
    $rname=isset($_POST['rname']) ? $_POST['rname'] : "";
  }

if (empty($_POST['raddress'])) {
    $raddressErr = "Delivery Address is required";
    //echo $nameErr;
  } else {
    $raddress=isset($_POST['raddress']) ? $_POST['raddress'] : "";
  }


if (empty($_POST['rsuburb'])) {
    $rsuburbErr = "Delivery Suburb is required";
    //echo $nameErr;
  } else {
    $rsuburb=isset($_POST['rsuburb']) ? $_POST['rsuburb'] : "";
  }

 $rstate = isset($_POST['rstate']) ? $_POST['rstate'] : "";

}
?>



<H1>ShipOnline System Registration Page</H1>
<br/>

<form action="" method="post">
<fieldset>
Item Information:
  <fieldset>
  Description: <input type="text" name="idesc"> <span class="error"> * <?php echo $idescErr;?></span><br/> 
  Weight: <select name="weight">
  <?php for ($i = 2; $i <= 20; $i++) : ?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
  <?php endfor; ?>
</select> <br/> 
  </fieldset>
  Pick-up Information
  <fieldset>
  Address: <input type="text" name="paddress"> <span class="error"> * <?php echo $paddressErr;?></span> <br/> 
  Suburb: <input type="text" name="psuburb" > <span class="error"> * <?php echo $psuburbErr;?></span> <br/> 
  Preferred date: <select name="pday" value=''><option>Day</option>
<?php for ($i = 1; $i <= 31; $i++) : ?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
  <?php endfor; ?>
</select> 
<select name="pmonth" value=''><option>Month</option>
<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
<select name="pyear">
<option value="2017">2017</option>
<option value="2018">2018</option>
</select><span class="error"> * <?php echo $pdateErr;?></span><br/>
  Preferred time: <select name="phour">
<?php for ($i = 7; $i <= 20; $i++) : ?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
  <?php endfor; ?>
</select> <input type="text" name="pminute"><span class="error"> * <?php echo $ptimeErr;?></span><br/>
  <small>If you don't input a minute property, we'll assume you want us to pick the item up at the exact hour.</small>
  </fieldset>
  Delivery Information:
  <fieldset>
  Reciever Name: <input type="text" name="rname"><span class="error"> * <?php echo $rnameErr;?></span> <br/>
  Address: <input type="text" name="raddress"><span class="error"> * <?php echo $raddressErr;?></span> <br/>
  Suburb: <input type="text" name="rsuburb"> <span class="error"> * <?php echo $rsuburbErr;?></span><br/>
  State: </select>
<select name="rstate">
<option value="VIC">VIC</option>
<option value="NSW">NSW</option>
<option value="SA">SA</option>
<option value="WA">WA</option>
<option value="QLD">QLD</option>
<option value="TAS">TAS</option>
</select> <br/>
  </fieldset>
  <input type="submit" value="Register" /> <br/>
  </fieldset>
</form>

<?php
date_default_timezone_set('Australia/Melbourne');
 $currentdate = date("Y-m-d H:i:s"); 
        // echo $pdate;
//echo $currentdate;
 if(empty($idescErr) && empty($paddressErr) && empty($psuburbErr) && empty($pdateErr) && empty($ptimeErr) && empty($rnameErr) && empty($raddressErr) && empty($rsuburbErr) && empty($pdateErr) && empty($ptimeErr)) {

  $servername = "feenix-mariadb.swin.edu.au";
  $username = "s414581x";
  $password = "141083";
  $dbname = "s414581x_db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  if ($conn === false) {
    die("Connection failed: " . $conn->connect_error);}


if(!empty($idesc) && !empty($rname))  { //&& !empty($RequestPsuburb) && !empty($RequestRname) && empty($RequestRaddress) && empty($RequestRsuburb)) {
      $currentdate = date("Y-m-d H:i:s"); 
      //$currentdate();

      //$currentdate = date('Y-m-d');
      $sql = "INSERT INTO request (customer_number, request_date, item_description, weight, pickup_address, pickup_suburb, preferred_pick_date_time, reciever_name, delivery_address, delivery_suburb, delivery_state)
      VALUES ('{$_SESSION['$login_user']}', '$currentdate', '$idesc', '$weight', '$paddress', '$psuburb', '$pdate', '$rname', '$raddress', '$rsuburb', '$rstate')";
  
    


      if($conn->query($sql) === TRUE){
     
      $i = 2;
      $finalcost = 10;
      $d = strval($weight);  
      //echo $d;

         while ($i<$d)
         {
          $i++;
           $finalcost+=2;    
         }

      $getrequestnumber = "SELECT request_number FROM request WHERE customer_number = '{$_SESSION['$login_user']}' AND request_date = '$currentdate' ";
        $result = mysqli_query($conn, $getrequestnumber);
        
        while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{

       echo "Thank you! Your request number is {$row['request_number']}. The cost is $" .$finalcost. ". We will pick-up the item at $ptime on $pdate. "; }
     }
      else {
        echo "ERROR: Could not execute insert." . $conn->error;
      }
 
  $conn->close();
    }
   }
?>

</body> 


</HTML>
