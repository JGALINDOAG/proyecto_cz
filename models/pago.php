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
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
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
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
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
            $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
            $stmt = null; // obligado para cerrar la conexión
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
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
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
            $query = "SELECT 
            ia.id_folio, i.nombre AS institucion, CONCAT(a.nombre,' ',a.apellidos) nombre, (ia.costo * ia.num_vendidas) costo_total,
            (
            SELECT CONCAT('{\"tipo_pago\":\"',tipo_pago,'\", \"fecha_registro\":\"',fecha_registro,'\"}') detalle FROM pago WHERE id_pago = (Select MAX(id_pago) FROM pago WHERE id_folio = ia.id_folio)
            ) detalle,
            (
            SELECT 
            CONCAT('{\"abono\":',ANY_VALUE(SUM(p2.transaccion->'$.total')),',
            \"adeudo\":',ANY_VALUE((ia2.costo * ia2.num_vendidas) - (SUM(p2.transaccion->'$.total'))),'
            }')
            FROM pago p2 
            INNER JOIN institucion_administrador ia2 USING(id_folio)
            WHERE ia2.id_folio = ia.id_folio
            GROUP BY p2.id_folio
            ) pagos, ia.fecha_emision,
            ia.costo, ia.num_vendidas,
            (SELECT MAX(costo_pago) FROM detalle_personas_pruebas WHERE id_folio = BINARY ia.id_folio) pagoUser
            FROM institucion_administrador ia
            INNER JOIN administradores a USING(id_admin)
            INNER JOIN institucion i USING(id_institucion)
            WHERE ia.fecha_emision BETWEEN ? AND ?
            ORDER BY ia.fecha_emision DESC;";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam(2, $fechaFin, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_reportPago() " . $e->getMessage());
        }
    }
    
    public function get_pagos_by_folio($folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT * FROM pago p 
            WHERE p.id_folio = ?
            ORDER BY p.fecha_registro DESC";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_pagos_by_folio() " . $e->getMessage());
        }
    }

}
