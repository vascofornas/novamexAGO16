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
$lang['CODIGO'] = 'Codigo';
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
$lang['PROFILE'] = 'Mi NOVAMEX';
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
$lang['LEVEL_3_OPTIONS'] = 'Opciones de Nivel 3';
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

$lang['PROJECT_TYPE_OPTION1'] = 'Fase 1';
$lang['PROJECT_TYPE_OPTION2'] = 'Fase 2';
$lang['PROJECT_TYPE_OPTION3'] = 'Fase 3';
$lang['PROJECT_TYPE_OPTION4'] = 'Fase 4';
$lang['PROJECT_TYPE_OPTION5'] = 'Fase 5';
$lang['PROJECT_TYPE_OPTION6'] = 'Fase 6';
$lang['PROJECT_TYPE_OPTION7'] = 'Fase 7';
$lang['PROJECT_TYPE_OPTION8'] = 'Fase 8';
$lang['PROJECT_TYPE_OPTION9'] = 'Fase 9';
$lang['PROJECT_TYPE_OPTION10'] = 'Fase 10';
$lang['PROJECT_TYPE_PERCENTAGE1'] = 'Porcentaje Fase 1';
$lang['PROJECT_TYPE_PERCENTAGE2'] = 'Porcentaje Fase 2';
$lang['PROJECT_TYPE_PERCENTAGE3'] = 'Porcentaje Fase 3';
$lang['PROJECT_TYPE_PERCENTAGE4'] = 'Porcentaje Fase 4';
$lang['PROJECT_TYPE_PERCENTAGE5'] = 'Porcentaje Fase 5';
$lang['PROJECT_TYPE_PERCENTAGE6'] = 'Porcentaje Fase 6';
$lang['PROJECT_TYPE_PERCENTAGE7'] = 'Porcentaje Fase 7';
$lang['PROJECT_TYPE_PERCENTAGE8'] = 'Porcentaje Fase 8';
$lang['PROJECT_TYPE_PERCENTAGE9'] = 'Porcentaje Fase 9';
$lang['PROJECT_TYPE_PERCENTAGE10'] = 'Porcentaje Fase 10';


$lang['PROJECT_TYPE_NUM_REVISIONES1'] = ' # Revisiones Fase 1';

$lang['PROJECT_TYPE_NUM_REVISIONES2'] = ' # Revisiones Fase 2';
$lang['PROJECT_TYPE_NUM_REVISIONES3'] = ' # Revisiones Fase 3';
$lang['PROJECT_TYPE_NUM_REVISIONES4'] = ' # Revisiones Fase 4';
$lang['PROJECT_TYPE_NUM_REVISIONES5'] = ' # Revisiones Fase 5';
$lang['PROJECT_TYPE_NUM_REVISIONES6'] = ' # Revisiones Fase 6';
$lang['PROJECT_TYPE_NUM_REVISIONES7'] = ' # Revisiones Fase 7';
$lang['PROJECT_TYPE_NUM_REVISIONES8'] = ' # Revisiones Fase 8';
$lang['PROJECT_TYPE_NUM_REVISIONES9'] = ' # Revisiones Fase 9';
$lang['PROJECT_TYPE_NUM_REVISIONES10'] = ' # Revisiones Fase 10';
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
$lang['NON_CONSOLIDATED_POINTS'] = 'Puntos NO consolidados';

$lang['CONSOLIDATED_POINTS'] = 'Puntos consolidados';

$lang['FREE_POINTS'] = 'Asignacion libre de puntos';
$lang['ADD_FREE_POINTS'] = 'Nueva Asignacion libre de puntos';
$lang['ASSIGNED_BY'] = 'Puntos Asignados Por';
$lang['ASSIGNED_TO'] = 'Puntos Asignados A';
$lang['ASSIGNED_POINTS'] = 'Total de Puntos Asignados';

$lang['MAX_ASSIGNED_POINTS'] = 'Max # Puntos a usuarios';

$lang['GIVEN_POINTS'] = 'Puntos ya distribuidos';
$lang['MORE_INFO'] = 'Ver detalles';
$lang['CLOSED_PROJECT'] = 'Proyecto cerrado?';
$lang['CLOSE_PROJECT'] = 'CERRAR PROYECTO';
$lang['PROJECT_CLOSED'] = 'PROYECTO CERRADO';

$lang['CONFIRMATION'] = 'ESTAS SEGURO?. ACCION NO REVERSIBLE';
$lang['POINTS_DISTRIBUTION'] = 'PROCESANDO PUNTOS';
$lang['HAS'] = ' tiene ';
$lang['HAS2'] = ' puntos no consolidados';
$lang['HAS3'] = ' Los puntos se han convertido en puntos permanentes del usuario  ';
$lang['TOTAL'] = 'Mis Puntos';
$lang['MONTH'] = 'Mes';
$lang['YEAR'] = 'Año';
$lang['NOT_AVAILABLE'] = 'No disponible';
$lang['LEFT_POINTS'] = 'Puntos restantes';
$lang['OTHER_PROJECTS'] = 'Otros Rubros';
$lang['EXCHANGE_POINTS'] = 'Puntos Canjeados';
$lang['AS_SUPPLIER'] = 'Como Proveedor';
$lang['AS_CUSTOMER'] = 'Como Cliente';
$lang['CREATE_NEW_REQ'] = 'CREAR NUEVO REQUERIMIENTO DE CLIENTE INTERNO';
$lang['CUSTOMER'] = 'Cliente';
$lang['INTERNAL_SUPPLIER'] = 'Proveedor Interno';

