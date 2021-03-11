<?php
class InstitucionAdministrador extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function add_institucionAdministrador($idFolio, $idAdmin, $costo, $numGratis, $numVendidas)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "INSERT INTO institucion_administrador VALUES (?, ?, ?, ?, ?);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $idFolio, PDO::PARAM_STR);
        $stmt->bindValue(2, $idAdmin, PDO::PARAM_INT);
        $stmt->bindValue(3, $costo, PDO::PARAM_INT);
        $stmt->bindValue(4, $numGratis, PDO::PARAM_INT);
        $stmt->bindValue(5, $numVendidas, PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_institucionAdministrador() " . $e->getMessage());
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
}
