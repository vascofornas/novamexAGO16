<?php

require_once 'dbconfig.php';
require_once 'funciones.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$code,$unombre,$uapellidos,$idioma)
	{
		try
		{						
			$imagen = "Icon_user.png";
			$password = md5($upass);
			$level = "Level 1";
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode,userLevel,nombre_usuario,apellidos_usuario,idioma_usuario,imagen_usuario) 
			                                             VALUES(:user_name, :user_mail, :user_pass, :active_code, :user_level,:unombre,:uapellidos,:uidioma,:uimagen)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
				$stmt->bindparam(":user_level",$level);
				$stmt->bindparam(":unombre",$unombre);
				$stmt->bindparam(":uapellidos",$uapellidos);
				$stmt->bindparam(":uidioma",$idioma);
				$stmt->bindparam(":uimagen",$imagen);
					
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass)  AND $userRow['autorizado']==1)
					{
						$_SESSION['userSession'] = $userRow['userID'];
						$_SESSION['userLevel'] = $userRow['userLevel'];
						$_SESSION['lang'] = $userRow['idioma_usuario'];
						
						return true;
					}
					if($userRow['autorizado']==0)
					{
						header("Location: index.php?error400");
						$texto = "CUENTA ACTIVADA PERO PENDIENTE DE AUTORIZACION, CONSULTE AL ADMINISTRADOR";
						$codigo = "400";
						add_log($texto,$email,$codigo);
						
						exit;
					}
					else
					{
						header("Location: index.php?error");
						$texto = "FALLO EN INTENTO DE LOGIN DE USUARIO REGISTRADO";
						$codigo = "002";
						add_log($texto,$email,$codigo);
						
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				$texto = "FALLO EN INTENTO DE LOGIN DE USUARIO REGISTRADO";
						$codigo = "002";
						add_log($texto,$email,$codigo);
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		$texto = "CIERRE DE SESION DE USUARIO REGISTRADO";
		$email = get_email($_SESSION['userSession']);
		$codigo = "003";
		add_log($texto,$email,$codigo);
		session_destroy();
		
		$_SESSION['userSession'] = false;
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
}