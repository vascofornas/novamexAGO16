<?php
include_once 'common.php';

if( $_POST ){
	
    $puntos_obtenidos = $_POST['puntos_obtenidos'];
   $comentarios_evaluados = $_POST['comentarios_evaluados'];
   $id_evaluacion_proyectos = $_POST['id_evaluacion_proyectos'];
 $estado_evaluacion = 1;
    
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

if ($stmt = $conn->prepare("UPDATE tb_evaluaciones_proyectos SET puntos_obtenidos = ?, comentarios_evaluados = ?, 
		estado_evaluacion = ?
WHERE id_evaluacion_proyectos=?"))
{
	$stmt->bind_param("dsii", $puntos_obtenidos, $comentarios_evaluados,$estado_evaluacion, $id_evaluacion_proyectos);
	$stmt->execute();
	$stmt->close();
}


   

?>
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong><?php echo $lang['SUCCESS']?></strong>, <?php echo $lang['EVALUATION_UPDATED']?>
    	</div>
    </td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['EVALUATION_POINTS']?>: </strong></td>
    <td><?php echo $puntos_obtenidos." ".$id_evaluacion_proyectos ?></td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['EVALUATION_COMMENTS']?>: </strong></td>
    <td><?php echo $comentarios_evaluados ?></td>
    </tr>
 
    <tr>
    
    
    
    </table>
    <?php
	
}