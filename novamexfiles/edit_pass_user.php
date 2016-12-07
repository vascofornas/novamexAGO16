<?php
include_once 'common.php';
include_once 'funciones.php';

if( $_POST ){
	
   
   $nueva = $_POST['nueva'];
   $confirmar = $_POST['confirmar'];
 
    
    $id = $_SESSION['userSession'];
    

    $password = md5($nueva);

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
    	
    	
    	
    
    	$stmt = $db_con->prepare("UPDATE tbl_users SET  userPass=:idi WHERE userID=:id");
    	

    	$stmt->bindParam(":idi", $password);
    	
    

    	$stmt->bindParam(":id", $id);
    
    	if($stmt->execute())
    	{
    		$texto = "USUARIO MODIFICA SU CONTRASEÑA";
    		$email = get_email($_SESSION['userSession']);
    		$codigo = "401";
    		add_log($texto,$email,$codigo);
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
    
   
    
    
    </table>
    <?php
	
}