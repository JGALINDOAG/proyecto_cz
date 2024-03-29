<?php
class InstitucionAdministrador extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_institucionAdministrador()
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $where = '';
        if($_SESSION['idInstitucion'] != 1) $where = 'WHERE i.id_institucion = ?';
        $query = "SELECT ia.*, i.id_institucion, (ia.costo * ia.num_vendidas) as total FROM institucion_administrador ia
        INNER JOIN administradores a USING (id_admin)
        INNER JOIN institucion i USING(id_institucion)
        $where";
        $stmt = $this->dbh->prepare($query);
        if($_SESSION['idInstitucion'] != 1) $stmt->bindParam(1, $_SESSION['idInstitucion'], PDO::PARAM_INT);
        if ($stmt->execute()) {
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->result[] = $row;
          }
          return $this->result;
          $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
          $stmt = null; // obligado para cerrar la conexión
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: get_institucionAdministrador() " . $e->getMessage());
      }
    }
    
    public function get_idFolio($folio)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT ia.*, CONCAT(a.nombre,' ',a.apellidos) nombre FROM institucion_administrador ia
        INNER JOIN administradores a USING (id_admin)
        WHERE ia.id_folio = BINARY ? ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $folio, PDO::PARAM_STR);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($row != null) $this->result[] = $row;
          return $this->result;
          $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
          $stmt = null; // obligado para cerrar la conexión
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: get_idFolio() " . $e->getMessage());
      }
    }

    public function get_folios_by_institucion($idInstitucion) 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $sql = "SELECT a.id_institucion, ia.id_folio, (ia.costo * ia.num_vendidas) as total FROM administradores a
            INNER JOIN institucion b USING(id_institucion)
            INNER JOIN institucion_administrador ia USING(id_admin)
            WHERE id_institucion = :idInstitucion";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam("idInstitucion", $idInstitucion, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $this->result[] = $row;
                }
                return $this->result;
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_folios_by_institucion() ".$e->getMessage());
        }
    }

    public function add_institucionAdministrador($idFolio, $idAdmin, $costo, $numGratis, $numVendidas)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "INSERT INTO institucion_administrador VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $idFolio, PDO::PARAM_STR);
        $stmt->bindValue(2, $idAdmin, PDO::PARAM_INT);
        $stmt->bindValue(3, $costo, PDO::PARAM_INT);
        $stmt->bindValue(4, $numGratis, PDO::PARAM_INT);
        $stmt->bindValue(5, $numVendidas, PDO::PARAM_INT);
        $stmt->bindValue(6, date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_institucionAdministrador() " . $e->getMessage());
      }
    }
}
