<?php

 include('conector.php');


 $con = new ConectorBD('localhost','root', 'rootroot');
  $response['conexion'] = $con->initConexion('agenda');

  if ($response['conexion']=='OK') {

$data['login'] = "'admin@admin.com'";
$data['password'] = "md5('123')";
$data['nombre_completo'] = "'Pedro Perez'";
$data['fecha_nacimiento'] = "'1980-08-08'";

    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
	
$data['login'] = "'admin2@admin.com'";
$data['password'] = "md5('1234')";
$data['nombre_completo'] = "'Hugo Perez'";
$data['fecha_nacimiento'] = "'1980-08-08'";

    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }

$data['login'] = "'admin3@admin.com'";
$data['password'] = "md5('12345')";
$data['nombre_completo'] = "'Paco Perez'";
$data['fecha_nacimiento'] = "'1980-08-08'";

    if($con->insertData('usuario', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }

	
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);
  
  $con->cerrarConexion();

 ?>
