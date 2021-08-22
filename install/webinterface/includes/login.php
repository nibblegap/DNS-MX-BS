<?php
	if (!isset($_SESSION["bxclogincheckban"])) {$_SESSION["bxclogincheckban"] = 0;}
	if ($_SESSION["bxclogincheckban"] > 5) {
?>
<div id="notifyoufirsttertwo"><div id="notifyouttertwo"><div id="notifynews">You are banned! Please try again later...</div></div></div>
<?php
	goto aosidj; exit();}
	if(isset($_POST["username"]) AND isset($_POST["password"])) {
			$wiki_sql2	=	"SELECT * FROM ".$config_mysql_table_users." WHERE user = \"".mysqli_real_escape_string($mysql, htmlspecialchars($_POST["username"]))."\" 
			";
			$wiki_r2	=	mysqli_query($mysql, $wiki_sql2);
			while($bxc_f2=mysqli_fetch_array($wiki_r2)){
					if ( $bxc_f2["user"] == htmlspecialchars($_POST["username"]) AND password_verify($_POST["password"], $bxc_f2["pass"])) {
						$_SESSION["tracker_loggedin"] = "true"; 
						$_SESSION["tracker_userid"]		=	$bxc_f2["id"];
						$_SESSION["tracker_username"]	=	$bxc_f2["user"];
						$_SESSION["tracker_rank"]		=	$bxc_f2["rank"];
						 echo '<meta http-equiv="refresh" content="0; url=./">';
						 @mysqli_close($mysql); 
						 exit();
					}									
				}	
			 $_SESSION["bxclogincheckban"]	=	$_SESSION["bxclogincheckban"] + 1;
			 $tries = mysqli_fetch_array(mysqli_query($mysql, "SELECT MAX(tries) AS tries FROM ".$config_mysql_table_users.""));
		     $tries = $tries["tries"]+1;
		     mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET tries = '".$tries."'");
			 echo '<meta http-equiv="refresh" content="0; url=./">'; 
			 @mysqli_close($mysql); 
			 exit();				
	}
?><title>Backup Module - Login</title>
 <div  id="notifyoufirsttertwo" >
		<div id="notifyouttertwo">	 
		<div id="notifynews">
			<div id="loginouter">
				<div id="loginbox">
					<form action="" method="post" >
						<input type="text" name="username" placeholder="Username" ><br />
						<input type="password" name="password" placeholder="Password"><br />
						<input type="submit" value="login" id="loginonlogintracking">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
 aosidj:
?>