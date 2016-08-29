<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>FLETES MEXICO</title>
        <!-- Bootstrap -->
          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
          <meta charset="utf-8" />
          <link rel="shortcut icon" type="image/x-icon" href="truck.ico" />
       
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oxygen:400,700">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script charset="utf-8" src="webapp.js"></script>
      
          <style type="text/css">
  body {
	background-image: url(fondofletes.jpg);
}
  </style>
  

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
    
    <!--/.ADMINISTRADOR-->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span></a>
                    <a class="brand" href="#">FLETES MEXICO</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['userName']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                 <li>
                                        <a href="miperfil.php">Mi perfil</a>
                                    </li>
                                    <li>
                                        <a  href="logout.php">Logout</a>
                                    </li>
                                   
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                           <li>
                                <a href="home.php">Inicio</a>
                            </li>
                            <li class="active">
                                <a href="usuarios.php">Usuarios</a>
                            </li>
                            <li>
                                <a href="documentos.php">Documentos</a>
                            </li>
                             <li>
                                <a href="licencias.php">Licencias Conducir / Afiliacion IMMS</a>
                            </li>
                            <li >
                                <a href="vencimientos.php">Documentos por vencer</a>
                            </li>
                            <li>
                                <a href="contacto.php">Contacto</a>
                            </li>
                           
                            
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
                      <!--/.ADMINISTRADOR-->
         <body id="home">
   
    <div id="page_container">

      

      <button type="button" class="button" id="add_company">Nuevo usuario </button>

      <table class="datatable" id="table_companies">
        <thead>
          <tr>
           
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Nivel Acceso</th>
            
            <th>Activado?</th>
            <th>Funciones</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    </div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
        
        <h2>Add company</h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          
          <div class="input_container">
            <label for="userName">Usuario: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="userName" id="userName" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="nombre_usuario">Nombre: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="nombre_usuario" id="nombre_usuario" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="apellidos_usuario">Apellidos: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="apellidos_usuario" id="apellidos_usuario" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="userEmail">Email: <span class="required">*</span></label>
            <div class="field_container">
              <input type="email" class="text" name="userEmail" id="userEmail" value="" required>
            </div>
          </div>
           <div class="input_container">
            <label for="userPass">Contraseña: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text"  class="text" name="userPass" id="userPass" value="" required>
            </div>
          </div>
          <div class="input_container">
            <label for="userLevel">Nivel de Acceso: <span class="required">*</span></label>
            <div class="field_container">
              <select  id="userLevel" name="userLevel" required>
              <option selected="selected">Nivel 1</option>
              <option>Nivel 2</option>
              <option>Nivel 3</option>
              </select>
            </div>
          </div>
          
          <div class="input_container">
            <label for="userStatus">Activado?: <span class="required">*</span></label>
            <div class="field_container">
              <select  id="userStatus" name="userStatus" required >
              <option selected="selected">Y</option>
              <option>N</option>
              
              </select>
            </div>
          </div>
          <div class="button_container">
            <button type="submit">Add company</button>
          </div>
        </form>
        
      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
            Procesando datos, espere, por favor...
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- /container -->
        <!--/.fluid-container-->
        
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>