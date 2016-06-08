<?php
   function selectStarFrom($db, $table)
   {
      $query = "";
      if ($table == "meeting")
         $query = "SELECT * FROM meeting";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $results;
   }

   function selectFromMeeting($db, $id, $column)
   {
      $query = "";
      $stmt = "";
      $result = "";
      if ($column == "id")
      {
         $query = "SELECT * FROM meeting WHERE id=:id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      if ($column == "ward_id")
      {
         $query = "SELECT * FROM meeting WHERE ward_id=:ward_id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":ward_id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      return $result;
   }

   function selectFromNote($db, $id, $column)
   {
      $query = "";
      $stmt = "";
      $result = "";
      if ($column == "id")
      {
         $query = "SELECT * FROM note WHERE id=:id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      if ($column == "meeting_id")
      {
         $query = "SELECT * FROM note WHERE meeting_id=:meeting_id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":meeting_id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
      }

      return $result;
   }

   function selectFromMember($db, $id, $column)
   {
      $query = "";
      $stmt = "";
      $result = "";
      if ($column == "id")
      {
         $query = "SELECT * FROM member WHERE id=:id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      if ($column == "ward_id")
      {
         $query = "SELECT * FROM member WHERE ward_id=:ward_id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":ward_id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
      }
      return $result;
   }

   function selectFromActivity($db, $id, $column)
   {
      $query = "";
      $stmt = "";
      $result = "";
      if ($column == "id")
      {
         $query = "SELECT * FROM activity WHERE id=:id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
      }
      if ($column == "meeting_id")
      {
         $query = "SELECT * FROM activity WHERE meeting_id=:meeting_id";
         $stmt = $db->prepare($query);
         $stmt->bindValue(":meeting_id", $id, PDO::PARAM_INT);
         $stmt->execute();
         $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
      }
      return $result;
   }
?>
