<?php

$errorMSG = "";

// NAME
if (empty($_POST["nombre_usuario"])) {
    $errorMSG = "Name is required ";
} else {
    $nombre_usuario = $_POST["nombre_usuario"];
}

// EMAIL
if (empty($_POST["apellidos_usuario"])) {
    $errorMSG .= "Last name is required ";
} else {
    $apellidos_usuario = $_POST["apellidos_usuario"];
}

// MESSAGE
if (empty($_POST["userPass"])) {
    $errorMSG .= "Password is required ";
} else {
    $message = $_POST["userPass"];
}




try {
	$host = "localhost";
	 $db_name = "herasosj_novamex";
	 $username = "herasosj_novamex";
	$password = "Papa020432";
	$conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
	$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "UPDATE tbl_users
      (nombre_usuario,apellidos_usuario,userPass)
      VALUES (:firstname, :lastname, :pass);
      ";



	$statement = $conn->prepare($sql);
	$statement->bindValue(":firstname", $nombre_usuario);
	$statement->bindValue(":lastname", $apellidos_usuario);
	$statement->bindValue(":pass", $userPass);

	$count = $statement->execute();

	$conn = null;        // Disconnect
}
catch(PDOException $e) {
	echo $e->getMessage();
}





// send email
$success = "Datos modificados";

// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>