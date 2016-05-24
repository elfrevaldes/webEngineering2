<?php
  require('database.php');
  session_start();

  // cheacking that they actually complete the signup part
  if (!isset($_POST['email']) || !isset($_POST["password"])) {
		  header('Location: ../index.php'); // send them back
	}
  
  // security              
  $passSpeChar = htmlspecialchars($_POST["password"]);
  $passSqlInje = strip_tags($passSpeChar);
    
    echo "email is : " . $_POST["email"];
    echo "<br/>";
  $emailSpeChar = htmlspecialchars($_POST["email"]);
  $emailSqlInje = htmlspecialchars($emailSpeChar);
    
    echo "sqlinject is : " . $emailSqlInje;
    echo "<br/>";


  try {
      $db = dbConnect();
      
      $query = 'SELECT * FROM user WHERE email = :email';
      
      $statement = $db->prepare($query);
		  $statement->bindValue(':email', $emailSqlInje, PDO::PARAM_STR);
		  $result = $statement->execute();
      echo "results:  " . $result;
      echo "<br/>";
      if ($result)
		  {
        $user = $statement->fetch();
        
        echo "caca". $user;
        echo "<br/>";
      }
      else
        echo "Nop sorry";
      
      //$_SESSION["displayName"] = "Elfre Valdes";
      //$_SESSION["email"] = "elfre@gmail.com";
      //$_SESSION["ward"] = "myWard"; 
      
      //$statement = mysqli_prepare($db, 'SELECT * FROM secretvo_sv WHERE email = ?');
      //mysqli_stmt_bind_param($statement, "s", $email);
      //mysqli_stmt_execute($statement);  
      //mysqli_stmt_store_result($statement);
      //mysqli_stmt_bind_result($statement,$id, $firstName, $lastName, $displayName, $email, $password, $wardId);
      //$profile = array();
      
      //while (mysqli_stmt_fetch($statement)) {
      //  $profile["id"] = $id;
      //  $profile["firstName"] = $firstName;
      //  $profile["lastName"] = $lastName;
      //  $profile["displayName"] = $displayName;
      //  $profile["email"] = $email;
      //  $profile["password"] = $password;
      //  $profile["wardId"] = $wardId;
     //}
     //$_SESSION["displayName"] = $profile["displayName"];
     //$_SESSION["email"] = "";
     //$_SESSION["ward"] = ""; 
   }
   catch(Exception $ex)
   {
      echo 'Could not login.';
   }    
  //header('Location: welcome.php');
?>