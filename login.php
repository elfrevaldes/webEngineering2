<?php
	session_start();
	 if (isset($_SESSION["email"]))
		header('Location: process/welcome.php');
	// the connection
	// we need the access to the db but only one time
	include_once('process/database.php');
	$db = dbConnect();

	//if(isset($userExist))
	//	unset($_POST);

	if(isset($_POST['loginBtn']))
	{
		  include_once('process/settings.php');
		  // security
		  $email = sanitizeInput($_POST['email']);
		  $pass = sanitizeInput($_POST['password']);
		  // checking if the user privided exist
			try
			{
					$query = 'SELECT id, display_name, pass, email, ward_id FROM user WHERE email=:email';
		      $statement = $db->prepare($query);
					$statement->bindValue(':email', $email, PDO::PARAM_STR);
		      $result = $statement->execute();
					// requesting the user
					$user = $statement->fetch();
		      if ($user)
		      {
						// checking that password match
		        if ($pass == $user[2])
		        {
							$_SESSION["id"] = $user[0];
		          $_SESSION["display_name"] = $user[1];
		          $_SESSION["email"] = $user[3];
		          $_SESSION["ward_id"] = $user[4];


		          // finding the ward name
		          $que = 'SELECT name FROM ward WHERE id = :id';
		          $sta = $db->prepare($que);
		          $sta->bindValue(':id', $user[4], PDO::PARAM_INT);
		          $ward = $sta->execute();
		          $wardName = $sta->fetch();

		          $_SESSION["ward_name"] = $wardName[0];

		          header("Location: process/welcome.php");
		      	}
					}
					//else{
						// I dont know how to handle this part

					//}
		      // I need to count the amount of times the user tries to access
		    //} // there is no such user.
		    //else
		    //{
		      // setting the the post variable on to display error message
		      //$_SESSION['pass_failed'] = "yes";
					// user enter wrong password
		    //}
	   }
	   catch(Exception $ex)
	   {
	      echo 'Error while loging in.';
	   }
 }

 //if(isset($_POST['signup']))
 if (isset($_POST['signupBtn']))
 {
		 echo "<br /> HERE";
		 	 //echo "<br />sending info: $_POST['semail']";
			 include_once('process/settings.php');
			 // security
			 $semail = sanitizeInput($_POST['semail']);
			 try
			 {
				 $query = 'SELECT * FROM user WHERE email=:email';
				 $statement = $db->prepare($query);
				 $statement->bindValue(':email', $semail, PDO::PARAM_STR);
				 $result = $statement->execute();
				 $result = $statement->fetch();

				 if (!$result)
				 {
					//$_SESSION['name'] = sanitizeInput($_POST["name"]);
				  //$_SESSION['last'] = sanitizeInput($_POST["last"]);
					$_SESSION['display_name'] = sanitizeInput($_POST["name"]) .' '. sanitizeInput($_POST["last"]);
				  $_SESSION['email'] = sanitizeInput($_POST["semail"]);
					$_SESSION['pass'] = sanitizeInput($_POST["spassword"]);
				  $_SESSION['ward_name'] = sanitizeInput($_POST["ward"]);

					header("Location: process/process.php");
				 }
				 // I need to count the amount of times the user tries to access
				 // there is no such user.
				 else
				 {
					 echo "<br />User " . $semail . " already in use";
					// echo "<br />email found $email";
					 // setting the the post variable on to display error message
					 // $_SESSION["user_already"] = $email;
					 //$userExist = "test@";
				 }
		}
		catch(Exception $ex)
		{
			 echo 'Error while loging in.';
		}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Bishopric Planner</title>
    <link rel="shortcut icon" href="img/ico.ico" />

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/basic.js"></script>
    <script src="js/login.js"></script>

    <link rel="stylesheet" href="css/basic.css" type="text/css" />
    <link rel="stylesheet" href="css/login.css" type="text/css" />
    <link rel="stylesheet" href="css/mobile.css" type="text/css" media="screen and (max-width:600px)" />
    <link rel="stylesheet" href="css/desktop.css" type="text/css" media="screen and (min-width: 600px)" />
</head>
<body>
	<img id="hfsbg" src="https://c7.staticflickr.com/9/8239/8543660542_bc565a3ae4_k.jpg" width="1980" height="1360" />
    <div id="header">
        <span class="icoMenu"></span>
        <nav class="mainNav">
            <ul>
                <li><a href="#" title="Projects">Projects</a></li>
                <li><a href="assign/index.html" title="Assignments">Assignments</a></li>
                <li><a href="#" title="Contact">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div id="body">
        <div id="tabs">
            <ul>
                <li><span id="loginLink" class="active link" onclick="openTab('login-tab');">Login</span></li>
                <li><span id="signupLink" class="inactive link" onclick="openTab('signup-tab');">Sign up</span></li>
            </ul>
            <div id="login-tab">
							<label id='loginLbl'>
							</label>
									<?php
										//echo "<label id='loginLbl'>";
										//if(isset($_SESSION['pass_failed'])){ echo "Wrong password or user email";}
										//echo "</label>";
											 ?>
                <form action="" method="POST" onsubmit="return fullValidation('login');">
                    <p>
                        <input id="email" name="email" type="text" placeholder="Email" onchange="isEmailValid('#loginLbl', '#email');" /><b>*</b>
                    </p>
                    <p>
                        <input id="password" name="password" type="password" placeholder="Password" onchange="isPassValid('#loginLbl', '#password');" /><b>*</b>
                    </p>
                    <p><input id="loginBtn" name="loginBtn" type="submit" value="Login" /></p>
                </form>
            </div>
            <div id="signup-tab">
							<label id='signupLbl'>
							</label>
                	<?php //if(isset($_SESSION["user_already"]))
									// echo "<label id='signupLbl'>";
									// if (isset($userExist))
									// {
									// 	//$e = $_SESSION['user_already'];
									// 	echo "Email $userExist already used";
									// }
									// echo "</label>";
									?>

                <form action="" method="POST" onsubmit="return (fullValidation('signup'));">
                    <p><input id="name" name="name" type="text" placeholder="Name" onchange="isValidName('#signupLbl', '#name');" /><b>*</b></p>
										<p><input id="last" name="last" type="text" placeholder="Last Name" onchange="isValidName('#signupLbl', '#last');" /><b>*</b></p>
                    <p><input id="semail" name="semail" type="text" placeholder="Email" onchange="isEmailValid('#signupLbl', '#semail');" /><b>*</b></p>
                    <p><input id="ward" name="ward" type="text" placeholder="Add new Ward" onchange="isValidWard();" style="display: none;"/>
										<select id="ward_name" onchange="addNewWard();">
											<option value='blank' disabled="true" selected></option>
											<?php
											try{
												$query = 'SELECT * FROM ward';
											  $stmt = $db->prepare($query);
											  //$stmt->bindValue(':id', $id, PDO::PARAM_INT);
											  //$stmt->bindValue(':name', $name, PDO::PARAM_STR);
											  $stmt->execute();
											  $wards = $stmt->fetchAll(PDO::FETCH_ASSOC); // key value pairs

												foreach ($wards as $ward) {
														$name = $ward['name'];
										      	$id = $ward['id'];
														echo "<option value='$id'>$name</option>";
													}
												echo "<option value='newWard'>Add New Ward</option>";
											}
											catch(Exception $ex)
											{
												 echo 'Error while requesting wards.';
											}
											?>
										</select><b>*</b>
										</p>
                    <p>
                        <input id="spassword" name="spassword" type="password" placeholder="Password" onchange="isPassValid('#signupLbl', '#spassword');" />
                        <input id="srpassword" name="srpassword" type="password" placeholder="Repeat Password" onchange="isPassValid('#signupLbl', '#srpassword');" /> <b>*</b>
                    </p>
                    <p><input id="signupBtn" name="signupBtn" type="submit" value="Sign up" /></p>
                </form>
            </div>
        </div>
    </div>
    <!-- end of the body -->
    <div class="clearfooter"></div>
    <div id="footer"><h3>There will be something here in future updates</h3></div>
</body>
</html>
