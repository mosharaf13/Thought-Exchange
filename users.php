<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Thought Exchange</title>
	<link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="./css/mystyle.css" rel="stylesheet" type="text/css" media="all">
	<link href="./css/style.css" rel="stylesheet" type="text/css" media="all">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="header-top">
				<div class="logo">
					<h1><a href="index.php">Thought Exchange</a></h1>
				</div>
				<?php
				if(isset($_SESSION['id']) || isset($_COOKIE['id']))
				{
					?>
					<div class="phone">
						<ul class="nav navbar-nav ">
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="phone">
						<ul class="nav navbar-nav ">
							<li><a href="process/login.php">Login</a></li>
						</ul>
					</div>
					<?php	
				}

				?>
			</div>
			<div class="header-bottom">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav ">
								<li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
								<li><a href="users.php">Users</a></li>
								<li><a href="questions.php">questions</a></li>
								<li><a href="tags.php">Tags</a></li>
								<?php
								if(isset($_SESSION['id']) || isset($_COOKIE['id']))
								{
									?>
									<li><a href="ask.php">Ask Question</a></li>
									<?php
								}
								else
								{
									?>
									<li><a href="process/login.php">Ask Question</a></li>
									<?php
								}
								?>
								
								<li><a href="contact.php">search</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<div id="leftpanel">
		<div class="left_titile">
			<h3>Top Tags</h3>
		</div>
		<ul class="nav">
		<?php
			$sql = "SELECT * FROM tag ORDER BY value DESC limit 7";
			$result = mysql_query($sql);
			while($row=mysql_fetch_array($result))
			{
				$tagname=$row['tag_name'];
		?>
		<li><a href="tag.php?uid=<?php echo $tagname ?>"><?php echo $tagname ?></a></li>
		<?php
		
			}
		?>
		</ul>
	</div>
	<div id="section">
		<?php
		$num=1;
		$sql = "SELECT * FROM user";
		$result = mysql_query($sql);
		while (  $num <= 3) {
			?>
			<!--gallery-->
			<div class="content">
				<div class="gallery-section">
					<div class="galary-grid">
						<?php
						
						while ($rows = mysql_fetch_array($result )) {
							$imagename=$rows['img_name'];
							$username2=$rows['username'];
							$userid=$rows['user_id'];
							?>
								<div class="col-md-4 gallery-grid">
									<div class="gallery">
										<a class="mask" href="profile.php?uid=<?php echo $userid ?>"><img src="<?php echo $imagename; ?>" class="img-responsive zoom-img" alt="/" title="image-name"></a>
										<a href="profile.php?uid=<?php echo $userid ?>"><?php echo $username2 ?></a>
									</div>	

								</div>
							<?php
							
						}
						?>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<?php
			$num=$num+1;
		}
		?>
	</div>
</div>
	<div id="rightpanel">
		<?php
		if(isset($_SESSION['id']))
		{
			?>
			<div class="status-grid_pic">
				<img src="<?php echo $_SESSION['pro']; ?>"alt="Smiley face" height="200" width="200">	
				<h4><a href="profile.php?uid=<?php echo $_SESSION['id'] ?>"><?php echo $_SESSION['name'] ?></a><h4>
				</div>

				<?php 
		}
		else if(isset($_COOKIE['id']))
		{
			?>
				<div class="status-grid_pic">
				<img src="<?php echo $_COOKIE['pro']; ?>"alt="Smiley face" height="200" width="200">	
				<h4><a href="profile.php?uid=<?php echo $_COOKIE['id'] ?>"><?php echo $_COOKIE['name'] ?></a><h4>
				</div>
	<?php
		}
			?>
		</div>
</body>
</html>