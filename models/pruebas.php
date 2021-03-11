<?php
class Pruebas extends AccesoDatos
{

    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function list_pruebas()
    {
        try {
            $this->dbh = parent::conexion();
            $stmt = $this->dbh->prepare("SELECT * FROM pruebas");
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: list_pruebas() " . $e->getMessage());
        }
    }

    public function list_byInstitucion()
    {
        try {
            $this->dbh = parent::conexion();
            $pruebas = $this->dbh->prepare("SELECT pruebas FROM institucion WHERE id_institucion = ?");
            $pruebas->bindParam(1, $_SESSION["idInstitucion"], PDO::PARAM_INT);
            $pruebas->execute();
            $rowPruebas = $pruebas->fetch(PDO::FETCH_NUM);
            $stmt = $this->dbh->prepare("SELECT * FROM pruebas WHERE id_prueba IN ($rowPruebas[0])");
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: list_byInstitucion() " . $e->getMessage());
        }
    }

    // # # # # # # T E R M A N # # # # # # 

    # Obtiene el último indicador registrado en la base de datos para la prueba de inteligencia mediante el usuario y la fecha actual, 
    # para saber cuál es la próxima serie que le sistema debe mostrar o dar por finalizada la prueba.
    
    public function avance_terman() {
        try {
            $this->dbh = parent::conexion();
            $fecha = parent::Fecha_actual();
            $stmt = $this->dbh->prepare("SELECT DISTINCT (resultados.id_indicador) 
            FROM pruebas 
            INNER JOIN preguntas ON pruebas.id_prueba = preguntas.id_prueba 
            INNER JOIN pregunta_indicador ON preguntas.id_pregunta = pregunta_indicador.id_pregunta 
            INNER JOIN indicadores ON pregunta_indicador.id_indicador = indicadores.id_indicador 
            INNER JOIN resultados ON indicadores.id_indicador = resultados.id_indicador 
            WHERE pruebas.id_prueba = ? 
            AND resultados.id_persona = ? 
            AND resultados.fecha_aplicacion = ? 
            ORDER BY resultados.id_indicador DESC 
            LIMIT 1");
            $stmt->bindParam(1, 1, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindParam(3, $fecha, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: avance_terman() " . $e->getMessage());
        }
    }

    //Muestra las preguntas correspondientes a un indicador o serie
    public function preguntas_por_serie($serie)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT preguntas.id_pregunta, preguntas.pregunta, pregunta_indicador.id_indicador 
            FROM pruebas 
            INNER JOIN preguntas ON pruebas.id_prueba = preguntas.id_prueba 
            INNER JOIN pregunta_indicador ON preguntas.id_pregunta = pregunta_indicador.id_pregunta 
            WHERE pregunta_indicador.id_indicador = ? ");
            $stmt->bindParam(1, $serie, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: preguntas_por_serie() " . $e->getMessage());
        }
    }
    
    //Realiza una suma acorde al valor de las opciones que recibe la consulta.
    public function suma($contesto)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT SUM(valor) AS total FROM opciones WHERE id_opcion IN( ? )");
            $stmt->bindParam(1, $contesto, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: suma() " . $e->getMessage());
        }
    }
    
    //Realiza una suma multiplicada por 2 acorde al valor de las opciones que recibe la consulta.
    public function sumaX2($contesto)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $stmt = $this->dbh->prepare("SELECT SUM(valor)*2 AS total FROM opciones WHERE id_opcion IN( ? )");
            $stmt->bindParam(1, $contesto, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: sumaX2() " . $e->getMessage());
        }
    }
    
    //De las opciones que recibe la consulta obtiene únicamente aquellas que solo marcaron 2 casillas y que las opciones sean las dos correctas para posteriormente realizar la suma en el controlador
    public function sumaS4($contesto)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            //159,160,164,166,170,171,173,174,175,178,180,181,185,187 = 2
            //159,162,163,165,170,171,173,175,179,182,185,187 = 6
            $stmt = $this->dbh->prepare("SELECT COUNT(*) AS ChecksPorPregunta, SUM(opciones.valor) AS resultadoPorPregunta FROM opciones INNER JOIN preguntas ON opciones.id_pregunta = preguntas.id_pregunta 
            WHERE id_opcion IN( ? ) GROUP BY preguntas.id_pregunta HAVING ChecksPorPregunta = ? AND resultadoPorPregunta = ? ");
            $stmt->bindParam(1, $contesto, PDO::PARAM_INT);
            $stmt->bindParam(2, 2, PDO::PARAM_INT);
            $stmt->bindParam(3, 2, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: sumaS4() " . $e->getMessage());
        }
    }
    
    // # # # # # #  SMP2 - SMP3 - RAVEN  # # # # # # 

