<?php require_once('Connections/conexion.php'); 
header('Content-type: text/html; charset=utf-8' , true );
include_once 'common.php';
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM tb_welcome_message WHERE tb_welcome_message.id_mensaje =1";
$Recordset1 = mysqli_query($conexion,$query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

mysqli_select_db($conexion,$database_conexion);
$query_Recordset2 = "SELECT * FROM tb_news WHERE tb_news.active_news = 1";
$Recordset2 = mysqli_query($conexion,$query_Recordset2) or die(mysql_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);


 
session_start();
require_once 'class.user.php';
$user_home = new USER();
if (!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
textarea {
    background: yellow !important;
    color:#000;
    text-shadow:0 1px 0 rgba(0, 0, 0, 0.4);
}
</style>
<title><?php echo $row['userName']?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp_free_points_level3.js"></script>


<style type="text/css">
    .bs-example{
    	margin: 20px;
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
<style type="text/css">
.styled-select {
   background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
   height: 29px;
   overflow: hidden;
   width: 240px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
}

.styled-select.slate {
   background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #3b8ec2; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #fff; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
   background: #58B14C url("http://i62.tinypic.com/15xvbd5.png") no-repeat scroll 319px center;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
}

select#soflow-color {
   color: #fff;
   background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#779126, #779126 40%, #779126);
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px;
}
body {
	
}
</style>
</head> 
<body>

<?php include 'menu.php';?>
<div class="container">
	<div class="row">

    </div>
    </div>
</div>


    <p>&nbsp;</p>
    <h1 align="center"><?php echo $lang['FREE_POINTS']?></h1>
    <p align="center">&nbsp;</p>
    <div id="page_container">

      

      <div align="center">
        <button type="button" class="button" id="add_company"><?php echo $lang['ADD_FREE_POINTS']?></button>
        
      </div>
      <table class="datatable" id="table_companies">
        <thead>
          <tr>
           
            
            
            <th><?php echo $lang['ASSIGNED_TO']?></th>
            <th><?php echo $lang['ASSIGNED_POINTS']?></th>
            <th><?php echo $lang['COMMENTS']?></th>
            <th><?php echo $lang['DATE']?></th>
       
         
            
            <th><?php echo $lang['ACTIONS']?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

</div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
        
        <h2><?php echo $lang['ADD_FREE_POINTS']?></h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          
       
       
         <?php   $sqlBU="SELECT * FROM tbl_users";?>
           
<div class="input_container">
        <label for="recibe_usuario"><?php echo $lang['ASSIGNED_TO']?>: <span class="required">*</span></label>
            <div class="styled-select slate">
              <select  id="recibe_usuario" name="recibe_usuario" class="selectpicker"  required>
           
           
        <?php   if ($result=mysqli_query($conexion,$sqlBU))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    	
    	$recibe_limit = $row[0];
    	$id_limit = base64_decode( urldecode( $_GET['pu'] ) );
    	$otorga_limit = $_SESSION['userSession'];
    	$resultado = get_user_repite_puntos_libres($id_limit, $otorga_limit, $recibe_limit);
    	
    	 if ($resultado>0 ){
    printf ("%s (%s)\n",$row[0],$row[1]);
    echo '<option value='.$row[0].' disabled style="color:RED;">'.$lang['NOT-AVAILABLE']." ".$row[7].' '.$row[8].'</option>';
    	 }
    	 else {
    	 	printf ("%s (%s)\n",$row[0],$row[1]);
    	 	echo '<option value='.$row[0].' selected>'.$row[7].' '.$row[8].'</option>';
    	 	
    	 }
    }
  // Free result set
  mysqli_free_result($result);
}
     ?>           
                
                
                
               
                
                
                
              </select>
            </div>
          </div>
 
     <div class="input_container">
            <label for="puntos_otorgados"><?php echo $lang['ASSIGNED_POINTS']?> <span class="required">*</span></label>
            <div class="field_container">
            <?php 
            
            $decoded = base64_decode( urldecode( $_GET['pu'] ) );
            $max_puntos = get_max_puntos_libres($decoded);
            
            ?>
              <input type="number" max="<?php echo $max_puntos?>" class="text" name="puntos_otorgados" id="puntos_otorgados" value="" >
            </div>
          </div>  
     <div class="input_container">
            <label for="comentarios_otorgados"><?php echo $lang['COMMENTS']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="comentarios_otorgados" id="comentarios_otorgados" value="" required>
            </div>
          </div>
          <?php 
         
          ?>
            <input type="hidden" class="text" name="id_puntos" id="id_puntos" value="<?php echo $decoded ?>" >
            
          <div class="button_container">
          
          
         
            <button type="submit"><?php echo $lang['ADD_FREE_POINTS']?></button>
          </div>
        </form>
        
      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
           <?php echo $lang['PROCESSING']?>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>
<?php

?>
