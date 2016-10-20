<?php
include_once 'common.php';
include_once 'funciones.php';
include_once 'class.user.php';

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
			
			
			$loop_usuarios_editados = mysqli_query($conn, "SELECT * FROM tb_miembros_equipos
					LEFT JOIN tb_proyectos ON tb_miembros_equipos.equipo = tb_proyectos.equipo_proyecto
					WHERE tb_proyectos.id_proyecto =   '$proyecto_evaluado'")
					or die (mysqli_error($dbh));
					$suma_puntos = 0;
					while ($row_usuarios_editados = mysqli_fetch_array($loop_usuarios_editados))
					{
			
						$usuario_editado= $row_usuarios_editados['usuario'];
			
			if ($stmt = $conn->prepare("UPDATE tb_puntos_temporales SET puntos_temporales = ?, comentarios_puntos_temporales = ?
			
			WHERE revision_puntos_temporales=? AND usuario_puntos_temporales = ?"))
			{
				$stmt->bind_param("dsii", $puntos_obtenidos, $comentarios_evaluados,$revision_evaluada, $usuario_editado);
				$stmt->execute();
				$stmt->close();
			}
		}
		}
		else {
			
			
			
			$loop_usuarios = mysqli_query($conn, "SELECT * FROM tb_miembros_equipos
					LEFT JOIN tb_proyectos ON tb_miembros_equipos.equipo = tb_proyectos.equipo_proyecto 
					WHERE tb_proyectos.id_proyecto =   '$proyecto_evaluado'")
			or die (mysqli_error($dbh));
			$suma_puntos = 0;
			while ($row_usuarios = mysqli_fetch_array($loop_usuarios))
			{
				
			$usuario = $row_usuarios['usuario'];
				
			echo $usuario."<br>";
						
						if ($stmt = $conn->prepare("INSERT INTO tb_puntos_temporales 
								SET puntos_temporales = ?, 
								comentarios_puntos_temporales = ?,
								revision_puntos_temporales = ?,
								usuario_puntos_temporales = ?,
								codigo_puntos_temporales =?,
								proyecto_puntos_temporales=?
					
						"))
						{
							$stmt->bind_param("dsiisi", $puntos_obtenidos, $comentarios_evaluados, $revision_evaluada,$usuario,$codigo_opcion_evaluacion,$proyecto_evaluado);
							$stmt->execute();
							$stmt->close();
						}
						
			
			//enviar email cdo puntos asignados
			 $email_usuario = get_email($usuario);
			 $message="Hi , Hola";
			 $message .= $puntos_obtenidos."Points / Puntos";
			 $subject="Points given to you / Te han asignado puntos por proyecto";
			 send_mail ($email_usuario,$message,$subject);
			}//usuarios
			
			
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

    
    </table>
    <?php
	
}