<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
		header('Location: ../index.php');
	}
	include_once('../helperFunctions.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome <?php echo $_SESSION["display_name"]; ?></title>
	  <?php writeHead('../'); ?>
</head>
<body>
	<?php writeNav("../", "Home"); ?>
    <div class="body">
        <img id="hfsbg" src="https://c2.staticflickr.com/9/8524/8552518841_44e823d100_k.jpg" width="3492" height="2100" />
        <div style="margin-left: 20%;">
            <h1>Welcome</h1>
            <p>Name: <b><?php echo $_SESSION["display_name"]; ?></b></p>
            <p>email: <b><?php echo $_SESSION["email"]; ?></b></p>
            <p>Ward: <b><?php echo $_SESSION["ward_name"]; ?></b></p>
        </div>
			<div style="margin-top: 20px; margin-left: 20%; max-width: 500px;">
		    <ul>
		    <?php
		    //foreach ($movies as $movie) {
		    //  $title = $movie['title'];
		    //  $year = $movie['year'];
		    //  $id = $movie['id'];
		      //echo "<li><a href='meeting.php?id=$id'> $title, ($year)</a></li>";
					echo "<li><a href='meeting/meeting.php'> Name   Date 05/31/2016 </a></li>"; //meeting.php?id=1

		    ?>
		  </ul>
		  <form action="addmovie.php" method="POST" style="margin-top: 10px;">
		    <!-- <input type="submit" value="New Meeting"/> -->
		  </form>
		  </div>
    </div>
	 <?php writeFooter() ?>
</body>
</html>
