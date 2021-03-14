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
            $sql = "SELECT CONCAT(p.nombre,' ',p.primer_apellido,' ',p.segundo_apellido) AS nombre, i.abreviatura FROM detalle_personas_pruebas dpp
            INNER JOIN personas p USING(Id_persona)
            INNER JOIN institucion_administrador ia USING(id_folio)
            INNER JOIN administradores a USING(id_admin)
            INNER JOIN institucion i USING(id_institucion);";
            $stmt = $this->dbh->prepare($sql);
            # $stmt->bindParam(1, $email, PDO::PARAM_INT);
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
}
