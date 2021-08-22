<?php
	##############################################
	##### TABLES
	##############################################		
		$config_mysql_table_relay	=	"bxc_relaydomains";
		$config_mysql_table_server	=	"bxc_servers";
		$config_mysql_table_users	=	"bxc_users";

	##############################################
	##### CONFIGURATIONS
	##############################################			
		# Name of the Page - Choose randomly if you want.
			$config_servername	=	"Backup Server"; 
		# Max tries after loggin get blocked and you have to reset via database. [anti bruteforce]
			$config_maxtries = 20;
		# // single = SINGLE SERVER FROM DNS | multi = MULTI SERVER FROM DNS | manual  = Manual Mail Backup Entries and Server Configuration
			$config_adns_mode = "multi";
		# Default Server	
			$config_adns_id = 3;  
		# Default Server [ Only for Multi Use ] 	
			$findvar_in_dns_txt	=	"relayserver=";
		# DNS FETCH MODE | 1 = get from /etc/bind/named.conf.local | 2 = get from /var/cache/bind
			$config_adns_fetch = 2;  			
		
	#####################################################################
	##### MySQL LOGIN ###################################################
	#####################################################################
		$configuration_mysql["mysql_host"]		=	"127.0.0.1";
		$configuration_mysql["mysql_db"]		=	"";
		$configuration_mysql["mysql_user"]		=	"";	
		$configuration_mysql["mysql_pass"]		=	"";
	
	#####################################################################
	##### MySQL SETTINGS ################################################
	#####################################################################
		$mysql = @mysqli_connect($configuration_mysql["mysql_host"], $configuration_mysql["mysql_user"], $configuration_mysql["mysql_pass"], $configuration_mysql["mysql_db"]);
			if (!$mysql) { http_response_code(503); echo "Error with Database"; exit(); }
		
?>