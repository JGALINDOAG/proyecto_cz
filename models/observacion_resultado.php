<?php
class ObservacionResultado extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function add_observacion_resultado($idDetalle, $observacion)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "INSERT INTO observacion_resultado (id_detalle, observacion) VALUES (?, ?);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $idDetalle, PDO::PARAM_INT);
        $stmt->bindValue(2, $observacion, PDO::PARAM_STR);
        $stmt->execute();
        // $id = $this->dbh->lastInsertId();
        // return $this->result[] = $id;
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_observacion_resultado() " . $e->getMessage());
      }
    }

    public function update_observacion_resultado($idObservacion, $observacion)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "UPDATE observacion_resultado SET observacion = ? WHERE id_observacion = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $observacion, PDO::PARAM_STR);
        $stmt->bindValue(2, $idObservacion, PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh = null;
      } catch (PDOException $e) {
        die("¡Error!: update_observacion_resultado()" . $e->getMessage());
      }
    }

    # Valida duplicados
    public function valid_observacion_resultado($id_detalle)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT * FROM observacion_resultado WHERE id_detalle = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $id_detalle, PDO::PARAM_STR);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if($row != null) $this->result[] = $row;
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: valid_observacion_resultado() " . $e->getMessage());
      }
    }
}
