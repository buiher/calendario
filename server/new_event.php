<?php
  
session_start();
	require ('conector.php');
	$con = new ConectorBD('localhost','root', 'rootroot');
	$response['conexion']= $con->initConexion('agenda');

	if ($response['conexion']=="OK") {
		$datos['titulo'] = $_POST['titulo'];
		$datos['fecha_inicial'] = $_POST['start_date'];
		if($_GET['allDay']=='true')
			$datos['evento_dia'] = 1;
		else {
			$datos['evento_dia'] = 0;
			$datos['hora_inicial'] = $_POST['start_hour'];
			$datos['fecha_final'] = $_POST['end_date'];
			$datos['hora_final'] = $_POST['end_hour'];
		}
		$datos['id_usuario'] = $_SESSION['id_usuario'];

		if ($con->insertData('evento',$datos)) {
			$response['msg'] = 'OK';
		}else
			$response['msg'] = 'Se ha producido un error al guardar el evento';
	}else
		$response['msg'] = 'Problemas con la conexión a la base de datos';

echo json_encode($response);

 ?>
