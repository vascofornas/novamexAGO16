<?php

if( $_POST ){
	
    $fname = $_POST['nombre_usuario'];
    $lname = $_POST['apellidos_usuario'];
    $email = $_POST['userPass'];
    

    ?>
    
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Form Submitted Successfully...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td>Nombre</td>
    <td><?php echo $fname ?></td>
    </tr>
    
    <tr>
    <td>Apellidos</td>
    <td><?php echo $lname ?></td>
    </tr>
    
    <tr>
    <td>Contraseña</td>
    <td><?php echo $email; ?></td>
    </tr>
    
    
    
    </table>
    <?php
	
}