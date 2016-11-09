<?php
include 'funciones.php';
include_once 'common.php';
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
    $eval_c1      = filter_var($_POST["eval_c1"], FILTER_SANITIZE_STRING);
    $eval_c2      = filter_var($_POST["eval_c2"], FILTER_SANITIZE_STRING);
    $eval_c3      = filter_var($_POST["eval_c3"], FILTER_SANITIZE_STRING);
    $eval_c4      = filter_var($_POST["eval_c4"], FILTER_SANITIZE_STRING);
    $eval_id      = filter_var($_POST["eval_id"], FILTER_SANITIZE_STRING);
    $proveedor      = filter_var($_POST["proveedor"], FILTER_SANITIZE_STRING);
    
    
    $suma_nueva = $eval_c1 + $eval_c2 + $eval_c3+ $eval_c4;
    
    $c1_anterior = get_c1($eval_id);
    $c2_anterior = get_c2($eval_id);
    $c3_anterior = get_c3($eval_id);
    $c4_anterior = get_c4($eval_id);
	$suma_anterior = $c1_anterior+$c2_anterior+$c3_anterior+$c4_anterior;
	
	$res = $suma_anterior + $suma_nueva;

    $mysqli = new mysqli('localhost', 'herasosj_novamex', 'Papa020432', 'herasosj_novamex');
    
    $sql = "UPDATE tb_revisiones_rci SET estado_evaluacion = 1, evaluacion_c1 = '".$eval_c1."', evaluacion_c2 = '".$eval_c2."', evaluacion_c3 = '".$eval_c3."', evaluacion_c4 = '".$eval_c4."'
    		WHERE id_revisiones_rci = '".$eval_id."'";
    
    if ($mysqli->query($sql) === TRUE) {
    	
    	
    	//comprobar si tiene saldo en puntos dispoibles
    	
    	$ya_tiene_puntos = comprobar_existe_puntos_disponibles($proveedor);
    	if ($ya_tiene_puntos == 0){
    		crear_puntos_disponibles($proveedor,$suma_nueva);
    	}
    	
    	if ($ya_tiene_puntos >0){
    		$puntos_actuales = get_puntos_disponibles($proveedor);
    		$puntos = $puntos_actuales + $suma_nueva;
    		update_puntos_disponibles($proveedor, $puntos);
    	}
    	 
    	

    	$output = json_encode(array('type'=>'message', 'text' => ' '. $lang['EVALUATED']."  <a class='btn btn-primary' href='evaluaciones_rci.php' role='button'>".$lang['GO']."</a>"));
    	die($output);
    		
    } else {
    
    }
    

   
}
?>