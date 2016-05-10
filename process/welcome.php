<?php session_start(); ?>
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
                    <li><a href="../index.html" title="Home">Home</a></li>
                    <li><a href="#" title="Projects">Projects</a></li>
                    <li><a href="../assign/index.html" title="Assignments">Assignments</a></li>
                    <li><a href="#" title="Contact">Contact</a></li>
                    <li><a href="login.html" title="Login">Login</a></li>
                </ul>
            </nav>
        </div>
        <br />
        <div style="margin-left: 20%;">
            <h1>Welcome</h1>
            <p>Name: <b><?php echo $_SESSION["name"] ?></b></p>
            <p>email: <b><?php echo $_SESSION["email"] ?></b></p>
            <p>Ward: <b><?php echo $_SESSION["ward"] ?></b></p>
        </div>
    </div>
</body>
</html>

