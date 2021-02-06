<?php

session_start();
include 'php/connectDB.php';
$conn = connect();
$sql = "SELECT * FROM appointments";
$result = mysqli_query($conn, $sql);
if (!$result) 
{
  die ('SQL Error: ' . mysqli_error($conn));
}

// Set your timezone!!
date_default_timezone_set('Europe/Moscow');
// Get prev & next month
if (isset($_GET['ym'])) 
{
    $ym = $_GET['ym'];
} else 
{
    // This month
    $ym = date('Y-m');
}
 
// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) 
{
    $timestamp = time();
}
 
// Today
$today = date('Y-m-j', time());
 
// For H5 title
$html_title = date('Y / m', $timestamp);
 
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
 
// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 0, date('Y', $timestamp)));
 
 
// Create Calendar!!
$weeks = array();
$week = '';
 
// Add empty cell
$week .= str_repeat('<td></td>', $str);


for ( $day = 1; $day <= $day_count; $day++, $str++) 
{   
    $date = $ym.'-'.$day;  

    if ($today == $date) 
    {
        $week .= '<td class="today">'.$day;
    } 
    else 
    {
        $week .= '<td>'.$day;
    }
    $week .= '</td>';

    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) 
    {         
        if($day == $day_count) 
        {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
         
        $weeks[] = '<tr>'.$week.'</tr>';
         
        // Prepare for new week
        $week = '';
    }
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>CR Photography - Services</title>
	<link href='https://fonts.googleapis.com/css?family=Bad Script' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap-4.1.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/appointmentts.css">
  <link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="bootstrap-4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid" id="logo">
		<img src="images/logo-negru.png">
	</div>

	<div class="container-fluid" id="menu">
		<nav class="navbar navbar-expand-lg navbar-light">
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
   				<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
    			<div class="navbar-nav">
     				<a id="nav-item" class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
      				<a id="nav-item" class="nav-item nav-link" href="services.html">Services</a>
      				<a id="nav-item" class="nav-item nav-link" href="portofolio.html">Portofolio</a>
      				<a id="nav-item" class="nav-item nav-link" href="appointment.php">Online Appointment</a>
      				<a id="nav-item" class="nav-item nav-link" href="contact.html">Contact</a>
    			</div>
  			</div>
		</nav>
	</div>
	<br><br>
	<div class="page-title">
		<h1>Online Appointment</h1>
	</div>
	<br><br>
	
	<div class="form">
	   <form id="regForm" action="php/form.php">
  		  <h1>Book now:</h1>
  		  <!-- One "tab" for each step in the form: -->
  		  <div class="tab">Name:
          <p><input placeholder="First name..." oninput="this.className = ''" name="fname"></p>
    		  <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p>
  		  </div>
  		  <div class="tab">Contact Info:
    		  <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
    		  <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
  		  </div>
        <div class="tab">Services:
          <p> 
            <select oninput="this.className = ''" name="code">
              <option value="#1STUD00">Studio</option>
              <option value="#2PROM01">Afara</option>
              <option value="#3DOUB02">Studio + Afara</option>
              <option value="#4WEDD03">Nunta</option>
              <option value="#5CHRI04">Botez</option>
              </select>
          </p>
          <p><input type="date" oninput="this.className = ''" name="date"></p>
        </div>
        <div class="tab">Services:
          <p><input placeholder="Location..." oninput="this.className = ''" name="location"></p>
          <p><input placeholder="Details..." oninput="this.className = ''" name="details"></p>
        </div>
  		  <div style="overflow:auto;">
    		  <div style="float:right;">
      		  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      		  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    		  </div>
  		  </div>
  		  <!-- Circles which indicates the steps of the form: -->
  		  <div style="text-align:center;margin-top:40px;">
    		  <span class="step"></span>
    		  <span class="step"></span>
    		  <span class="step"></span>
    		  <span class="step"></span>
  		  </div>
	   </form>
  </div><br>
  <div class="calendar">
    <div class="container">
        <h5><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h5>
        <table class="table table-bordered">
            <tr>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
                <th>S</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }   
            ?>
        </table>
    </div>
  </div>

<script src="javascript/appointment.js"></script> 
<p style="color: white;">.</p>
  <footer>
		<div class="footer-logo">
			<br><img src="images/logo-alb.png">
		</div>
		<div class="footer-menu">
			<a href="index.php">Home</a>
			<a href="services.html">Services</a>
			<a href="portofolio.html">Portofolio</a>
			<a href="appointment.php">Online Appointment</a>
			<a href="contact.html">Contact</a>
		</div>
		<div class="social-icons">
			<a href="https://www.youtube.com/channel/UC8ih3RwpQXGb860Rh4tU94A" target="_blank"><img src="images/youtube.png"></a>
			<a href="https://www.facebook.com/klas.photos" target="_blank"><img src="images/facebook.png"></a>
			<a href="https://www.instagram.com/klas.photography" target="_blank"><img src="images/instagram.png"></a>
		</div>
		<div class="copyright"><br>
			<p>&copy Copyright Rusu Claudia</p>
		</div>
	</footer>

</body>
</html>