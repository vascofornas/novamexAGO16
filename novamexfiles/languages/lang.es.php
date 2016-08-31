<?php
/* 
-----------------
Language: Spanish
-----------------
*/

header('Content-Type: text/html; charset=utf-8');
$lang = array();

//SIGN_UP
$lang['SIGN_UP'] = 'Registrar';
$lang['UNAME'] = 'Nombre de Usuario (alias)';
$lang['FNAME'] = 'Nombre';
$lang['SNAME'] = 'Apellidos';
$lang['EMAIL'] = 'Email';
$lang['PASSWORD'] = 'Contraseña';
$lang['SIGN_IN'] = 'Iniciar Sesión';
$lang['ALREADY_USED_EMAIL_MESSAGE'] = "<div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Lo sentimos !</strong>  Email/Usuario ya existe en nuestro sistema , por favor, intente con otro email/usuario
			  </div>";
			   $lang['CLICK_HERE_TO_ACTIVATE']= "CLICK AQUI PARA ACTIVAR SU CUENTA";
$lang['TEXTO_EMAIL_BIENVENIDA']= "					
						
						Bienvenid@ a Novamex!<br/>
						Para completar su registro como usuario , seleccione el siguiente link<br/>
						<br /><br />
						
						Gracias,";
$lang['CONFIRM_REGISTRATION']= "Confirmar Registro";
$lang['REGISTRATION_OK']= "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Registro realizado con exito!</strong>  Hemos enviado un email a $email.
                    Selecciona el enlace de confirmación en el email para activar su cuenta de usuario. 
			  		</div>
					";


//SIGN_IN
$lang['PASSWORD_LOST'] ='Ha perdido su contraseña?';

//FORGOT PASSWORD
$lang['FORGOT_PASSWORD_TEXT'] = 'Introduzca su dirección Email. En breve recibirá un enlace para crear un nuevo password en su bandeja de entrada.!';
$lang['FORGOT_PASSWORD'] = 'Contraseña olvidada';
$lang['GENERATE_PASSWORD'] = 'Generar nueva contraseña';


// HOME.PHP

$lang['MEMBER_HOME'] = 'Zona de Miembros';
$lang['HOME'] = 'Inicio';
$lang['PROFILE'] = 'Mi Perfil';
$lang['ADMIN_ZONE'] = 'Zona de Administración';
$lang['LOGOUT'] = 'Cerrar Sesion';
$lang['USER'] = 'Usuario ';
$lang['MESSAGES'] = 'Mensajes';
$lang['NEWS'] = 'Noticias';
$lang['INBOX'] = 'Bandeja de Entrada';
$lang['SENT'] = 'Enviados ';
$lang['BY'] = 'por ';

// ADMIN_HOME.PHP

$lang['LEVEL_5_OPTIONS'] = 'Opciones de Nivel 5';
$lang['WELCOME_MESSAGE'] = 'Mensaje de Bienvenida';
$lang['BUSINESS_UNITS'] = 'Unidades de Negocio';
$lang['DEPARTMENTS'] = 'Departamentos';
$lang['USERS'] = 'Usuarios';

// Menu

$lang['MENU_HOME'] = 'Inicio';
$lang['MENU_ABOUT_US'] = 'Sobre Nosotros';
$lang['MENU_OUR_PRODUCTS'] = 'Nuestros productos';
$lang['MENU_CONTACT_US'] = 'Contáctenos';
$lang['MENU_ADVERTISE'] = 'Publicidad';
$lang['MENU_SITE_MAP'] = 'Mapa del Sitio';
// ADMIN_HOME.PHP

$lang['EDIT_WELCOME_MESSAGE'] = 'Editar Mensaje de Bienvenida';
$lang['SEND_WELCOME_MESSAGE'] = 'Enviar';

// ADMIN_NEWS.PHP
$lang['ADD_NEWS'] = 'Nueva noticia';
$lang['NUMBER_OF_NEWS_TO_SHOW'] = 'Numero de noticias a mostrar';
$lang['TEXT'] = 'Texto';
$lang['TITLE'] = 'Titulo';
$lang['ADDED_BY'] = 'Incluida por';
$lang['DATE'] = 'Fecha';
$lang['ACTIVE'] = 'Activa ?';
$lang['ACTIONS'] = 'Acciones';
$lang['YES'] = 'Si';
$lang['PROCESSING'] = 'Procesando datos...';

// ADMIN_BU.PHP
$lang['ADD_BU'] = 'Nueva Unidad de Negocio';
$lang['BUSINESS_UNIT'] = 'Unidad de Negocio';

// ADMIN_DEPARTMENT.PHP
$lang['ADD_DEPARTMENT'] = 'Nuevo Departamento';
$lang['DEPARTMENT'] = 'Departamento';


// ADMIN_USUARIOS.PHP
$lang['ADD_USER'] = 'Nuevo Usuario';
$lang['USERNAME'] = 'Nombre de Usuario (alias)';
$lang['FIRST_NAME'] = 'Nombre';
$lang['LAST_NAME'] = 'Apellidos';
$lang['USER_LEVEL'] = 'Nivel de Usuario';
$lang['ACTIVATED'] = 'Activado?';

// MENSAJES.PHP
$lang['ADD_MESSAGE'] = 'Nuevo Mensaje';
$lang['TO'] = 'Para';
$lang['FROM'] = 'De';
$lang['MESSAGE_TITLE'] = 'Asunto';
$lang['MESSAGE_TEXT'] = 'Texto del Mensaje';


?>