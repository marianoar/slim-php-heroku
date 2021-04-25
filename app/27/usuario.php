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

  public function __construct($nombre = "", $apellido, $clave, $mail, $localidad)
  {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->clave = $clave;
    $this->mail = $mail;
    $this->localidad= $localidad;
    $this->SetId();
    $this->SetFechaRegistro();
  }

  function SetId()
  {
    $this->id = rand(1,1000);
  }

  function SetFechaRegistro()
  {
    $this->fechaRegistro = date('Y-m-d');
  }

  function GetFechaRegistro()
  {
    return $this->fechaRegistro;
  }
  function GetClave()
  {
    return $this->clave;
  }
  function GetMail()
  {
    return $this->mail;
  }
  public function GetDatos()
  {
    return $this->nombre . ", " . $this->clave . ", " . $this->mail;
  }

  public function UsuarioToCSV()
  {
    $archivo = fopen('usuarios.csv', 'a+');
    if ($archivo) {
      fwrite($archivo, $this->GetDatos() . "\n");
    }
    fclose($archivo);
    return true;
  }

  public static function UsuarioToJSON($usuario, $file)
  {
    $js=json_encode($usuario,JSON_UNESCAPED_UNICODE);

    $jsonencoded = json_encode($usuario,JSON_UNESCAPED_UNICODE);

    
    if(!file_exists($file)){
      $fh = fopen($file, 'a+');
      fwrite($fh, "[");
      fwrite($fh, $js);
      fwrite($fh, "]");
    }else{
      $fh = fopen($file, 'a+');
      $stat=fstat($fh);
      ftruncate($fh, $stat['size']-1);
      fwrite($fh, ",".PHP_EOL);
      fwrite($fh, $jsonencoded);
      fwrite($fh, "]");
    }
    
    fclose($fh);
    return true;
  }

  public static function leerArchivo($path)
  {
    if (file_exists($path)) {
      $file = fopen($path, 'r');
      while (!feof($file)) {
        $data[] = explode(",", fgets($file));
        // $linea[] = fgetcsv($file);
      }
      fclose($file);
      array_pop($data);
      return $data;
    } else {
      return false;
    }
  }

  public static function printInfo($arrayList)
  {
    echo "<ul>";

    foreach ($arrayList as $usuario) {
      echo "<li>" . $usuario[0] . $usuario[1] . $usuario[2] . "</li>";
    }

    echo "</ul>";
  }

  public static function VerificarUser($usuario, $arrayUsuarios)
  {
    $pass = $usuario->GetClave();
    $correo = $usuario->GetMail();

    trim($pass);
    trim($correo);

    foreach ($arrayUsuarios as $usuario) {
      if (trim($usuario[1]) == $pass && trim($usuario[2]) == $correo) {
        return "Verificado";
      } else if (trim($usuario[1]) != $pass && trim($usuario[2]) == $correo) {
        return "Error en los datos";
      } else if (trim($usuario[1]) == $pass && trim($usuario[2]) != $correo) {
        return "Usuario no registrado";
      }
    }
  }

  public function savePhoto($path)
  {
    $tipoArchivo = pathinfo($path, PATHINFO_EXTENSION);

    move_uploaded_file($_FILES["archivo"]["tmp_name"], $path);

    rename($path, "Fotos/" . $this->nombre . "." . $tipoArchivo);

    return true;
  }
}
