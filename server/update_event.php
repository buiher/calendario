<?php
 
function validateDate($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

session_start();

if (isset($_SESSION['id_usuario'])) {
	require 'conector.php';
	$con= new ConectorBD('localhost','root', 'rootroot');
	$response['conexion']= $con->initConexion('agenda');

	if ($response['conexion']=="OK") {

		if(validateDate($_GET['start_date'], 'Y-m-d'))
			$datos['fecha_inicial'] = $_POST['start_date'];
		if(validateDate($_GET['start_hour'], 'H:i:s'))
			$datos['hora_inicial'] = $_POST['start_hour'];
		if(validateDate($_GET['end_date'], 'Y-m-d'))
			$datos['fecha_final'] = $_POST['end_date'];
		if(validateDate($_GET['end_hour'], 'H:i:s'))
			$datos['hora_final'] = $_POST['end_hour'];

		if ($con->actualizarRegistro('evento', $datos, 'id_evento= '.$_POST['id'])) {
			$response['msg'] = 'OK';
		}else
			$response['msg'] = 'Se ha producido un error al guardar el evento'. $_POST['id'];
		
	}else
		$response['msg'] = 'Problemas con la conexión a la base de datos';

}else
	$response['msg']="Debe iniciar sesión";


echo json_encode($response);


 ?>
