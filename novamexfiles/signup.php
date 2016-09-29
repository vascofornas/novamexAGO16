<?php
session_start();

include_once 'common.php';
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('home.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
		$unombre = trim($_POST['txtunombre']);
			$uapellidos = trim($_POST['txtuapellidos']);
				$uidioma = trim($_POST['idioma']);
	
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg =  $lang['ALREADY_USED_EMAIL_MESSAGE'];
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code, $unombre,$uapellidos,$uidioma))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;		
			
			
			$message = $uname;
			$message .= $lang['TEXTO_EMAIL_BIENVENIDA'];
			$message .= "<a href='http://juarezserver.com/novamex/verify.php?id=$id&code=$code'>".$lang['CLICK_HERE_TO_ACTIVATE']."</a>";
						
			$subject = $lang['CONFIRM_REGISTRATION'];
			
			$texto = "REGISTRO DE USUARIO REALIZADO";
			
			add_log($texto,$email);
			
			
			$reg_user->send_mail($email,$message,$subject);	
			$msg = $lang['REGISTRATION_OK'];;
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>NOVAMEX</title>
    <!-- Bootstrap -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-form-helpers.min.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
   <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <style type="text/css">
 html, body{
  height: 100%;
}
body { 
			background-image: url(sLSdbm.jpg) ;
			background-position: center center;
			background-repeat:  no-repeat;
			background-attachment: fixed;
			background-size:  cover;
			background-color: #999;
  
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
  
  <div class="fixed">
<a href="signup.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
<a href="signup.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>

</div>
  <div class="container">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading"><?php echo $lang['SIGN_UP']?></h2><hr />
        <input type="text" class="input-block-level" placeholder="<?php echo $lang['UNAME']?>" name="txtuname" required />
         <input type="text" class="input-block-level" placeholder="<?php echo $lang['FNAME']?>" name="txtunombre" required />
        
         <input type="text" class="input-block-level" placeholder="<?php echo $lang['SNAME']?>" name="txtuapellidos" required />
        
        <input type="email" class="input-block-level" placeholder="<?php echo $lang['EMAIL']?>" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="<?php echo $lang['PASSWORD']?>" name="txtpass" required />
        <select name="idioma">
          <option value="en" selected="selected">English</option>
          <option value="es">Espa&ntilde;ol</option>
        </select>
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup"><?php echo $lang['SIGN_UP']?></button>
        <a href="index.php" style="float:right;" class="btn btn-large"><?php echo $lang['SIGN_IN']?></a>
     <br><br><br>
        <img src="logonovamex100.png" alt="Mountain View" style="width:414px;height:110px;">
     
      </form>

    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-formhelpers.min.js"></script>
  </body>
</html>