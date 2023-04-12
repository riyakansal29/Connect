<?php
  include 'core/init.php';
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);
    if ($getFromU->loggedIn() === false) {
    header('Location: index.php');
  }
 
  if (isset($_POST['post'])) {
    $status = $getFromU->checkInput($_POST['status']);
    if (!empty($status) && strlen($status) < 150) {
      $getFromU->create('post', array('status' => $status, 'postby' => $user_id, 'postedon' => date("Y-m-d H:i:s")));
    } elseif (!empty($status) && strlen($status) > 150) {
      $error = "The post is too long! Limit: 150 characters";
    } 
    else {
      $error = "Please type something to post!";
    }
  }

  if (isset($_POST['search'])) {
    $searchUserURL = $getFromU->searchByUsername($_POST['searchUsername']);
    header('Location: '. $searchUserURL);
  }
?>

<html>
	<head>
		<title>Connect</title>
		  <meta charset="UTF-8" />
		  <link rel="stylesheet" href="assets/css/font/css/font-awesome.css"/>  
 	  	  <link rel="stylesheet" href="assets/css/style-complete.css"/>   	  
	</head>
<body>
<div class="wrapper">
<div class="header-wrapper">

<div class="nav-container">
	
	<div class="nav">
		
		<div class="nav-left">
			<ul>
				<li><a href=""><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
			</ul>
		</div>

		<div class="nav-right">
			<ul>
				<li>
					<form method="post">
					<input type="text" id="searchText" placeholder="Search" name="searchUsername" class="search"/>
					<i class="fa fa-search" aria-hidden="true"><button type="submit" name="search" style="display: none"></button></i>
					</form>
				</li>

				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user->profileImage; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="profile.php?username=<?php echo $user->username; ?>"><?php echo $user->username; ?></a></li>
							<li><a href="includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
			</ul>
		</div>
	</div>
</div>

</div>

<div class="inner-wrapper">
<div class="in-wrapper">
	<div class="in-full-wrap">
		<div class="in-left">
			<div class="in-left-wrap">
		<div class="info-box">
			<div class="info-inner">
				<div class="info-in-head">
					<!-- PROFILE COVER IMAGE -->
					<img src="assets/images/defaultCoverImage.png"/>
				</div><!-- info in head end -->
				<div class="info-in-body">
					<div class="in-b-box">
						<div class="in-b-img">
						<!-- PROFILE IMAGE -->
						<img src="<?php echo $user->profileImage; ?>"/>
						</div>
					</div>
					<div class="info-body-name">
						<div class="in-b-name">
							<div><a href="profile.php?username=<?php echo $user->username; ?>"><?php echo $user->fullname; ?></a></div>
							<span><small>@<?php echo $user->username; ?></small></span>
						</div>
					</div>
				</div>
				<div class="info-in-footer">
					<div class="number-wrapper">
						<div class="num-box">
							<div class="num-head">
								POSTS
							</div>
							<div class="num-body">
								<?php $getFromT->countPosts($user_id); ?>
							</div>
						</div>
						<div class="num-box">
							<div class="num-head">
								FOLLOWING
							</div>
							<div class="num-body">
								<span class="count-following"><?php echo $user->following; ?></span>
							</div>
						</div>
						<div class="num-box">
							<div class="num-head">
								FOLLOWERS
							</div>
							<div class="num-body">
								<span class="count-followers"><?php echo $user->followers; ?></span>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>

	</div>
		</div>
		<div class="in-center">
			<div class="in-center-wrap">
				<!--POST -->
				<div class="post-wrap">
					<div class="post-inner">
						 <div class="post-h-left">
						 	<div class="post-h-img">
						 	<!-- PROFILE IMAGE -->
						 		<img src="<?php echo $user->profileImage; ?>"/>
						 	</div>
						 </div>
						 <div class="post-body">
						 <form method="post" enctype="multipart/form-data">
							<textarea class="status" name="status" placeholder="Type Something here!" rows="4" cols="50"></textarea>
 						 	<div class="hash-box">
						 		<ul>
						 				<span class="post-error"><?php if (isset($error)) { echo $error; } ?></span>
  						 		</ul>
						 	</div>
 						 </div>
						 <div class="post-footer">
						 	<div class="t-fo-right">
						 		<input type="submit" name="post" value="Post"/>
				 		</form>
						 	</div>
						 </div>
					</div>
				</div><!--POST -->

			
				<!-- Show Post-->
				 <div class="post">
 				  	<?php $getFromT->posts($user_id); ?>
 				 </div>
 				<!--Show Post ends-->

			</div>
		</div>

		<div class="in-right">
			<div class="in-right-wrap">
 			</div>

		</div>

	</div>

</div>
</div>
</div>
</body>

</html>
