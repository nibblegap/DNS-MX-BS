<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted

	if ($_SESSION['tracker_csrf'] == $_POST['csrf']) {

		if (isset($_POST['updatepass'])) {
			mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET pass = \"".password_hash($_POST["password"],PASSWORD_BCRYPT)."\"
														WHERE id = ".$_SESSION['tracker_userid'].";");
		} 
		
		if (isset($_POST['updateuser'])) {
		mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET user = \"".htmlspecialchars($_POST["username"])."\"
														WHERE id = ".$_SESSION['tracker_userid'].";");
		} 
	}
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
} else {
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
}


	$query = "SELECT * FROM `".$config_mysql_table_users."` WHERE id = ".$_SESSION['tracker_userid']." ORDER BY id DESC LIMIT 15 ";
		
	?>
<section id="userinfosection">
	<div id="sectionheading">Here you can change your personal data!</div>
	<?php	
		
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
						
		
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				echo '<form method="post">';

					
					echo "<input name='username' type='text' style='width: 80% !important;' value='".$row["user"]."'>";
					echo "<input name='updateuser' type='submit' style='width: 20% !important;' value='Change Username'>";
					
					echo "<input name='password' type='text' style='width: 80% !important;' value='xxx'>";
					echo "<input name='updatepass' type='submit' style='width: 20% !important;' value='Change Password'>";
					
					echo "<input name='csrf' type='hidden' value='".$csrftoken."'>";

				echo '</form>';
			$flag = TRUE;
		}
	echo '</table>';
	?>
</section>
