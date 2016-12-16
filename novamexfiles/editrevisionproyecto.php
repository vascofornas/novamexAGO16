<?php
include_once 'common.php';
include_once 'funciones.php';
if( $_POST ){
	
    $nombre_revision = $_POST['nombre_revision'];
   $fecha_revision = $_POST['fecha_revision'];
   $id_revisiones_proyectos = $_POST['id_revisiones_proyectos'];
 $id_proyecto =  $_POST['id_proyecto'];
 $fechafin =  get_fecha_fin_proyecto($id_proyecto);
 $id_equipo = get_equipo_proyecto($id_proyecto);
 $proyecto = get_nombre_proyecto($id_proyecto);
    
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




if ($stmt = $conn->prepare("UPDATE tb_revisiones_proyectos SET nombre_revision = ?, fecha_revision = ?
WHERE id_revisiones_proyectos=?"))
{
	$stmt->bind_param("ssi", $nombre_revision, $fecha_revision, $id_revisiones_proyectos);
	$stmt->execute();
	$stmt->close();
	$texto = "USUARIO EDITA REVISIONES DE  PROYECTO";
	$codigo = "032";
	$miemail = get_email($_SESSION['userSession']);
	add_log($texto,$miemail,$codigo);
	send_mail_miembros_equipos_proyecto_revisiones_editadas($id_equipo,$proyecto);
	//email a superadmin
	$super = get_email_superadmin();
	$pro = $proyecto;
	$men = "El proyecto ".$proyecto." tiene  revisiones editadas";
	send_mail($super,$men,$pro);
	
}


   
}