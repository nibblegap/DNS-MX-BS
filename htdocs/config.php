<?php
	##############################################
	##### TRACKER
	##############################################		
		$config_mysql_table_relay	=	"bxc_relaydomains";
		$config_mysql_table_server	=	"bxc_servers";
		$config_mysql_table_users	=	"bxc_users";
		
		$config_servername	=	"Trace"; # Name of the Server
		$config_maxtries = 20; # Max Fail Logins until Site block
		$config_adns_id = 1; # ID of the Default Mail Server used in AUTODNS Script
		
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