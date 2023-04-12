<?php  
  include 'core/init.php';
?>

<html>
	<head>
		<title>Connect</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="assets/css/font/css/font-awesome.css">
		<link rel="stylesheet" href="assets/css/style-complete.css">
		<link rel="stylesheet" href="assets/css/validation.css">
	</head>
<body>
<div class="bg">
<div class="wrapper">
		<div class="inner-wrapper-index">
			<div class="main-container">
				<div class="content-left">
					<h1>Welcome to Connect</h1>
					<br>
					<h3>See what's happening around you.</h3>
				</div>	

				<div class="content-right">
					<!-- Log In Section Starts-->
					<div class="login-wrapper">
					  <?php include 'includes/login.php' ?>
					</div><!-- log in Section Ends -->

					<!-- SignUp Section Starts-->
					<div class="signup-wrapper">
					   <?php include 'includes/signup-form.php' ?>
					</div>
					<!-- SignUp Section Ends -->

				</div>

			</div>

		</div>
	</div>
</div>	

</body>
</html>
