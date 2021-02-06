<?php
session_start();
include 'php/connectDB.php';
$conn = connect();

$cod = $_SESSION['codeDB'];
$last_name ="";
$first_name = "";
$telefon="";
$mail="";
$service="";
$date="";
$details="";
$location="";
$downloadLink="";
$confirmed="";
$finished="";


//inner join
$sql = "SELECT * FROM appointments INNER JOIN clients ON appointments.id_client = clients.id_client INNER JOIN services ON appointments.id_service = services.id_service WHERE clients.Cod = '".$cod."' ";
$result = mysqli_query($conn, $sql);
if (!$result) 
{
    die ('SQL Error: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result))
{
    $last_name = $row['Nume'];
    $first_name = $row['Prenume'];
    $telefon = $row['Telefon'];
    $mail = $row['Mail'];
    $service = $row['Denumire'];
    $date = $row['Data'];
    $location = $row['Locatie'];
    $details = $row['Detalii'];
    $downloadLink = $row['DownloadLink'];
    $confirmed = $row['Confirmed'];
    $finished = $row['Finished'];
}

$strdate = $date;
$strdate .= ' 2:00 PM';
$convertdate = strtotime($strdate);
$remaining = $convertdate - time();

$days_remaining = floor($remaining / 86400);
$hours_remaining = floor(($remaining % 86400) / 3600);

?>

<!DOCTYPE html>
<html>
<head>
	<title>CR Photography - Services</title>
	<link href='https://fonts.googleapis.com/css?family=Bad Script' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap-4.1.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/client.css">
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
	<br><br><br>
	<div class="page-title">
		<?php
			echo '<h1>Hi, '.$first_name.'</h1>';
		?>
	</div>
	<br><br>
	<div class="body">
		<div class="left">
			<div class="left-body">
			<br>
			<h3>Informations</h3>
			<div class="info-1">
				<ul>Service: </ul>
				<ul>Location: </ul>
				<ul>Date: </ul>
				<ul>Details: </ul>
			</div>
			<div class="info-2">
				<?php
					echo '<ul>'.$service.'</ul>';
					echo '<ul>'.$location.'</ul>';
					echo '<ul>'.date('j F Y',strtotime($date)).'</ul>';
					echo '<ul>'.$details.'</ul>';
				?>
			</div>
			</div>
		</div>

		<div class="right">
			<br>
			<h3>News</h3>
			<br>
			<div class="countdown">
				<?php
					if(true == $confirmed && (0 <= $days_remaining || 0 < $hours_remaining))
					{
						echo '<h4 style=" width: 70%;
						margin-left: auto; margin-right: auto;">There are <span style="color:LimeGreen;">'
						.$days_remaining.' days</span> and <span style="color:LimeGreen">'
						.$hours_remaining.' hours</span> left till your photo shoot!</h4>';
					}
					else if(true == $confirmed)
					{
						echo '<h4 style=" width:70%;
						margin-left: auto; margin-right: auto;">Photo shoot was taken in '.$date.'</h4>';
					}
				?>
			</div>
			<div class="downloadLink">
				<?php
					if(null != $downloadLink)
					{
						echo '<h4 style="margin-top:5%;">Download link: <a style="color:LimeGreen;" href="'.$downloadLink.'">'.$downloadLink.'</a></h4>';
					}
				?>
			</div>
			<div class="confirm">
				<?php
					if(false == $confirmed)
					{
						echo '<p style="background-color: #3a5f21; color: white; padding: 10px;">Waiting to confirm...</p>';
					}
					else
					{
						echo '<p style="background-color: #3a5f21; color:white; padding: 10px;">Confirmed.</p>';
					}
				?>
			</div>
		</div>
	</div>
	<br><br><br>

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