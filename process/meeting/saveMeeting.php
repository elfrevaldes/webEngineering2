<?php
   session_start();
   if(!isset($_SESSION["email"]))
   {
      header('Location: ../index.php');
   }
   echo "SORRY! I really want to save your new data but <br />I run out of time for this project and even though I did my best I can't get this part working today <br /> See you next time!";
?>
