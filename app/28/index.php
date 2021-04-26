<?php
/*
Arias Mariano
Aplicación Nº 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <t
*/
include_once 'usuario.php';
include_once 'producto.php';
include_once 'venta.php';

$tipoLista = $_GET['tipo'];

$conStr = 'mysql:host = localhost; dbname = programacion3';
$user = 'root';
$pass = '123';
$pdo = new PDO($conStr, $user, $pass);
echo "Conexion exitosa<br>";

if (isset($tipoLista)) {

  switch ($tipoLista) {

    case 'usuarios':

      $listaUsuarios = array();
      $query = $pdo->prepare("SELECT * FROM programacion3.usuario");
      $query->execute();

      //$query->bindColumn()
      while ($result = $query->fetch())
    {
      $user = new Usuario($result['id'], $result['nombre'], $result['apellido'], $result['clave'], $result['mail'], $result['fecha_de_registro'], $result['localidad']);

      array_push($listaUsuarios, $user);
    }

    Usuario::MostrarListado(($listaUsuarios));

      break;
    case 'productos':
      $query = $pdo->prepare("SELECT * FROM programacion3.producto");
      $query->execute();

      $listaProductos= array ();
      while($result = $query->fetch()){
        $producto= new Producto($result['id'], $result['codigo_de_barra'], $result['nombre'], $result['tipo'], $result['stock'], $result['precio'], $result['fecha_de_creacion'], $result['fecha_de_modificacion']);
        array_push($listaProductos, $producto);
      }
      Producto::MostrarListado($listaProductos, $producto);
      break;
    case 'ventas':
      $query = $pdo->prepare("SELECT * FROM programacion3.venta");
      $query->execute();
      $listadoVentas = array();

      while($result = $query->fetch()){
        $venta= new Venta($result['id'], $result['id_producto'], $result['id_usuario'], $result['cantidad'], $result['fecha_de_venta']);
        array_push($listadoVentas, $venta);
      }

      Venta::MostrarListado($listadoVentas);
      break;
    default:
    echo "No se ha encontrado lista de ".$tipoLista;
  }
} else {
  echo "Error. Faltan datos";
}
