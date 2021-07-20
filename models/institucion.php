<?php
class Institucion extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_institucion()
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM institucion WHERE id_institucion != 1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: valid_institucion() " . $e->getMessage());
      }
    }

    public function get_id_institucion($idInstitucion)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM institucion WHERE id_institucion = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $idInstitucion, PDO::PARAM_STR);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($row != null) $this->result[] = $row;
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: get_id_institucion() " . $e->getMessage());
      }
    }

    public function add_institucion($nombre, $abreviatura, $rfc, $email, $telefono, $pruebas)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "INSERT INTO institucion VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, null, PDO::PARAM_INT);
        $stmt->bindValue(2, $nombre, PDO::PARAM_STR);
        $stmt->bindValue(3, $abreviatura, PDO::PARAM_STR);
        $stmt->bindValue(4, $rfc, PDO::PARAM_STR);
        $stmt->bindValue(5, $email, PDO::PARAM_STR);
        $stmt->bindValue(6, $telefono, PDO::PARAM_STR);
        $stmt->bindValue(7, $pruebas, PDO::PARAM_STR);
        $stmt->bindValue(8, 1, PDO::PARAM_INT);
        $stmt->execute();
        $id = $this->dbh->lastInsertId();
        return $this->result[] = $id;
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_institucion() " . $e->getMessage());
      }
    }

    public function update_pruebas($idInstitucion, $pruebas)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
        $query = "UPDATE institucion SET pruebas = ? WHERE id_institucion = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $pruebas, PDO::PARAM_STR);
        $stmt->bindValue(2, $idInstitucion, PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh = null;
      } catch (PDOException $e) {
        die("¡Error!: update_pruebas()" . $e->getMessage());
      }
    }

    # Valida duplicados por RFC
    public function valid_institucion($rfc)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM institucion WHERE rfc = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $rfc, PDO::PARAM_STR);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($row != null) $this->result[] = $row;
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: valid_institucion() " . $e->getMessage());
      }
    }
    
    #Obtiene los folios no pagados por la institución.
    public function get_folio($idInstitucion) 
    {
      try {
          $this->dbh = AccesoDatos::conexion();
          $query = "SELECT id_folio, (ia.costo * ia.num_vendidas) as total FROM institucion i
          INNER JOIN administradores a USING (id_institucion)
          INNER JOIN institucion_administrador ia USING (id_admin)
          WHERE i.id_institucion = ?
          -- AND (ia.costo * ia.num_vendidas) > (
          -- 	SELECT SUM(JSON_EXTRACT(transaccion, '$.total')) FROM pago
          -- )
          ";
          $stmt = $this->dbh->prepare($query);
          $stmt->bindParam(1, $idInstitucion, PDO::PARAM_STR);
          if ($stmt->execute()) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $this->result[] = $row;
              }
              return $this->result;
              $this->dbh = null;
          }
      } catch (Exception $e) {
          die("¡Error!: get_costoPrueba()" . $e->getMessage());
      }
    }
}