$lang['TITLE_REQ'] = 'Titulo Requerimiento Cliente Interno';
$lang['DESC_REQ'] = 'Descripcion Requerimiento Cliente Interno';
$lang['PERIODICITY'] = 'Periodicidad';
$lang['ONLY_ONCE'] = 'Solo una vez';
$lang['EVERYDAY'] = 'Cada dia';
$lang['EVERY_WEEK'] = 'Cada semana';
$lang['EVERY_TWO_WEEKS'] = 'Cada dos semanas';
$lang['EVERY_MONTH'] = 'Cada mes';
$lang['EVERY_TWO_MONTHS'] = 'Cada dos meses';
$lang['EVERY_THREE_MONTHS'] = 'Cada tres meses';
$lang['EVERY_FOUR_MONTHS'] = 'Cada cuatro meses';
$lang['EVERY_SIX_MONTHS'] = 'Cada seis meses';
$lang['EVERY_TWELVE_MONTHS'] = 'Cada doce meses';
$lang['REPEATS'] = '# de repeticiones';
$lang['START_DATE_REQ'] = 'Fecha Inicio Evaluacion';
$lang['CONCEPT'] = 'Concepto';

$lang['REQ_SENT'] = 'Requirimiento enviado para su aprobacion';
$lang['AS_INTERNAL_SUPPLIER'] = 'Como proveedor interno';
$lang['AS_INTERNAL_CUSTOMER'] = 'Como cliente interno';
$lang['STATUS'] = 'Estado';
$lang['PENDING_APPROVEMENT'] = 'Solicitud pendiente';
$lang['APPROVED'] = 'Solicitud aprobada';
$lang['REJECTED'] = 'Solicitud denegada';
$lang['RCI_INFO'] = 'Datos del Requerimiento de Cliente Interno';
$lang['APPROVED_SUPERVISOR'] = 'Autorizado por Supervisor?';
$lang['APPROVED_SUPERADMIN'] = 'Autorizado por Super Administrador?';
$lang['AUTHORIZE_REQUEST'] = 'AUTORIZAR REQUERIMIENTO';
$lang['REJECT_REQUEST'] = 'RECHAZAR REQUERIMIENTO';
$lang['RCI_REVISIONS'] = 'CREAR FASES DE LA EVALUACION A PROVEEDOR INTERNO';
$lang['NO_REVISIONS'] = 'CREATE PHASES FOR THIS INTERNAL CUSTOMER REQUIREMENT';
$lang['EVALUATION_DATE'] = 'Fecha de la evaluación';

$lang['EVALUATION_STATE'] = 'Estado de la evaluación ';
$lang['NOT_EVALUATED'] = 'Sin evaluar';
$lang['EVALUATED'] = 'Evaluado';
$lang['EVALUATE'] = 'Evaluar Proveedor Interno';
$lang['NO_ANSWER_POINTS'] = 'No hay respuesta';
$lang['ESFUERZO_LEVE'] = 'Esfuerzo leve';
$lang['ESFUERZO_ACEPTABLE'] = 'Esfuerzo aceptable';
$lang['ESFUERZO_EXCEPCIONAL'] = 'Esfuerzo excepcional';
$lang['ABRIR_ENTREGABLE'] = 'Abrir Entregable';
$lang['AS_EMPLOYEE'] = 'Como empleado';
$lang['AS_SUPERVISOR'] = 'Como supervisor';

$lang['CREATE_NEW_TA'] = 'CREAR NUEVAS TAREAS DE PROACTIVIDAD';
$lang['EVALUATED'] = 'Usuario Evaluado';
$lang['TITLE_PT'] = 'Titulo de las Tareas de Proactividad';
$lang['DESC_PT'] = 'Descripcion de las Tareas de Proactividad';
$lang['PT_INFO'] = 'Datos de las Tareas de Proactividad';
$lang['PT_REVISIONS'] = 'CREAR FASES DE LA EVALUACION DE LAS TAREAS DE PROACTIVIDAD';
$lang['EVALUACION_TAREAS'] = 'Evaluar Tareas de Proactividad';
$lang['CHANGE_PASSWORD'] = 'Cambiar Contraseña';
$lang['CONFIRM_NEW_PASSWORD'] = 'Confirmar Nueva Contraseña';
$lang['NEW_PASSWORD'] = 'Nueva Contraseña';
$lang['PASSWORD_CHANGED'] = 'Contraseña cambiada';
$lang['ONLINE_STORES'] = 'Tiendas Online';
$lang['REGIONS'] = 'Regiones';
$lang['REGION'] = 'Region';

$lang['ADD_REGION'] = 'Nueva Region';
$lang['SUPERA_PORCENTAJE'] = 'El porcentaje acumulado no puede superar el 100%, porcentaje corregido. ';

?>