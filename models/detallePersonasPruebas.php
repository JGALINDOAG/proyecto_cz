<?php
class DetallePersonasPruebas extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_detallePersonasPruebas() 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            if($_SESSION["idInstitucion"] == 1) $band = "";
            else $band = "AND i.id_institucion = :idIntitucion";
            $sql = "SELECT dpp.id_detalle,ia.id_folio,p.Id_persona,CONCAT(p.nombre,' ',p.primer_apellido,' ',p.segundo_apellido) AS nombre, i.nombre, i.abreviatura FROM detalle_personas_pruebas dpp
            INNER JOIN personas p USING(Id_persona)
            INNER JOIN institucion_administrador ia USING(id_folio)
            INNER JOIN administradores a USING(id_admin)
            INNER JOIN institucion i USING(id_institucion)
            WHERE dpp.activo = 0
            $band";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":idIntitucion", $_SESSION["idInstitucion"], PDO::PARAM_INT);
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
    
    public function get_resultados() 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $band = '';
            if($_SESSION['idInstitucion'] != 1) $band = 'AND i.id_institucion = ?';
            $sql = "SELECT dpp.id_detalle, dpp.id_folio, CONCAT(p.nombre,' ',p.primer_apellido,' ',p.segundo_apellido) nombre, p.email, dpp.fecha_registro,
            (
                SELECT dpp2.id_detalle
                FROM detalle_personas_pruebas dpp2 
                INNER JOIN personas p2 USING(Id_persona)    
                WHERE p2.Id_persona = p.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
                AND dpp2.id_detalle IN (SELECT id_detalle FROM resultados)
            ) AS viewResultado,
            i.nombre as institucion
            FROM detalle_personas_pruebas dpp
            INNER JOIN personas p USING(Id_persona)
            INNER JOIN institucion_administrador ia USING(id_folio)
            INNER JOIN administradores a USING (id_admin)
            INNER JOIN institucion i USING(id_institucion)
            WHERE dpp.activo = 1 $band";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $_SESSION['idInstitucion'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_resultados() ".$e->getMessage());
        }
    }

    public function update_detallePersonasPruebas($idDetalle)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        # $idAdmin = AccesoDatos::desencriptar(str_replace(' ', '+', $idAdmin));
        $query = "UPDATE detalle_personas_pruebas SET activo = ? WHERE id_detalle = ?;";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(1, 1, PDO::PARAM_STR);
        $stmt->bindValue(2, $idDetalle, PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh = null;
      } catch (PDOException $e) {
        die("¡Error!: update_detallePersonasPruebas()" . $e->getMessage());
      }
    }

    public function get_avance($folio) 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $sql = "SELECT dpp.id_folio, p.id_persona, CONCAT(p.nombre,' ',p.primer_apellido,' ',p.segundo_apellido) nombre,
            (
                SELECT if(COUNT(id_prueba) = 10, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 1
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS ter,
            (
                SELECT if(COUNT(id_prueba) = 11, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 2
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS per1,
            (
                SELECT if(COUNT(id_prueba) = 5, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 3
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS per2,
            (
                SELECT if(COUNT(id_prueba) = 5, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 4
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS rav,
            (
                SELECT if(COUNT(id_prueba) = 10, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 5
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS inte,
            (
                SELECT if(COUNT(id_prueba) = 10, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 6
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS apt,
            (
                SELECT if(COUNT(id_prueba) = 12, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 7
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS atr,
            (
                SELECT if(COUNT(id_prueba) = 1, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 8
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS clo,
            (
                SELECT if(COUNT(id_prueba) = 1, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 9
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS tco,
            (
                SELECT if(COUNT(id_prueba) = 1, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 10
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS cpec,
            (
                SELECT if(COUNT(id_prueba) = 1, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 11
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS nde,
            (
                SELECT if(COUNT(id_prueba) = 13, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 12
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS mmpi,
            (
                SELECT if(COUNT(id_prueba) = 16, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 13
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS km,
            (
                SELECT if(COUNT(id_prueba) = 2, '1','0') FROM resultados r2
                INNER JOIN detalle_personas_pruebas dpp2 USING(id_detalle)
                WHERE r2.id_prueba = 14
                AND dpp2.Id_persona = dpp.Id_persona
                AND dpp2.id_folio = BINARY dpp.id_folio
            ) AS gdr
            FROM personas p
            INNER JOIN detalle_personas_pruebas dpp USING(Id_persona)
            WHERE dpp.activo = 1
            AND dpp.id_folio = BINARY ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_avance() ".$e->getMessage());
        }
    }

    public function get_pagos_by_folio_user($folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT SUM(costo_pago) pagoUser, MAX(costo_pago) costo_individual FROM detalle_personas_pruebas WHERE id_folio = BINARY ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_pagos_by_folio_user() " . $e->getMessage());
        }
    }

    public function get_personas_folio($folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $query = "SELECT dpp.*,CONCAT(p.nombre,' ',p.primer_apellido,' ',p.segundo_apellido) nombre, p.grado_estudios, p.area, p.turno
            FROM detalle_personas_pruebas dpp
            INNER JOIN personas p USING (id_persona)
            WHERE dpp.id_folio = BINARY ?;";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(1, $folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    if($row != null) $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_personas_folio() " . $e->getMessage());
        }
    }
}
