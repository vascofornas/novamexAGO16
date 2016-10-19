<?php
include_once 'common.php';

if( $_POST ){
	
    $puntos_obtenidos = $_POST['puntos_obtenidos'];
   $comentarios_evaluados = $_POST['comentarios_evaluados'];
   $id_evaluacion_proyectos = $_POST['id_evaluacion_proyectos'];

   $proyecto_evaluado = $_POST['proyecto_evaluado'];
   $revision_evaluada = $_POST['revision_evaluada'];
   $codigo_opcion_evaluacion = $_POST['codigo_opcion_evaluacion'];
   
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

$loop_puntos = mysqli_query($conn, "SELECT * FROM tb_puntos_temporales WHERE revision_puntos_temporales =  '$revision_evaluada'")
		or die (mysqli_error($dbh));
		$suma_puntos = 0;
		while ($row_puntos = mysqli_fetch_array($loop_puntos))
		{
			
			$suma_puntos = $suma_puntos+1;
				}
		if ($suma_puntos > 0){
			echo "YA ESTA EVALUADO ".$suma_puntos;
			
			
			
			if ($stmt = $conn->prepare("UPDATE tb_puntos_temporales SET puntos_temporales = ?, comentarios_puntos_temporales = ?
			
			WHERE revision_puntos_temporales=?"))
			{
				$stmt->bind_param("dsi", $puntos_obtenidos, $comentarios_evaluados,$revision_evaluada);
				$stmt->execute();
				$stmt->close();
			}
		}
		else {
			echo "NO ESTA EVALUADO ".$suma_puntos;
			
			
					
				
			
						
						if ($stmt = $conn->prepare("INSERT INTO tb_puntos_temporales SET puntos_temporales = ?, comentarios_puntos_temporales = ?,
								revision_puntos_temporales = ?
					
						"))
						{
							$stmt->bind_param("dsi", $puntos_obtenidos, $comentarios_evaluados, $revision_evaluada);
							$stmt->execute();
							$stmt->close();
						}
						
			
			
			
			
			
			
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
    <td><?php echo $puntos_obtenidos ?></td>
    </tr>
    
    <tr>
    <td><strong><?php echo $lang['EVALUATION_COMMENTS']?>: </strong></td>
    <td><?php echo $comentarios_evaluados ?></td>
    </tr>
 <tr>
    <td><strong><?php echo $lang['EVALUATION_COMMENTS']?>: </strong></td>
    <td><?php echo $proyecto_evaluado ?></td>
    </tr>
    <tr>
    <td><strong><?php echo $lang['EVALUATION_COMMENTS']?>: </strong></td>
    <td><?php echo $revision_evaluada ?></td>
    </tr>
    <tr>
    <tr>
    <td><strong><?php echo $lang['EVALUATION_COMMENTS']?>: </strong></td>
    <td><?php echo $codigo_opcion_evaluacion ?></td>
    </tr>
    <tr>
    
    </table>
    <?php
	
}