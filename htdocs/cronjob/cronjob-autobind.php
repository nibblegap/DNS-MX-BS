<?php
$path	=	"/var/www/html/bxc/cronjob/";
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
				
				 $resultsfromdns = dns_get_record(
					$match[1],
					DNS_TXT);
					
				foreach ($resultsfromdns as &$value) {
					
				if(strpos($value["txt"], $findvar_in_dns_txt) > -1) {
						
						$value = substr($value["txt"], strpos($value["txt"], "=")+1, 1 );
						break;
						
					}
					
				}	
				if($value != NULL AND is_numeric($value)) {
				@mysqli_query($mysql, "INSERT INTO ".$config_mysql_table_relay."(domain, serverid, fromuserid, sourceexec)
				VALUES('".$match[1]."', ".$config_adns_id.", 0, 'DNSAUTO');");	
				} else { echo "error on ".$match[1].""; }
			}
			}
    }
    fclose($handle);
} else {
    echo "ERROR OPEN THE FILE FOR BIND DOMAINS";
} 
echo $config_servername." Bind AUTO DNS Cron on Backup Server has been executed!";
?>