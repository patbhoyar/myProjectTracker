<div id="menuContainer">
	<div id="menuInnerContainer">
		<div id="welcomeUser">
			<?php $user = (Session::get("userType") == 1)?Session::get("userName")." (ADMIN)":Session::get("userName"); echo "WELCOME, ".$user; ?>
		</div>

		<ul id="menu">
			<a href="index.php"> <li class="menuItems" id="home">HOME</li> </a>
			<a href="clients.php"> <li class="menuItems" id="viewTasks">CLIENTS</li> </a>
			<a href="projects.php"> <li class="menuItems" id="viewTasks">PROJECTS</li> </a>
			<a href="tasks.php"> <li class="menuItems" id="viewTasks">TASKS</li> </a>
			<a href="logHours.php"> <li class="menuItems" id="logHours">LOG HOURS</li> </a>
			<a href="index.php"> <li class="menuItems" id="editProfile">PROFILE</li> </a>
			<li class="menuItems" id="logout">LOGOUT</li>
		</ul>
	</div>
</div>