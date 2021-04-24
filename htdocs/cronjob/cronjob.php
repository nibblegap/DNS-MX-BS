<?php
$path	=	PATH TO CRONJOB FOLDER;
require_once($path."../config.php");
$buildstring_transport = "";
$buildstring_relay = "";
$query	=	"SELECT * FROM `".$config_mysql_table_relay."`"; 
$result = mysqli_query($mysql, $query) or die(mysqli_error($mysql));
while ($vars = mysqli_fetch_array($result, MYSQLI_BOTH)) {
	$isok = false;
	$servername = "";
	$serverport = "";
	$query11	=	"SELECT * FROM `".$config_mysql_table_server."` WHERE id = ".$vars["serverid"].""; 
	$result11 = mysqli_query($mysql, $query11) or die(mysqli_error($mysql));
	while ($vars11 = mysqli_fetch_array($result11, MYSQLI_BOTH)) {
		$isok = true;
		$servername = $vars11["servername"];
		$serverport = $vars11["port"];
	}
	if($isok == true) {
		$buildstring_transport .= $vars["domain"]." smtp:".$servername.":".$serverport."\n";
		$buildstring_relay .= $vars["domain"]." OK"."\n";
	}
}
@unlink($path."transportmaps");
$myfile = fopen($path."transportmaps", "w") or die("Unable to open file Transport!");
fwrite($myfile, $buildstring_transport);
fclose($myfile);
@unlink($path."relaydomains");
$myfile = fopen($path."relaydomains", "w") or die("Unable to open file Relay!");
fwrite($myfile, $buildstring_relay);
fclose($myfile);	
echo $config_servername." Manual Cron on Backup Server has been executed!";
?>