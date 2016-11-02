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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp_rci.js"></script>

 <script>
  $(document).ready(function() {

    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    $('#fecha_inicio_req_interno').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });;
    $('#fecha_final_proyecto').datepicker({
        minDate: new Date(currentYear, currentMonth, currentDate),
        dateFormat: 'yy-mm-dd'
    });;
  });
  </script>

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
</head> 
<body>


<?php include 'menu_admin.php'?>
<div class="container">
	<div class="row">

    </div>
    </div>
</div>


    <p>&nbsp;</p>
    <h1 align="center"><?php echo $lang['REQUERIMIENTOS_CLIENTE_INTERNO']?></h1>
    <p align="center">&nbsp;</p>
    <div id="page_container">

      

      <div align="center">
        <button type="button" class="button" id="add_company"><?php echo $lang['ADD_PROJECT']?></button>
        
      </div>
      <table class="datatable" id="table_companies">
        <thead>
          <tr>
           
             <th><?php echo $lang['CUSTOMER']?></th>
            <th><?php echo $lang['SUPERVISOR']?></th>
           
              <th><?php echo $lang['INTERNAL_SUPPLIER']?></th>
              <th><?php echo $lang['TITLE_REQ']?></th>
              <th><?php echo $lang['START_DATE_REQ']?></th>
             
              <th><?php echo $lang['STATUS']?></th>
              
         
            
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
        
        <h2><?php echo $lang['ADD_PROJECT']?></h2>
        <form class="form add" id="form_company" data-id="" novalidate>
           <?php   $sqlevaluador="SELECT * FROM tbl_users ORDER BY nombre_usuario";?>
        <div class="input_container">
        <label for="cliente_req_interno"><?php echo $lang['CUSTOMER']?>: <span class="required">*</span></label>
            <div class="styled-select slate">
              <select  id="cliente_req_interno" name="cliente_req_interno" class="selectpicker"  required>
           
           
        <?php   if ($resultevaluador=mysqli_query($conexion,$sqlevaluador))
  {
  // Fetch one and one row
  while ($rowevaluador=mysqli_fetch_row($resultevaluador))
    {
    printf ("%s (%s)\n",$rowevaluador[0],$rowevaluador[1]);
    echo '<option value='.$rowevaluador[0].' selected>'.$rowevaluador[7].' '.$rowevaluador[8].'</option>';
    }
  // Free result set
  mysqli_free_result($resultevaluador);
}
     ?>           
                
                
                
               
                
                
                
              </select>
            </div>
          </div>
          
          
          
                 <?php   $sqlevaluador="SELECT * FROM tbl_users ORDER BY nombre_usuario";?>
        <div class="input_container">
        <label for="proveedor_req_interno"><?php echo $lang['INTERNAL_SUPPLIER']?>: <span class="required">*</span></label>
            <div class="styled-select slate">
              <select  id="proveedor_req_interno" name="proveedor_req_interno" class="selectpicker"  required>
           
           
        <?php   if ($resultevaluador=mysqli_query($conexion,$sqlevaluador))
  {
  // Fetch one and one row
  while ($rowevaluador=mysqli_fetch_row($resultevaluador))
    {
    printf ("%s (%s)\n",$rowevaluador[0],$rowevaluador[1]);
    echo '<option value='.$rowevaluador[0].' selected>'.$rowevaluador[7].' '.$rowevaluador[8].'</option>';
    }
  // Free result set
  mysqli_free_result($resultevaluador);
}
     ?>           
                
                
                
               
                
                
                
              </select>
            </div>
          </div>
          <div class="input_container">
            <label for="titulo_req_interno"><?php echo $lang['TITLE_REQ']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="titulo_req_interno" id="titulo_req_interno" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="descripcion_req_interno"><?php echo $lang['DESC_REQ']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="descripcion_req_interno" id="descripcion_req_interno" value="" required>
            </div>
          </div>
       
       
           <div class="input_container">
            <label for="fecha_inicio_req_interno"><?php echo $lang['START_DATE']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="fecha_inicio_req_interno" id="fecha_inicio_req_interno" value="" required>
            </div>
          </div>
       
       
           <div class="input_container">
             
                      <label><?php echo $lang['PERIODICITY']?></label>
                        <div class="styled-select slate">
                   <select id="periodicidad" name="periodicidad" class="form-control select2" style="width: 100%;">
                        <option selected="selected" value="1"><?php echo $lang['ONLY_ONCE']?></option>
                      <option value="2"><?php echo $lang['EVERYDAY']?></option>
                      <option value="3"><?php echo $lang['EVERY_WEEK']?></option>
                      <option value="4"><?php echo $lang['EVERY_TWO_WEEKS']?></option>
                      <option value="5"><?php echo $lang['EVERY_MONTH']?></option>
                      <option value="6"><?php echo $lang['EVERY_TWO_MONTHS']?></option>
                      <option value="7"><?php echo $lang['EVERY_THREE_MONTHS']?></option>
                      <option value="8"><?php echo $lang['EVERY_FOUR_MONTHS']?></option>
                      
                      <option value="9"><?php echo $lang['EVERY_SIX_MONTHS']?></option>
                      
                      <option value="10"><?php echo $lang['EVERY_TWELVE_MONTHS']?></option>
                    </select>  </div>
	
       
       
       </div>
       
          <div class="input_container">
             
                      <label><?php echo $lang['REPEATS']?></label>
                       <div class="styled-select slate">
                      <select id="repeticiones" name="repeticiones" class="form-control select2" style="width: 100%;">
                      <option selected="selected">1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                      </select>  
                       </div> 
	
       
       
       </div>
       
       
       
       
         
       
         

	<div class="input_container">
                      <label><?php echo $lang['CONCEPT']?> 1</label>
                      <div class="field_container">
                     <input type="text" class="form-control" name="concepto1" id="concepto2" placeholder="<?php echo $lang['CONCEPT']?> 1 ...">    </div>
	</div>
	
	<div class="input_container">
                      <label><?php echo $lang['CONCEPT']?> 2</label>
                      <div class="field_container">
                     <input type="text" class="form-control" name="concepto2" id="concepto2" placeholder="<?php echo $lang['CONCEPT']?> 2 ...">    </div>
	</div>
	
	<div class="input_container">
                      <label><?php echo $lang['CONCEPT']?> 3</label>
                      <div class="field_container">
                     <input type="text" class="form-control" name="concepto3" id="concepto3" placeholder="<?php echo $lang['CONCEPT']?> 3 ...">    </div>
	</div>

	<div class="input_container">
                      <label><?php echo $lang['CONCEPT']?> 4</label>
                      <div class="field_container">
                     <input type="text" class="form-control" name="concepto4" id="concepto4" placeholder="<?php echo $lang['CONCEPT']?> 4 ...">    </div>
	</div>
	
	
	
	
		<div class="input_container">
                      <label>Sin PUNTUAR</label>
                      <div class="field_container">
       <input type="text" class="form-control" name="sin_puntuar" id="sin_puntuar"  placeholder="Puntos por sin puntuar ...">  </div>
	</div>

	<div class="input_container">
                      <label>Puntos ESFUERZO LEVE</label>
                      <div class="field_container">
                     <input type="text" class="form-control" name="leve" id="leve" placeholder="Puntos por esfuerzo leve ...">    </div>
	</div>
	
<div class="input_container">
                      <label>Puntos ESFUERZO ACEPTABLE</label>
                      <div class="field_container">
       <input type="text" class="form-control" name="aceptable" id="aceptable"  placeholder="Puntos por esfuerzo aceptable ...">  </div>
	</div>
	
	<div class="input_container">
                      <label>Puntos ESFUERZO EXCEPCIONAL</label>
                      <div class="field_container">
       <input type="text" class="form-control" name="excepcional" id="excepcional"  placeholder="Puntos por esfuerzo excepcional ...">  </div>
	</div>
	
	   <div class="input_container">
             
                      <label><?php echo $lang['STATUS']?></label>
                       <div class="styled-select slate">
                      <select id="estado_req_interno" name="estado_req_interno" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="0"><?php echo $lang['PENDING_APPROVEMENT']?></option>
                      <option value="1"><?php echo $lang['APPROVED']?></option>
                      <option value="2"><?php echo $lang['REJECTED']?></option>
                     
                      </select>  
                       </div> 
	
       
       
       </div>
       
	
          <div class="button_container">
            <button type="submit"><?php echo $lang['ADD_PROJECT']?></button>
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
