<?php
  session_start();
  // cheacking that they actually complete the signup part
  if (!isset($_POST['name']) || !$_POST["spassword ) {
		  Header('Location: index.php'); // send them back
	}
  // security              
  $nameSpeChar = htmlspecialchars($_POST["name"]);
  $nameSqlInje = strip_tags($nameSpeChar);
    
  $passSpeChar = htmlspecialchars($_POST["spassword"]);
  $passSqlInje = strip_tags($passSpeChar);
    
  $emailSpeChar = htmlspecialchars($_POST["email"]);
  $emailSqlInje = htmlspecialchars($emailSpeChar);
    
  $wardSpeChar = htmlspecialchars($_POST["ward"]);
  $wardSqlInje = htmlspecialchars($wardSpeChar);
    
  $_SESSION["name"] = $nameSqlInje;
  $_SESSION["password"] = $passSqlInje;
  $_SESSION["email"] = $emailSqlInje;
  $_SESSION["ward"] = $wardSqlInje;

    
  header('Location: welcome.php');
?>