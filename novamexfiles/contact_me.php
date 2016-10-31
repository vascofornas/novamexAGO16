<?php
if($_POST)
{
    $to_email       = "modestovasco@gmail.com"; //Recipient email, Replace with own email here
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        
        $output = json_encode(array( //create JSON data
            'type'=>'error', 
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    } 
    
    //Sanitize input data using PHP filter_var().
    $supervisor      = filter_var($_POST["supervisor"], FILTER_SANITIZE_STRING);
//    $cliente     = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
  //  $proveedor   = filter_var($_POST["country_code"], FILTER_SANITIZE_NUMBER_INT);
    //$titulo   = filter_var($_POST["phone_number"], FILTER_SANITIZE_NUMBER_INT);
   // $texto        = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    
    //additional php validation
   // if(strlen($user_name)<4){ // If length is less than 4 it will output JSON error.
     //   $output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty!'));
       // die($output);
  //  }
    //if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
      //  $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
     //   die($output);
   // }
    //if(!filter_var($country_code, FILTER_VALIDATE_INT)){ //check for valid numbers in country code field
      //  $output = json_encode(array('type'=>'error', 'text' => 'Enter only digits in country code'));
        //die($output);
   // }
    //if(!filter_var($phone_number, FILTER_SANITIZE_NUMBER_FLOAT)){ //check for valid numbers in phone number field
      //  $output = json_encode(array('type'=>'error', 'text' => 'Enter only digits in phone number'));
        //die($output);
   // }
   // if(strlen($subject)<3){ //check emtpy subject
     //   $output = json_encode(array('type'=>'error', 'text' => 'Subject is required'));
       // die($output);
   // }
    //if(strlen($message)<3){ //check emtpy message
     //   $output = json_encode(array('type'=>'error', 'text' => 'Too short message! Please enter something.'));
       // die($output);
   // }
    
    //email body
    $message_body = $message."\r\n\r\n-".$supervisor."\r\nEmail : ".$supervisor."\r\nPhone Number : (".$supervisor.") ". $supervisor ;
    
    //proceed with PHP email.
    $headers = 'From: '.$supervisor.'' . "\r\n" .
    'Reply-To: '.$supervisor.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    $send_mail = mail($to_email, $subject, $message_body, $headers);
    
    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$supervisor .' Thank you for your email'));
        die($output);
    }
}
?>