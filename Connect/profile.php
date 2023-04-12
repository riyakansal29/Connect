<?php  
  if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
    include 'core/init.php';
    $username = $getFromU->checkInput($_GET['username']);
    $profileId = $getFromU->userIdByUsername($username);
    $profileData = $getFromU->userData($profileId);
    $post = $getFromT->getUserPosts($profileId);
    $user_id = $_SESSION['user_id'];
    $user = $getFromU->userData($user_id);
 
    if(!$profileData || ($getFromU->loggedIn() === false)) {
      header('Location: index.php');
    }
  } else {
    header('Location: index.php');
  }
  
  if (isset($_POST['follow'])) {
    $getFromF->follow($user_id, $profileId);
    header("Refresh:0"); // Refresh the page
}

if (isset($_POST['unfollow'])) {
    $getFromF->unfollow($user_id, $profileId);
    header("Refresh:0");
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
 		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css"/>
   			<link rel="stylesheet" href="./assets/css/font/css/font-awesome.css"/>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    </head>

<body>
<div class="wrapper">
<div class="header-wrapper">
	<div class="nav-container">
    	<div class="nav">
		<div class="nav-left">
			<ul>
				<li><a href="<?php echo BASE_URL; ?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
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

				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profileImage; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="profile.php?username=<?php echo $user->username; ?>"><?php echo $user->username; ?></a></li>
							<li><a href="<?php echo BASE_URL; ?>includes/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
			</ul>
		</div>

	</div>
	</div>
</div>
<!-- PROFILE COVER-->
<div class="profile-cover-wrap">
<div class="profile-cover-inner">
	<div class="profile-cover-img">
		<!-- PROFILE COVER -->
		<img src="<?php echo BASE_URL; ?>assets/images/defaultCoverImage.png"/>
	</div>
</div>
<div class="profile-nav">
 <div class="profile-navigation">
	<ul>
		<li>
		<div class="n-head">
			POSTS
		</div>
		<div class="n-bottom">
		  <?php $getFromT->countPosts($profileId); ?>
		</div>
		</li>
		<li>
				<div class="n-head">
					FOLLOWING
				</div>
				<div class="n-bottom">
					<span class="count-following"><?php echo $profileData->following; ?></span>
				</div>
			</a>
		</li>
		<li>
				<div class="n-head">
					FOLLOWERS
				</div>
				<div class="n-bottom">
					<span class="count-followers"><?php echo $profileData->followers; ?></span>
				</div>
			</a>
		</li>
	</ul>
	<div class="edit-button">
		<form method="post">
			<?php $getFromF->displayBtn($user_id, $profileId); ?>
		</form>
	</div>
    </div>
</div>
</div><!--PROFILE COVER END-->

<div class="in-wrapper">
 <div class="in-full-wrap">
   <div class="in-left">
     <div class="in-left-wrap">
	<div class="profile-info-wrap">
	 <div class="profile-info-inner">
		 
	 <!-- PROFILE IMAGE -->
		<div class="profile-img">
			<img src="<?php echo BASE_URL.$profileData->profileImage; ?>"/>
		</div>

		<div class="profile-name-wrap">
			<div class="profile-name">
				<?php echo $profileData->fullname; ?>
			</div>
			<div class="profile-tname">
				@<span class="username"><?php echo $profileData->username; ?></span>
			</div>
		</div>

	 </div>

	</div>

	</div>

  </div>

 <div class="in-center">
	<div class="in-center-wrap">
		<?php
			$post = $getFromT->getUserPosts($profileId);
			foreach ($post as $post) {
				echo '<div class="all-post">
						<div class="t-show-wrap">
						 <div class="t-show-inner">
							<div class="t-show-popup">
								<div class="t-show-head">
									<div class="t-show-img">
										<img src="'. $post->profileImage .'"/>
									</div>
									<div class="t-s-head-content">
										<div class="t-h-c-name">
											<span><a href=""'. $post->username .'">'. $post->fullname .'</a></span>
											<span>@'. $post->username .'</span>
											<span>'. $post->postedon .'</span>
										</div>
										<div class="t-h-c-dis">
											'. $post->status .'
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>';
			}

		?>
  <div class="popuppost"></div>
</div>
</div>
</div>
</div>
</body>
</html>
