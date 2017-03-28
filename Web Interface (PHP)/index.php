<?php
$db = new mysqli('host', 'user', 'pass', 'stat');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="refresh" content="5" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body style="background-image:url(NGE.jpg)">
  <div class="row">
  <div class="col-1"></div>
  <div class="col-10">
  <br>
  <!-- BEGIN STARSHA -->
  <?php
  $sql = <<<SQL
    SELECT *
    FROM `computers`
    WHERE `id` = 1 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc()
  ?>
<div class="card card-inverse" style="background-color: #333; border-color: #333;">
  <div class="card-block">
  	<div class="row">
  <div class="col-4"><h1 class="card-title">Starsha</h1></div>
  <?php
  
  //get date and time for determining whether computer is online or not. If it hasn't updated in 15 seconds, assume offline
  $date = date('Y-m-d H:i:s');
  $date2 = date($row['updated']);
  $newdate = strtotime ( '-15 second' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d H:i:s' , $newdate );
if ($date2 > $newdate)
{
  echo'
  <div class="col-4"><h3><span class="badge badge-pill badge-success">Online</span></h3></div>
</div>
	<div class="row">
  <div class="col-1">
  <h2>CPU:</h2>
  
  </div>
  <div class="col-1">
  <h3>'.$row["CPUload"].'%</h3>
  </div>
    <div class="col-1">
  <h3><span class="badge badge-pill badge-default">'.$row["CPUtemp"].'°C</span></h3>
  </div>
  <div class="col-3"><h5>Locked in P0</h5></div>
  <div class="col-1">
  <h2>GPU:</h2>
  </div>
    <div class="col-1">
  <h3>'.$row["GPUload"].'%</h3>
  </div>
      <div class="col-4">
  <h3><span class="badge badge-pill badge-default">'.$row["GPUtemp"].'°C</span></h3>
  </div>
</div>

<div class="row">
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["CPUload"].'%" aria-valuenow="'.$row["CPUload"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["GPUload"].'%" aria-valuenow="'.$row["GPUload"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-2">
Physical - Core #1:
</div>
<div class="col-4">
'.$row["CPU1clock"].' MHz
</div>
<div class="col-1">
Core:
</div>
<div class="col-5">
'.$row["GPUclock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #2:
</div>
<div class="col-4">
'.$row["CPU2clock"].' MHz
</div>
<div class="col-1">
Memory:
</div>
<div class="col-5">
500 MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #3:
</div>
<div class="col-4">
'.$row["CPU3clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #4:
</div>
<div class="col-4">
'.$row["CPU4clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #5:
</div>
<div class="col-4">
'.$row["CPU5clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #6:
</div>
<div class="col-4">
'.$row["CPU6clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #7:
</div>
<div class="col-4">
'.$row["CPU7clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #8:
</div>
<div class="col-4">
'.$row["CPU8clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #9:
</div>
<div class="col-4">
'.$row["CPU9clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #10:
</div>
<div class="col-4">
'.$row["CPU10clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #11:
</div>
<div class="col-4">
'.$row["CPU11clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #12:
</div>
<div class="col-4">
'.$row["CPU12clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #13:
</div>
<div class="col-4">
'.$row["CPU13clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #14:
</div>
<div class="col-4">
'.$row["CPU14clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Physical - Core #15:
</div>
<div class="col-4">
'.$row["CPU15clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Logical -- Core #16:
</div>
<div class="col-4">
'.$row["CPU16clock"].' MHz
</div>
</div>
<hr>
<div class="row">
  <div class="col-1">
  <h2>RAM:</h2>
  
  </div>
  <div class="col-5">
  <h3>'.$row["RAMusage"].'% of 32GB</h3>
  </div>
  <div class="col-1">
  <h2>SSD:</h2>
  </div>
    <div class="col-5">
  <h3>'.$row["HDDusage"].'% of 1TB</h3>
  </div>
</div>

<div class="row">
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["RAMusage"].'%" aria-valuenow="'.$row["RAMusage"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["HDDusage"].'%" aria-valuenow="'.$row["HDDusage"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>';

}
else
{
	echo'
  <div class="col-4"><h3><span class="badge badge-pill badge-danger">Offline</span></h3></div>';
}

?>

</div>
</div>
</div>
<!-- Starsha card ends here -->
<hr>
   <!-- BEGIN YOSHIMURA -->
  <?php
  $sql = <<<SQL
    SELECT *
    FROM `computers`
    WHERE `id` = 2 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc()
  ?>
<div class="card card-inverse" style="background-color: #333; border-color: #333;">
  <div class="card-block">
  	<div class="row">
  <div class="col-4"><h1 class="card-title">Yoshimura</h1></div>
  <?php
  
  //get date and time for determining whether computer is online or not. If it hasn't updated in 15 seconds, assume offline
  $date = date('Y-m-d H:i:s');
  $date2 = date($row['updated']);
  $newdate = strtotime ( '-15 second' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d H:i:s' , $newdate );
if ($date2 > $newdate)
{
  echo'
  <div class="col-4"><h3><span class="badge badge-pill badge-success">Online</span></h3></div>
</div>
	<div class="row">
  <div class="col-1">
  <h2>CPU:</h2>
  
  </div>
  <div class="col-1">
  <h3>'.$row["CPUload"].'%</h3>
  </div>
    <div class="col-1">
  <h3><span class="badge badge-pill badge-default">';
  
  $fxcorrtemp = $row["CPUtemp"] + 25;
  echo $fxcorrtemp;
  
  echo '°C</span></h3>
  </div>
  <div class="col-3"></div>
  <div class="col-1">
  <h2>GPU:</h2>
  </div>
    <div class="col-1">
  <h3>'.$row["GPUload"].'%</h3>
  </div>
      <div class="col-4">
  <h3><span class="badge badge-pill badge-default">'.$row["GPUtemp"].'°C</span></h3>
  </div>
</div>

<div class="row">
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["CPUload"].'%" aria-valuenow="'.$row["CPUload"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["GPUload"].'%" aria-valuenow="'.$row["GPUload"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-2">
Module 1 - Core #1:
</div>
<div class="col-4">
'.$row["CPU1clock"].' MHz
</div>
<div class="col-1">
Core:
</div>
<div class="col-5">
'.$row["GPUclock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 1 - Core #2:
</div>
<div class="col-4">
'.$row["CPU2clock"].' MHz
</div>
<div class="col-1">
Memory:
</div>
<div class="col-5">
2000 MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 2 - Core #3:
</div>
<div class="col-4">
'.$row["CPU3clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 2 - Core #4:
</div>
<div class="col-4">
'.$row["CPU4clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 3 - Core #5:
</div>
<div class="col-4">
'.$row["CPU5clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 3 - Core #6:
</div>
<div class="col-4">
'.$row["CPU6clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 4 - Core #7:
</div>
<div class="col-4">
'.$row["CPU7clock"].' MHz
</div>
</div>

<div class="row">
<div class="col-2">
Module 4 - Core #8:
</div>
<div class="col-4">
'.$row["CPU8clock"].' MHz
</div>
</div>

<hr>
<div class="row">
  <div class="col-1">
  <h2>RAM:</h2>
  
  </div>
  <div class="col-5">
  <h3>'.$row["RAMusage"].'% of 16GB</h3>
  </div>
  <div class="col-1">
  <h2>SSD:</h2>
  </div>
    <div class="col-5">
  <h3>'.$row["HDDusage"].'% of 500GB</h3>
  </div>
</div>

<div class="row">
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["RAMusage"].'%" aria-valuenow="'.$row["RAMusage"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["HDDusage"].'%" aria-valuenow="'.$row["HDDusage"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>';

}
else
{
	echo'
  <div class="col-4"><h3><span class="badge badge-pill badge-danger">Offline</span></h3></div>';
}

?>

</div>
</div>
</div>
<!-- Yoshimura card ends here -->
<hr>
   <!-- BEGIN Pserver -->
  <?php
  $sql = <<<SQL
    SELECT *
    FROM `computers`
    WHERE `id` = 5 
SQL;

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
$row = $result->fetch_assoc()
  ?>
<div class="card card-inverse" style="background-color: #333; border-color: #333;">
  <div class="card-block">
  	<div class="row">
  <div class="col-4"><h1 class="card-title">pSERVER</h1></div>
  <?php
  
  //get date and time for determining whether computer is online or not. If it hasn't updated in 15 seconds, assume offline
  $date = date('Y-m-d H:i:s');
  $date2 = date($row['updated']);
  $newdate = strtotime ( '-15 second' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d H:i:s' , $newdate );
if ($date2 > $newdate)
{
  echo'
  <div class="col-4"><h3><span class="badge badge-pill badge-success">Online</span></h3></div>
</div>
	<div class="row">
  <div class="col-1">
  <h2>CPU #1:</h2>
  
  </div>
  <div class="col-1">
  <h3>'.$row["CPUload"].'%</h3>
  </div>
    <div class="col-1">
  </div>
  <div class="col-3"></div>
  <div class="col-1">
  <h2>CPU #2:</h2>
  </div>
    <div class="col-1">
  <h3>'.$row["GPUload"].'%</h3>
  </div>
      <div class="col-4">
  </div>
</div>

<div class="row">
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["CPUload"].'%" aria-valuenow="'.$row["CPUload"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["GPUload"].'%" aria-valuenow="'.$row["GPUload"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-1">
Core #1:
</div>
<div class="col-1">
'.$row["CPU1clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU5clock"].'°C</span></div>
<div class="col-1">
Core #1:
</div>
<div class="col-1">
'.$row["CPU9clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU13clock"].'°C</span></div>
</div>

<div class="row">
<div class="col-1">
Core #2:
</div>
<div class="col-1">
'.$row["CPU2clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU6clock"].'°C</span></div>
<div class="col-1">
Core #2:
</div>
<div class="col-1">
'.$row["CPU10clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU14clock"].'°C</span></div>
</div>

<div class="row">
<div class="col-1">
Core #3:
</div>
<div class="col-1">
'.$row["CPU3clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU7clock"].'°C</span></div>
<div class="col-1">
Core #3:
</div>
<div class="col-1">
'.$row["CPU11clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU15clock"].'°C</span></div>
</div>

<div class="row">
<div class="col-1">
Core #4:
</div>
<div class="col-1">
'.$row["CPU4clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU8clock"].'°C</span></div>
<div class="col-1">
Core #4:
</div>
<div class="col-1">
'.$row["CPU12clock"].' MHz
</div>
<div class="col-4"><span class="badge badge-pill badge-default">'.$row["CPU16clock"].'°C</span></div>
</div>


<hr>
<div class="row">
  <div class="col-1">
  <h2>RAM:</h2>
  
  </div>
  <div class="col-5">
  <h3>'.$row["RAMusage"].'% of 24GB</h3>
  </div>
  <div class="col-1">
  <h2>ARRAY:</h2>
  </div>
    <div class="col-5">
  <h3>'.$row["HDDusage"].'% of 600GB</h3>
  </div>
</div>

<div class="row">
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["RAMusage"].'%" aria-valuenow="'.$row["RAMusage"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<div class="col-6">
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: '.$row["HDDusage"].'%" aria-valuenow="'.$row["HDDusage"].'" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>';

}
else
{
	echo'
  <div class="col-4"><h3><span class="badge badge-pill badge-danger">Offline</span></h3></div>';
}

?>

</div>
</div>
</div>
<!-- pSERVER card ends here -->



	
	<br><br></div></div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>