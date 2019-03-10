<?php

session_start();
if ($_SESSION['id_usuario']) {
	require ('conector.php');

	$con = new ConectorBD('localhost','root', 'rootroot');
	$response['conexion'] = $con -> initConexion('agenda');
	if ($response['conexion'] == 'OK') {
		if ($con -> eliminarRegistro('evento', 'id_evento = ' . $_POST['id']))
			$response['msg'] = 'OK';
		else
			$response['msg'] = 'Se ha producido un error al eliminar el evento';
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
} else
	$response['msg'] = 'Debe iniciar sesión';

echo json_encode($response);


 ?>
