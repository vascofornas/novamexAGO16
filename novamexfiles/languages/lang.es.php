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
$lang['TEXT'] = 'Texto en ES';
$lang['TEXT_EN'] = 'Texto en EN';
$lang['TITLE'] = 'Titulo en ES';
$lang['TITLE_EN'] = 'Titulo en EN';
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
$lang['SUPERVISOR'] = 'Supervisor';

// MENSAJES.PHP
$lang['ADD_MESSAGE'] = 'Nuevo Mensaje';
$lang['TO'] = 'Para';
$lang['FROM'] = 'De';
$lang['MESSAGE_TITLE'] = 'Asunto';
$lang['MESSAGE_TEXT'] = 'Texto del Mensaje';
$lang['READ'] = 'Leido?';
$lang['DATE'] = 'Fecha/Hora';
$lang['ANSWERED'] = 'Contestado?';
$lang['SENT_MESSAGES'] = 'Bandeja de salida';
$lang['RECEIVED_MESSAGES'] = 'Bandeja de entrada';
$lang['COMPOSE_MESSAGE'] = 'Crear mensaje';
$lang['NO_MESSAGE'] = 'No tienes mensajes nuevos';

//EQUPOS Y PROYECTOS
$lang['TEAMS'] = 'Equipos';
$lang['TEAM'] = 'Equipo';
$lang['TEAM_MEMBERS'] = 'Miembros de Equipos';
$lang['PROJECTS'] = 'Proyectos';
$lang['PROJECT'] = 'Proyecto';
$lang['ADD_TEAM'] = 'Nuevo equipo';
$lang['CREATION_DATE'] = 'Fecha de Creación';
$lang['TEAM_NAME'] = 'Nombre del Equipo';

//MIEMBROS EQUIPO
$lang['ADD_TEAM_MEMBER'] = 'Nuevo Miembro de Equipos';
$lang['EMPLOYEE'] = 'Empleado';
$lang['START_DATE'] = 'Fecha de Alta';
$lang['END_DATE'] = 'Fecha de Baja';

//PROYECTOS
$lang['ADD_PROJECT'] = 'Nuevo Proyecto';
$lang['PROJECT_DESCRIPTION'] = 'Descripcion del proyecto';
$lang['PROJECT_TYPE'] = 'Tipo de proyecto';

$lang['EVALUATOR'] = 'Evaluador';

$lang['POINTS'] = 'Puntos';
//MIS DATOS PERSONALES
$lang['PERSONAL_INFO'] = 'Datos personales';
$lang['NOT_EDITABLE_DATA'] = 'Datos no editables';
$lang['EDITABLE_DATA'] = 'Datos editables';
$lang['UPDATE_DATA'] = 'Actualizar datos';
$lang['SUCCESS'] = 'Correcto!';
$lang['UPDATED'] = 'Datos actualizados correctamente';
//MIS PROYECTOS
$lang['MY_PROJECTS'] = 'Mis Proyectos';
$lang['AS_TEAM_MEMBER'] = 'Como miembro de Equipo';
$lang['AS_EVALUATOR'] = 'Como evaluador';
$lang['LANGUAGE'] = 'Idioma por defecto';
$lang['PROJECT_INFO'] = 'Datos del proyecto';
$lang['PROJECT_NAME'] = 'Nombre del Proyecto';
$lang['START_DATE_PROJECT'] = 'Fecha de inicio del Proyecto';
$lang['END_DATE_PROJECT'] = 'Fecha final del Proyecto';
$lang['PROJECT_TEAM'] = 'Equipo del Proyecto';
$lang['PROJECT_EVALUATOR'] = 'Evaluador del Proyecto';
$lang['DELIVERABLES'] = 'Entregables del Proyecto';
$lang['NEW_DELIVERABLE'] = 'Nuevo Entregable';
$lang['TITLE_DELIVERABLE'] = 'Titulo del Entregable';
$lang['DESCRIPTION_DELIVERABLE'] = 'Descripcion del Entregable';
$lang['CREATED'] = 'Entregable subido al servidor'; 
$lang['UPLOAD_DELIVERABLE'] = 'Subir Entregable';
$lang['FILE_DELIVERABLE'] = 'Archivo Entregable';
$lang['FILE_NAME'] = 'Nombre del Archivo Entregable';
$lang['SELECT_FILE'] = 'Seleccione Archivo';
$lang['PROJECT_TYPES'] = 'Tipos de Proyectos';
$lang['PROJECT_EVAL'] = 'Evaluaciones de Proyectos';
$lang['ADD_PROJECT_TYPE'] = 'Nuevo Tipo de Proyecto';
$lang['PROJECT_TYPE_NAME'] = 'Nombre del Tipo de Proyecto';

$lang['PROJECT_TYPE_POINTS'] = 'Puntos del Tipo de Proyecto';

$lang['PROJECT_TYPE_REVISIONS'] = 'Numero de Revisiones';

