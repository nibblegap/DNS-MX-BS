<?php
$path	=	PATH TO CRONJOB FOLDER;
$pathtobindfile	=	PATH TO YOUR BIND FILE;
require_once($path."../config.php");
$handle = fopen($pathtobindfile, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
			$pos = strpos($line, "zone ");
			$pos1 = strpos($line, ".arpa");
			if ($pos === false) {
			} else {
			if ($pos1 === false) {
				$str = $line;
				preg_match('/"(.*?)"/', $str, $match);
				@mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay."(domain, serverid, fromuserid, sourceexec)
				VALUES('".$match[1]."', ".$config_adns_id.", 0, 'DNSAUTO');");	
			}
			}
    }
    fclose($handle);
} else {
    echo "ERROR OPEN THE FILE FOR BIND DOMAINS";
} 
echo $config_servername." Bind AUTO DNS Cron on Backup Server has been executed!";
?>