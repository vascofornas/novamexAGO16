
<div class="bs-example">
    <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             <a href="home.php" class="navbar-brand">
<img   src="logonovamex100.png" width="207" height="55" style="PADDING-TOP: 5px"></a>
        
 
           <BR>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <?php 
  $idioma_actual = $_SESSION['lang'];
  
  
  if ($idioma_actual == "es"){?>
  <a href="<?php basename($_SERVER['PHP_SELF'])?>?lang=es<?php echo '&id='.$_GET['id'].'&rev='.$_GET['rev'].'&pu='.$_GET['pu']?>"><img src="mexico.png" width="45" height="45" /></a>
<a href="<?php basename($_SERVER['PHP_SELF'])?>?lang=en<?php echo '&id='.$_GET['id'].'&rev='.$_GET['rev'].'&pu='.$_GET['pu']?>"><img src="usa.png" width="30" height="30" /></a>
  <?php }
  if ($idioma_actual == "en"){?>
  <a href="<?php basename($_SERVER['PHP_SELF'])?>?lang=en<?php echo '&id='.$_GET['id'].'&rev='.$_GET['rev'].'&pu='.$_GET['pu']?>"><img src="usa.png" width="45" height="45" /></a>
  <a href="<?php basename($_SERVER['PHP_SELF'])?>?lang=es<?php echo '&id='.$_GET['id'].'&rev='.$_GET['rev'].'&pu='.$_GET['pu']?>"><img src="mexico.png" width="30" height="30" /></a>
  
<?php }?>

<?php 

$query = "SELECT * from tb_mensajes WHERE leido ='NO' AND receptor = '".$row['userID']."'";
 if ($result=mysqli_query($conexion,$query))
  {
   if(mysqli_num_rows($result) > 0)
    {
      ?>
      <a href="mensajes_recibidos.php"><img class="blink-image" src="email_open.png" width="40" height="40" /></a>
      <?php 
    }
  else
      echo $lang['NO_MESSAGE'];
  }
