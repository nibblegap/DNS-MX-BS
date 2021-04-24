<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
if ($_SESSION['tracker_csrf'] == $_POST['csrf']) {
    if (isset($_POST['delete'])) {
        mysqli_query($mysql, "DELETE FROM `".$config_mysql_table_users."` WHERE id = \"".$_POST["id"]."\";");
    } 
	
    if (isset($_POST['updateuser'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET user = '".$_POST["username"]."'
													WHERE id = \"".$_POST["id"]."\";");
    } 	
    if (isset($_POST['updatepass'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET pass = '".password_hash($_POST["password"],PASSWORD_BCRYPT)."'
													WHERE id = \"".$_POST["id"]."\";");
    } 		
    if (isset($_POST['updaterank'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET rank = '".$_POST["rank"]."'
													WHERE id = \"".$_POST["id"]."\";");
    } 				
	
	
    if (isset($_POST['add'])) {
        mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_users." (user, pass, rank) 
													VALUES (\"".$_POST["username"]."\"
													 ,\"".password_hash($_POST["password"],PASSWORD_BCRYPT)."\"
													 ,\"".$_POST["rank"]."\");");
    } 		
}
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
} else {
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
}


	$query = "SELECT * FROM `".$config_mysql_table_users."` ORDER BY id DESC LIMIT 15 ";
		
	?>
<section id="usermanagersection" >
	<div id="sectionheading">User Manager</div>
	<?php

	echo '<table id="usermanagertable">';
	
		
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
		
				echo '<tr>';
					echo "<td>USER</td>";
					echo "<td>PASS</td>";
					echo "<td>RANK</td>";
					echo "<td>DEL</td>";
				echo '</tr>';		
				
				echo '<form method="post">';
				echo '<tr >';
					echo "<input type='hidden' name='id'>";
					echo "<td><input name='username'  type='text'></td>";
					echo "<td><input name='password'  type='text'></td>";
					echo '<td>  <select name="rank">
    <option value="admin">admin</option>
    <option value="user">user</option>
  </select></td>';
					echo "<input name='csrf' type='hidden' value='".$csrftoken."'>";
					echo "<td><input name='add' type='submit' value='add'></td>";
					echo "<td></td>";
				echo '</tr>';
				echo '</form>';			
				
			$stringwithoutputs	=	"";
		
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				echo '<form method="post">';
				echo '<tr >';
					echo "<input type='hidden' name='id' value='".$row["id"]."'>";
					echo "<td><input name='username' style='width: 80% !important;'  type='text' value='".$row["user"]."'>";
					echo "<input name='updateuser' type='submit' style='width: 20% !important;' value='C'></td>";
					
					echo "<td><input name='password' style='width: 80% !important;' type='text' value='".$row["pass"]."'>";
					echo "<input name='updatepass' style='width: 20% !important;' type='submit' value='C'></td>";
					
					echo "<td><input name='rank' style='width: 80% !important;' type='text' value='".$row["rank"]."'>";
					echo "<input name='updaterank' style='width: 20% !important;' type='submit' value='C'></td>";					
					

					echo "<input name='csrf' type='hidden' value='".$csrftoken."'>";
					
					echo "<td><input name='delete' style='width: 100% !important;' type='submit' value='DEL'></td>";
				echo '</tr>';
				echo '</form>';
			$flag = TRUE;
		}
	echo '</table><br /><br />';
	echo $stringwithoutputs;
	?>
</section><?php
	$tries22 = mysqli_fetch_array(mysqli_query($mysql, "SELECT MAX(tries) AS tries FROM ".$config_mysql_table_users.""));
	echo "Current Fail Login Count: ".$tries22["tries"]." <br />";
	echo "Block Limit: ".$config_maxtries." <br />";
	?>
	
	<a href="./?colocation=admuser&reset=yes">reset</a>
	<?php
	if(@$_GET["reset"] == "yes") {
		mysqli_query($mysql, "UPDATE ".$config_mysql_table_users." SET tries = 1");
	}
	?>