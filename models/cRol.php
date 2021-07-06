<?php
class CROL extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_c_rol()
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        if($_SESSION['idRol'] == 1) $rol = ' > 1';
        else $rol = ' > 2';
        $query = "SELECT * FROM c_rol WHERE id_rol $rol";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: get_c_rol() " . $e->getMessage());
      }
    }
}
