<?php 
require_once 'dbconfig.php';
require_once('Connections/conexion.php');
include_once 'common.php';
  
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function add_log ($texto, $usuario, $codigo){
	
	$ip = get_client_ip();
	
	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
    $stmt = $mysqli->prepare("INSERT INTO tb_historico (texto,usuario,ip,codigo) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $texto, $usuario, $ip,$codigo);
$stmt->execute();
	  
}
function get_email_superadmin(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop = mysqli_query($mysqli, "SELECT * FROM tb_datos_configuracion")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop))
	{
		$email_del_usuario = $row_usua['superadmin_email'];
	}
	return $email_del_usuario;

}
function get_email($usuario){
	
	$email_del_usuario = "modestovasco@gmail.com";
	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
	 
	$loop = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));
	
	
	
	//display the results
	while ($row_usua = mysqli_fetch_array($loop))
	{ 
	 	$email_del_usuario = $row_usua['userEmail'];
	}
	return $email_del_usuario;
	
}
function get_idioma($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$idioma_del_usuario = $row_usua['idioma_usuario'];
	}
	return $idioma_del_usuario;

}
function get_unidad_negocio_usuario($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tbl_users LEFT JOIN tb_unidades_negocio ON tbl_users.unidad_negocio_usuario = tb_unidades_negocio.id_unidades_negocio 
			WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$idioma_del_usuario = $row_usua['id_unidades_negocio'];
	}
	return $idioma_del_usuario;

}
function get_nombre_revision($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_proyectos WHERE id_revisiones_proyectos = '".$usuario."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$nombre_del_usuario = $row_usua['nombre_revision'];
	}
	return $nombre_del_usuario;

}
function get_supervisor($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$supervisor_del_usuario = $row_usua['supervisor_usuario'];
	}
	return $supervisor_del_usuario;

}
function get_nombre($usuario){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID = '".$usuario."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$nombre_del_usuario = $row_usua['nombre_usuario']." ".$row_usua['apellidos_usuario'];
	}
	return $nombre_del_usuario;

}
function get_proyecto($proyecto){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_proyecto = mysqli_query($mysqli, "SELECT * FROM tb_proyectos WHERE id_proyecto = '".$proyecto."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_proyecto = mysqli_fetch_array($loop_proyecto))
	{
		$proyecto = $row_proyecto['nombre_proyecto'];
	}
	return $proyecto;

}
function get_evaluador_proyecto($proyecto){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_proyecto = mysqli_query($mysqli, "SELECT * FROM tb_proyectos WHERE id_proyecto = '".$proyecto."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_proyecto = mysqli_fetch_array($loop_proyecto))
	{
		$proyecto = $row_proyecto['evaluador_proyecto'];
	}
	return $proyecto;

}
function get_nombre_proyecto($proyecto){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_proyecto = mysqli_query($mysqli, "SELECT * FROM tb_proyectos WHERE id_proyecto = '".$proyecto."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_proyecto = mysqli_fetch_array($loop_proyecto))
	{
		$proyecto = $row_proyecto['nombre_proyecto'];
	}
	return $proyecto;

}
function get_equipo_proyecto($proyecto){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_proyecto = mysqli_query($mysqli, "SELECT * FROM tb_proyectos WHERE id_proyecto = '".$proyecto."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_proyecto = mysqli_fetch_array($loop_proyecto))
	{
		$proyecto = $row_proyecto['equipo_proyecto'];
	}
	return $proyecto;

}
function get_team($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT * FROM tb_equipos WHERE id_equipo = '".$team."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$equipo = $row_equipos['nombre_equipo'];
	}
	return $equipo;

}
function get_team_member($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT * FROM tb_miembros_equipos WHERE id_miembro = '".$team."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$equipo = $row_equipos['equipo'];
	}
	return $equipo;

}
function send_mail_miembros_equipos_proyecto_editado($equipo,$proyecto,$fecha_inicio,$fecha_final){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT * FROM tb_miembros_equipos WHERE equipo = '".$equipo."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$usuario = $row_equipos['usuario'];
		$idioma_usuario = get_idioma($usuario);
		$email_usuario = get_email($usuario);
		$nombre_usuario = get_nombre($usuario);

		if ($idioma_usuario == "en"){
			$message = "Hi, ".$nombre_usuario."!<br><br>";
			$message .= "The project  ".$proyecto." has been updated.";
		
			$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
			$subject = "The project  ".$proyecto." has been updated.";
			send_mail($email_usuario,$message,$subject);
		}
		else {
			$message = "Hola, ".$nombre_usuario."!<br><br>";
			$message .= "El proyecto  ".$proyecto." ha sido modificado.";
			
			$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
			$subject = "El proyecto  ".$proyecto." ha sido modificado.";
			send_mail($email_usuario,$message,$subject);

		}




	}


}
function send_mail_miembros_equipos_proyecto_cancelado($equipo,$proyecto){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT * FROM tb_miembros_equipos WHERE equipo = '".$equipo."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$usuario = $row_equipos['usuario'];
		$idioma_usuario = get_idioma($usuario);
		$email_usuario = get_email($usuario);
		$nombre_usuario = get_nombre($usuario);
		$proyecto_nombre = get_nombre_proyecto($proyecto);

		if ($idioma_usuario == "en"){
			$message = "Hi, ".$nombre_usuario."!<br><br>";
			$message .= "The project  ".$proyecto_nombre." has been canceled.";
			
			$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
			$subject = "The project  ".$proyecto_nombre." has been canceled.";
			send_mail($email_usuario,$message,$subject);
		}
		else {
			$message = "Hola, ".$nombre_usuario."!<br><br>";
			$message .= "El proyecto  ".$proyecto_nombre." ha sido cancelado.";
			
			$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
			$subject = "El proyecto  ".$proyecto_nombre." ha sido cancelado.";
			send_mail($email_usuario,$message,$subject);

		}




	}


}
function send_mail_miembros_equipos_proyecto($equipo,$proyecto,$fecha_inicio,$fecha_final){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT * FROM tb_miembros_equipos WHERE equipo = '".$equipo."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$usuario = $row_equipos['usuario'];
		$idioma_usuario = get_idioma($usuario);
		$email_usuario = get_email($usuario);
		$nombre_usuario = get_nombre($usuario);
		
		if ($idioma_usuario == "en"){
			$message = "Hi, ".$nombre_usuario."!<br><br>";
			$message .= "You have been assigned to project: ".$proyecto.".";
			$message .= "<br>from ".$fecha_inicio." to ".$fecha_final;
			$message .= "<br><br>Best regards.<br> Your NOVAMEX Team";
			$subject = "You have been assigned  to project ".$proyecto;
			send_mail($email_usuario,$message,$subject);
		}
		else {
			$message = "Hola, ".$nombre_usuario."!<br><br>";
			$message .= "Te han asignado al proyecto: ".$proyecto.".";
			$message .= "<br>desde el ".$fecha_inicio." al ".$fecha_final;
			$message .= "<br><br>Saludos.<br> Tu equipo NOVAMEX";
			$subject = "Te han asignado al proyecto: ".$proyecto.".";
			send_mail($email_usuario,$message,$subject);
				
		}
		
		
		
		
	}
	

}
function get_team_member_user($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT * FROM tb_miembros_equipos WHERE id_miembro = '".$team."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$equipo = $row_equipos['usuario'];
	}
	return $equipo;

}
function send_mail($email,$message,$subject)
{
	require_once('mailer/class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug  = 1;
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host       = "cs8.webhostbox.net";
	$mail->Port       = 465;
	$mail->AddAddress($email);
	$mail->Username="novamex@juarezserver.com";
	$mail->Password="Papa020432";
	$mail->SetFrom('novamex@juarezserver.com','Novamex');
	$mail->AddReplyTo("novamex@juarezserver.com","Novamex");
	$mail->Subject    = $subject;
	$mail->MsgHTML($message);
	$mail->Send();
}
function get_puntos_temporales_proyectos($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT SUM(puntos_temporales) as ptos 
			FROM tb_puntos_temporales WHERE (usuario_puntos_temporales = '".$team."'
			)")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_equipos = mysqli_fetch_array($loop_equipos))
	{
		$equipo = $row_equipos['ptos'];
	}
	return $equipo;

}
function get_puntos_consolidados_proyectos($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT SUM(consolidados_puntos_temporales) as ptos
			FROM tb_puntos_temporales WHERE (usuario_puntos_temporales = '".$team."'
			)")
			or die (mysqli_error($dbh));



			//display the results
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['ptos'];
			}
			return $equipo;

}
function comprobar_proyecto($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT proyecto_cerrado 		
			FROM tb_proyectos WHERE (id_proyecto = '".$team."'
			)")
			or die (mysqli_error($dbh));



			//display the results
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['proyecto_cerrado'];
			}
			return $equipo;

}

