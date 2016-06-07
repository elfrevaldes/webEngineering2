<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
		header('Location: ../index.php');
	}
	include_once('../helperFunctions.php');

	include_once('database.php');
   include_once('password.php');
   $db = dbConnect();
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
				 $ward_id = $_SESSION["ward_id"];
				 $query = "SELECT id, date FROM meeting WHERE ward_id=:ward_id";
				 $statement = $db->prepare($query);
				 $statement->bindValue(':ward_id', $ward_id, PDO::PARAM_INT);
				 $result = $statement->execute();
				// // requesting the user
				 if ($result)
				 {
				 	$meetings = $statement->fetchAll(PDO::FETCH_ASSOC);
				//
			    	foreach ($meetings as $meeting) {
			       $id = $meeting['id'];
			       $date = $meeting['date'];
			       //echo "<li><a href='meeting.php?id=$id'> $date</a></li>";
					 echo "<li><a href='meeting/meeting.php'> Date $date </a></li>"; //meeting.php?id=1
					}
				 }
		   ?>
		  </ul>
		  <form action="#" method="POST">
				<input class="btn btn-info" type="submit" value="Add Movie"></input>
		  </form>
		  </div>
    </div>
	 <?php writeFooter() ?>
</body>
</html>
