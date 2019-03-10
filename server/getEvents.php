<?php
session_start();
if($_SESSION['id_usuario']){
	require ('conector.php');
	
	$con = new ConectorBD('localhost','root', 'rootroot');
	$response['conexion'] = $con -> initConexion('agenda');

	if ($response['conexion'] == 'OK') {
		
		$query="select * from evento WHERE id_usuario=".$_SESSION['id_usuario'];
//echo $query;

$resultado_consulta = $con->ejecutarQuery($query);
	
		if ($resultado_consulta->num_rows != 0) {
			$i=0;
			while ($fila = $resultado_consulta->fetch_assoc()) {
				$evento['id'] = $fila['id_evento'];
				$evento['title'] = $fila['titulo'];
				if($fila['evento_dia'] == 1){
					$evento['start'] = $fila['fecha_inicial'];
					$evento['allDay'] = true;
				} else {
					$evento['start'] = $fila['fecha_inicial'].'T'.$fila['hora_inicial'];
					$evento['end'] = $fila['fecha_final'].'T'.$fila['hora_final'];
					$evento['allDay'] = false;
				}
				$evento['color'] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
				$response['eventos'][$i] = $evento;
				$i++;
			}
		}
		$response['msg'] = 'OK';
	} else
		$response['msg'] = 'Problemas con la conexión a la base de datos';
} else
	$response['msg'] = 'Debe iniciar sesión';

echo json_encode($response);
?>