function comprobar_rci($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$team."'
			")
			or die (mysqli_error($dbh));



			//display the results
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$respuesta = $row_equipos['rci_cerrado'];
			}
			return $respuesta;

}

function comprobar_existe_puntos_disponibles($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_disponibles WHERE (usuario_puntos_disponibles = '".$team."'
			)")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['id_puntos_disponibles'];
				$nim=$nim+1;
			}
			return $nim;

}
function recuperar_id_puntos_disponibles($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_disponibles WHERE (usuario_puntos_disponibles = '".$team."'
			)")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['id_puntos_disponibles'];
				$nim=$nim+1;
			}
			return $equipo;

}
function get_puntos_disponibles_totales(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_disponibles ")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['puntos_conseguidos'];
				$nim=$nim+1;
			}
			return $equipo;

}
function get_puntos_disponibles($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_disponibles WHERE (usuario_puntos_disponibles = '".$team."'
			)")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['puntos_conseguidos'];
				$nim=$nim+1;
			}
			return $equipo;

}
function get_max_puntos_libres($team){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres WHERE id_puntos_libres = '".$team."'
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				$equipo = $row_equipos['max_puntos_libres'];
				$nim=$nim+1;
			}
			return $equipo;

}
function get_user_repite_puntos_libres($id_limit,$otorga_limit,$recibe_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres_otorgados WHERE id_puntos = '".$_SESSION['puntos_libres']."'
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				if ($id_limit ==  $row_equipos['id_puntos'] &&
						$otorga_limit == $row_equipos['otorga_usuario'] &&
						$recibe_limit == $row_equipos['recibe_usuario'])
			
					$nim=$nim+1;
				else {
					$nim = $nim;
				}
			}
			return $nim;

}
function incluir_en_puntos_libres_otorgados($id_puntos,$puntos){

	$puntos_ya_otorgados = get_puntos_ya_otorgados($id_puntos);
	$puntos_finales = $puntos_ya_otorgados +$puntos;
	$conn = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
$sql = "UPDATE tb_puntos_libres SET total_puntos_consumidos='".$puntos_finales."' WHERE id= '".$id_puntos."'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
}
function get_puntos_ya_otorgados($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres WHERE id_puntos_libres = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results
			
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				
						$nim = $row_equipos['total_puntos_consumidos'];
					
			}
			return $nim;

}



