<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
		header('Location: ../../index.php');
	}
   include_once('../../helperFunctions.php');


	include_once('../database.php');
   include_once('../password.php');
   $db = dbConnect();
	$id = $_GET['id'];
	$query = "SELECT * FROM meeting WHERE id=:id";
	$stmt = $db->prepare($query);
	$stmt->bindValue(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
	$meeting = $stmt->fetch(PDO::FETCH_ASSOC);

	$id = $meeting['meeting_prayer'];
	$query = "SELECT * FROM member WHERE id=:id";
	$stmt = $db->prepare($query);
	$stmt->bindValue(":id", $id, PDO::PARAM_INT);
	$stmt->execute();
	$name = $stmt->fetch(PDO::FETCH_ASSOC);
	$prayer = $name['first_name']. " " . $name['last_name'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Meeting</title>
    <?php writeHead('../../'); ?>
    <link rel="stylesheet" href="meeting.css" type="text/css" />
</head>
<body>
   <?php writeNav("../../", ""); ?>
   <div class="body">
      <!-- beggining of meeting table -->
      <div class="container">
         <div class="jumbotron head-title">
            <h2 class="text-center"> <?php echo $_SESSION["ward_name"]; ?> - Bishopric Agenda</2>
         </div>
      </div>
      <div class="container">
         <form class="form-horizontal" method="post">
            <div class="jumbotron head-title">
               <div class="row">
                  <div class="col-md-8">
                     <div class="form-group ">
                        <div class="col-md-8">
                           <div class="form-group ">
                              <div class="row">
                                 <label class="control-label col-md-3" for="prayer">Prayer</label>
                                 <div class="col-md-9">
                                    <input class="form-control" type="text" name="prayer" value="<?php echo $prayer; ?>"/>
                                 </div>
                              </div>
                              <div class="row">
                                 <label class="control-label col-md-3" for="handbook">Handbook</label>
                                 <div class="col-md-9">
                                    <input class="form-control" type="text" name="handbook" value=""/>
                                 </div>
                              </div>
                              <div class="row">
                                 <label class="control-label col-md-3" for="sacPrayer">Sac Prayer</label>
                                 <div class="col-md-9">
                                    <input class="form-control" type="text" name="sacPrayer" value=""/>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <label class="">Date</label>
                  </div>
               </div>
            </div>
            <!-- second part-->
            <div class="jumbotron head-title">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label class="control-label col-md-2" for="calendar">Calendar</label>
                        <div class="col-md-10">
                           <textarea class="form-control" cols="40" id="calendar" name="calendar" rows="10"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label class="control-label col-md-2" for="notes">Notes</label>
                        <div class="col-md-10">
                           <textarea class="form-control" cols="40" id="notes" name="notes" rows="10"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="jumbotron head-title">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label class="control-label col-md-2" for="callings">Callings</label>
                        <div class="col-md-10">
                           <textarea class="form-control" cols="40" id="callings" name="callings" rows="10"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                           <button class="btn btn-primary pull-right" name="submit" type="submit">
                             Save
                           </button>
                        </div>
                    </div>
                 </div>
               </div>
            </div>
         </form>
      </div>
      <!-- End of meeting table -->
    </div>
   <!-- end of the body -->
   <?php writeFooter(); ?>

</body>
</html>