else
    echo "Query Failed.";
    ?>
                <li class="active"><a href="admin_home.php"><?php echo $lang['ADMIN_ZONE']?></a></li>
                <li ><a href="home.php"><?php echo $lang['MEMBER_HOME']?></a></li>
                  <li class="dropdown">
                
                         <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['PROFILE']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="miperfil.php"><?php echo $lang['DATOS_PERSONALES']?></a></li>
                        <li class="divider"></li>
                         <li><a href="misproyectos.php"><?php echo $lang['MY_PROJECTS']?></a></li>
                         <li class="divider"></li>
                         <li><a href="requerimientos_cliente_interno.php"><?php echo $lang['REQUERIMIENTOS_CLIENTE_INTERNO']?></a></li>
                    
                         <li><a href="evaluaciones_rci.php"><?php echo $lang['EVALUACION_PROVEEDOR_INTERNO']?></a></li>
                           <li class="divider"></li>
                           <li><a href="tareas_proactividad.php"><?php echo $lang['TAREAS_PROACTIVIDAD']?></a></li>
                            <li><a href="evaluaciones_tp.php"><?php echo $lang['EVALUACION_TAREAS']?></a></li>
                    <li class="divider"></li>
                      <li><a href="otros_rubros.php"><?php echo $lang['OTHER_PROJECTS']?></a></li>
                           
                      <li class="divider"></li>
                       <li><a href="misreconocimientos.php"><?php echo $lang['MIS_RECONOCIMIENTOS']?></a></li>
                       <li class="divider"></li>
                       <li><a href="tiendas.php"><?php echo $lang['ONLINE_STORES']?></a></li>
                     
                        
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['MESSAGES']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="mensajes_recibidos.php"><?php echo $lang['RECEIVED_MESSAGES']?></a></li>
                        <li><a href="mensajes.php"><?php echo $lang['SENT_MESSAGES']?></a></li>
                         <li><a href="nuevo_mensaje.php"><?php echo $lang['COMPOSE_MESSAGE']?></a></li>
                        
                        
                    </ul>
                </li>
                 <li ><a href="videos.php">Videos</a></li>
                <?php  
				$nivel = $row['userLevel'];
				if ($nivel == "Level 3" || $nivel == "Level 4" || $nivel == "Level 5") {
				?>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['LEVEL_3_OPTIONS']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="mispuntoslibres_select.php"><?php echo $lang['FREE_POINTS']?></a></li>
                         <li><a href="autorizar_rci.php"><?php echo $lang['REQUERIMIENTOS_CLIENTE_INTERNO']?></a></li>
                        
                    </ul>
                </li>
              <?php 
				}
				if ($nivel == "Level 5") {
					?>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $lang['LEVEL_5_OPTIONS']?> <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="admin_welcome_message.php"><?php echo $lang['WELCOME_MESSAGE']?></a></li>
                        <li><a href="admin_news.php"><?php echo $lang['NEWS']?></a></li>
                        <li class="divider"></li>
                        <li><a href="admin_bu.php"><?php echo $lang['BUSINESS_UNITS']?></a></li>
                        <li><a href="admin_departamentos.php"><?php echo $lang['REGIONS']?></a></li>
                        <li><a href="admin_equipos.php"><?php echo $lang['TEAMS']?></a></li>
                        <li><a href="admin_miembros_equipos.php"><?php echo $lang['TEAM_MEMBERS']?></a></li>
                        <li class="divider"></li>
                        <li><a href="admin_tipo_proyectos.php"><?php echo $lang['PROJECT_TYPES']?></a></li>
                        <li><a href="admin_proyectos.php"><?php echo $lang['PROJECTS']?></a></li>
                        
                        <li><a href="admin_evaluacion_proyectos.php"><?php echo $lang['PROJECT_EVAL']?></a></li>
                        <li class="divider"></li>
                        <li><a href="admin_rci.php"><?php echo $lang['REQUERIMIENTOS_CLIENTE_INTERNO']?></a></li>
                                 <li><a href="admin_evaluacion_proveedor_interno.php"><?php echo $lang['EVALUACION_PROVEEDOR_INTERNO']?></a></li>
                        <li class="divider"></li>
                      <li><a href="admin_tareas_proactividad.php"><?php echo $lang['TAREAS_PROACTIVIDAD']?></a></li>
                     <li><a href="admin_evaluacion_tareas_proactividad.php"><?php echo $lang['EVALUACION_TAREAS']?></a></li>
                        <li class="divider"></li>
                      <li><a href="admin_tipos_otros_rubros.php"><?php echo $lang['TIPOS_OTROS_RUBROS']?></a></li>
                     <li><a href="admin_evaluacion_tareas_proactividad.php"><?php echo $lang['OTHER_PROJECTS']?></a></li>
                       
                      <li class="divider"></li>
                        <li><a href="admin_free_points.php"><?php echo $lang['FREE_POINTS']?></a></li>
                        <li><a href="admin_free_points_assigned.php"><?php echo $lang['GIVEN_POINTS']?></a></li>
                        
                        
                        <li class="divider"></li>
                          <li><a href="admin_historico.php"><?php echo $lang['HISTORICO']?></a></li>
                       
                        <li class="divider"></li>
                        <li><a href="admin_usuarios.php"><?php echo $lang['USERS']?></a></li>
                         <li class="divider"></li>
                        <li><a href="admin_config.php"><?php echo $lang['SETUP']?></a></li>
                        
                          
                        
                        
                    </ul>
                </li>
                <?php }?>
                
                
                
                
                
            </ul>
            
          <ul class="nav pull-right">
            	<li class="dropdown">
                	<a href="#" role="button"  class="dropdown-toggle" data-toggle="dropdown">
                       <img src="usuarios/<?php echo $row['imagen_usuario']?>" alt="<?php echo $row['userName']?>" height="70" width="70">
    
                    <?php echo $row['userName']." (". $lang['USER'].$row['userLevel'].")";?> <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu">
                    <li>
                    <a tabindex="-1" href="cambiar_pass.php"><?php echo $lang['CHANGE_PASSWORD']?></a>
                    <a tabindex="-1" href="logout.php"><?php echo $lang['LOGOUT']?></a>
                    </li>
                    
                    </ul>
              </li>
          </ul> 
        </div>
    </nav>
</div>