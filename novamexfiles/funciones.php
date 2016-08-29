<?php 

  
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
?>
