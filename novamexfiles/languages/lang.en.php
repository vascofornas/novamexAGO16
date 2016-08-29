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






?>