<?php
include_once 'common.php';
include_once 'funciones.php';
include_once 'class.user.php';

if( $_POST ){
	
    $puntos_obtenidos = $_POST['puntos_obtenidos'];
   $comentarios_evaluados = $_POST['comentarios_evaluados'];
   $id_evaluacion_proyectos = $_POST['id_evaluacion_proyectos'];

   $proyecto_evaluado = $_POST['proyecto_evaluado'];
   $equipo_proyecto = get_equipo_proyecto($proyecto_evaluado);
   $nombre_proyecto = get_nombre_proyecto($proyecto_evaluado);
   $revision_evaluada = $_POST['revision_evaluada'];
   $codigo_opcion_evaluacion = $_POST['codigo_opcion_evaluacion'];
   
  $puntos_ya_otorgados = get_puntos_ya_otorgados_proyectos($proyecto_evaluado);
  $puntos_maximos = get_puntos_proyecto($proyecto_evaluado);
   $puntos_anteriores = get_puntos_revision_proyecto($revision_evaluada,$proyecto_evaluado);
  
  if (($puntos_obtenidos+ $puntos_ya_otorgados-$puntos_anteriores)>$puntos_maximos){
  	?>
  	<table class="table table-striped" border="0">
  	
  	<tr>
  	<td colspan="2">
  	<div class="alert alert-danger">
  	<strong><?php echo $lang['ERROR_PUNTOS']?>
  	    	</div>
  	    </td>
  	    </tr>
  	    <?php 
  }
  else {
  	
 
   // Change the line below to your timezone!
   date_default_timezone_set('America/Chihuahua');
   $date = date('Y-m-d');

   
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

$texto = "USUARIO EVALUA REVISIONES DE  PROYECTO";
$codigo = "033";
$miemail = get_email($_SESSION['userSession']);
add_log($texto,$miemail,$codigo);
send_mail_miembros_equipos_proyecto_revisiones($equipo_proyecto,$nombre_proyecto);
//email a superadmin
$super = get_email_superadmin();
$pro = $nombre_proyecto;
$men = "El proyecto ".$pro." tiene nuevas evaluaciones";
send_mail($super,$men,$pro);

if ($stmt = $conn->prepare("UPDATE tb_evaluaciones_proyectos SET puntos_obtenidos = ?, comentarios_evaluados = ?, 
		estado_evaluacion = ? , fecha_evaluacion = ?
WHERE id_evaluacion_proyectos=?"))
{
	$stmt->bind_param("dsisi", $puntos_obtenidos, $comentarios_evaluados,$estado_evaluacion, $date, $id_evaluacion_proyectos);
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
					WHERE tb_proyectos.id_proyecto =   '$proyecto_evaluado' AND fecha_baja > '".$date."'")
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
			

			//enviar email cdo puntos asignados
			$email_usuario = get_email($usuario_editado);
				
			$idioma = get_idioma($usuario_editado);
			$proyecto = get_proyecto($proyecto_evaluado);
			$nombre = get_nombre($usuario_editado);
			$nombre_revision = get_nombre_revision($revision_evaluada);
			
			if ($idioma == "en"){
				//email en ingles
				$message="Hi ".$nombre." !";
				$message .= "<br>You have got ".$puntos_obtenidos." points at project ".$proyecto." / Revision: ".$nombre_revision;
				$message .= "<br>Comments: ".$comentarios_evaluados;
				$message .= "<br><br>Please, remember that they are NON-Consolidated points, to be consolidated at the end of the project.";
				$message .= "<br><br>Thank you for your effort.";
				$message .= "<br><br>The NOVAMEX Team.";
			
				$subject=" UPDATE from Points given to you at Project: ".$proyecto;
				send_mail ($email_usuario,$message,$subject);
			}
			else
			{
				//email en espanol
				$message="Hola ".$nombre." !";
				$message .= "<br>Has conseguido ".$puntos_obtenidos." puntos en el proyecto ".$proyecto." / Revision: ".$nombre_revision;
				$message .= "<br>Comentarios recibidos: ".$comentarios_evaluados;
				$message .= "<br><br>Recuerda que se trata de puntos NO consolidados, y que se consolidaran una vez finalizado el proyecto.";
				$message .= "<br><br>Gracias por tu esfuerzo.";
				$message .= "<br><br>El Equipo NOVAMEX.";
					
				$subject=" ACTUALIZACION de puntos recibidos en el proyecto: ".$proyecto;
				send_mail ($email_usuario,$message,$subject);
			}
		}
		}
		else {
			
			
			
			$loop_usuarios = mysqli_query($conn, "SELECT * FROM tb_miembros_equipos
					LEFT JOIN tb_proyectos ON tb_miembros_equipos.equipo = tb_proyectos.equipo_proyecto 
					WHERE tb_proyectos.id_proyecto =   '$proyecto_evaluado' AND fecha_baja > '".$date."'")
			or die (mysqli_error($dbh));
			$suma_puntos = 0;
			while ($row_usuarios = mysqli_fetch_array($loop_usuarios))
			{
				
			$usuario = $row_usuarios['usuario'];
			$usuario = $row_usuarios['usuario'];
				
			
						
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
			
			 $idioma = get_idioma($usuario);
			 $proyecto = get_proyecto($proyecto_evaluado);
			 $nombre = get_nombre($usuario);
			 $nombre_revision = get_nombre_revision($revision_evaluada);
			 
			 if ($idioma == "en"){
			 	//email en ingles
			 	$message="Hi ".$nombre." !";
			 	$message .= "<br>You have got ".$puntos_obtenidos." points at project ".$proyecto." / Revision: ".$nombre_revision;
			 	$message .= "<br>Comments: ".$comentarios_evaluados;
			 	$message .= "<br><br>Please, remember that they are NON-Consolidated points, to be consolidated at the end of the project.";
			 	$message .= "<br><br>Thank you for your effort.";
			 	$message .= "<br><br>The NOVAMEX Team.";
			 		
			 	$subject=" Points given to you at Project: ".$proyecto;
			 	send_mail ($email_usuario,$message,$subject);
			 }
			 else 
			 {
			 	//email en espanol
			 	$message="Hola ".$nombre." !";
			 	$message .= "<br>Has conseguido ".$puntos_obtenidos." puntos en el proyecto ".$proyecto." / Revision: ".$nombre_revision;
			 	$message .= "<br>Comentarios recibidos: ".$comentarios_evaluados;
			 	$message .= "<br><br>Recuerda que se trata de puntos NO consolidados, y que se consolidaran una vez finalizado el proyecto.";
			 	$message .= "<br><br>Gracias por tu esfuerzo.";
			 	$message .= "<br><br>El Equipo NOVAMEX.";
			 	
			 	$subject=" Has recibido puntos en el proyecto: ".$proyecto;
			 	send_mail ($email_usuario,$message,$subject);
			 }
			 
			 
			
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
}