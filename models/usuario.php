<?php
class Usuario extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_usuarios()
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM usuarios";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: get_usuarios() " . $e->getMessage());
      }
    }

    public function get_id_admin($idAdmin)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
        $query = "SELECT * FROM usuarios where id_admin = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $idAdminDs, PDO::PARAM_INT);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $this->result[] = $row;
        }
        return $this->result;
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: get_id_admin() " . $e->getMessage());
      }
    }

    public function add_usuario($usuario, $clave, $rol)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "INSERT INTO usuario (usuario, clave, activo) VALUES (?, ?, ?);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(2, $usuario, PDO::PARAM_STR);
        $stmt->bindValue(3, $clave, PDO::PARAM_STR);
        $stmt->bindValue(4, $rol, PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_usuario() " . $e->getMessage());
      }
    }

    public function update_id_admin($idAdmin, $usuario, $clave, $rol)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
        $query = "UPDATE usuarios SET usuario = ?, clave = ?, rol = ? WHERE id_admin = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $usuario, PDO::PARAM_STR);
        $stmt->bindValue(2, $clave, PDO::PARAM_STR);
        $stmt->bindValue(3, $rol, PDO::PARAM_INT);
        $stmt->bindValue(4, $idAdmin, PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh = null;
      } catch (PDOException $e) {
        die("¡Error!: update_id_admin()" . $e->getMessage());
      }
    }

    public function delete_id_admin($idAdmin, $activo)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
            $query = "UPDATE usuarios SET activo = ? WHERE id_admin = ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(1, $activo, PDO::PARAM_INT);
            $stmt->bindValue(2, $idAdmin, PDO::PARAM_INT);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: delete_id_admin() " . $e->getMessage());
        }
    }

    public function lastIndex()
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT MAX(id_admin) AS max FROM usuarios";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: lastIndex()" . $e->getMessage());
      }
    }

    #METODO PARA INICIAR SESION
    public function logueo($suario)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM usuarios WHERE usuario = ? ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $suario, PDO::PARAM_STR);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: logueo()" . $e->getMessage());
      }
    }

    public function salir()
    {
      // session_start();
      #unset($_SESSION["cve_p"]);
      unset($_SESSION["idAdmin"]);
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
      #header("Location:" . AccesoDatos::ruta() . "?accion=indexUsuario&m=" . AccesoDatos::encriptar(3) . "");
      header("Location:".AccesoDatos::ruta());
      exit();
    }
}
