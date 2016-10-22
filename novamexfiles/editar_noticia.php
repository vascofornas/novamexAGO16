<?php

$server = 'localhost';
$user =  'herasosj_novamex';
$pass =  'Papa020432';
$db = 'herasosj_novamex';
include_once 'funciones.php';
// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

if ($_POST['title_news']) {

	$texto = "USUARIO MODIFICA NOTICIA";
	$codigo = "011";
	$miemail = get_email($_SESSION['userSession']);
	add_log($texto,$miemail,$codigo);

    $title_news = $_POST['title_news'];

    $title_news_en = $_POST['title_news_en'];
    
    $text_news = $_POST['text_news'];
   
    $text_news_en = $_POST['text_news_en'];
  
    $active_news = $_POST['active_news'];
    
    $user_news = $_POST['user_news'];
    
    $id_news = $_POST['id_news'];
   
    // if everything is fine, update the record in the database
    if ($stmt = $mysqli->prepare("UPDATE tb_news SET title_news = ?, title_news_en = ?,
    		text_news = ?, text_news_en = ?,
    		user_news = ?, active_news = ?
WHERE id_news=?"))
    {
    	$stmt->bind_param("sssssii", $title_news, $title_news_en,$text_news,$text_news_en,$user_news,$active_news, $id_news);
    	$stmt->execute();
    	$stmt->close();
    }
    // show an error message if the query has an error
    else
    {
    	echo "ERROR: could not prepare SQL statement.";
    }
    
    // redirect the user once the form is updated
    header("Location: home.php");
    
}

?>