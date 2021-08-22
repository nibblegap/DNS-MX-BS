<?php

$path	=	"/var/www/html/";
require_once($path."../config.php");



/////////// MAKE FROM NAMED.CONF.LOCAL
if( $config_adns_fetch == 1 ) {
$pathtobindfile	=	"/etc/bind/named.conf.local";
require_once($path."/../config.php");
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
					
					
					@ob_start();
						@passthru("/usr/bin/dig ".$match[1]." TXT");
						@$lookup = @ob_get_contents();
					@ob_end_clean();
									

					
				if(strpos(@$lookup, $findvar_in_dns_txt) > -1) {
						
						$ssssss = substr($lookup, strpos($lookup, $findvar_in_dns_txt)+strlen($findvar_in_dns_txt), 1 );
						
					} 
					
				
				if(@$ssssss != NULL AND is_numeric(@$ssssss)) {
				@mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay."(domain, serverid, fromuserid, sourceexec)
				VALUES('".$match[1]."', ".$ssssss.", 0, 'DNSAUTO');");echo $match[1]." to ".@$ssssss."  \r\n";	
				} else { @mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay."(domain, serverid, fromuserid, sourceexec)
				VALUES('".$match[1]."', ".$config_adns_id.", 0, 'DNSAUTO');");	echo $match[1]." to default was NONE \r\n"; }
			}
			}
    }
    fclose($handle);
} else { echo "ERROR OPEN THE FILE FOR BIND DOMAINS"; } 
echo $config_servername." Bind AUTO DNS Cron on Backup Server has been executed for named.conf!!"; } else {

$pathtobindfile	=	"/var/cache/bind/";
require_once($path."../config.php");
if ($handle = opendir($pathtobindfile)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
			$pos1 = strpos($entry, "_default.nzd");
			$pos2 = strpos($entry, "keys.bind");
			if ($pos1 === false) {
			if ($pos2 === false) {
				
				
					@ob_start();
						@passthru("/usr/bin/dig ".$entry." TXT");
						@$lookup = @ob_get_contents();
					@ob_end_clean();
					

					
				if(strpos(@$lookup, $findvar_in_dns_txt) > -1) {
						
						$ssssss = substr($lookup, strpos($lookup, $findvar_in_dns_txt)+strlen($findvar_in_dns_txt), 1 );
						
					} 
								
								
				if(@$ssssss != NULL AND is_numeric(@$ssssss)) {
				@mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay."(domain, serverid, fromuserid, sourceexec)
				VALUES('".$entry."', ".$ssssss.", 0, 'DNSAUTO');"); echo $entry." to ".@$ssssss."  \r\n";	
				} else { @mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay."(domain, serverid, fromuserid, sourceexec)
				VALUES('".$entry."', ".$config_adns_id.", 0, 'DNSAUTO');");	echo $entry." to default was NONE  \r\n"; }
				
			}
			}			
			
        }
    }
    closedir($handle);
}
echo $config_servername." Bind AUTO DNS Cron on Backup Server has been executed with Cache Files!";
}

///////////// CRON FOR WRITING FILES FOR MOVING TO POSTFIX

$buildstring_transport = "";
$buildstring_relay = "";
$query	=	"SELECT * FROM `".$config_mysql_table_relay."` WHERE serverid IS NOT NULL AND serverid <> ''"; 
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
echo $config_servername." New Postmap Files written!\r\n";


?>
