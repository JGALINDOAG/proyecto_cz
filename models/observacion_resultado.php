<?php
class ObservacionResultado extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function add_observacion_resultado($idDetalle, $observacion, $datosPsicol)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "INSERT INTO observacion_resultado (id_detalle, observacion, datosPsicol) VALUES (?, ?, ?);";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $idDetalle, PDO::PARAM_INT);
        $stmt->bindValue(2, $observacion, PDO::PARAM_STR);
        $stmt->bindValue(3, $datosPsicol, PDO::PARAM_INT);
        $stmt->execute();
        // $id = $this->dbh->lastInsertId();
        // return $this->result[] = $id;
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: add_observacion_resultado() " . $e->getMessage());
      }
    }

    public function update_observacion_resultado($idObservacion, $observacion, $datosPsicol)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "UPDATE observacion_resultado SET observacion = ?, datosPsicol = ? WHERE id_observacion = ?";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, $observacion, PDO::PARAM_STR);
        $stmt->bindValue(2, $datosPsicol, PDO::PARAM_INT);
        $stmt->bindValue(3, $idObservacion, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
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
          $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
          $stmt = null; // obligado para cerrar la conexión
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: valid_observacion_resultado() " . $e->getMessage());
      }
    }
}
