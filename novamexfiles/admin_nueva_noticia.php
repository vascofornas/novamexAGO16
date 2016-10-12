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

<?php  include 'menu_admin.php'?>
<div class = "container">
   <div class="row">
   <div class="col-xs-12 col-md-12">
     <h2 align="center"><?php echo $lang['ADD_NEWS']?><a href=""></a>
     </h2>
   </div>
    <div class="col-xs-12 col-md-12">
 
        <form class="form add"  data-id="" action="nueva_noticia.php" method="post">
          
          <div class="input_container">
            <label for="title_news"><?php echo $lang['TITLE']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text col-xs-12 col-md-12" name="title_news" id="title_news" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="title_news_en"><?php echo $lang['TITLE_EN']?>: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text col-xs-12 col-md-12" name="title_news_en" id="title_news_en" value="" required>
            </div>
          </div>
        <div class="input_container">
            <label for="text_news"><?php echo $lang['TEXT']?>: <span class="required">*</span></label>
            <div class="field_container">
             <textarea class="form-control col-xs-12" rows="5"  style="width: 100%;" cols="100%"  id="text_news" name="text_news"></textarea>
             
             
                 </div>
         
               <div class="input_container">
            <label for="text_news"><?php echo $lang['TEXT_EN']?>: <span class="required">*</span></label>
            <div class="field_container">
             <textarea class="form-control col-xs-12" rows="5"  style="width: 100%;" cols="100%"  id="text_news_en" name="text_news_en"></textarea>
             
             
                 </div>
         
       
          
           
<div class="input_container">
        <label for="active_news"><?php echo $lang['ACTIVE']?>: <span class="required">*</span></label>
            <div class="styled-select slate">
              <select  id="active_news" name="active_news" class="selectpicker col-xs-12 col-md-12"  required>
                <option value="1" selected><?php echo $lang['YES']?></option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          
         
          <div class="button_container">
          <br><br><br>
          <input type="hidden" class="text col-xs-12 col-md-12" name="user_news" id="user_news" value="<?php echo $row['userName']?>" required>
          
            <button type="submit"><?php echo $lang['ADD_NEWS']?></button>
          </div>
        </form>
        
      </div>
    </div>
     
    </div>
  
  </div>
   </div>
   

</body>
</html>
<?php


?>
