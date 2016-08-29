<?php
session_start();
require_once 'class.user.php';
require_once 'funciones.php';
header('Content-type: text/html; charset=utf-8' , true );
include_once 'common.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		
		$texto = "LOGIN DE USUARIO REGISTRADO";
		
		add_log($texto,$email);
		
		$user_login->redirect('home.php');
	}
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8">
    <title>NOVAMEX</title>
    
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    

  <style type="text/css">
  body {
	background-image: url(fondonovamex.jpg);
}
  </style>
  <style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
}
</style>
  
  </head>
  
  <body id="login">
    <div class="fixed" >
<a href="index.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
<a href="index.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>

</div>
    <div class="container">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong Details!</strong> 
			</div>
            <?php
		}
		?>
        <h2 class="form-signin-heading"><?php echo $lang['SIGN_IN']?></h2><hr />
        <input type="email" class="input-block-level" placeholder="<?php echo $lang['EMAIL']?>" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="<?php echo $lang['PASSWORD']?>" name="txtupass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login"><?php echo $lang['SIGN_IN']?></button>
        <a href="signup.php" style="float:right;" class="btn btn-large"><?php echo $lang['SIGN_UP']?></a><hr />
        <a href="fpass.php"><?php echo $lang['PASSWORD_LOST']?></a>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>