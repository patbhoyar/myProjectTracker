<?php
	$title = 'Clients - KKMedia Project Tracker';
	$loginRequired = 1;
	$css = "style.css, clients.css";
	$js = 'script.js, clients.js';
	include(dirname(__FILE__) . '/includes/adminHeader.php');
?>
	<div id="heading">CLIENTS</div>
	<br>
	
	<div id="addClientsContainer">
		<div id="clientNameContainer"> <input type="text" id="clientName"> </div>
		<div id="clientStatusContainer"></div>
		<div id="addClient"> Add Client </div>
	</div>

	<br><br><br>

	<div id="editClients">Edit Clients</div>
	<div id="saveEditedClients">Save Changes</div>
	<div id="cancelEditClients">Cancel</div>

	<br><br><br>

	<div id="clientList"></div>

<?php include(dirname(__FILE__) . '/includes/footer.php'); ?>