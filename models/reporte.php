<?php
class Reporte extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function detalle_terman($persona, $fecha)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $fecha = parent::Evita_SQL_XSS($fecha);
        $query = "SELECT indicadores.indicador, abs(resultados.resultado) as resultado 
        FROM pruebas 
        INNER JOIN prueba_indicador ON pruebas.id_prueba = prueba_indicador.id_prueba 
        INNER JOIN indicadores ON prueba_indicador.id_indicador = indicadores.id_indicador 
        INNER JOIN resultados ON indicadores.id_indicador = resultados.id_indicador 
        WHERE pruebas.id_prueba = ?
        AND resultados.id_persona = ? 
        AND resultados.fecha_aplicacion = ? ";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, 1, PDO::PARAM_INT);
        $stmt->bindParam(1, $persona, PDO::PARAM_INT);
        $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
        return $this->result;
        $this->dbh = null;
      } catch (Exception $e) {
        die("¡Error!: detalle_terman() " . $e->getMessage());
      }
    }

    //Lista que muestra la participación del usuario en cualquier prueba por fechas registradas, filtrado por folio o matricula que viene del formulario de búsqueda.
    public function lst_cve($cve)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT personas.Id_persona, personas.nombre, personas.primer_apellido, personas.segundo_apellido, personas.tipo_persona, personas.folio_matricula, personas.email, personas.area, resultados.fecha_aplicacion, COUNT(resultados.id_indicador) AS total 
        FROM personas 
        INNER JOIN resultados ON personas.Id_persona = resultados.id_persona 
        WHERE personas.folio_matricula = ?
        GROUP BY personas.Id_persona,resultados.fecha_aplicacion";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $cve, PDO::PARAM_INT);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: lst_cve()" . $e->getMessage());
      }
    }
    
    //Lista que muestra la participación del usuario en cualquier prueba por fechas registradas, filtrado por email que viene del formulario de búsqueda.
    public function lst_correo($correo)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT personas.Id_persona, personas.nombre, personas.primer_apellido, personas.segundo_apellido, personas.tipo_persona, personas.folio_matricula, personas.email, personas.area, resultados.fecha_aplicacion, COUNT(resultados.id_indicador) AS total 
        FROM personas 
        INNER JOIN resultados ON personas.Id_persona = resultados.id_persona 
        WHERE personas.email = ? 
        GROUP BY personas.Id_persona,resultados.fecha_aplicacion";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $correo, PDO::PARAM_STR);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: lst_correo()" . $e->getMessage());
      }
    }
    
    //Lista de usuarios que tienen registro de participación en alguna prueba en un rango de fechas
    public function lst_personas($from, $to)
    {
      try {
        $this->dbh = AccesoDatos::conexion();
        $query = "SELECT personas.Id_persona, personas.nombre, personas.primer_apellido, personas.segundo_apellido, personas.tipo_persona, personas.folio_matricula, personas.email, personas.area, resultados.fecha_aplicacion, COUNT(resultados.id_indicador) AS total 
        FROM personas 
        INNER JOIN resultados ON personas.Id_persona = resultados.id_persona 
        WHERE resultados.fecha_aplicacion BETWEEN ? AND ? 
        GROUP BY personas.Id_persona,resultados.fecha_aplicacion";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(1, $from, PDO::PARAM_INT);
        $stmt->bindParam(2, $to, PDO::PARAM_INT);
        if ($stmt->execute()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->result[] = $row;
          }
          return $this->result;
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: lst_personas()" . $e->getMessage());
      }
    }

    //Suma las 10 series de la prueba de inteligencia para obtener el ci en crudo
    public function result_terman($persona, $fecha)
    {
      try {
          $this->dbh = parent::conexion();
          $stmt = $this->dbh->prepare("SELECT sum(resultados.resultado) as ci 
          FROM pruebas 
          INNER JOIN prueba_indicador ON pruebas.id_prueba = prueba_indicador.id_prueba 
          INNER JOIN indicadores ON prueba_indicador.id_indicador = indicadores.id_indicador 
          INNER JOIN resultados ON indicadores.id_indicador = resultados.id_indicador 
          WHERE pruebas.id_prueba = ? 
          AND resultados.id_persona = ? 
          AND resultados.fecha_aplicacion = ? ");
          $stmt->bindParam(1, 1, PDO::PARAM_INT);
          $stmt->bindParam(2, $persona, PDO::PARAM_INT);
          $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
          if ($stmt->execute()) {
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $this->result[] = $row;
              return $this->result;
              $this->dbh = null;
          }
      } catch (Exception $e) {
          die("¡Error!: result_terman() " . $e->getMessage());
      }
    }

    //Lista de resultados para la prueba personalidad 1 filtrado por usuario y fecha.
    public function result_personalidad_1($persona, $fecha)
    {
       try {
         $this->dbh = AccesoDatos::conexion();
         $fecha = parent::Evita_SQL_XSS($fecha);
         $query = "SELECT indicadores.indicador, abs(resultados.resultado) as resultado 
         FROM pruebas 
         INNER JOIN prueba_indicador ON pruebas.id_prueba = prueba_indicador.id_prueba 
         INNER JOIN indicadores ON prueba_indicador.id_indicador = indicadores.id_indicador 
         INNER JOIN resultados ON indicadores.id_indicador = resultados.id_indicador 
         WHERE pruebas.id_prueba = ? 
         AND resultados.id_persona = ? 
         AND resultados.fecha_aplicacion = ? ";
         $stmt = $this->dbh->prepare($query);
         $stmt->bindParam(1, 2, PDO::PARAM_INT);
         $stmt->bindParam(2, $persona, PDO::PARAM_INT);
         $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
         if ($stmt->execute()) {
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $this->result[] = $row;
           }
           return $this->result;
           $this->dbh = null;
         }
       } catch (Exception $e) {
         die("¡Error!: result_personalidad_1()" . $e->getMessage());
       }
    }
    
     //Lista de resultados para la prueba personalidad 2 filtrado por usuario y fecha.
    public function result_personalidad_2($persona, $fecha)
    {
       try {
         $this->dbh = AccesoDatos::conexion();
         $fecha = parent::Evita_SQL_XSS($fecha);
         $query = "SELECT indicadores.indicador, abs(resultados.resultado) as resultado 
         FROM pruebas 
         INNER JOIN prueba_indicador ON pruebas.id_prueba = prueba_indicador.id_prueba 
         INNER JOIN indicadores ON prueba_indicador.id_indicador = indicadores.id_indicador 
         INNER JOIN resultados ON indicadores.id_indicador = resultados.id_indicador 
         WHERE pruebas.id_prueba = ? 
         AND resultados.id_persona = ? 
         AND resultados.fecha_aplicacion = ? ";
         $stmt = $this->dbh->prepare($query);
         $stmt->bindParam(1, 3, PDO::PARAM_INT);
         $stmt->bindParam(2, $persona, PDO::PARAM_INT);
         $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
         if ($stmt->execute()) {
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $this->result[] = $row;
           }
           return $this->result;
           $this->dbh = null;
         }
       } catch (Exception $e) {
         die("¡Error!: result_personalidad_2()" . $e->getMessage());
       }
    }

    //Función para obtener el ci final mediante la conversión del ci en crudo.
    public function ci($puntaje)
    {
      try {
          $this->dbh = parent::conexion();
          $stmt = $this->dbh->prepare("SELECT * FROM ci WHERE puntaje = ?");
          $stmt->bindParam(1, $puntaje, PDO::PARAM_INT);
          if ($stmt->execute()) {
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $this->result[] = $row;
              return $this->result;
              $this->dbh = null;
          }
      } catch (Exception $e) {
          die("¡Error!: ci() " . $e->getMessage());
      }
    }
    
    //Obtiene los registros que existen de la prueba de inteligencia mediante el usuario y la fecha actual, para saber si ya es posible pintar los resultados en el reporte o no.
    public function count_avance_terman($id_persona, $fecha)
    {
      try {
          $this->dbh = parent::conexion();
          $fecha = parent::Evita_SQL_XSS($fecha);
          $stmt = $this->dbh->prepare("SELECT count(*) as total 
          FROM resultados 
          INNER JOIN indicadores ON resultados.id_indicador = indicadores.id_indicador 
          INNER JOIN prueba_indicador ON indicadores.id_indicador = prueba_indicador.id_indicador 
          WHERE prueba_indicador.id_prueba = ? 
          AND resultados.id_persona = ? 
          AND resultados.fecha_aplicacion = ? ");
          $stmt->bindParam(1, 1, PDO::PARAM_INT);
          $stmt->bindParam(2, $id_persona, PDO::PARAM_INT);
          $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
          if ($stmt->execute()) {
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $this->result[] = $row;
              return $this->result;
              $this->dbh = null;
          }
      } catch (Exception $e) {
          die("¡Error!: count_avance_terman() " . $e->getMessage());
      }
    }

    //Función para obtener el perfil de la prueba de inteligencia
    public function perfil_person_ci($ciCrudo) {
      if ($ciCrudo <= 66) {
          $coeficiente = 'Deficiente';
          $color = 'Rojo';
          $imagen = '<img src="assets/RedBall.png" height="16" width="16">';
          $detalle = "Mostrará fuertes dificultades para concluir una carrera universitaria. Requiere apoyo en técnicas y/o hábitos de estudio de lo contrario su pronóstico no es favorable.";
      } elseif ($ciCrudo >= 67) {
          $puntaje = new Reporte();
          //Función para obtener el ci final mediante la conversión del ci en crudo.
          $ci = $puntaje->ci($ciCrudo);
          $coeficiente = $ci[0]["ci"];
          if ($coeficiente >= 93) {
              $color = 'Verde';
              $imagen = '<img src="assets/GreenBall.png" height="16" width="16">';
              $detalle = "El evaluado muestra una buena capacidad intelectual lo que le permitirá concluir satisfactoriamente una carrera universitaria.";
          }
          if ($coeficiente >= 90 && $coeficiente <= 92) {
              $color = 'Amarillo';
              $imagen = '<img src="assets/YellowBall.png" height="16" width="16">';
              $detalle = "El evaluado tiene un bajo nivel intelectual pero con apoyo puede lograr un buen pronóstico de rendimiento académico.";
          }
          if ($coeficiente <= 89) {
              $color = 'Rojo';
              $imagen = '<img src="assets/RedBall.png" height="16" width="16">';
              $detalle = "Mostrará fuertes dificultades para concluir una carrera universitaria. Requiere apoyo en técnicas y/o hábitos de estudio de lo contrario su pronóstico no es favorable.";
          }
      }
      return $arr = array($coeficiente, $color, $imagen, $detalle);
    }

    //Función para obtener el perfil de personalidad 1
    public function perfil_person_1($ar) {
      while (list($valor, $repeticion) = each($ar)) {
          if ((abs($valor) >= 8 && $repeticion >= 1) || (abs($valor) == 7 && $repeticion >= 3) || (abs($valor) == 6 && $repeticion >= 10)) {
              $color = 'Rojo';
              $imagen = '<img src="assets/RedBall.png" height="16" width="16">';
              return $arr = array($color, $imagen);
              break;
          } elseif ((abs($valor) == 7 && $repeticion == 2) || ( (abs($valor) == 6 && $repeticion >= 3) && (abs($valor) == 6 && $repeticion <= 9))) {
              $color = 'Amarillo';
              $imagen = '<img src="assets/YellowBall.png" height="16" width="16">';
              return $arr = array($color, $imagen);
              break;
          } elseif ((abs($valor) == 7 && $repeticion == 1) || (abs($valor) == 6 && $repeticion <= 2) || (abs($valor) <= 5 && $repeticion >= 0)) {
              $color = 'Verde';
              $imagen = '<img src="assets/GreenBall.png" height="16" width="16">';
              return $arr = array($color, $imagen);
              break;
          }
      }
    }

   //Función para obtener el perfil de personalidad 2
    public function perfil_person_2($L, $M, $N, $O, $P) {
        if (($L >= 19 && $L <= 24) || ($M >= 18 && $M <= 24) || ($N >= 23 && $N <= 24) || ($O >= 20 && $O <= 24) || ($P >= 20 && $P <= 24)) {
            $color = 'Rojo';
            $imagen = '<img src="assets/RedBall.png" height="16" width="16">';
        } elseif (($L >= 13 && $L <= 18) || ($M >= 12 && $M <= 17) || ($N >= 20 && $N <= 22) || ($O >= 16 && $O <= 19) || ($P >= 15 && $P <= 19)) {
            $color = 'Amarillo';
            $imagen = '<img src="assets/YellowBall.png" height="16" width="16">';
        } elseif (($L >= 0 && $L <= 12) || ($M >= 0 && $M <= 11) || ($N >= 0 && $N <= 19) || ($O >= 0 && $O <= 15) || ($P >= 0 && $P <= 14)) {
            $color = 'Verde';
            $imagen = '<img src="assets/GreenBall.png" height="16" width="16">';
        }
        return $arr = array($color, $imagen);
    }

    //Función para obtener el perfil final
    public function perfil_final($colorCI, $colorP1) {
        if ($colorCI != '-' and $colorP1 != '-') {
            $x = array($colorCI, $colorP1);
            if (in_array("Rojo", $x)) {
                $color = 'Rojo';
                $imagen = '<img src="assets/RedBall.png" height="16" width="16">';
            } elseif (in_array("Amarillo", $x)) {
                $color = 'Amarillo';
                $imagen = '<img src="assets/YellowBall.png" height="16" width="16">';
            } elseif (in_array("Verde", $x)) {
                $color = 'Verde';
                $imagen = '<img src="assets/GreenBall.png" height="16" width="16">';
            }
            return $arr = array($color, $imagen);
        } else {
            return $arr = array("-", "-");
        }
    }
}