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
$lang['PASSWORD'] = utf8_encode('Contrase�a');
$lang['SIGN_IN'] = utf8_encode('Iniciar Sesi�n');
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
                    Selecciona el enlace de confirmaci�n en el email para activar su cuenta de usuario. 
			  		</div>
					";


//SIGN_IN
$lang['PASSWORD_LOST'] = utf8_encode('Ha perdido su contrase�a?');

//FORGOT PASSWORD
$lang['FORGOT_PASSWORD_TEXT'] = utf8_encode('Introduzca su direcci�n Email. En breve recibir� un enlace para crear un nuevo password en su bandeja de entrada.!');
$lang['FORGOT_PASSWORD'] = utf8_encode('Contrase�a olvidada');
$lang['GENERATE_PASSWORD'] = utf8_encode('Generar nueva contrase�a');


// HOME.PHP

$lang['MEMBER_HOME'] = 'Zona de Miembros';
$lang['HOME'] = 'Inicio';
$lang['PROFILE'] = 'Mi Perfil';
$lang['ADMIN_ZONE'] = utf8_encode('Zona de Administraci�n');
$lang['LOGOUT'] = utf8_encode('Cerrar Sesion');
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
$lang['MENU_CONTACT_US'] = utf8_encode('Cont�ctenos');
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



?>