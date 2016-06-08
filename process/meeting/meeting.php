<?php
	session_start();
	if(!isset($_SESSION["email"]))
	{
		header('Location: ../../index.php');
	}
   include_once('../../helperFunctions.php');
	include_once('../database.php');
	include_once('../queries.php');

   $db = dbConnect();

 	$id = $_GET['id'];
	$meeting = selectFromMeeting($db, $id, "id");
	$wardMembers = selectFromMember($db, $meeting['ward_id'], 'ward_id');

	$date = date_create($meeting['date']);
	$date = date_format($date,"m/d/Y");

	$notes = selectFromNote($db, $meeting['id'], 'meeting_id');

	$activities = selectFromActivity($db, $meeting['id'], "meeting_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meeting</title>
    <?php writeHead('../../'); ?>
    <link rel="stylesheet" href="meeting.css" type="text/css" />
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
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
         <form action="saveMeeting.php" method="post" class="form-horizontal" method="post">
            <div class="jumbotron head-title">
               <div class="row">
                  <div class="col-md-7">
                     <div class="form-group ">
                        <div class="col-md-12">
                           <div class="form-group ">
                              <div class="row">
                                 <label class="control-label col-md-3" for="prayer">Meeting Prayer</label>
                                 <div class="col-md-6">
												<select id="prayer" name="prayer" class="form-control">
													<?php
														foreach ($wardMembers as $wm) {
															$i = $wm['id'];
															$name = $wm['first_name']." ".$wm['last_name'];
															echo "<option value='$i'";
															if($i == $meeting['meeting_prayer'])
															{
																echo " selected ";
															}
															echo ">$name</option>";
														}
													?>
											    </select>
                                    <!-- <input class="form-control" type="text" name="prayer" value="<!--?php echo $prayer; ?>"/> -->
                                 </div>
                              </div>
                              <div class="row">
                                 <label class="control-label col-md-3" for="handbook">Handbook</label>
                                 <div class="col-md-6">
                                    <input class="form-control" type="text" name="handbook" value="<?php echo $meeting['lesson_number']; ?>"/>
                                 </div>
                              </div>
										<div class="row">
                                 <label class="control-label col-md-3" for="lessonInstuctor">Lesson Instructor</label>
                                 <div class="col-md-6">
												<select id="lessonInstructor" name="lessonInstructor" class="form-control">
													<?php
														foreach ($wardMembers as $wm) {
															$i = $wm['id'];
															$name = $wm['first_name']." ".$wm['last_name'];
															echo "<option value='$i'";
															if($i == $meeting['lesson_instructor'])
															{
																echo " selected ";
															}
															echo ">$name</option>";
														}
													?>
											    </select>
                                 </div>
                              </div>
                              <div class="row">
                                 <label class="control-label col-md-3" for="sacPrayer">Sac Prayer</label>
                                 <div class="col-md-6">
												<select id="sacPrayer" name="sacPrayer" class="form-control">
													<?php
														foreach ($wardMembers as $wm) {
															$i = $wm['id'];
															$name = $wm['first_name']." ".$wm['last_name'];
															echo "<option value='$i'";
															if($i == $meeting['sacrament_prayer'])
															{
																echo " selected ";
															}
															echo ">$name</option>";
														}
													?>
												 </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
						<div class="col-md-4">
                     <label class="control-label col-md-3" for="date">Date</label>
							<div class="col-md-6">
								<input class="form-control" id="date" name="date" value="<?php echo $date; ?>" />
							</div>
                  </div>
               </div>
            </div>
            <!-- second part-->
            <div class="jumbotron head-title">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group ">
                        <label class="control-label col-md-6" for="notes">Notes</label>
                        <div class="col-md-12">
                           <textarea class="form-control col-md-10" cols="10" id="notes" name="notes" rows="10"><?php echo $notes['text']; ?></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="jumbotron head-title">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label col-md-6">Calendar</label>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4" style="margin-left: 5px;">
							<label class="control-label">Act. Name</label>
						</div>
						<div class="col-md-4">
							<label class="control-label">Description</label>
						</div>
						<div class="col-md-3">
							<label class="control-label">Date</label>
						</div>
					</div>
               <div class="row">
                  <div class="form-group ">
                     <div class="col-md-12">
								<?php
									foreach ($activities as $act) {
										 //[id] => 2 [meeting_id] => 3 [description] => Well go to national park [name] => Camp out [date]
										$i = $act['id'];
										$dec = $act['description'];
										$actName = $act['name'];
										$day = date_create($act['date']);
										$day = date_format($day,"m/d/Y");
										echo "<label id='$i' style='display: block;'></label>";
										// name of the activity
										echo "<div class='col-md-4'>";
										echo "<input class='form-control' type='text' name='activities[]' value='$actName'/>";
                              echo "</div>";
										// description
										echo "<div class='col-md-4'>";
										echo "<input class='form-control' type='text' name='activities[]' value='$dec'/>";
                              echo "</div>";
										// date
										echo "<div class='col-md-4'>";
										echo "<input class='form-control datepicker' type='text' name='activities[]' value='$day'/>";
                              echo "</div>";
									}
								?>
                     </div>
                  </div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<button class="btn btn-primary pull-right" name="submit" type="submit">
						   	Save
							</button>
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
<script type="text/javascript">
	$(function () {
		$('#date').datepicker();
		$('.datepicker').each(function(i, obj) {
    		$(obj).datepicker();
		});
	});
</script>
</html>
