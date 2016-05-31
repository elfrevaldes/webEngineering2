<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
		header('Location: ../index.php');
	}
	//	print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/basic.js"></script>

    <link rel="stylesheet" href="../css/basic.css" type="text/css" />
    <link rel="stylesheet" href="../css/login.css" type="text/css" />
    <link rel="stylesheet" href="../css/mobile.css" type="text/css" media="screen and (max-width:600px)" />
    <link rel="stylesheet" href="../css/desktop.css" type="text/css" media="screen and (min-width: 600px)" />
</head>
<body>
    <div id="body">
        <img id="hfsbg" src="https://c2.staticflickr.com/9/8524/8552518841_44e823d100_k.jpg" width="3492" height="2100" />
        <div id="header">
            <span class="icoMenu"></span>
            <nav class="mainNav">
                <ul>
                    <li><a href="../index.php" title="Home">Home</a></li>
                    <li><a href="#" title="Projects">Projects</a></li>
                    <li><a href="../assign/index.html" title="Assignments">Assignments</a></li>
                    <li><a href="#" title="Contact">Contact</a></li>
					<li><a href="../logout.php" title="Login out">Logout</a></li>
                </ul>
            </nav>
        </div>
        <br />
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
						echo "<li><a href='#'> Name   Date 05/31/2016 </a></li>"; //meeting.php?id=1

			    ?>
			  </ul>
			  <form action="addmovie.php" method="POST" style="margin-top: 10px;">
			    <input type="submit" value="New Meeting"/>
			  </form>
			  </div>
    </div>
</body>
</html>
