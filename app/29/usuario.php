<?php
class Usuario
{
  public $id;
  public $nombre;
  public $apellido;
  public $clave;
  public $mail;
  public $fechaRegistro;
  public $localidad;

  public function __construct($id='', $nombre='', $apellido='', $clave, $mail, $fechaRegistro='', $localidad='')
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->clave = $clave;
    $this->mail = $mail;
    $this->fechaRegistro = $fechaRegistro;
    $this->localidad = $localidad;
  }

  public static function MostrarListado($listado)
  {
    echo "<ul>";
    foreach ($listado as $user) {
      echo "<li>" . $user->id . " - " . $user->apellido . ", " . $user->nombre ." - ".$user->mail."</li>";
    }
    echo "</ul>";
  }

  
  public static function VerificarUser($user, $arrayUsuarios)
  {
    foreach ($arrayUsuarios as $usuario)
    {
      if (($usuario->mail === $user->mail)&&($usuario->clave == $user->clave))
      {
        return "Verificado";
      }else if(($usuario->mail === $user->mail)&&($usuario->clave != $user->clave)){
        return "error en los datos";
      }
    }
    return "Usuario no registrado";
  }
}
