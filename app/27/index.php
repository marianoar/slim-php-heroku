<?php
/*
Arias Mariano
Aplicación Nº 27 (Registro BD) 
Archivo: registro.php - método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST , 
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos  la base de datos 
retorna si se pudo agregar o no.
*/
include_once 'usuario.php';

//var_dump($_POST);

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['mail']) && isset($_POST['localidad'])) {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $clave = $_POST['clave'];
  $mail = $_POST['mail'];
  $localidad = $_POST['localidad'];

  $usuario = new Usuario($nombre, $apellido, $clave, $mail, $localidad);

  try
  {
    $conStr = 'mysql:host = localhost; dbname = programacion3';
    $user='root';
    $pass='123';
    $pdo = new PDO($conStr, $user, $pass);
    echo "Conexion exitosa<br>";

   $insert = $pdo->prepare
    ("INSERT INTO programacion3.usuario (nombre, apellido, clave, mail, fecha_de_registro, localidad) 
     VALUES (:nombre, :apellido, :clave, :mail, :fecha, :localidad)");

  $insert->bindParam('nombre', $usuario->nombre, pdo::PARAM_STR);
  $insert->bindParam('apellido', $usuario->apellido, pdo::PARAM_STR);
  $insert->bindParam('clave', $usuario->clave, pdo::PARAM_STR);
  $insert->bindParam('mail', $usuario->mail, pdo::PARAM_STR);
  $insert->bindParam('fecha', $usuario->fechaRegistro);
  $insert->bindParam('localidad', $usuario->localidad, pdo::PARAM_STR);

  var_dump($usuario->fechaRegistro);
if ($insert->execute()) {
  echo "Se ha creado un nuevo registro <br>";
} else {
  echo "Error";
}

}
catch (PDOException $ex)
{
  echo 'Error '.$ex->getMessage()."<br>";
}
} else {
  echo "Error. Faltan datos";
}