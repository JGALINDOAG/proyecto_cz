<?php
class Pago extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_pago()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT * FROM pago";
            $stmt = $this->dbh->prepare($query);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_pago() " . $e->getMessage());
        }
    }

    public function get_id_pago($idPago)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            // $idPago = AccesoDatos::desencriptar(str_replace(' ', '+', $idPago));
            $query = "SELECT * FROM pago WHERE id_pago = ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $idPago, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_id_pago() " . $e->getMessage());
        }
    }

    public function add_pago($idFolio, $tipoPago, $transaccion)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("INSERT INTO pago (id_folio, tipo_pago, transaccion) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $idFolio, PDO::PARAM_STR);
            $stmt->bindValue(2, $tipoPago, PDO::PARAM_STR);
            $stmt->bindValue(3, $transaccion, PDO::PARAM_STR);
            $stmt->execute();
            //$id = $this->dbh->lastInsertId();
            //return $this->result[]=$id;
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: add_pago() ".$e->getMessage());
        }
    }

    public function lastIndex()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT MAX(id_pago) AS max FROM pago";
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

    public function get_reportPago($fechaInicio, $fechaFin)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT p.*, i.nombre AS institucion FROM pago p 
            INNER JOIN institucion_administrador ia USING(id_folio)
            INNER JOIN administradores a USING(id_admin)
            INNER JOIN institucion i USING(id_institucion)
            WHERE p.fecha_registro BETWEEN ? AND ?
            ORDER BY p.fecha_registro";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(2, $fechaFin, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_reportPago() " . $e->getMessage());
        }
    }

}
