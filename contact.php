<?php
include "process/database.php";
session_start();
unset($_SESSION['link']);
?>
<!DOCTYPE html>

<html>
<head>
<script>
  function showHint(str) {
    if (str.length == 0) { 
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET", "search.php?q=" + str, true);
      xmlhttp.send();
    }
  }
  </script>
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
								
								<li><a href="#">search</a></li>
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
		<div class="search">
			<form action="search_process.php"  method="post">
				<textarea name="search" cols="70" rows="1" onkeyup="showHint(this.value)" required></textarea>
				<input type="submit"  class="btn btn-primary" value="Search">
			</form>
		</div>
		<div class="hint">
			<span id="txtHint" ></span>
		</div>
		
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