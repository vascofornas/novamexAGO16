<div class="bs-example">
                     
    <nav role="navigation" class="navbar navbar-default">
    
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <button type="button" data-target="#navbarCollapse" style="PADDING-TOP: 5px" data-toggle="collapse" class="navbar-toggle">
                
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a href="home.php" class="navbar-brand">
<img   src="logonovamex100.png" width="207" height="55" style="PADDING-TOP: 5px"></a>
        
 
   
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        
        
        
        <div id="navbarCollapse" class="collapse navbar-collapse" style="PADDING-TOP: 15px">
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
                <li ><a href="home.php"><?php echo $lang['HOME']?></a></li>
                
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
			
				if ($nivel != "Level 1") {
					?>
                    <li>
                    <a href="admin_home.php"><?php echo $lang['ADMIN_ZONE']?></a>
                    </li>
                    <?php 
				}
				?>
                
            </ul>
            
           <ul class="nav pull-right">
            	<li class="dropdown">
                	<a href="#" role="button"  class="dropdown-toggle" data-toggle="dropdown">
                       <img src="usuarios/<?php echo $row['imagen_usuario']?>" alt="<?php echo $row['userName']?>" height="50" width="50" >
    
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