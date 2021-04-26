<?php
/*
Arias Mariano
Aplicación Nº 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos, 
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.
*/
include_once 'usuario.php';

$conStr = 'mysql:host = localhost; dbname = programacion3';
$user = 'root';
$pass = '123';
$pdo = new PDO($conStr, $user, $pass);
echo "Conexion exitosa<br>";

if (isset($_POST['clave']) && isset($_POST['mail'])) {

  $clave = trim($_POST['clave']);
  $mail = trim($_POST['mail']);
//echo $clave;
//echo $mail;
 $userLogin = new Usuario(null, null, null,  $clave, $mail, null, null);

  $listaUsuarios = array();
  $query = $pdo->prepare("SELECT * FROM programacion3.usuario");
  $query->execute();

  //$query->bindColumn()
  while ($result = $query->fetch())
  {
  $user = new Usuario($result['id'], $result['nombre'], $result['apellido'], $result['clave'], $result['mail'], $result['fecha_de_registro'], $result['localidad']);

  array_push($listaUsuarios, $user);
  }

  //Usuario::MostrarListado(($listaUsuarios));
  $login=Usuario::VerificarUser($userLogin, $listaUsuarios);
  echo $login;
} else {
  echo "Error. Faltan datos";
}
