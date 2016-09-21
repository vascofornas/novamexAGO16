<?php
include_once 'common.php';

if( $_POST ){
	
    $nombre_usuario = $_POST['nombre_usuario'];
   $apellidos_usuario = $_POST['apellidos_usuario'];
   $idioma_usuario = $_POST['idioma_usuario'];
 
    
    $id = $_POST['userID'];
    



 $db_host = "localhost";
 $db_name = "herasosj_novamex";
 $db_user = "herasosj_novamex";
 $db_pass =  "Papa020432";
 
 try{
  
  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }

?>
    <?php

    {
    	
    
    	$stmt = $db_con->prepare("UPDATE tbl_users SET nombre_usuario=:en, apellidos_usuario=:es, idioma_usuario=:idi WHERE userID=:id");
    	$stmt->bindParam(":en", $nombre_usuario);
    	$stmt->bindParam(":es", $apellidos_usuario);

    	$stmt->bindParam(":idi", $idioma_usuario);
    

    	$stmt->bindParam(":id", $id);
    
    	if($stmt->execute())
    	{

    	}
    	else{
    		echo "Query Problem";
    	}
    }
?>
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong><?php echo $lang['SUCCESS']?></strong>, <?php echo $lang['UPDATED']?>...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['FIRST_NAME']?>: </strong></td>
    <td><?php echo $nombre_usuario ?></td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['LAST_NAME']?>: </strong></td>
    <td><?php echo $apellidos_usuario ?></td>
    </tr>
      <tr>
    <td><strong><?php echo $lang['LANGUAGE']?>: </strong></td>
    <td><?php echo $idioma_usuario ?></td>
    </tr>
    
   
    <tr>
    
    
    
    </table>
    <?php
	
}