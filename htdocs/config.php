<?php
	##############################################
	##### TRACKER
	##############################################		
		$config_mysql_table_relay	=	"bxc_relaydomains";
		$config_mysql_table_server	=	"bxc_servers";
		$config_mysql_table_users	=	"bxc_users";
		
		$config_servername	=	"Trace"; # Name of the Page - Choose randomly if you want.
		$config_maxtries = 20; # Max tries after loggin get blocked and you have to reset via database. [anti bruteforce]
		$config_adns_mode = "2"; # // 1 = SINGLE SERVER | 2 = MULTI SERVER [ see readme how to prepare mail dns with txt. entry ]
		$config_adns_id = 1;  # Default Server [ Only for Single Use ] 
		
		$findvar_in_dns_txt	=	"backup_mail_servid=";
		
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