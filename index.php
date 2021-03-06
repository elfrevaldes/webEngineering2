<?php
   session_start();
   if (isset($_SESSION["email"]))
   	header('Location: process/welcome.php');
   // the connection
   // we need the access to the db but only one time
   include_once('process/database.php');
   include_once('process/password.php');
   $db = dbConnect();

   include_once('helperFunctions.php');

	if(isset($_POST['loginBtn']))
	{
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
           if (password_verify($pass, $user[2]))
	        //if ($pass == $user[2])
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
      }
     catch(Exception $ex)
     {
        echo 'Error while loging in.';
     }
   }

    if (isset($_POST['signupBtn']))
    {
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
            $_SESSION['name'] = sanitizeInput($_POST["name"]);
            $_SESSION['last'] = sanitizeInput($_POST["last"]);
            $_SESSION['display_name'] = sanitizeInput($_POST["name"]) .' '. sanitizeInput($_POST["last"]);
            $_SESSION['email'] = sanitizeInput($_POST["semail"]);
            $_SESSION['pass'] = password_hash(sanitizeInput($_POST["spassword"]), PASSWORD_DEFAULT);
            $_SESSION['ward_name'] = sanitizeInput($_POST["ward"]);

				header("Location: process/process.php");
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
    <title>Bishopric Planner</title>
    <?php writeHead(); ?>
    <link rel="stylesheet" href="css/login.css" type="text/css" />
    <script src="js/login.js"></script>
</head>
<body>
	<img id="hfsbg" src="https://c7.staticflickr.com/9/8239/8543660542_bc565a3ae4_k.jpg" width="1980" height="1360" />
    <?php writeNav("", "Home"); ?>
    <div class="body">
        <div id="tabs">
            <ul>
                <li><span id="loginLink" class="active link" onclick="openTab('login-tab');">Login</span></li>
                <li><span id="signupLink" class="inactive link" onclick="openTab('signup-tab');">Sign up</span></li>
            </ul>
            <div id="login-tab">
							<label id='loginLbl'></label>
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
                <form action="" method="POST" onsubmit="return (fullValidation('signup'));">
                    <p><input id="name" name="name" type="text" placeholder="Name" onchange="isValidName('#signupLbl', '#name');" /><b>*</b></p>
										<p><input id="last" name="last" type="text" placeholder="Last Name" onchange="isValidName('#signupLbl', '#last');" /><b>*</b></p>
                    <p><input id="semail" name="semail" type="text" placeholder="Email" onchange="isEmailValid('#signupLbl', '#semail');" /><b>*</b></p>
                    <p><input id="ward" name="ward" type="text" placeholder="Add new Ward" onchange="isValidWard();" style="display: none;"/>
										<select id="ward_name" onchange="addNewWard();">
											<option value='blank' disabled="true" selected>Select your ward</option>
											<?php
											try{
												$query = 'SELECT * FROM ward';
											   $stmt = $db->prepare($query);
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
    <?php writeFooter(); ?>
</body>
</html>
