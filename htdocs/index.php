<?php
	@ini_set('session.cookie_lifetime', 86400);
	@ini_set('session.gc_maxlifetime', 86400);
	session_start();
	require_once("./config.php");
	
	$tries1 = mysqli_fetch_array(mysqli_query($mysql, "SELECT MAX(tries) AS tries FROM ".$config_mysql_table_users.""));
	if($tries1["tries"] >= $config_maxtries) {
		echo "<title>Backup Module Blocked!</title><body style='background: black; color: yellow;'><center>Module is now blocked duo to security reasons!</center></body>";
		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html version="-//W3C//DTD XHTML 1.1//EN"
      xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.w3.org/1999/xhtml
                          http://www.w3.org/MarkUp/SCHEMA/xhtml11.xsd"
	>
  <head>
	<!-- Meta Tags For Site --> 
	<title>Backup Module on <?php echo $config_servername; ?></title>
		<link rel="stylesheet" type="text/css" href="./stylesheet.css" />
	 
	<!-- Meta Tags For Site -->
		<meta http-equiv="content-Type" content="text/html; utf-8" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="content-Language" content="en" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Jan-Maurice Dahlmanns" />
		<meta name="publisher" content="Jan-Maurice Dahlmanns" />
		<meta name="copyright" content="Jan-Maurice Dahlmanns" />
		<meta name="audience" content="all" />
		<meta name="expires" content="0" />
		<meta name="robots" content="noindex, nofollow" />
  </head>
  <body>
	<?php
		require_once("./includes/index.php");
	?>
  </body>
</html>