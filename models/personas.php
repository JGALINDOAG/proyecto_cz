<?php
class Personas extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function get_personas()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT * FROM personas");
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_persona() " . $e->getMessage());
        }
    }

    public function get_id_personas($idPersona)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            # $idPersona = AccesoDatos::desencriptar(str_replace(' ', '+', $idPersona));
            $stmt = $this->dbh->prepare("SELECT * FROM personas WHERE Id_persona = ?");
            $stmt->bindParam(1, $idPersona, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_id_personas() " . $e->getMessage());
        }
    }

    public function add_persona($nombre, $primer_apellido, $segundo_apellido, $email, $sexo, $fecha_nacimiento, $grado_estudios, $area, $turno, $id_folio, $activo)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("INSERT INTO persona (nombre, primer_apellido, segundo_apellido, email, sexo, fecha_nacimiento, grado_estudios, area, turno, id_folio, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $primer_apellido, PDO::PARAM_STR);
            $stmt->bindValue(3, $segundo_apellido, PDO::PARAM_STR);
            $stmt->bindValue(4, $email, PDO::PARAM_STR);
            $stmt->bindValue(5, $sexo, PDO::PARAM_STR);
            $stmt->bindValue(6, $fecha_nacimiento, PDO::PARAM_STR);
            $stmt->bindValue(7, $grado_estudios, PDO::PARAM_STR);
            $stmt->bindValue(8, $area, PDO::PARAM_STR);
            $stmt->bindValue(9, $turno, PDO::PARAM_STR);
            $stmt->bindValue(10, $id_folio, PDO::PARAM_STR);
            $stmt->bindValue(11, $activo, PDO::PARAM_INT);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: add_persona() " . $e->getMessage());
        }
    }

    public function update_id_persona($idPersona, $nombre, $primer_apellido, $segundo_apellido, $email, $sexo, $fecha_nacimiento, $grado_estudios, $area, $turno, $id_folio)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            # $idPersona = AccesoDatos::desencriptar(str_replace(' ', '+', $idPersona));
            $stmt = $this->dbh->prepare("UPDATE personas SET nombre = ?, primer_apellido = ?, segundo_apellido = ?, email = ?, sexo = ?, fecha_nacimiento = ?, grado_estudios = ?, area = ?, turno = ?, id_folio = ? WHERE Id_persona = ?");
            $stmt->bindValue(1, $nombre, PDO::PARAM_STR);
            $stmt->bindValue(2, $primer_apellido, PDO::PARAM_STR);
            $stmt->bindValue(3, $segundo_apellido, PDO::PARAM_STR);
            $stmt->bindValue(4, $email, PDO::PARAM_STR);
            $stmt->bindValue(5, $sexo, PDO::PARAM_STR);
            $stmt->bindValue(6, $fecha_nacimiento, PDO::PARAM_STR);
            $stmt->bindValue(7, $grado_estudios, PDO::PARAM_STR);
            $stmt->bindValue(8, $area, PDO::PARAM_STR);
            $stmt->bindValue(9, $turno, PDO::PARAM_STR);
            $stmt->bindValue(10, $id_folio, PDO::PARAM_STR);
            $stmt->bindValue(11, $activo, PDO::PARAM_INT);
            $stmt->bindValue(12, $idPersona, PDO::PARAM_INT);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: update_id_persona() " . $e->getMessage());
        }
    }

    public function delete_id_persona($idPersona, $activo)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            # $idPersona = AccesoDatos::desencriptar(str_replace(' ', '+', $idPersona));
            $query = "UPDATE personas SET activo = ? WHERE Id_persona = ?";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(1, $activo, PDO::PARAM_INT);
            $stmt->bindValue(2, $idPersona, PDO::PARAM_INT);
            $stmt->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            die("¡Error!: delete_id_persona() " . $e->getMessage());
        }
    }

    public function lastIndex()
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT MAX(id_persona) AS max FROM persona");
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

    //#Valida si la persona existe en la base de datos mediante el correo
    public function no_double_correo($email) 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT * FROM personas WHERE email = ?");
            $stmt->bindParam(1, $email, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $num = $stmt->num_rows;
                $this->result[] = $num;
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: get_id_personas() " . $e->getMessage());
        }

    }
}
