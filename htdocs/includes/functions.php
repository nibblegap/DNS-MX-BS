<?php
	function getUsernameFromID($mysql, $userid, $table) {
		$query	=	mysqli_query($mysql, "SELECT * FROM ".$table." WHERE id = \"".mysqli_real_escape_string($mysql, $userid)."\"");
		while ($result	=	mysqli_fetch_array($query) ) {
			return $result["user"];
		}
		return "Not Avail.";
	}
?>