<?php 
require_once 'dbconfig.php';
require_once('Connections/conexion.php');
  
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

?>
