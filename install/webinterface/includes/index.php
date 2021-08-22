<?php	
	require_once("./includes/functions.php");
	$tracker_loginvar	=	false;
	if(@$_SESSION["tracker_loggedin"] == "true" AND isset($_SESSION["tracker_userid"])AND isset($_SESSION["tracker_username"])) {
			$tracker_loginvar  = true; }
	if ($tracker_loginvar != true) { require_once("./includes/login.php"); } else {
?>	
	<div id="trackerdiv">
			<div id="trackerinner">
				<?php require_once("./includes/navigation.php"); ?>				
			</div>	
			<div id="trackersec">
				<?php
					switch(@htmlspecialchars($_GET["colocation"])) {
						case "userchange": 	
								require_once("./includes/userinfo.php");	
							break;								
							
						case "admuser": 				
								if($_SESSION["tracker_rank"] == "admin") {
									require_once("./includes/usermanager.php");
								} else { echo '<meta http-equiv="refresh" content="0; url=./">';@mysqli_close($mysql);  exit(); }
							break;	
						case "admcheck": 				
								if($_SESSION["tracker_rank"] == "admin") {
									require_once("./includes/usermanager.php");
								} else { echo '<meta http-equiv="refresh" content="0; url=./">';@mysqli_close($mysql);  exit(); }
							break;
						case "logout": 
								unset($_SESSION['tracker_loggedin']);
								unset($_SESSION['tracker_rank']);
								unset($_SESSION['tracker_userid']);
								unset($_SESSION['tracker_username']);
								echo '<meta http-equiv="refresh" content="0; url=./">';
								exit();
							break;							
						case "listadmin":
								if($_SESSION["tracker_rank"] == "admin") {
									require_once("./includes/listad.php");
								} else { echo '<meta http-equiv="refresh" content="0; url=./">';@mysqli_close($mysql);  exit(); }	
							break;
						default:	
								require_once("./includes/stats.php");	
					};
				 ?>
			</div>
	</div>
	<?php } ?>
	</div>