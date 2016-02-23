<?php
	// PAGE DESCRIPTION: This page displays information about the developers.
	
	// Retrieves logged user.
	$query = $_POST;
	
	if ($query->num_rows == 0) redirect ('main/'); // If there are no logged users, there will be a redirection to the main controller.
	else { // If there is a logged user, the page will display its content.
		foreach ($query->result() as $row) {
			displayContent($row->role, $row->username);
		}
	}
	
	function displayContent($role, $username) {
		include("header.php");
		$checker = 1;
		include("sidebar.php");
		
		echo "<h1>User Manual</h1>
		<p>This is a guide to the usage of the site. In case there are questions not addressed by the instructions below, the <a href='" . base_url() . "index.php/admin_controller/developers'>developer team</a> is available for consultation.</p>";
		
		echo "Contents:
		<ol id='contents'>
		<li><a href='#site'>Site</a>
			<ol id='upper-alpha'>
				<li><a href='#site-parts'>Parts</a></li>
				<li><a href='#site-parts-sidebar'>Sidebar</a></li>
			</ol>
		</li>";
		if ($role != 'upf') {
			echo "<li><a href='#adding'>Adding</a>
				<ol id='upper-alpha'>
					<li><a href='#adding-record'>Add a record</a></li>
					<li><a href='#adding-violation'>Add a violation</a></li>
					<li><a href='#adding-id'>Add an ID</a></li>
					<li><a href='#adding-pic'>Upload a picture</a></li>
				</ol>
			</li>
			<li><a href='#editing'>Editing</a>
				<ol id='upper-alpha'>
					<li><a href='#editing-record'>Edit a record</a></li>
				</ol>
			</li>
			";
		}
		echo "
		<li><a href='#searching'>Searching</a>
			<ol id='upper-alpha'>
				<li><a href='#searching-surname'>Search by surname</a></li>
				<li><a href='#searching-platenumber'>Search by plate number</a></li>
				<li><a href='#searching-id'>Search by ID number</a></li>
				<li><a href='#searching-explic'>Search by expiration of license</a></li>
				<li><a href='#searching-expfran'>Search by expiration of franchise</a></li>
				<li><a href='#searching-color'>Search by ID color</a></li>
			</ol>
		</li>
		<li><a href='#viewing'>Viewing</a>
			<ol id='upper-alpha'>
				<li><a href='#viewing-profile'>View profile</a></li>
				<li><a href='#viewing-all'>View all records</a></li>
				<li><a href='#viewing-explic'>View records of drivers with expired licenses</a></li>
				<li><a href='#viewing-expfran'>View records of drivers with expired franchises</a></li>
				<li><a href='#viewing-blue'>View records of drivers with blue IDs</a></li>
				<li><a href='#viewing-yellow'>View records of drivers with yellow IDs</a></li>
			</ol>
		</li>
		<li><a href='#account'>Account</a>
			<ol id='upper-alpha'>
				<li><a href='#account-pword'>Change Password</a></li>
			</ol>
		</li>";
		if ($role == 'administrator') {
			echo "<li><a href='#admin'>Administrator-only</a>				
				<ol id='upper-alpha'>
					<li><a href='#admin-protection'>User Settings</a></li>
					<li><a href='#admin-reg'>Register Users</a></li>
					<li><a href='#admin-view'>View Users</a></li>
					<li><a href='#admin-viewprof'>View User Profiles</a></li>
					<li><a href='#admin-del'>Delete Users</a></li>
					<li><a href='#admin-edit'>Edit Users</a></li>
				</ol>
			</li>
			";
		}
		echo "</ol>";
		echo "<h2 name='site' id='site'>Site</h2>
		<p name='site-parts' id='site-parts'>This is a basic walkthrough to the interface of the site.</p>
		<center><img src='" . base_url() . "images/home.jpg' /><br />Figure 1. The home page and its parts.</center>
		<p>Each page has four major parts:</p>
		<ol>
			<li><strong>Header.</strong> This contains the logo of the site.</li>
			<li><strong>Sidebar.</strong> The navigations of the site can be seen in the sidebar.</li>
			<li><strong>Main content.</strong> Displays the content of the page.</li>
			<li><strong>Footer.</strong> This contains the credits and the disclaimers for the site.</li>
		</ol>
		<center name='site-parts-sidebar' id='site-parts-sidebar'><img src='" . base_url() . "images/sidebar.jpg' /><br />Figure 2. The sidebar.</center>
		<p>The sidebar is integral in the site; without it, there would be great difficulty in using the site. It has three tabs:</p>
		<ol>
			<li><strong>Functionalities.</strong> This contains the ";
		if ($role == 'administrator' || $role == 'studentassistant') echo "add, ";
		echo "view and search functions.</li>
			<li><strong>Account.</strong> Displays the ";
		if ($role == 'administrator') echo "register a user, view users, ";
		echo "change password and logout functions</li>
			<li><strong>Information.</strong> This contains links to the manual and the developer team page.</li>
		</ol>
		<p>The default tab opened in the sidebar is the Functionalities tab. To open other sidebar tabs, just click on the name of the tab. For example, if you want to logout. You must click on the Accounts tab name. The list of available links will glide down.</p>
		";
		echo "<p align='right'><a href='#top'>Back to top</a></p>";
		
		if ($role != 'upf') {
			echo "<h2 name='adding' id='adding'>Adding</h2>
			<p name='adding-record' id='adding-record'>To <strong>add a driver record</strong> (and add an image of the driver), perform the instructions that follow:</p>
			<ol>
				<li>Click on the Functionalities tab on the sidebar and select Add.</li>
				<li>Adding a record requires two steps. The first step is to fill the profile form. After filling in the needed information, click submit.</li>
				<li>For the second step, an upload form will be displayed. Upload the photo of the driver. Click submit.</li>
			</ol>
			<p name='adding-violation' id='adding-violation'>To <strong>add a violation</strong>, perform the following instructions:</p>
			<ol>
				<li>Access the 'Add violation' page through any of the following ways:
					<ol id='alpha'>
						<li>Functionalities tab > View. In every view functionality, there is an available 'Add Violation' link at the side of every record viewed.</li>
						<li>Functionalities tab > View > (Select any view functionality) > (Click on the name of the driver to view profile). In the 'Violations' subheading of the driver's profile, there is an 'Add' link.
					</ol>
				</li>
				<li>The 'Add violation' will be loaded. Enter information on the fields and then submit the form.</li>
			</ol>
			<p name='adding-id' id='adding-id'>To <strong>add an ID</strong>, perform the following instructions:</p>
			<ol>
				<li>Access the 'Add ID' page through any of the following ways:
					<ol id='alpha'>
						<li>Functionalities tab > View. In every view functionality, there is an available 'Add ID' link at the side of every record viewed.</li>
						<li>Functionalities tab > View > (Select any view functionality) > (Click on the name of the driver to view profile). In the 'ID' subheading of the driver's profile, there is an 'Add' link.
					</ol>
				</li>
				<li>The 'Add violation' will be loaded. Enter information on the fields and then submit the form.</li>
			</ol>
			<p name='adding-pic' id='adding-pic'>To <strong>upload a picture</strong>, perform the following instructions:</p>
			<ol>
				<li>There is only one way to upload a picture and the chance of adding one is only once in a record's lifetime. Functionalities tab > Add. Uploading a picture is the step two of adding a record process. You must never add a record if you do not have a picture of the driver ready to be uploaded.</li>
				<li>On the Add a record page, fill in the profile form and then click submit (provided that you have a picture to upload).</li>
				<li>The Upload an image page will be displayed. Click the browse button and search for the image you wanted to upload.</li>
				<li>Click open.</li>
				<li>Click submit.</li>
			</ol>
			";
			echo "<p align='right'><a href='#top'>Back to top</a></p>";
			echo "<h2 name='editing' id='editing'>Editing</h2>
			<p name='editing-record' id='editing-record'>To <strong>edit a driver record</strong>, perform the instructions that follow:</p>
			<ol>
				<li>On any search result or view display, there is an edit link at the right of each record. The link can also be seen at the profile of every driver.</li>
				<li>Fill in the information on the form. Click submit.</li>
			</ol>
			";
			echo "<p align='right'><a href='#top'>Back to top</a></p>";
		}
		
		echo "<h2 name='searching' id='searching'>Searching</h2>
		<p name='searching-surname' id='searching-surname'>To <strong>search the database by the surname of the driver</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select Search.</li>
			<li>A search menu will be displayed. Click on the 'Search by surname' link.</li>
			<li>The search by surname form will be displayed.</li>
			<li>Enter the surname of the driver. Click submit.</li>
		</ol>
		<p name='searching-platenumber' id='searching-platenumber'>To <strong>search the database by the plate number of the driver</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select Search.</li>
			<li>A search menu will be displayed. Click on the 'Search by plate number' link.</li>
			<li>The search by plate number form will be displayed.</li>
			<li>Enter the plate number of the driver. Click submit.</li>
		</ol>
		<p name='searching-id' id='searching-id'>To <strong>search the database by the ID number of the driver (regardless of color and if lost)</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select Search.</li>
			<li>A search menu will be displayed. Click on the 'Search by ID number' link.</li>
			<li>The search by ID number form will be displayed.</li>
			<li>Enter the ID number of the driver. Click submit.</li>
		</ol>
		<p name='searching-explic' id='searching-explic'>To <strong>search by expiration of licenses</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select Search.</li>
			<li>A search menu will be displayed. Click on the 'Search by Expiration of Licenses' link.</li>
			<li>The search by expiration of licenses form will be displayed.</li>
			<li>Enter the month and year of expiration of license of the driver. Click submit.</li>
		</ol>
		<p name='searching-expfran' id='searching-expfran'>To <strong>search by expiration of franchises</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select Search.</li>
			<li>A search menu will be displayed. Click on the 'Search by Expiration of Franchises' link.</li>
			<li>The search by expiration of franchises form will be displayed.</li>
			<li>Enter the month and year of expiration of franchise of the driver. Click submit.</li>
		</ol>
		<p name='searching-color' id='searching-color'>To <strong>search by ID color</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select Search.</li>
			<li>A search menu will be displayed. Click on the 'Search by ID color' link.</li>
			<li>The search by ID color form will be displayed.</li>
			<li>Select the ID color of the driver. Click submit.</li>
		</ol>";
		echo "<p align='right'><a href='#top'>Back to top</a></p>";
		echo "
		<h2 name='viewing' id='viewing'>Viewing</h2>
		<center><img src='" . base_url() . "images/ids.jpg' name='viewing-profile' id='viewing-profile' /><br /><strong>Figure 3.</strong> Displaying the ID number.</center>
		<p>The <strong>profile</strong> of each driver consists of three parts:</p>
		<ol>
			<li>ID</li>
			<li>Profile</li>
			<li>Violations</li>
		</ol>
		<p>In Figure 3, the driver's first ID is 16 (Yellow). Her next ID is 100 (Blue) and the last is 296 (Blue). When viewing the profile, the latest ID entered is isolated from the old IDs. Also, on search and view results, when the ID number is referenced, the latest ID number is displayed.</p>
		<p name='viewing-all' id='viewing-all'>To <strong>view all records in the database</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select View.</li>
			<li>The view menu will be displayed. Click on the 'View all records' link.</li>
			<li>All of the records in the database will be shown.</li>
		</ol>
		<p name='viewing-explic' id='viewing-explic'>If you want to <strong>view all the records in the database with expired licenses</strong>, perform the instructions that follow:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select View.</li>
			<li>The view menu will be displayed. Click on the 'View records of drivers with expired licenses' link.</li>
			<li>All of the records in the database with expired licenses will be shown.</li>
		</ol>
		<p name='viewing-expfran' id='viewing-expfran'>If you want to <strong>view all the records in the database with expired franchises</strong>, perform the instructions that follow:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select View.</li>
			<li>The view menu will be displayed. Click on the 'View records of drivers with expired franchises' link.</li>
			<li>All of the records in the database with expired franchises will be shown.</li>
		</ol>
		<p name='viewing-blue' id='viewing-blue'>To <strong>view all records in the database with blue IDs</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select View.</li>
			<li>The view menu will be displayed. Click on the 'View records of drivers with blue IDs' link.</li>
			<li>All of the records in the database with blue IDs will be shown.</li>
		</ol>
		<p name='viewing-yellow' id='viewing-yellow'>To <strong>view all records in the database with yellow IDs</strong>:</p>
		<ol>
			<li>Click on the Functionalities tab on the sidebar and select View.</li>
			<li>The view menu will be displayed. Click on the 'View records of drivers with yellow IDs' link.</li>
			<li>All of the records in the database with yellow IDs will be shown.</li>
		</ol>
		";
		echo "<p align='right'><a href='#top'>Back to top</a></p>";
		
		echo "<h2 name='account' id='account'>Account</h2>
			<p name='account-pword' id='account-pword'>To <strong>change password</strong>, do the following:</p>
			<ol>
				<li>Account tab > Change password.</li>
				<li>Fill your current password in the 'old password' field and the new password in the 'new password'.</li>
				<li>Click submit.</li>
			</ol>
		";
		if ($role == 'administrator') echo "<p align='right'><a href='#top'>Back to top</a></p>";
		
		
		if ($role == 'administrator') {
			echo "<h2 name='admin' id='admin'>Administrator-only functions</h2>
			<center><img src='" . base_url() . "images/protection.jpg' name='admin-protection' id='admin-protection' /><br /><strong>Figure 4.</strong> Display of all the users in the system.</center>
			<p>There are three kinds of <strong>users</strong> in the system:</p>
			<ol>
				<li>Administrator</li>
				<li>Student Assistant</li>
				<li>University Police Force</li>
			</ol>
			<p>Each kind has limitations set. The Administrator can control everything in the system. The Student Assistant has similar settings with the administrator, except the control of users. Only the Administrator can register a user, view users, view and edit user profiles, and delete users. The University Police Force has the least access settings because only the search and view functionalities are available.</p>
			<p name='admin-reg' id='admin-reg'>As an administrator, you are the only one who can <b>register a user</b>. To do that, do the following:</p>
			<ol>
				<li>Account tab > Register User.</li>
				<li>Fill in the necessary information. (Note: you cannot add another administrator. Only one administrator is allowed in the database.)</li>
				<li>Click submit.</li>
				<li>For the user you registered to log, he/she must verify his/her account first.</li>
			</ol>
			<p name='admin-view' id='admin-view'>As an administrator, you are the only one who can <b>view users registered in the database</b>. To do that, do the following:</p>
			<ol>
				<li>Account tab > View Users.</li>
				<li>All the users registered in the database will be printed.</li>
			</ol>
			<p name='admin-viewprof' id='admin-viewprof'>As an administrator, you are the only one who can <b>view profiles of the users registered in the database</b>. To do that, do the following:</p>
			<ol>
				<li>Account tab > View Users.</li>
				<li>All the users registered in the database will be printed. Click on the username of the user whose profile you wanted to view.</li>
				<li>The profile of that user is displayed.</li>
			</ol>
			<p name='admin-del' id='admin-del'>As an administrator, you are the only one who can <b>delete users</b>. To do that, do the following:</p>
			<ol>
				<li>Account tab > View Users.</li>
				<li>All the users registered in the database will be printed. Click on the delete link on the right side of the information of the user you wanted to delete (Note: the administrator cannot be deleted).</li>
				<li>A page will be displayed asking you if you are certain in deleting the user. Click 'yes' if you are sure and 'no' if you are not.</li>
			</ol>
			<p name='admin-edit' id='admin-edit'>As an administrator, you are the only one who can <b>edit user information</b>. To do that, do the following:</p>
			<ol>
				<li>Account tab > View Users.</li>
				<li>All the users registered in the database will be printed. Click on the edit link on the right side of the information of the user you wanted to edit (Note: the role of the administrator cannot be edited).</li>
				<li>An edit link is also available on the profile of the user.</li>
			</ol>
			";
		}
		
		include("footer.php");
	}
?>