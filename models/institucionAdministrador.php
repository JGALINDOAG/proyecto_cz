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
        $query = "SELECT ia.*, i.id_institucion FROM institucion_administrador ia
        INNER JOIN administradores a USING (id_admin)
        INNER JOIN institucion i USING(id_institucion)
        $where";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $_SESSION['idInstitucion'], PDO::PARAM_INT);
        if ($stmt->execute()) {
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->result[] = $row;
          }
          return $this->result;
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
        $query = "SELECT * FROM institucion_administrador WHERE id_folio = BINARY ? ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $folio, PDO::PARAM_STR);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($row != null) $this->result[] = $row;
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: get_idFolio() " . $e->getMessage());
      }
    }

    public function get_foliosDesactivos() 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $sql = "SELECT i.id_institucion, i.nombre, a.id_admin, CONCAT(a.nombre,' ',a.apellidos) AS nombre, ia.id_folio, ia.activo FROM institucion i
            INNER JOIN administradores a USING (id_institucion)
            INNER JOIN institucion_administrador ia USING (id_admin)
            WHERE ia.activo = 0
            AND  ia.id_folio IN (SELECT id_folio FROM pago)";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam("idIntitucion", $_SESSION["idInstitucion"], PDO::PARAM_INT);
            if ($stmt->execute()) {
                while($row = $stmt->fetch(PDO::FETCH_NUM)){
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_detallePersonasPruebas() ".$e->getMessage());
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
        $stmt->bindValue(6, 0, PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_institucionAdministrador() " . $e->getMessage());
      }
    }

    public function update_institucionAdministrador($idFolio)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
        $query = "UPDATE institucion_administrador SET activo = ? WHERE id_folio = BINARY ?;";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, 1, PDO::PARAM_STR);
        $stmt->bindValue(2, $idFolio, PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh = null;
      } catch (PDOException $e) {
        die("¡Error!: update_institucionAdministrador()" . $e->getMessage());
      }
    }
}
