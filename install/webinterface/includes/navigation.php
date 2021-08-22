<style>
	input[type=submit] {
		width: auto !important;
	}
	
	input[type=submit]:hover {
		background: blue;
	}	
	
	input[type=text] {
		color: white !important;
	}	
	
	tr:hover {
		background: red;
	}
	
	#listlinktoref {
		color: white !important;
		width: 100%;
		font-size: 17px !important;
	}
	
	#listlinktoreflg {
		color: red !important;
		width: 100%;
		font-size: 17px !important;
	}	
	
	#listlinktoref:hover {
		color: lightgrey !important;
	}	
	
</style>		
	<fieldset style="border-color: grey;">
		<legend>Navigation</legend>	

		<?php
		#######################
		# ADMINISTRATOR AREA
		#######################
			if($_SESSION["tracker_rank"] == "admin") {
		?>	

						<?php if(isset($_GET["ticketid"])) { echo '<a href="./?&colocation=admdelete&ticketid='.htmlspecialchars($_GET["ticketid"]).'">Issue Force Delete<br /><font size="-1">Not recommended!</font></a><br /><br />'; } ?>
						<a id="listlinktorefto" href="./?&colocation=admuser">User-Management</a><br />
						<a id="listlinktorefto" href="./?&colocation=listadmin">Mail-Servers</a><br /><br />

		<?php
			}
		?>				
					<a id="listlinktorefto" href="./?&colocation=stats">Mail-Domains</a><br />
					<a id="listlinktoref" href="./?&colocation=userchange">Edit My Password</a>		<br />
					<a id="listlinktoreflg" href="./?&colocation=logout">Log Off</a>	<br />
							</fieldset>	