<?php
include_once 'common.php';

if( $_POST ){
	
    $nombre_revision = $_POST['nombre_revision'];
   $fecha_revision = $_POST['fecha_revision'];
   $id_revisiones_proyectos = $_POST['id_revisiones_proyectos'];
 
    
 $db_host = "localhost";
 $db_name = "herasosj_novamex";
 $db_user = "herasosj_novamex";
 $db_pass =  "Papa020432";
 
 // Change the line below to your timezone!
 date_default_timezone_set('America/Chihuahua');
 $date = date('Y-m-d H:i:s');

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($stmt = $conn->prepare("UPDATE tb_revisiones_proyectos SET nombre_revision = ?, fecha_revision = ?, fecha_evaluacion = ?
WHERE id_revisiones_proyectos=?"))
{
	$stmt->bind_param("sssi", $nombre_revision, $fecha_revision, $date, $id_revisiones_proyectos);
	$stmt->execute();
	$stmt->close();
}


   

?>
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong><?php echo $lang['SUCCESS']?></strong>, <?php echo $lang['REVISION_UPDATED']?>
    	</div>
    </td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['REVISION_NAME']?>: </strong></td>
    <td><?php echo $nombre_revision ?></td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['REVISION_DATE']?>: </strong></td>
    <td><?php echo $fecha_revision ?></td>
    </tr>
 
    <tr>
    
    
    
    </table>
    <?php
	
}