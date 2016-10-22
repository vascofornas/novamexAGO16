<?php

define('HOST', 'localhost');
define('USER', 'herasosj_novamex');
define('PASS', 'Papa020432');
define('DBNAME', 'herasosj_novamex');
include_once 'funciones.php';
if ($_POST['submit']) {

	$texto = "USUARIO CAMBIA MENSAJE DE BIENVENIDA -EN-";
	$codigo = "009";
	$miemail = get_email($_SESSION['userSession']);
	add_log($texto,$miemail,$codigo);

    $mensaje = $_POST['mensaje'];
   
    $id = $_POST['id_mensaje'];
    
    if (!empty($mensaje)  && !empty($id)) {
        $db = new mysqli(HOST, USER, PASS, DBNAME);
        if ($db->connect_errno) {
            echo "Failed to connect to MySQL: (" . $db->connect_errno . ") "
            . $db->connect_error;
        }
mysqli_set_charset($db,'utf8');
        $query = "UPDATE tb_welcome_message SET mensaje_en=? WHERE id_mensaje=?";
        $conn = $db->prepare($query);
		
        $conn->bind_param('si',$mensaje,$id);

        if ($conn->execute()) {
            header('location: home.php');
        }
        $db->close();
    }
}
?>
