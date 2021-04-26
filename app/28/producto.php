<?php

class producto{

  public $id;
  public $codigoDeBarra;
  public $nombre;
  public $tipo;
  public $stock;  
  public $precio;
  public $fechaCreacion;
  public $fechaModificacion;

  public function __construct($id, $codigoDeBarra, $nombre, $tipo, $stock, $precio, $fechaCreacion, $fechaModificacion)
  {
    $this->id=$id;
    $this->codigoDeBarra=$codigoDeBarra;
    $this->nombre = $nombre;
    $this->tipo = $tipo;
    $this->stock = $stock;
    $this->precio=$precio;
    $this->fechaCreacion=$fechaCreacion;
    $this->fechaModificacion=$fechaModificacion;
  }

  public static function MostrarListado($listado){
    echo "<ul>";
    foreach($listado as $producto){
      echo "<li>".$producto->id." - ". $producto->codigoDeBarra. " - ".$producto->nombre."</li>";
    }
    echo "</ul";
  }
}