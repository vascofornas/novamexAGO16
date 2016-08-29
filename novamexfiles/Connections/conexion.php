<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion = "localhost";
$database_conexion = "herasosj_novamex";
$username_conexion = "herasosj_novamex";
$password_conexion = "Papa020432";
$conexion = mysqli_connect($hostname_conexion, $username_conexion, $password_conexion,$database_conexion) or trigger_error(mysql_error(),E_USER_ERROR); 
mysqli_set_charset($conexion, 'utf8');
?>