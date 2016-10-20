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
function add_log ($texto, $usuario){
	
	$ip = get_client_ip();
	
	$mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
    $stmt = $mysqli->prepare("INSERT INTO tb_historico (texto,usuario,ip) VALUES (?,?,?)");
        $stmt->bind_param("sss", $texto, $usuario, $ip);
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
?>
