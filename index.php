<?php
session_start();
include 'php/connectDB.php';
$conn = connect();


$sql = "SELECT * FROM appointments WHERE Finished = '0'";
$result = mysqli_query($conn, $sql);
if (!$result) 
{
    die ('SQL Error: ' . mysqli_error($conn));
}
$count = mysqli_num_rows($result);
$offers = 40 - $count;
?>

<!DOCTYPE html>
<html>
<head>
	<title>CR Photography - Home</title>
	<link href='https://fonts.googleapis.com/css?family=Bad Script' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap-4.1.0/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/inndex.css">
	<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script src="bootstrap-4.1.0/js/bootstrap.min.js"></script>
</head>

<body>
	<div id="background-photo">
		<div>
			<div class="mySlides">
  				<img src="images/photo-1.jpg">
			</div>
			<div class="mySlides">
  				<img src="images/photo-2.jpg">
			</div>
			<div class="mySlides">
  				<img src="images/photo-3.jpg">
			</div>
			<div class="mySlides">
  				<img src="images/photo-4.jpg">
			</div>
			<div class="mySlides">
  				<img src="images/photo-5.jpg">
			</div>
			<div class="mySlides">
  				<img src="images/photo-6.jpg">
			</div>
			<div class="mySlides">
  				<img src="images/photo-7.jpg">
			</div>
		</div>

		<div class="container-fluid" id="header">
		</div>

		<div class="container-fluid" id="logo">
			<img src="images/logo-alb.png">
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
	</div>

	<div class="code-img">
		<img src="images/body-green.png">
	</div>
	<div class="code">
		<br><p>Enter your code</p>
		<div class="code-input ">
			<form action="php/client.php">
				<input type="text" placeholder="Code" name="clientCode">
				<button type="submit" class="nextButton">Next</button>
			</form>
		</div>
	</div>
	<div class="info">
		<br>
		<h1>News</h1>
		<?php
			echo '<p>There are '.$offers.' offers left.</p>';
		?>
		<form action="appointment.html">
			<button type="submit" class="bookbutton">Book now</button>
		</form>
	</div>

	<div class="reviews">
		<q class="item-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non vulputate quam. Proin maximus lorem et cursus sollicitudin. Cras dignissim ex a lacus fringilla consequat.</q><br>
		<q class="item-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non vulputate quam.</q>
		<q class="item-3">Vivamus volutpat vitae velit ac aliquam. Suspendisse tincidunt ornare mauris, aliquam pretium augue. Interdum et malesuada fames ac ante ipsum primis in faucibus.</q>
	</div>

	<script src="javascript/index.js"></script>

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