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
body {
	background-image: url(fondonovamex.jpg);
}
</style>
</head> 
<body>
 <div class="fixed">
<a href="admin_welcome_message.php?lang=en"><img src="usa.png" width="45" height="45" /></a>
<a href="admin_welcome_message.php?lang=es"><img src="mexico.png" width="45" height="45" /></a>

</div>
<br><br>
<div class="bs-example">
    <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><?php echo $lang['ADMIN_ZONE']?></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="admin_home.php"><?php echo $lang['ADMIN_ZONE']?></a></li>
                <li ><a href="home.php"><?php echo $lang['MEMBER_HOME']?></a></li>
                <li><a href="#"><?php echo $lang['PROFILE']?></a></li>
                     <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['MESSAGES']?><b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#"><?php echo $lang['INBOX']?></a></li>
                        <li><a href="#"><?php echo $lang['SENT']?></a></li>
                        
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['LEVEL_5_OPTIONS']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="admin_welcome_message.php"><?php echo $lang['WELCOME_MESSAGE']?></a></li>
                        <li><a href="admin_news.php"><?php echo $lang['NEWS']?></a></li>
                        <li><a href="admin_bu.php"><?php echo $lang['BUSINESS_UNITS']?></a></li>
                        <li><a href="admin_departamentos.php"><?php echo $lang['DEPARTMENTS']?></a></li>
                        <li><a href="admin_usuarios.php"><?php echo $lang['USERS']?></a></li>
                        
                        <li class="divider"></li>
                        
                    </ul>
                </li>
                
                
                
                
                
            </ul>
            
            <ul class="nav pull-right">
            	<li class="dropdown">
                	<a href="#" role="button"  class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>
                     <?php echo $row['userName']." (". $lang['USER'].$row['userLevel'].")";?> <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu">
                    <li>
                    <a tabindex="-1" href="logout.php">Logout</a>
                    </li>
                    
                    </ul>
              </li>
          </ul> 
        </div>
    </nav>
</div>
<div class="container">
	<div class="row">
     
      <p>&nbsp;</p>
    </div>
</div>
<div class = "container">
   <div class="row">
   <div class="col-xs-12 col-md-8">
     <h2 align="center"><?php echo $lang['EDIT_WELCOME_MESSAGE']?></h2>
   </div>
    <div class="col-xs-12 col-md-8">
      <form method="post" name="form1" action="update_welcome_message.php">
        <div align="center">
          <table align="center">
            <tr valign="baseline">
              <td><textarea name="mensaje" style="width: 100%;" cols="100%" rows="5"><?php echo htmlentities($row_Recordset1['mensaje'], ENT_COMPAT, 'utf-8'); ?> </textarea></td>
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
