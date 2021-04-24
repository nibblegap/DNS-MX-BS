<style>
#tracker_post a:hover #tracker_listitem  {
	background: rgba(255,255,255,0.2);
	color: white !important;
}
#tracker_listitem  {
	font-size: 14px !important;
}

#tracker_post {
	background: rgba(0,0,0,0.1);
}
</style>

<?php
	if($_SESSION["tracker_rank"] == "admin") {
?>

<div id="tracker_post">
	<div id="tracker_hline" style="text-align: center;width: 100%; background: #1B1B1B;">All Domains Registred</div>
	<?php

	$curissue	=	mysqli_query($mysql, "SELECT *
											FROM ".$config_mysql_table_relay." 
											");

			echo "<div id='tracker_listitem' style='width: 20%;'>Status</div>";
			echo "<div id='tracker_listitem' style='width: 50%;'>Server</div>";
			echo "<div id='tracker_listitem' style='width: 10%;'>Assigned</div>";
			echo "<div id='tracker_listitem' style='width: 10%;'>Created</div><br />";

															
	while ($curissuer	=	mysqli_fetch_array($curissue) ) {
				echo "<div id='tracker_listitem' style='width: 20%;color: lightgreen;'>".$curissuer["domain"]."</div>";
				echo "<div id='tracker_listitem' style='width: 50%;color: lightblue;'><b> - ".$curissuer["serverid"]."</b></div>";
				echo "<div id='tracker_listitem' style='width: 10%;color: lightgreen;'>".getUsernameFromID($mysql, $curissuer["fromuserid"], $config_mysql_table_users)."</div>";
				echo "<div id='tracker_listitem' style='width: 10%;color: lightgreen;'>".$curissuer["sourceexec"]."</div>";
				echo "<div id='tracker_listitem' style='width: 10%;color: lightgreen;'>".$curissuer["sourceexec"]."</div>";
		echo "";					
	}

		

	?>
	</div><?php } ?>

<br clear="left">

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
if ($_SESSION['tracker_csrf'] == $_POST['csrf']) {
    if (isset($_POST['delete'])) {
        mysqli_query($mysql, "DELETE FROM `".$config_mysql_table_server."` WHERE id = \"".$_POST["id"]."\";");
    } 
	
    if (isset($_POST['updateuser'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_server." SET servername = '".$_POST["username"]."'
													WHERE id = \"".$_POST["id"]."\";");
    } 	
    if (isset($_POST['updatepass'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_server." SET port = '".$_POST["password"]."'
													WHERE id = \"".$_POST["id"]."\";");
    } 					
	
    if (isset($_POST['add'])) {
        mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_server." (servername, port) 
													VALUES (\"".$_POST["username"]."\"
													 ,\"".$_POST["password"]."\");");
    } 		
}
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
} else {
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
}


	$query = "SELECT * FROM `".$config_mysql_table_server."` ORDER BY id DESC LIMIT 15 ";
		
	?>
<section id="usermanagersection" >
	<div id="sectionheading" style="background: black;"><h1>Add Server <br /><font size="-1">[AutoDNS goes to -> <?php echo $config_adns_id; ?>]</font></h1></div>
	<?php

	echo '<table id="usermanagertable">';
	
		
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
		
				echo '<tr>';
					echo "<td>NAME</td>";
					echo "<td>PORT</td>";
					echo "<td>DEL</td>";
				echo '</tr>';		
				
				echo '<form method="post">';
				echo '<tr >';
					echo "<input type='hidden' name='id'>";
					echo "<td><input name='username'  type='text'></td>";
					echo "<td><input name='password'  type='text'></td>";
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
					echo "<td>[".$row["id"]."]</td><td><input name='username' style='width: 80% !important;'  type='text' value='".$row["servername"]."'>";
					echo "<input name='updateuser' type='submit' style='width: 20% !important;' value='C'></td>";
					
					echo "<td><input name='password' style='width: 80% !important;' type='text' value='".$row["port"]."'>";
					echo "<input name='updatepass' style='width: 20% !important;' type='submit' value='C'></td>";

					echo "<input name='csrf' type='hidden' value='".$csrftoken."'>";
					
					echo "<td><input name='delete' style='width: 100% !important;' type='submit' value='DEL'></td>";
				echo '</tr>';
				echo '</form>';
			$flag = TRUE;
		}
	echo '</table><br /><br />';
	echo $stringwithoutputs;
	?>
</section>
								<a href="./?&colocation=listadmin&reset=deleteall">Delete All Domains</a>	
								<?php
									if($_GET["reset"] == "deleteall") mysqli_query($mysql, "DELETE FROM ".$config_mysql_table_relay);
								?>