<?php
/* 
------------------
Language: English
------------------
*/

$lang = array();

header('Content-Type: text/html; charset=utf-8');
//SIGN_UP
$lang['SIGN_UP'] = 'Sign up';
$lang['UNAME'] = 'Username (alias)';
$lang['FNAME'] = 'First Name';
$lang['SNAME'] = 'Last Name';
$lang['EMAIL'] = 'Email';
$lang['PASSWORD'] = 'Password';
$lang['SIGN_IN'] = 'Sign In';
$lang['ALREADY_USED_EMAIL_MESSAGE'] = "<div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>";
			  $lang['CLICK_HERE_TO_ACTIVATE']= "CLICK HERE TO ACTIVATE";
$lang['TEXTO_EMAIL_BIENVENIDA']= "					
						
						<br /><br />
						Welcome to Novamex!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
							<br /><br />";
$lang['CONFIRM_REGISTRATION']= "Confirm Registration";
$lang['REGISTRATION_OK']= "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";

//SIGN_IN
$lang['PASSWORD_LOST'] = 'Lost your Password?';

//FORGOT PASSWORD
$lang['FORGOT_PASSWORD_TEXT'] = 'Please enter your email address. You will receive a link to create a new password via email.!';
$lang['FORGOT_PASSWORD'] = 'Forgot Password';
$lang['GENERATE_PASSWORD'] = 'Generate new Password';

// HOME.PHP

$lang['MEMBER_HOME'] = 'Member Home';
$lang['HOME'] = 'Home';
$lang['PROFILE'] = 'Profile';
$lang['ADMIN_ZONE'] = 'Admin Zone';
$lang['LOGOUT'] = 'LogOut';
$lang['USER'] = 'User ';
$lang['MESSAGES'] = 'Messages ';

$lang['NEWS'] = 'News';
$lang['INBOX'] = 'Inbox';
$lang['SENT'] = 'Sent ';
$lang['BY'] = 'by ';

// ADMIN_HOME.PHP

$lang['DEPARTMENTS'] = 'Departaments';
$lang['LEVEL_5_OPTIONS'] = 'Level 5 Options';
$lang['WELCOME_MESSAGE'] = 'Welcome Message';
$lang['BUSINESS_UNITS'] = 'Business Units';
$lang['USERS'] = 'Users';


// ADMIN_HOME.PHP

$lang['EDIT_WELCOME_MESSAGE'] = 'Edit Welcome Message';
$lang['SEND_WELCOME_MESSAGE'] = 'Send';


// ADMIN_NEWS.PHP
$lang['ADD_NEWS'] = 'Add News';
$lang['NUMBER_OF_NEWS_TO_SHOW'] = 'Number of News to show';
$lang['TEXT'] = 'Text';
$lang['TITLE'] = 'Title';
$lang['ADDED_BY'] = 'Added  by';
$lang['DATE'] = 'Date';
$lang['ACTIVE'] = 'Active?';
$lang['ACTIONS'] = 'Actions';
$lang['YES'] = 'Yes';
$lang['PROCESSING'] = 'Processing data...';



// ADMIN_BU.PHP
$lang['ADD_BU'] = 'Add Business Unit';
$lang['BUSINESS_UNIT'] = 'Business Unit';

// ADMIN_DEPARTMENT.PHP
$lang['ADD_DEPARTMENT'] = 'Add Department';
$lang['DEPARTMENT'] = 'Departament';

// ADMIN_USUARIOS.PHP
$lang['ADD_USER'] = 'Add User';
$lang['USERNAME'] = 'User Name (alias)';
$lang['FIRST_NAME'] = 'First Name';
$lang['LAST_NAME'] = 'Last Name';
$lang['USER_LEVEL'] = 'User Level';
$lang['ACTIVATED'] = 'Activated?';
$lang['SUPERVISOR'] = 'Supervisor';

// MENSAJES.PHP
$lang['ADD_MESSAGE'] = 'New Message';
$lang['TO'] = 'To';
$lang['FROM'] = 'From';
$lang['MESSAGE_TITLE'] = 'Message Title';
$lang['MESSAGE_TEXT'] = 'Message Text';
$lang['READ'] = 'Read?';
$lang['DATE'] = 'Date/Time';
$lang['ANSWERED'] = 'Answered?';
$lang['SENT_MESSAGES'] = 'Sent Messages';
$lang['RECEIVED_MESSAGES'] = 'Received Messages';
$lang['NO_MESSAGE'] = 'You have no new mail';


//EQUPOS Y PROYECTOS
$lang['TEAMS'] = 'Teams';
$lang['TEAM'] = 'Team';
$lang['TEAM_MEMBERS'] = 'Team Members';
$lang['PROJECTS'] = 'Projects';
$lang['PROJECT'] = 'Project';
$lang['ADD_TEAM'] = 'New Team';
$lang['CREATION_DATE'] = 'Creation Date';
$lang['TEAM_NAME'] = 'Team Name';


//MIEMBROS EQUIPO
$lang['ADD_TEAM_MEMBER'] = 'Add Team Member';
$lang['EMPLOYEE'] = 'Employee';
$lang['START_DATE'] = 'Start Date';
$lang['END_DATE'] = 'End Date';

//PROYECTOS
$lang['ADD_PROJECT'] = 'Add Project';
$lang['PROJECT_DESCRIPTION'] = 'Project Description';
$lang['PROJECT_TYPE'] = 'Project Type';

$lang['EVALUATOR'] = 'Evaluator';

$lang['POINTS'] = 'Points';

//MIS DATOS PERSONALES
$lang['PERSONAL_INFO'] = 'Personal Information';
$lang['NOT_EDITABLE_DATA'] = 'Non-editable data';
$lang['EDITABLE_DATA'] = 'Editable data';
$lang['UPDATE_DATA'] = 'Update data';
$lang['SUCCESS'] = 'Success!';
$lang['UPDATED'] = 'Data updated successfully';

//MIS PROYECTOS
$lang['MY_PROJECTS'] = 'My Projects';
$lang['AS_TEAM_MEMBER'] = 'As Team Member';
$lang['AS_EVALUATOR'] = 'As Evaluator';
$lang['LANGUAGE'] = 'Default Language';

$lang['PROJECT_TYPES'] = 'Project Types';
$lang['PROJECT_INFO'] = 'Project Data';
$lang['PROJECT_NAME'] = 'Project Name';
$lang['START_DATE_PROJECT'] = 'Project Start Date';
$lang['END_DATE_PROJECT'] = 'Project End Date';
$lang['PROJECT_TEAM'] = 'Project Team';
$lang['PROJECT_EVALUATOR'] = 'Project Evaluator';
$lang['DELIVERABLES'] = 'Deliverables';
$lang['NEW_DELIVERABLE'] = 'Add New Deliverable';
$lang['TITLE_DELIVERABLE'] = 'Deliverable Title';
$lang['DESCRIPTION_DELIVERABLE'] = 'Deliverable Description';
$lang['CREATED'] = 'Deliverable uploaded successfully';

$lang['UPLOAD_DELIVERABLE'] = 'Upload Deliverable';

$lang['FILE_DELIVERABLE'] = 'Deliverable File';
$lang['FILE_NAME'] = 'Deliverable File Name';
$lang['SELECT_FILE'] = 'Select File';

?>