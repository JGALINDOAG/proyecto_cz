<?php
class Personas extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function update_costo($costo,$idDetalle)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("UPDATE `detalle_personas_pruebas` SET `costo_pago` = ? WHERE `detalle_personas_pruebas`.`id_detalle` = ?");
            $stmt->bindValue(1, $costo, PDO::PARAM_INT);
            $stmt->bindParam(2, $idDetalle, PDO::PARAM_INT);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: ".$e->getMessage());
        }
    }

    public function total_sistema($id_folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT (`num_gratis`+`num_vendidas`) as total_sistema FROM `institucion_administrador` WHERE  binary  `id_folio`=?");
            $stmt->bindValue(1, $id_folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!:".$e->getMessage());
        }
    }

    public function total_registros($id_folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT count(*) as total_registros FROM detalle_personas_pruebas WHERE binary id_folio=?");
            $stmt->bindValue(1, $id_folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!:".$e->getMessage());
        }
    }
//
    public function verifica_idfolio($id_folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT count(*) as valor FROM institucion_administrador WHERE binary id_folio=?");
            $stmt->bindValue(1, $id_folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!:".$e->getMessage());
        }
    }

    public function get_personas_email($email) 
    { 
        //echo $email;
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT * FROM personas WHERE email = ?");
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $num = $stmt->rowCount();//num_rows; | rowCount();
                $this->result[] = $num;
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!:".$e->getMessage());
        }
    }

    public function add_persona($nombre, $primer_apellido, $segundo_apellido, $email, $sexo, $fecha_nacimiento, $grado_estudios, $area, $turno)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("INSERT INTO personas (nombre, primer_apellido, segundo_apellido, email, sexo, fecha_nacimiento, grado_estudios, area, turno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $primer_apellido, PDO::PARAM_STR);
            $stmt->bindValue(3, $segundo_apellido, PDO::PARAM_STR);
            $stmt->bindValue(4, $email, PDO::PARAM_STR);
            $stmt->bindValue(5, $sexo, PDO::PARAM_STR);
            $stmt->bindValue(6, $fecha_nacimiento, PDO::PARAM_STR);
            $stmt->bindValue(7, $grado_estudios, PDO::PARAM_STR);
            $stmt->bindValue(8, $area, PDO::PARAM_STR);
            $stmt->bindValue(9, $turno, PDO::PARAM_STR);
            $stmt->execute();
            //$id = $this->dbh->lastInsertId();
            //return $this->result[]=$id;
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: ".$e->getMessage());
        }
    }

    public function max_persona()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT max(Id_persona) as Id_persona FROM personas");
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: ".$e->getMessage());
        }
    }

    public function add_detalle($Id_persona, $id_folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("INSERT INTO detalle_personas_pruebas (Id_persona, id_folio, fecha_registro, activo) VALUES (?, ?, NOW(), '0');");
            $stmt->bindValue(1, $Id_persona, PDO::PARAM_INT);
            $stmt->bindValue(2, $id_folio, PDO::PARAM_STR);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: ".$e->getMessage());
        }
    }

    public function get_detalle($Id_persona, $id_folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT * FROM detalle_personas_pruebas where Id_persona=? and  binary id_folio=?");
            $stmt->bindValue(1, $Id_persona, PDO::PARAM_INT);
            $stmt->bindValue(2, $id_folio, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $num = $stmt->rowCount();
                $this->result[] = $num;
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!:".$e->getMessage());
        }
    }

}