$lang['PROJECT_TYPE_OPTION1'] = 'Opcion 1';
$lang['PROJECT_TYPE_OPTION2'] = 'Opcion 2';
$lang['PROJECT_TYPE_OPTION3'] = 'Opcion 3';
$lang['PROJECT_TYPE_OPTION4'] = 'Opcion 4';
$lang['PROJECT_TYPE_OPTION5'] = 'Opcion 5';
$lang['PROJECT_TYPE_OPTION6'] = 'Opcion 6';
$lang['PROJECT_TYPE_OPTION7'] = 'Opcion 7';
$lang['PROJECT_TYPE_OPTION8'] = 'Opcion 8';
$lang['PROJECT_TYPE_OPTION9'] = 'Opcion 9';
$lang['PROJECT_TYPE_OPTION10'] = 'Opcion 10';
$lang['PROJECT_TYPE_PERCENTAGE1'] = 'Porcentaje Opcion 1';
$lang['PROJECT_TYPE_PERCENTAGE2'] = 'Porcentaje Opcion 2';
$lang['PROJECT_TYPE_PERCENTAGE3'] = 'Porcentaje Opcion 3';
$lang['PROJECT_TYPE_PERCENTAGE4'] = 'Porcentaje Opcion 4';
$lang['PROJECT_TYPE_PERCENTAGE5'] = 'Porcentaje Opcion 5';
$lang['PROJECT_TYPE_PERCENTAGE6'] = 'Porcentaje Opcion 6';
$lang['PROJECT_TYPE_PERCENTAGE7'] = 'Porcentaje Opcion 7';
$lang['PROJECT_TYPE_PERCENTAGE8'] = 'Porcentaje Opcion 8';
$lang['PROJECT_TYPE_PERCENTAGE9'] = 'Porcentaje Opcion 9';
$lang['PROJECT_TYPE_PERCENTAGE10'] = 'Porcentaje Opcion 10';


$lang['PROJECT_TYPE_NUM_REVISIONES1'] = ' # Revisiones Opcion 1';

$lang['PROJECT_TYPE_NUM_REVISIONES2'] = ' # Revisiones Opcion 2';
$lang['PROJECT_TYPE_NUM_REVISIONES3'] = ' # Revisiones Opcion 3';
$lang['PROJECT_TYPE_NUM_REVISIONES4'] = ' # Revisiones Opcion 4';
$lang['PROJECT_TYPE_NUM_REVISIONES5'] = ' # Revisiones Opcion 5';
$lang['PROJECT_TYPE_NUM_REVISIONES6'] = ' # Revisiones Opcion 6';
$lang['PROJECT_TYPE_NUM_REVISIONES7'] = ' # Revisiones Opcion 7';
$lang['PROJECT_TYPE_NUM_REVISIONES8'] = ' # Revisiones Opcion 8';
$lang['PROJECT_TYPE_NUM_REVISIONES9'] = ' # Revisiones Opcion 9';
$lang['PROJECT_TYPE_NUM_REVISIONES10'] = ' # Revisiones Opcion 10';
$lang['PORCENTAJE_ACUMULADO'] = 'Porcentaje acumulado';

//historico
$lang['HISTORICO'] = 'Registro de Eventos';
$lang['EVENT'] = 'Evento';
$lang['DATE'] = 'Fecha';
$lang['USERID'] = 'Ususario / ID de usuario';
$lang['IP'] = 'IP';
$lang['IMAGE'] = 'Imagen del Usuario';
$lang['UPLOAD_PICTURE'] = 'Subir imagen del usuario';
$lang['DATOS_PERSONALES'] = 'Datos Personales';
$lang['EVALUACION_PROVEEDOR_INTERNO'] = 'Evaluacion a Proveedor Interno';
$lang['REQUERIMIENTOS_CLIENTE_INTERNO'] = 'Requerimientos de Cliente Interno';
$lang['MIS_RECONOCIMIENTOS'] = 'Mis Reconocimientos';
$lang['TAREAS_PROACTIVIDAD'] = 'Tareas de Proactividad';

$lang['PROJECT_REVISIONS'] = 'Revisiones del Proyecto';
$lang['NO_REVISIONS'] = 'CREAR LAS REVISIONES PARA ESTE PROYECTO';
$lang['PROJECT_REVISIONS_CREATING'] = 'CREANDO LAS REVISIONES PARA ESTE PROYECTO';
$lang['#_REVISIONS'] = 'NUMERO DE REVISIONES PARA ESTE PROYECTO';
$lang['REVISION_CREATED'] = 'creada correctamente';
$lang['CONFIGURAR_REVISIONES'] = 'CONFIGURAR REVISIONES';
$lang['PROJECT_REVISIONS_EDITING'] = 'EDITAR LAS REVISIONES PARA ESTE PROYECTO';
$lang['REVISION_NAME'] = 'Nombre de la Revision';
$lang['REVISION_DATE'] = 'Fecha de la Revision';
$lang['REVISION_UPDATED'] = 'Revision Actualizada';
$lang['GO'] = 'CONTINUAR';
$lang['EVALUAR_REVISIONES'] = 'EVALUAR REVISION';
$lang['POINTS'] = 'Puntos';

$lang['COMMENTS'] = 'Comentarios';
$lang['TOTAL_POINTS'] = 'Puntos totales para este Proyecto';
$lang['PERCENTAGE_ASSIGNED'] = 'Porcentaje asignado a esta Opcion';
$lang['RECOMMENDED_POINTS'] = 'Numero maximo de puntos recomendados para esta revision';
$lang['EVALUATION_UPDATED'] = 'Evaluacion actualizada';
$lang['EVALUATION_POINTS'] = 'Puntos Evaluacion';
$lang['EVALUATION_COMMENTS'] = 'Comentarios Evaluacion';
$lang['LIMIT_FILE'] = 'Tamaño máximo de archivo: 2 Mb';
$lang['GIVEN_POINTS'] = 'Puntos ya asignados';
$lang['POINTS_ASSIGNED'] = 'Puntos asignados a esta Opción';

?>