<?php
class Administradores extends AccesoDatos
{

  private $dbh;
  private $result;

  public function __construct()
  {
    $this->result = array();
  }

  public function get_administradores()
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      $query = "SELECT * FROM administradores";
      $stmt = $this->dbh->prepare($query);
      if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $this->result[] = $row;
        }
        return $this->result;
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      }
    } catch (Exception $e) {
      die("¡Error!: get_administradores() " . $e->getMessage());
    }
  }

  public function get_id_admin($idAdmin)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      #$idAdminDs = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
      $query = "SELECT * FROM administradores 
      where id_admin = ?";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(1, $idAdmin, PDO::PARAM_INT);
      if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $this->result[] = $row;
        }
      }
      return $this->result;
      $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
      $stmt = null; // obligado para cerrar la conexión
      $this->dbh = null;
    } catch (Exception $e) {
      die("¡Error!: get_id_admin() " . $e->getMessage());
    }
  }
  
  public function get_InnerPersona($idAdmin)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      #$idAdminDs = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
      $query = "SELECT a.*, cr.nombre as rol FROM administradores a
      INNER JOIN c_rol cr USING(id_rol) 
      where id_admin = ?";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(1, $idAdmin, PDO::PARAM_INT);
      if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $this->result[] = $row;
        }
      }
      return $this->result;
      $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
      $stmt = null; // obligado para cerrar la conexión
      $this->dbh = null;
    } catch (Exception $e) {
      die("¡Error!: get_id_admin() " . $e->getMessage());
    }
  }

  public function add_administradores($idInstitucion, $idRol, $nombre, $apellidos, $email, $telefono, $usuario, $clave)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      $query = "INSERT INTO administradores VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindValue(1, null, PDO::PARAM_INT);
      $stmt->bindValue(2, $idInstitucion, PDO::PARAM_INT);
      $stmt->bindValue(3, $idRol, PDO::PARAM_INT);
      $stmt->bindValue(4, $nombre, PDO::PARAM_STR);
      $stmt->bindValue(5, $apellidos, PDO::PARAM_STR);
      $stmt->bindValue(6, $email, PDO::PARAM_STR);
      $stmt->bindValue(7, $telefono, PDO::PARAM_STR);
      $stmt->bindValue(8, $usuario, PDO::PARAM_STR);
      $stmt->bindValue(9, $clave, PDO::PARAM_STR);
      $stmt->bindValue(10, 1, PDO::PARAM_INT);
      $stmt->execute();
      $id = $this->dbh->lastInsertId();
      return $this->result[] = $id;
      $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
      $stmt = null; // obligado para cerrar la conexión
      $this->dbh = null;
    } catch (Exception $e) {
      die("¡Error!: add_administradores() " . $e->getMessage());
    }
  }

  public function update_id_admin($idAdmin, $idRol, $nombre, $apellidos, $email, $telefono)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
      $query = "UPDATE administradores SET id_rol=?, nombre=?, apellidos=?, email=?, telefono=? WHERE id_admin = ?";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindValue(1, $idRol, PDO::PARAM_INT);
      $stmt->bindValue(2, $nombre, PDO::PARAM_STR);
      $stmt->bindValue(3, $apellidos, PDO::PARAM_STR);
      $stmt->bindValue(4, $email, PDO::PARAM_STR);
      $stmt->bindValue(5, $telefono, PDO::PARAM_STR);
      $stmt->bindValue(6, $idAdmin, PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
      $stmt = null; // obligado para cerrar la conexión
      $this->dbh = null;
    } catch (PDOException $e) {
      die("¡Error!: update_id_admin()" . $e->getMessage());
    }
  }
  
  public function update_id_admin_pass($idAdmin, $usuario, $clave)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
      $query = "UPDATE administradores SET usuario = ?, clave = ? WHERE id_admin = ?";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindValue(1, $usuario, PDO::PARAM_STR);
      $stmt->bindValue(2, $clave, PDO::PARAM_STR);
      $stmt->bindValue(3, $idAdmin, PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
      $stmt = null; // obligado para cerrar la conexión
      $this->dbh = null;
    } catch (PDOException $e) {
      die("¡Error!: update_id_admin_pass()" . $e->getMessage());
    }
  }

  public function delete_id_admin($idAdmin, $activo)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
      $query = "UPDATE administradores SET activo = ? WHERE id_admin = ?";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindValue(1, $activo, PDO::PARAM_INT);
      $stmt->bindValue(2, $idAdmin, PDO::PARAM_INT);
      $stmt->execute();
      $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
      $stmt = null; // obligado para cerrar la conexión
      $this->dbh = null;
    } catch (PDOException $e) {
      die("¡Error!: delete_id_admin() " . $e->getMessage());
    }
  }

  public function get_byIdInstitucion($cveInstitucion)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      $query = "SELECT a.id_institucion, a.id_admin, a.id_rol, cr.nombre as rol, CONCAT(a.nombre,' ',a.apellidos) as nombre FROM administradores a
      INNER JOIN institucion b USING(id_institucion)
      INNER JOIN c_rol cr USING(id_rol)
      WHERE id_institucion = ?
      AND id_rol = 3";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(1, $cveInstitucion, PDO::PARAM_INT);
      if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $this->result[] = $row;
        }
        return $this->result;
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      }
    } catch (Exception $e) {
      die("¡Error!: get_idInstitucion()" . $e->getMessage());
    }
  }

  #METODO PARA INICIAR SESION
  public function logueo($suario)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      $query = "SELECT * FROM administradores WHERE usuario = ? ";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(1, $suario, PDO::PARAM_STR);
      if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $this->result[] = $row;
        }
        return $this->result;
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      }
    } catch (Exception $e) {
      die("¡Error!: logueo()" . $e->getMessage());
    }
  }

  public function salir()
  {
    // session_start();
    unset($_SESSION["cve_p"]);
    // Destruir todas las variables de sesión.
    $_SESSION = array();
    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );
    }
    // Finalmente, destruir la sesión.
    session_destroy();
    header("Location:" . AccesoDatos::ruta() . "?accion=loginUsuario&m=" . AccesoDatos::encriptar(3) . "");
    exit();
  }
  
  # Valida duplicados por nombres y usuario
  public function valid_administradores($nombre, $apellidos, $idInstitucion)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      $query = "SELECT * FROM administradores WHERE nombre = ? AND apellidos = ? AND id_institucion = ?";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
      $stmt->bindParam(2, $apellidos, PDO::PARAM_STR);
      $stmt->bindParam(3, $idInstitucion, PDO::PARAM_INT);
      if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != null) $this->result[] = $row;
        return $this->result;
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      }
    } catch (Exception $e) {
      die("¡Error!: valid_administradores() " . $e->getMessage());
    }
  }

  #Recupera contraseñas valida e-mail inicial.
  public function get_recoveryEmail($email, $usuario) 
  {
    try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM administradores a
        WHERE a.email = ?
        AND a.usuario = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $usuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }
            return $this->result;
            $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
            $stmt = null; // obligado para cerrar la conexión
            $this->dbh = null;
        }
    } catch (Exception $e) {
        die("¡Error!: get_recoveryEmail()" . $e->getMessage());
    }
  }

  public function get_personalByInstitucion($cveInstitucion)
  {
    try {
      $this->dbh = AccesoDatos::conexion();
      $and = '';
      if($_SESSION["idInstitucion"] != 1) $and = 'AND id_rol not in (2)';
      $query = "SELECT a.id_institucion, a.id_admin, a.id_rol, cr.nombre as rol, a.nombre, a.apellidos, a.email, a.telefono FROM administradores a
      INNER JOIN institucion b USING(id_institucion)
      INNER JOIN c_rol cr USING(id_rol)
      WHERE id_institucion = ?
      $and ";
      $stmt = $this->dbh->prepare($query);
      $stmt->bindParam(1, $cveInstitucion, PDO::PARAM_INT);
      if ($stmt->execute()) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $this->result[] = $row;
        }
        return $this->result;
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      }
    } catch (Exception $e) {
      die("¡Error!: get_idInstitucion()" . $e->getMessage());
    }
  }

}
