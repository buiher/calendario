<?php
session_start();
require('conector.php');

 $con = new ConectorBD('localhost','root', 'rootroot');
  $response['conexion'] = $con->initConexion('agenda');
  
  if ($response['conexion']=='OK') {

$query='select * from usuario WHERE login="'.$_POST['username'].'" AND password= md5( "'.$_POST['password'].'" )';
//echo $query;
$resultado_consulta = $con->ejecutarQuery($query);

    if ($resultado_consulta->num_rows != 0) {
      $fila = $resultado_consulta -> fetch_assoc();
$_SESSION['id_usuario']=$fila['id_usuario'];
//echo $fila['id_usuario'];
  
	  $response['acceso'] = 'concedido';
    }else $response['acceso'] = 'rechazado';
  }

  echo json_encode($response);

  $con->cerrarConexion();







 ?>
