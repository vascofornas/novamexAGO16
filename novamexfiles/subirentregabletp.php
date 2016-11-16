<?php include_once 'common.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $lang['SELECT_FILE']?></title>

</head>



<body>



<?php 



 if ((isset($_POST["enviado"])) && ($_POST["enviado"]=="form1")){
$length = 6;

$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

$prefijo =  $randomString;
	

	$nombre_archivo = $_FILES['userfile']['name'];
	
	$file_upload = "true";
	if ($_FILES['userfile']['size']>2000000){
$file_upload="false";
}
	
	if ($file_upload == 'true'){
	
   $str=preg_replace('/\s+/', '', $nombre_archivo);
   $str =preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($str, ENT_QUOTES, 'UTF-8'));
	move_uploaded_file($_FILES['userfile']['tmp_name'],"entregables_tareas_proactividad/".$prefijo.$str);
	?>
	  <script>

	opener.document.form1.nombre_entregable.value="<?php echo $prefijo.$str;?>";
	 

	
	self.close();

	</script>
<?php
	
	}
	else 
	{
		echo "El archivo seleccionado es superior a 2MB, inténtalo de nuevo con otro archivo de tamaño inferior a 200KB.<BR><BR><BR>";?>
<input type='submit' name='submit' value='Reintentar' onClick="window.location.reload()" />
	
	
<?php }
	?>

  

	

	<?php 

}

else {?>

<form id="form1" name="form1" method="post" action="subirentregabletp.php" data-ajax="false" enctype="multipart/form-data">

  <p>

    <input name="userfile" type="file" />

  </p>

  <p>

    <input type="submit" name="button" id="button" value="<?php echo $lang['UPLOAD_DELIVERABLE']?>" />

    <input type="hidden" name="enviado" value="form1" />

  </p>


</form>

<?php }?>

</body>

</html>