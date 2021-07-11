<style>
#tracker_post a:hover #tracker_listitem  {
	background: rgba(255,255,255,0.2);
}
#tracker_listitem  {
	font-size: 15px !important;
}

#tracker_post {
	background: rgba(0,0,0,0.1);
	min-width: 400px;
	word-break: break-all;
	white-space: nowrap;
}
</style>

<div id="tracker_post" >
	<div id="tracker_hline" style="text-align: center;width: 100%; background: #1B1B1B;">MX Servers</div>
	<?php
				$curissue	=	mysqli_query($mysql, "SELECT *	FROM ".$config_mysql_table_relay."  ORDER BY serverid DESC");
	echo "<div>";		
	while ($curissuer	=	mysqli_fetch_array($curissue) ) { 
			$curissue3434	=	mysqli_query($mysql, "SELECT *	FROM ".$config_mysql_table_server." WHERE id = ".$curissuer["serverid"]." ORDER BY id DESC");
			$curissuer345654	=	mysqli_fetch_array($curissue3434);

				echo "<div id='tracker_listitem' style='width: 20%;color: lightgreen;'>".$curissuer["domain"]."</div>";
				echo "<div id='tracker_listitem' style='width: 50%;color: lightblue;'><b> - ".$curissuer["serverid"]." - ".@$curissuer345654["servername"]."</b></div>";
				echo "<div id='tracker_listitem' style='width: 10%;color: lightgreen;'>".getUsernameFromID($mysql, $curissuer["fromuserid"], $config_mysql_table_users)."</div>";
				echo "<div id='tracker_listitem' style='width: 10%;color: lightgreen;'>".$curissuer["sourceexec"]."</div>";
			
	}
		echo "</div>";	
	?>
</div><br />

</div>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
if ($_SESSION['tracker_csrf'] == $_POST['csrf']) {
    if (isset($_POST['delete'])) {
        mysqli_query($mysql, "DELETE FROM `".$config_mysql_table_relay."` WHERE id = \"".htmlspecialchars($_POST["id"])."\";");
    } 
	
    if (isset($_POST['updateuser'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_relay." SET domain = '".htmlspecialchars($_POST["username"])."'
													WHERE id = \"".$_POST["id"]."\";");
    } 	
    if (isset($_POST['updatepass'])) {
        mysqli_query($mysql, "UPDATE ".$config_mysql_table_relay." SET serverid = '".htmlspecialchars($_POST["password"])."'
													WHERE id = \"".$_POST["id"]."\";");
    } 					
	
    if (isset($_POST['add'])) {
        mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay." (domain, serverid, fromuserid, sourceexec) 
													VALUES (\"".htmlspecialchars($_POST["username"])."\"
													, \"".htmlspecialchars($_POST["password"])."\"
													, \"".$_SESSION["tracker_userid"]."\"
													 ,\"user\");") or die (mysqli_error($mysql));
    } 		
}
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
} else {
	$csrftoken	=	mt_rand(100000,9999999);
	$_SESSION['tracker_csrf'] = $csrftoken;
}


	$query = "SELECT * FROM `".$config_mysql_table_relay."` WHERE sourceexec = 'user' AND fromuserid = ".$_SESSION["tracker_userid"]." ORDER BY id DESC LIMIT 15 ";
		
		if($config_adns_mode != "2") {
	?>
<section id="usermanagersection" >
	<div id="sectionheading" style="background: black;"><h1>Add Server</h1></div>
	<?php

	echo '<table id="usermanagertable">';
	
		
		$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
		$flag = FALSE;
		
				echo '<tr>';
					echo "<td>DOMAIN</td>";
					echo "<td>Server  ID</td>";
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
					echo "<td><input name='username' style='width: 80% !important;'  type='text' value='".$row["domain"]."'>";
					echo "<input name='updateuser' type='submit' style='width: 20% !important;' value='C'></td>";
					
					echo "<td><input name='password' style='width: 80% !important;' type='text' value='".$row["serverid"]."'>";
					echo "<input name='updatepass' style='width: 20% !important;' type='submit' value='C'></td>";

					echo "<input name='csrf' type='hidden' value='".$csrftoken."'>";
					
					echo "<td><input name='delete' style='width: 100% !important;' type='submit' value='DEL'></td>";
				echo '</tr>';
				echo '</form>';
			$flag = TRUE;
		}
	echo '</table><br /><br />';
	echo $stringwithoutputs;
		}
	?>
</section>
										