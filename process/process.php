<?php
  session_start();
  // cheacking that they actually complete the signup part
  if (!isset($_SESSION["email"])){
		  header('Location: ../index.php'); // send them back
    }

   require('database.php');
   $db = dbConnect();
   // finding the ward
   $query = 'SELECT id FROM ward WHERE name = :name';
   $statement = $db->prepare($query);
   $statement->bindValue(':name', $_SESSION['ward_name'], PDO::PARAM_STR);
   $result = $statement->execute();
   $result = $statement->fetch();

   // adding a new ward
   if($result[0] == "")
   {
      $query = "INSERT INTO ward(id, name) VALUES (NULL, :name)";
      $stmt = $db->prepare($query);
      $stmt->bindValue(':name', $_SESSION['ward_name'], PDO::PARAM_STR);
      $stmt->execute();
      // getting the id
      $_SESSION['ward_id'] = $db->lastInsertId();
   }
   else
    $_SESSION["ward_id"] = $result[0];

   $query = "INSERT INTO user(id, first_name, last_name, display_name, email, pass, ward_id) VALUES (NULL, :name, :last, :display, :email, :pass, :ward_id)";

   $stmt = $db->prepare($query);
   $stmt->bindValue(':name', $_SESSION['name'], PDO::PARAM_STR);
   $stmt->bindValue(':last', $_SESSION['last'], PDO::PARAM_STR);
   $stmt->bindValue(':display', $_SESSION['display_name'], PDO::PARAM_STR);
   $stmt->bindValue(':email', $_SESSION['email'], PDO::PARAM_STR);
   $stmt->bindValue(':pass', $_SESSION['pass'], PDO::PARAM_STR);
   $stmt->bindValue(':ward_id', $_SESSION['ward_id'], PDO::PARAM_INT);
   $stmt->execute();
   $_SESSION["id"] = $db->lastInsertId();
   header("Location: welcome.php");
 ?>
