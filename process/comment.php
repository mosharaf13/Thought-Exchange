<?php
include "database.php";
session_start();
if(isset($_SESSION['link'])){
	$status_id=$_SESSION['link'];
}
else{
	$_SESSION['link']=$_GET['stid'];
	$status_id=$_SESSION['link'];
}
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Thought Exchange</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<link href="../css/mystyle.css" rel="stylesheet" type="text/css" media="all">
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
	<script type="text/javascript" src="../css/jquery.js"></script>
	<link href="file://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="https://www.google.com/fonts#UsePlace:use/Collection:Playfair+Display">
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="header-top">
				<div class="logo">
					<h1><a href="../index.php">Thought Exchange</a></h1>
				</div>
				<?php
				if(isset($_SESSION['id']) || isset($_COOKIE['id']))
				{
					?>
					<div class="phone">
						<ul class="nav navbar-nav ">
							<li><a href="../logout.php">Logout</a></li>
						</ul>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="phone">
						<ul class="nav navbar-nav ">
							<li><a href="login.php">Login</a></li>
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
								<li class="active"><a href="../index.php">Home<span class="sr-only">(current)</span></a></li>
								<li><a href="../users.php">Users</a></li>
								<li><a href="../questions.php">questions</a></li>
								<li><a href="../tags.php">Tags</a></li>
								<li><a href="../ask.php">Ask Question</a></li>
								<li><a href="../contact.php">search</a></li>
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
		<li><a href="../tag.php?uid=<?php echo $tagname ?>"><?php echo $tagname ?></a></li>
		<?php
		
			}
		?>
		</ul>
	</div>
	<div id="section">
		<?php
		$sql = "SELECT * FROM status WHERE status_id = '$status_id'";
		$result = mysql_query($sql);
		$rows = mysql_fetch_array($result);    
		$status=base64_decode($rows['status']);
		$status_header=$rows['status_header'];
		$vote_number=$row['votes'];

		if (!isset($_SESSION['recent_posts'][$status_id]) && !isset($_COOKIE['recent_posts'][$status_id])) {
			$sql2="UPDATE status SET views=views+ 1 WHERE status_id=$status_id";
			mysql_query($sql2);
			$_SESSION['recent_posts'][$status_id] = 1;
			$_COOKIE['recent_posts'][$status_id] =1;
		}


		?>
		<div class="status_header2"><h3><a href="comment.php"><?php echo nl2br($status_header) ?></a></h3></div>
		<div class="status2"><h5><?php echo nl2br($status) ?></h5></div>
		<?php
		if(isset($_SESSION['id']) || isset($_COOKIE['id']))
		{
			?>
			<div class="like">
				<a href="#" id="<?php echo $status_id ?>" class="like_btn">Upvoat</a>

				<a href="#" id="<?php echo $status_id ?>" class="like_btn2">Downvoat</a>
			</div>
			


			<script type="text/javascript">
			$(".like_btn").click(function(e){
				e.preventDefault();

				var obj = $(this);

				var id = $(this).attr('id');

				$.get("http://localhost/project/like.php?id=" + id, function(res){
					var response = JSON.parse(res);
					if(response['status'] == 'error'){
						alert(response['msg']);
					}
					obj.text("upvoted");
				});

			});
			</script>
			<script type="text/javascript">
			$(".like_btn2").click(function(e){
				e.preventDefault();

				var obj = $(this);

				var id = $(this).attr('id');

				$.get("http://localhost/project/dislike.php?id=" + id, function(res){
					var response = JSON.parse(res);
					if(response['status'] == 'error'){
						alert(response['msg']);
					}
					obj.text("downvoted");
				});

			});
			</script>
			<?php
		}
		?>
		<?php
		$sql2 = "SELECT * FROM comment WHERE comment_id = '$status_id' ORDER BY id DESC limit 10";
		$res2=mysql_query($sql2);
		while($row2=mysql_fetch_array($res2))
		{
			$comment=base64_decode($row2['comment']);
			$userid2=$row2['user_id'];		
			?>
			<?php

			$sqlimage = "SELECT * FROM user WHERE user_id = '$userid2'";
			$result = mysql_query($sqlimage);
			$rows = mysql_fetch_array($result);       
			$imagename=$rows['img_name'];
			$username2=$rows['username'];
			?>
			<div class="fullcomment">
				<div class="online">
					<div class="comment_image"><img src="<?php echo $imagename; ?>"alt="profile picture" height="40" width="40"></div>
					<div class="comment_name"><h5><a href="profile/index.php"><?php echo $username2 ?></a></h5></div>
				</div>
				<div class="maincomment">
					<p><?php echo nl2br($comment) ?></p>
				</div>
			</div>

			<?php
		}
		if(isset($_SESSION['id']) || isset($_COOKIE['id']))
		{
			?>
			<div class="forcomment">
				<form action="comment_process.php"  method="post">
					<textarea name="comment" cols="80" rows="10"></textarea>
					<input type="hidden" value="<?php echo $status_id ?>" name="status_id">
					<div style="margin-left:30px">
						<input type="submit" class="btn btn-primary" value="comment">
					</div>

				</form>
			</div>

			<?php
		}
		?>
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