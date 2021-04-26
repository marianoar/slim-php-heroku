<?php
class Venta{

  public $id;
  public $idProducto;
  public $idUsuario;
  public $cantidad;
  public $fechaVenta;


  public function __construct($id, $idProducto, $idUsuario, $cantidad, $fechaVenta)
  {
    $this->id=$id;
    $this->idProducto=$idProducto;
    $this->idUsuario = $idUsuario;
    $this->cantidad = $cantidad;
    $this->fechaVenta=$fechaVenta;
  }

  public static function MostrarListado($listado){
    echo "<ul>";
    foreach($listado as $venta){
      echo "<li>".$venta->id." - ". $venta->idProducto. " - ".$venta->idUsuario." - ".$venta->cantidad." - ".$venta->fechaVenta."</li>";
    }
    echo "</ul";
  }
}