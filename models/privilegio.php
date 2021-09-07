<?php
class Privilegio extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_privilegio()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT * FROM privilegio";
            $stmt = $this->dbh->prepare($query);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_privilegio() " . $e->getMessage());
        }
    }

    public function get_id_privilegio($cvePrivilegio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            // $cvePrivilegio = AccesoDatos::desencriptar(str_replace(' ', '+', $cvePrivilegio));
            $query = "SELECT * FROM privilegio WHERE id_privilegio = ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $cvePrivilegio, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_id_privilegio() " . $e->getMessage());
        }
    }

    public function delete_id_privilegio($cvePrivilegio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            // $cvePrivilegio = AccesoDatos::desencriptar(str_replace(' ', '+', $cvePrivilegio));
            $query = "UPDATE privilegio SET activo = 0 WHERE id_privilegio = ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(1, $cvePrivilegio, PDO::PARAM_INT);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: delete_id_privilegio() " . $e->getMessage());
        }
    }

    public function lastIndex()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT MAX(id_privilegio) AS max FROM privilegio";
            $stmt = $this->dbh->prepare($query);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: lastIndex() " . $e->getMessage());
        }
    }

    public function get_menu($idRol)
    {
        try {
            $this->dbh = AccesoDatos::conexion();

            // $query = "SELECT * FROM privilegio AS a
            // INNER JOIN c_menu AS b ON a.id_menu = b.id_menu
            // WHERE a.id_rol = ?";

            $query = "SELECT * FROM c_menu_fijo WHERE id_rol = ?";
            
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $idRol, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_menu() " . $e->getMessage());
        }
    }
}