function get_puntos_consumidos_puntos_libres(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres  WHERE id_puntos_libres = '".$_SESSION['puntos_libres']."'
			")
			or die (mysqli_error($dbh));



			
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
				
						$puntos_ya = $row_equipos['total_puntos_consumidos'] ;
						
						
					
			}
			return $puntos_ya;

}
function get_puntos_totales_puntos_libres(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres  WHERE id_puntos_libres = '".$_SESSION['puntos_libres']."'
			")
			or die (mysqli_error($dbh));



				
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{

				$puntos_ya = $row_equipos['total_puntos_libres'] ;


					
			}
			return $puntos_ya;

}



function update_puntos_consumidos_puntos_libres($puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

$sql = "UPDATE tb_puntos_libres SET total_puntos_consumidos = '".$puntos."' WHERE id_puntos_libres = '".$_SESSION['puntos_libres']."'";

if ($mysqli->query($sql) === TRUE) {
   
} else {
    
};

}

function comprobar_si_existe_puntos_libres_usuario($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres_usuario WHERE usuario_puntos_libres = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
					$nim=$nim+1;
				
			}
			return $nim;

}
function get_puntos_libres_usuario($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres_usuario WHERE usuario_puntos_libres = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results
			
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_libres_usuario'];

			}
			return $nim;

}
function update_puntos_libres($usuario,$puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$sql = "UPDATE tb_puntos_libres_usuario SET puntos_libres_usuario = '".$puntos."' WHERE usuario_puntos_libres = '".$usuario."'";

	if ($mysqli->query($sql) === TRUE) {
		 
	} else {

	};

}

