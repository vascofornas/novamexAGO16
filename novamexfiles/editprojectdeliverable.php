<?php
include_once 'common.php';

if( $_POST ){
	
    $titulo_entregable = $_POST['titulo_entregable'];
   $descripcion_entregable = $_POST['descripcion_entregable'];
   $proyecto_entregable = $_POST['proyecto_entregable'];
   $nombre_entregable = $_POST['nombre_entregable'];
 
    



 $db_host = "localhost";
 $db_name = "herasosj_novamex";
 $db_user = "herasosj_novamex";
 $db_pass =  "Papa020432";
 


// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO tb_entregables_proyecto (titulo_entregable, descripcion_entregable, proyecto_entregable, nombre_entregable)
VALUES ('$titulo_entregable', '$descripcion_entregable', '$proyecto_entregable', '$nombre_entregable')";

if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
   

?>
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong><?php echo $lang['SUCCESS']?></strong>, <?php echo $lang['CREATED']?>...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['TITLE_DELIVERABLE']?>: </strong></td>
    <td><?php echo $titulo_entregable ?></td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['DESCRIPTION_DELIVERABLE']?>: </strong></td>
    <td><?php echo $descripcion_entregable ?></td>
    </tr>
    
   <tr>
    <td><strong><?php echo $lang['DESCRIPTION_DELIVERABLE']?>: </strong></td>
    <td><?php echo $nombre_entregable ?></td>
    </tr>
    
    <tr>
    
    
    
    </table>
    <?php
	
}