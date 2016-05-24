<?php
	session_start();
	if(isset($_SESSION["email"]))
		header('Location: process/welcome.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Elfre Valdes</title>
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
        <img id="hfsbg" src="https://c7.staticflickr.com/9/8239/8543660542_bc565a3ae4_k.jpg" width="1980" height="1360" />
        <div id="tabs">	
            <ul>
                <li><span id="loginLink" class="active link" onclick="openTab('login-tab');">Login</span></li>
                <li><span id="signupLink" class="inactive link" onclick="openTab('signup-tab');">Sign up</span></li>
            </ul>
            <div id="login-tab">
                <label id="loginLbl"></label>
				<label>Please use: test</label>
                <form action="process/process.php" method="post" onsubmit="return fullValidation('login');">
                    <p>
                        <input id="email" name="email" type="text" placeholder="Email" onchange="isEmailValid('#loginLbl', '#email');" value="elfre@gmail.com"/><b>*</b>
                    </p>
					<label>Please use: test</label>
                    <p>
                        <input id="password" name="password" type="password" placeholder="Password" onchange="isPassValid('#loginLbl', '#password');" value="pass1234"/><b>*</b>
                    </p>
                    <p><input id="loginBtn" type="submit" value="Login" /></p>
                </form>
            </div>
            <div id="signup-tab">
                <label id="signupLbl"></label>
                <form action="process/signup.php" method="post" onsubmit="return (fullValidation('signup'));">
                    <p><input id="name" name="name" type="text" placeholder="Name" /><b>*</b></p>
                    <p><input id="semail" name="semail" type="text" placeholder="Email" onchange="isEmailValid('#signupLbl', '#semail');" /><b>*</b></p>
                    <p><input id="ward" name="ward" type="text" placeholder="Ward Name" /></p>
                    <p>
                        <input id="spassword" name="spassword" type="password" placeholder="Password" onchange="isPassValid('#signupLbl', '#spassword');" />
                        <input id="srpassword" name="srpassword" type="password" placeholder="Repeat Password" onchange="isPassValid('#signupLbl', '#srpassword');" /> <b>*</b>
                        <input name="action" type="hidden" value="signup" />
                    </p>
                    <p><input id="signupBtn" name="signup" type="submit" value="Sign up" /></p>
                </form>
            </div>
        </div>
    </div>
    <!-- end of the body -->
    <div class="clearfooter"></div>
    <div id="footer"><h3>There will be something here in future updates</h3></div>
</body>
</html>