function update_puntos_disponibles($usuario,$puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$sql = "UPDATE tb_puntos_disponibles SET puntos_conseguidos = '".$puntos."' WHERE usuario_puntos_disponibles = '".$usuario."'";

	if ($mysqli->query($sql) === TRUE) {
			
	} else {

	};

}
function crear_puntos_disponibles($usuario,$puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$sql = "INSERT INTO tb_puntos_disponibles (usuario_puntos_disponibles,puntos_conseguidos)  VALUES ('".$usuario."','".$puntos."')";

	if ($mysqli->query($sql) === TRUE) {
			
	} else {

	};

}
function crear_puntos_libres_usuario($usuario,$puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$sql = "INSERT INTO tb_puntos_libres_usuario (usuario_puntos_libres,puntos_libres_usuario)  VALUES ('".$usuario."','".$puntos."')";

	if ($mysqli->query($sql) === TRUE) {
			
	} else {

	};

}
function get_id_usuario_puntos_otorgados($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres_otorgados WHERE id_puntos_libres_otorgados = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results
				
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['recibe_usuario'];

			}
			return $nim;

}
function get_descripcion_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['descripcion_req_interno'];

			}
			return $nim;

}
function get_descripcion_pt($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['descripcion_tareas_proactividad'];

			}
			return $nim;

}
function get_concepto1_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_1'];

			}
			return $nim;

}
function get_concepto1_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_1'];

			}
			return $nim;

}
function get_concepto2_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_2'];

			}
			return $nim;

}
function get_concepto2_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_2'];

			}
			return $nim;

}
function get_concepto3_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_3'];

			}
			return $nim;

}
function get_concepto3_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_3'];

			}
			return $nim;

}
function get_concepto4_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_4'];

			}
			return $nim;

}
function get_concepto4_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['concepto_4'];

			}
			return $nim;

}
function get_na_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['sin_puntos'];

			}
			return $nim;

}
function get_na_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['sin_puntos'];

			}
			return $nim;

}
function get_el_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_esfuerzo_leve'];

			}
			return $nim;

}
function get_el_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_esfuerzo_leve'];

			}
			return $nim;

}
function get_ea_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_esfuerzo_aceptable'];

			}
			return $nim;

}
function get_ea_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_esfuerzo_aceptable'];

			}
			return $nim;

}
function get_ee_rci($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE id_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_esfuerzo_excepcional'];

			}
			return $nim;

}
function get_ee_tp($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_tareas_proactividad WHERE id_tareas_proactividad = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_esfuerzo_excepcional'];

			}
			return $nim;

}
function get_puntos_otorgados($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres_otorgados WHERE id_puntos_libres_otorgados = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results

			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_otorgados'];

			}
			return $nim;

}

