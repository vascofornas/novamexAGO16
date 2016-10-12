<?php require_once('Connections/conexion.php');
include_once 'common.php';
mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM tb_welcome_message WHERE tb_welcome_message.id_mensaje = 1";
$Recordset1 = mysqli_query($conexion,$query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

session_start();








require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<style>
div.fixed {
    position: fixed;
    right: 10px;
    top: 10px;
    width: 300px;
 
}
div.logo {
    position: fixed;
    left: 20px;
    top: 10px;
    width: 414px;
 
}
</style>
<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
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
/* Firefox old*/
@-moz-keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
} 

@-webkit-keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
}
/* IE */
@-ms-keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
} 
/* Opera and prob css3 final iteration */
@keyframes blink {
    0% {
        opacity:1;
    }
    50% {
        opacity:0;
    }
    100% {
        opacity:1;
    }
} 
.blink-image {
    -moz-animation: blink normal 2s infinite ease-in-out; /* Firefox */
    -webkit-animation: blink normal 2s infinite ease-in-out; /* Webkit */
    -ms-animation: blink normal 2s infinite ease-in-out; /* IE */
    animation: blink normal 2s infinite ease-in-out; /* Opera and prob css3 final iteration */
}
</style>
</head> 
<body>
<?php include 'menu_admin.php';?>
<div class="container">
	<div class="row">
     
      <p>&nbsp;</p>
    </div>
</div>
<div class = "container">
   <div class="row">
   <div class="col-xs-12 col-md-8">
     <h2 align="center"><?php echo $lang['EDIT_WELCOME_MESSAGE']?><a href=""><img src="mexico.png" width="45" height="45" /></a>
     </h2>
   </div>
    <div class="col-xs-12 col-md-8">
      <form method="post" name="form1" action="update_welcome_message.php">
        <div align="center">
          <table align="center">
            <tr valign="baseline">
              <td><textarea name="mensaje" style="width: 100%;" cols="100%" rows="5"><?php echo htmlentities($row_Recordset1['mensaje_es'], ENT_COMPAT, 'utf-8'); ?> </textarea></td>
            </tr>
            <tr valign="baseline">
              <td><input name="submit" type="submit" value="<?php echo $lang['SEND_WELCOME_MESSAGE']?>"></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="id_mensaje" value="<?php echo $row_Recordset1['id_mensaje']; ?>">
        </div>
      </form>
      <p align="center">&nbsp;</p>
    </div>
  
  </div>
   </div>
   
   <div class = "container">
   <div class="row">
   <div class="col-xs-12 col-md-8">
     <h2 align="center"><?php echo $lang['EDIT_WELCOME_MESSAGE']?><a href=""><img src="usa.png" width="45" height="45" /></a></h2>
   </div>
    <div class="col-xs-12 col-md-8">
      <form method="post" name="form1" action="update_welcome_message_en.php">
        <div align="center">
          <table align="center">
            <tr valign="baseline">
              <td><textarea name="mensaje" style="width: 100%;" cols="100%" rows="5"><?php echo htmlentities($row_Recordset1['mensaje_en'], ENT_COMPAT, 'utf-8'); ?> </textarea></td>
            </tr>
            <tr valign="baseline">
              <td><input name="submit" type="submit" value="<?php echo $lang['SEND_WELCOME_MESSAGE']?>"></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="id_mensaje" value="<?php echo $row_Recordset1['id_mensaje']; ?>">
        </div>
      </form>
      <p align="center">&nbsp;</p>
    </div>
  
  </div>
   </div>
</body>
</html>
<?php


?>
