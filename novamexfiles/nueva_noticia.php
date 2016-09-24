<?php

$dbhost= 'localhost';
$dbusername =  'herasosj_novamex';
$dbpassword =  'Papa020432';
$dbname = 'herasosj_novamex';

if ($_POST['title_news']) {



    $title_news = $_POST['title_news'];

    $title_news_en = $_POST['title_news_en'];

    $text_news = $_POST['text_news'];

    $text_news_en = $_POST['text_news_en'];

    $active_news = $_POST['active_news'];
    
  
    $user_news = $_POST['user_news'];    
  
    $link = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername,$dbpassword);
    
    $statement = $link->prepare("INSERT INTO tb_news (title_news,title_news_en,text_news,text_news_en,user_news, active_news)
    VALUES(:fn1, :fn2, :fn3, :fn4, :fn5, :fn6)");
    $statement->execute(array(
    		"fn1" => $title_news,
    		"fn2" => $title_news_en,
    		"fn3" => $text_news,
    		"fn4" => $text_news_en,
    		"fn5" => $user_news,
    		
    		"fn6" => $active_news
    ));
   
    	header('location: home.php');
  
}

?>