function update_puntos_libres_borrados($usuario,$puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$sql = "UPDATE tb_puntos_libres_usuario SET puntos_libres_usuario = '".$puntos."' WHERE usuario_puntos_libres = '".$usuario."'";

	if ($mysqli->query($sql) === TRUE) {
			
	} else {

	};

}
function update_puntos_disponibles_borrar($usuario,$puntos){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$sql = "UPDATE tb_puntos_disponibles SET puntos_conseguidos = '".$puntos."' WHERE usuario_puntos_disponibles = '".$usuario."'";

	if ($mysqli->query($sql) === TRUE) {
			
	} else {

	};

}
function get_c1($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci WHERE id_revisiones_rci = '".$rci."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$c1_del_usuario = $row_usua['evaluacion_c1'];
	}
	return $c1_del_usuario;

}
function get_c2($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci WHERE id_revisiones_rci = '".$rci."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$c2_del_usuario = $row_usua['evaluacion_c2'];
	}
	return $c2_del_usuario;

}
function get_c3($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci WHERE id_revisiones_rci = '".$rci."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$c3_del_usuario = $row_usua['evaluacion_c3'];
	}
	return $c3_del_usuario;

}
function get_c4($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci WHERE id_revisiones_rci = '".$rci."'")
	or die (mysqli_error($dbh));



	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$c4_del_usuario = $row_usua['evaluacion_c4'];
	}
	return $c4_del_usuario;

}
function comprobar_si_existe_puntos_epi($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_epi WHERE usuario_puntos_epi = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_puntos_epi($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci WHERE proveedor_rci = '".$rci."'")
	or die (mysqli_error($dbh));

$suma = 0;

	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$suma = $suma + $row_usua['evaluacion_c1'];
		$suma = $suma + $row_usua['evaluacion_c2'];
		$suma = $suma + $row_usua['evaluacion_c3'];
		$suma = $suma + $row_usua['evaluacion_c4'];
	}
	return $suma;

}
function get_puntos_epi_rev($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci WHERE rci_revisado = '".$rci."'")
	or die (mysqli_error($dbh));

	$suma = 0;

	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$suma = $suma + $row_usua['evaluacion_c1'];
		$suma = $suma + $row_usua['evaluacion_c2'];
		$suma = $suma + $row_usua['evaluacion_c3'];
		$suma = $suma + $row_usua['evaluacion_c4'];
	}
	return $suma;

}
function get_puntos_etp_rev($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_tareas_proactividad WHERE tareas_proactividad_revisado = '".$rci."'")
	or die (mysqli_error($dbh));

	$suma = 0;

	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$suma = $suma + $row_usua['evaluacion_c1'];
		$suma = $suma + $row_usua['evaluacion_c2'];
		$suma = $suma + $row_usua['evaluacion_c3'];
		$suma = $suma + $row_usua['evaluacion_c4'];
	}
	return $suma;

}

function get_puntos_tp($rci){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_tareas_proactividad WHERE proveedor_tareas_proactividad = '".$rci."'")
	or die (mysqli_error($dbh));

	$suma = 0;

	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$suma = $suma + $row_usua['evaluacion_c1'];
		$suma = $suma + $row_usua['evaluacion_c2'];
		$suma = $suma + $row_usua['evaluacion_c3'];
		$suma = $suma + $row_usua['evaluacion_c4'];
	}
	return $suma;

}
function get_puntos_tp_total(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_tareas_proactividad ")
	or die (mysqli_error($dbh));

	$suma = 0;

	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$suma = $suma + $row_usua['evaluacion_c1'];
		$suma = $suma + $row_usua['evaluacion_c2'];
		$suma = $suma + $row_usua['evaluacion_c3'];
		$suma = $suma + $row_usua['evaluacion_c4'];
	}
	return $suma;

}
function get_puntos_epi_total(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_idioma = mysqli_query($mysqli, "SELECT * FROM tb_revisiones_rci ")
	or die (mysqli_error($dbh));

	$suma = 0;

	//display the results
	while ($row_usua = mysqli_fetch_array($loop_idioma))
	{
		$suma = $suma + $row_usua['evaluacion_c1'];
		$suma = $suma + $row_usua['evaluacion_c2'];
		$suma = $suma + $row_usua['evaluacion_c3'];
		$suma = $suma + $row_usua['evaluacion_c4'];
	}
	return $suma;

}
function get_rci_created_total($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno 
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_rci_created($id_limit){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_requerimientos_cliente_interno WHERE cliente_req_interno = '".$id_limit."'
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_noticias(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_news 
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_un(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_unidades_negocio
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_equipos(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_equipos
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_num_proyectos(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_proyectos
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_departamentos(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_departamentos
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_messages_totales(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_mensajes 
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_historico(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_historico
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_messages($user){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_mensajes WHERE emisor = '".$user."'
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_num_usuarios(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tbl_users
			")
			or die (mysqli_error($dbh));



			//display the results
			$nim = 0;
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim=$nim+1;

			}
			return $nim;

}
function get_puntos_libres_totales(){

	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');

	$loop_equipos = mysqli_query($mysqli, "SELECT *
			FROM tb_puntos_libres_usuario
			")
			or die (mysqli_error($dbh));



			//display the results
				
			while ($row_equipos = mysqli_fetch_array($loop_equipos))
			{
					
				$nim = $row_equipos['puntos_libres_usuario'];

			}
			return $nim;

}

?>
