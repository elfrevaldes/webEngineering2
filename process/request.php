<?php
session_start();
var_dump($_POST);

$_SESSION["name"] = htmlspecialchars($_POST["name"]);
$_SESSION["password"] = $_POST["spassword"];
$_SESSION["email"] = $_POST["semail"];
$_SESSION["ward"] = $_POST["ward"];

$name = 'name: '.$_SESSION["name"].PHP_EOL;
$password = 'pass: '.$_SESSION["password"].PHP_EOL;
$email = 'email: '.$_SESSION["email"].PHP_EOL;
$ward = $_SESSION["ward"];

if($ward == "")
{
 $ward = 'ward: *'.PHP_EOL.PHP_EOL; // no ward name
}
else
{
  $ward = 'ward: '.$ward.PHP_EOL.PHP_EOL;
}

$fp = fopen('db.txt', 'a');
fwrite($fp, $name);
fwrite($fp, $password);
fwrite($fp, $email);
fwrite($fp, $ward);

#header('Location: welcome.html');
?>