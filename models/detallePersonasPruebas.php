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
            $sql = "SELECT p.Id_persona,CONCAT(p.nombre,' ',p.primer_apellido,' ',p.segundo_apellido) AS nombre, i.abreviatura FROM detalle_personas_pruebas dpp
            INNER JOIN personas p USING(Id_persona)
            INNER JOIN institucion_administrador ia USING(id_folio)
            INNER JOIN administradores a USING(id_admin)
            INNER JOIN institucion i USING(id_institucion)
            WHERE dpp.activo = 0";
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
}