    # Lista de las preguntas que aún no ha respondido la persona para la prueba en el día actual
    public function ultima_prg($id_prueba,$limit)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $sql = "SELECT preguntas.id_pregunta, preguntas.pregunta, pregunta_indicador.id_indicador 
            FROM pruebas 
            INNER JOIN preguntas ON pruebas.id_prueba = preguntas.id_prueba 
            INNER JOIN pregunta_indicador ON preguntas.id_pregunta = pregunta_indicador.id_pregunta 
            WHERE pruebas.id_prueba = ? 
            AND preguntas.id_pregunta 
            NOT IN (
                SELECT id_pregunta 
                FROM respuestas 
                WHERE id_persona = ?
                AND fecha_respuesta = ?
            )
            ORDER BY id_pregunta ASC 
            LIMIT ? ";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $id_prueba, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
            $stmt->bindParam(4, $limit, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: ultima_prg() " . $e->getMessage());
        }
    }

    //Calculo por indicador mediante las respuestas almacenadas
    public function suma_prueba($id_prueba,$sum)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $sql = "SELECT pregunta_indicador.id_indicador, SUM(opciones.valor) $sum AS Result 
            FROM pruebas 
            INNER JOIN preguntas ON pruebas.id_prueba = preguntas.id_prueba 
            INNER JOIN pregunta_indicador ON preguntas.id_pregunta = pregunta_indicador.id_pregunta 
            INNER JOIN indicadores ON pregunta_indicador.id_indicador = indicadores.id_indicador 
            INNER JOIN respuestas ON preguntas.id_pregunta = respuestas.id_pregunta 
            INNER JOIN opciones ON respuestas.id_opcion = opciones.id_opcion 
            WHERE pruebas.id_prueba = ?
            AND respuestas.id_persona = ? 
            AND respuestas.fecha_respuesta = ?
            GROUP BY pregunta_indicador.id_indicador";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $id_prueba, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: suma_prueba() " . $e->getMessage());
        }
    }

    //Valida si el usuario ya termino la prueba en el día actual
    public function fin_prueba($id_prueba)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $stmt = $this->dbh->prepare("SELECT COUNT(DISTINCT(resultados.id_indicador)) AS Total
            FROM pruebas 
            INNER JOIN preguntas ON pruebas.id_prueba = preguntas.id_prueba
            INNER JOIN pregunta_indicador ON preguntas.id_pregunta = pregunta_indicador.id_pregunta 
            INNER JOIN indicadores ON pregunta_indicador.id_indicador = indicadores.id_indicador 
            INNER JOIN resultados ON indicadores.id_indicador = resultados.id_indicador 
            WHERE pruebas.id_prueba = ? 
            AND resultados.id_persona = ?
            AND resultados.fecha_aplicacion = ?");
            $stmt->bindParam(1, $id_prueba, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: fin_prueba() " . $e->getMessage());
        }
    }

    // # # # # # # G E N E R A L # # # # # # 

    //Muestra las opciones que contiene una pregunta
    public function opciones_pregunta($pregunta) 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $sql = "SELECT * FROM opciones WHERE id_pregunta = ?";
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $pregunta, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $this->result[] = $row;
                }
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: suma_prueba() " . $e->getMessage());
        }
    }

    // # # # # # # R E S U L T A D O S # # # # # # 

    //Valida duplicados de resultados
    public function valida_duplicado_resultados($id_indicador, $id_prueba) 
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $stmt = $this->dbh->prepare("SELECT COUNT(*) 
            FROM resultados 
            WHERE id_persona = ? 
            AND id_indicador = ?
            AND fecha_aplicacion = ? 
            AND id_prueba = ? ");
            $stmt->bindParam(1, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindParam(2, $id_indicador, PDO::PARAM_STR);
            $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
            $stmt->bindParam(4, $id_prueba, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->result[] = $row;
                return $this->result;
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: valida_duplicado_resultados() " . $e->getMessage());
        }
    }
    
    //Registra las respuestas del usuario
    public function add_respuesta($id_pregunta, $id_opcion)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $stmt = $this->dbh->prepare("INSERT INTO respuestas (id_persona, id_pregunta, id_opcion, fecha_respuesta) VALUES (?, ?, ?, ?);");
            $stmt->bindvalue(1, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindvalue(2, $id_pregunta, PDO::PARAM_INT);
            $stmt->bindvalue(3, $id_opcion, PDO::PARAM_INT);
            $stmt->bindvalue(4, $fecha, PDO::PARAM_STR);
            $stmt->execute();
            $this->dbh = null;
        } catch (Exception $e) {
            die("¡Error!: valida_duplicado_resultados() " . $e->getMessage());
        }
    }
    
    //Registra las respuestas del usuario
    public function delete_respuestas($id_prueba)
    {
        try {
            $this->dbh = AccesoDatos::conexion();
            $fecha = parent::Fecha_actual();
            $stmt = $this->dbh->prepare("DELETE respuestas 
            FROM pruebas 
            INNER JOIN preguntas ON pruebas.id_prueba = preguntas.id_prueba 
            INNER JOIN pregunta_indicador ON preguntas.id_pregunta = pregunta_indicador.id_pregunta 
            INNER JOIN indicadores ON pregunta_indicador.id_indicador = indicadores.id_indicador 
            INNER JOIN respuestas ON preguntas.id_pregunta = respuestas.id_pregunta 
            WHERE pruebas.id_prueba = $id_prueba 
            AND respuestas.id_persona = ".$_SESSION["persona"]." 
            AND respuestas.fecha_respuesta = '".$fecha."';");
            $stmt->bindvalue(1, $id_prueba, PDO::PARAM_INT);
            $stmt->bindvalue(2, $_SESSION["idAdmin"], PDO::PARAM_INT);
            $stmt->bindvalue(3, $fecha, PDO::PARAM_STR);
            $stmt->execute();
            $this->dbh = null;
        } catch (Exception $e) {
            die("¡Error!: valida_duplicado_resultados() " . $e->getMessage());
        }
    }
}
