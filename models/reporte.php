<?php
class Reporte extends AccesoDatos
{
    private $dbh;
    private $result;

    public function __construct()
    {
        $this->result = array();
    }

    public function perfil_test($test,$perfil,$idDetalle)
    {
      try {
        $this->dbh = parent::conexion();
        $stmt = $this->dbh->prepare("UPDATE detalle_personas_pruebas SET perfil = JSON_SET(perfil, '$.".$test."', $perfil) where id_detalle = $idDetalle");
        $stmt->execute();
        $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
        $stmt = null; // obligado para cerrar la conexión
        $this->dbh = null;
      } catch (PDOException $e) {
          die("¡Error!: perfil_test".$e->getMessage());
      }
    }

    public function perfil_final($idDetalle)
    {
      try {
        $this->dbh = parent::conexion();
        $stmt = $this->dbh->prepare("SELECT JSON_EXTRACT(perfil, '$.smpuno') AS smpuno, JSON_EXTRACT(perfil, '$.smpdos') AS smpdos, JSON_EXTRACT(perfil, '$.ci') AS ci FROM detalle_personas_pruebas where `id_detalle` = ?");
        $stmt->bindParam(1, $idDetalle, PDO::PARAM_INT);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $smpuno=$row['smpuno'];
          $smpdos=$row['smpdos'];
          $ci=$row['ci'];
          if(!empty($smpuno) and !empty($smpdos) and !empty($ci)){
            $pila = array();
            array_push($pila, $smpuno);
            array_push($pila, $smpdos);
            array_push($pila, $ci);
            rsort($pila);
            if (in_array(3,$pila)) {
              $perfil=3;
            }elseif(in_array(2,$pila)){
              $perfil=2;
            }elseif(in_array(1,$pila)){
              $perfil=1;
            }
            return $perfil;
          }else{
            return $perfil=0;
          }
          $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
          $stmt = null; // obligado para cerrar la conexión
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: res_mmpi() " . $e->getMessage());
      }
    }
    # # # OK # # #
    public function p_final($idDetalle)
    {
      try {
        $this->dbh = parent::conexion();
        $stmt = $this->dbh->prepare("SELECT JSON_EXTRACT(perfil, '$.final') AS final, JSON_EXTRACT(perfil, '$.smpuno') AS smpuno, JSON_EXTRACT(perfil, '$.smpdos') AS smpdos, JSON_EXTRACT(perfil, '$.ci') AS ci FROM detalle_personas_pruebas where `id_detalle` = ?");
        $stmt->bindParam(1, $idDetalle, PDO::PARAM_INT);
        if ($stmt->execute()) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $result[] = $row;
          return $result;
          $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
          $stmt = null; // obligado para cerrar la conexión
          $this->dbh = null;
        }
      } catch (Exception $e) {
        die("¡Error!: p_final() " . $e->getMessage());
      }
    }
    # # # OK # # #
    public function res_total($idDetalle,$id_prueba)
    {
        try {
            $this->dbh = parent::conexion();
            $stmt = $this->dbh->prepare("SELECT 
            SUM(res.resultado) AS total
                FROM
                    detalle_personas_pruebas dpp
                        INNER JOIN
                    resultados res ON dpp.id_detalle = res.id_detalle
                        INNER JOIN
                    indicadores ind ON res.id_indicador = ind.id_indicador
                WHERE
                    dpp.id_detalle = ?
                        AND res.id_prueba = ?");
        $stmt->bindParam(1, $idDetalle, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_prueba, PDO::PARAM_INT);
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[] = $row;
                }
                return $result;
                $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
                $stmt = null; // obligado para cerrar la conexión
                $this->dbh = null;
            }
        } catch (Exception $e) {
            die("¡Error!: res_mmpi() " . $e->getMessage());
        }
    }
    # # # OK # # #
  public function res_ind($idDetalle,$id_prueba)
  {
      try {
          $this->dbh = parent::conexion();
          $stmt = $this->dbh->prepare("SELECT 
          dpp.id_detalle,
          ind.id_indicador,
          ind.indicador,
          ind.descripcion,
          res.resultado,
          res.escala
      FROM
          detalle_personas_pruebas dpp
              INNER JOIN
          resultados res ON dpp.id_detalle = res.id_detalle
              INNER JOIN
          indicadores ind ON res.id_indicador = ind.id_indicador
      WHERE
          dpp.id_detalle = ?
              AND res.id_prueba = ?
      ORDER BY ind.id_indicador ASC");
      $stmt->bindParam(1, $idDetalle, PDO::PARAM_INT);
      $stmt->bindParam(2, $id_prueba, PDO::PARAM_INT);
          if ($stmt->execute()) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $result[] = $row;
              }
              return $result;
              $stmt->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
              $stmt = null; // obligado para cerrar la conexión
              $this->dbh = null;
          }
      } catch (Exception $e) {
          die("¡Error!: res_mmpi() " . $e->getMessage());
      }
  }
  # # # OK # # #
  public function perfil_terman($terman){
    if($terman<=66){
      if($terman<=44){
        if($terman<=29){$ci=72;}
        if($terman>=30 and $terman<=34){$ci=73;}	
        if($terman>=35 and $terman<=39){$ci=74;}	
        if($terman>=40 and $terman<=44){$ci=75;}
        $categoria='LIMITROFE';
      }
      if($terman>=45 and $terman<=66){
        if($terman>=45 and $terman<=49){$ci=76;}
        if($terman>=50 and $terman<=54){$ci=77;}
        if($terman>=55 and $terman<=69){$ci=78;}
        if($terman>=60 and $terman<=66){$ci=79;}
        $categoria='MUY INFERIOR';
      }
      $definicion='<p>El Grado de Éxito de  esta persona se encuentra sumamente disminuido. En este apartado se considera  al sujeto con un pronóstico en su desempeño académico, social, familia, laboral, etc., muy pobre, caracterizándose por tener  elevadas dificultades para resolver problemas o conflictos , los cuales se van a ver reflejados en actividades académicas, sociales, familiares, laborales, emocionales etc.  Por ejemplo:</p>
      <ul>
        <li>hay presencia de dificultades para resolver problemas en el que se incluyan las matemáticas o la física.</li>
        <li>Hay manifestaciones de algunas conductas de necedad o de conflicto al no poder resolver determinadas situaciones familiares, sociales, emocionales, entre otros.</li>
      </ul>';
      $tratamiento='<p>El Grado de Éxito se encuentra sumamente en riesgo. Es importante que el sujeto evaluado asista con un especialista (Psicólogo clínico de preferencia), con la intención de evaluar y analizar como favorecer algunas áreas de oportunidad.</p>
      <ul>
        <li>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada.</li>
      </ul>';
      $perfil=3;
    }
    if($terman>=67 and $terman<=93){
      if($terman>=67 and $terman<=69){$ci=80;}
      if($terman>=70 and $terman<=71){$ci=81;}
      if($terman>=72 and $terman<=74){$ci=82;}
      if($terman>=75 and $terman<=76){$ci=83;}
      if($terman>=77 and $terman<=80){$ci=84;}
      if($terman>=81 and $terman<=82){$ci=85;}
      if($terman>=83 and $terman<=85){$ci=86;}
      if($terman==86){$ci=87;}
      if($terman>=87 and $terman<=90){$ci=88;}
      if($terman>=91 and $terman<=93){$ci=89;}
      $categoria='INFERIOR A TEMINO MEDIO';
      $definicion='<p>El Grado de Éxito de  esta persona se encuentra  disminuido, dado que sus capacidades "cerebrales" no han sido "activadas" lo suficiente como para resolver razonadamente problemas o conflictos, los cuales se van a ver reflejados en actividades académicas, sociales, familiares, laborales, emocionales etc. Por ejemplo:</p>
      <ul>
        <li>Es muy probable que tenga dificultades para resolver problemas en el que se incluyan las matemáticas o la física.</li>
        <li>Es probable que el evaluado manifieste conductas de   necedad o de conflicto al no poder resolver determinadas situaciones familiares, sociales, emocionales, entre otros.</li>
      </ul>';
      $tratamiento='<p>El Grado de Éxito se encuentra  en riesgo, se recomienda canalización del sujeto a un especialista con el fin de favorecer y "activar"  su desempeño académico, además de otras áreas de oportunidad.</p>';
      $perfil=2;
    }
    if($terman>=94){
      if($terman>=94 and $terman<=162){
        if($terman>=94 and $terman<=96){$ci=90;}
        if($terman>=97 and $terman<=99){$ci=91;}
        if($terman>=100 and $terman<=102){$ci=92;}
        if($terman>=103 and $terman<=104){$ci=93;}
        if($terman>=105 and $terman<=106){$ci=94;}
        if($terman>=107 and $terman<=110){$ci=95;}
        if($terman>=111 and $terman<=113){$ci=96;}
        if($terman>=114 and $terman<=116){$ci=97;}
        if($terman>=117 and $terman<=119){$ci=98;}
        if($terman>=120 and $terman<=123){$ci=99;}
        if($terman>=124 and $terman<=125){$ci=100;}
        if($terman>=126 and $terman<=129){$ci=101;}
        if($terman>=130 and $terman<=133){$ci=102;}
        if($terman>=134 and $terman<=137){$ci=103;}
        if($terman>=138 and $terman<=141){$ci=104;}
        if($terman>=142 and $terman<=145){$ci=105;}
        if($terman>=146 and $terman<=149){$ci=106;}
        if($terman>=150 and $terman<=153){$ci=107;}
        if($terman>=154 and $terman<=157){$ci=108;}
        if($terman>=158 and $terman<=159){$ci=109;}
        if($terman>=160 and $terman<=162){$ci=110;}
        $categoria='TERMINO MEDIO';
      }
      if($terman>=163){
        if($terman>=163 and $terman<=166){$ci=111;}
        if($terman==167){$ci=112;}
        if($terman>=168 and $terman<=170){$ci=113;}
        if($terman>=171 and $terman<=173){$ci=114;}
        if($terman>=174 and $terman<=175){$ci=115;}
        if($terman>=176 and $terman<=177){$ci=116;}
        if($terman>=178 and $terman<=180){$ci=117;}
        if($terman>=181 and $terman<=183){$ci=118;}
        if($terman>=184 and $terman<=185){$ci=119;}
        if($terman>=186){$ci=120;}
        $categoria='SUPERIOR';
      }
      $definicion='<p>En este apartado se considera  al sujeto con un pronóstico Exitoso adecuado para resolver dificultades o problemas de tipo racional (mental) en sus diferentes modalidades, es decir ya sean académicas, profesionales, sociales, familiares, laborales, etc., (independientemente de sus áreas emocionales, las cuales se recomienda analizar).</p>';
      $tratamiento='<p>Se considera al sujeto evaluado, con capacidad cerebral suficiente  para poder llegar al logro de sus Éxitos.</p>';
      $perfil=1;
    }
    $out['ci'] = $ci;
    $out['categoria'] = $categoria;
    $out['definicion'] = $definicion;
    $out['tratamiento'] = $tratamiento;
    $out['perfil'] = $perfil;
    return $out;
  }
# # # OK # # #
  public function perfil_raven($raven){
    if($raven<=24){
      if($raven<=19){$ci=40;}
      if($raven==20){$ci=43;}
      if($raven==21){$ci=45;}
      if($raven==22){$ci=47;}
      if($raven==23){$ci=50;}
      if($raven==24){$ci=52;}
      $categoria='LIMITROFE';
      $definicion='<p>El Grado de Éxito de  esta persona se encuentra sumamente disminuido. En este apartado se considera  al sujeto con un pronóstico en su desempeño académico, social, familia, laboral, etc., muy pobre, caracterizándose por tener  elevadas dificultades para resolver problemas o conflictos , los cuales se van a ver reflejados en actividades académicas, sociales, familiares, laborales, emocionales etc.  Por ejemplo:</p>
      <ul>
        <li>hay presencia de dificultades para resolver problemas en el que se incluyan las matemáticas o la física.</li>
        <li>Hay manifestaciones de algunas conductas de necedad o de conflicto al no poder resolver determinadas situaciones familiares, sociales, emocionales, entre otros.</li>
      </ul>';
      $tratamiento='<p>El Grado de Éxito se encuentra sumamente en riesgo. Es importante que el sujeto evaluado asista con un especialista (Psicólogo clínico de preferencia), con la intención de evaluar y analizar como favorecer algunas áreas de oportunidad.</p>
      <ul>
        <li>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada.</li>
      </ul>';
      $perfil=3;
    }
    if($raven>=25 and $raven<=40){
        if($raven==25){$ci=54;}
        if($raven==26){$ci=56;}
        if($raven==27){$ci=58;}
        if($raven==28){$ci=60;}
        if($raven==29){$ci=63;}
        if($raven==30){$ci=65;}
        if($raven==31){$ci=67;}
        if($raven==32){$ci=69;}
        if($raven==33){$ci=71;}
        if($raven==34){$ci=73;}
        if($raven==35){$ci=76;}
        if($raven==36){$ci=78;}
        if($raven==37){$ci=80;}
        if($raven==38){$ci=82;}
        if($raven==39){$ci=84;}
        if($raven==40){$ci=87;}
        $categoria='INFERIOR A TEMINO MEDIO';

      $definicion='<p>El Grado de Éxito de  esta persona se encuentra  disminuido, dado que sus capacidades "cerebrales" no han sido "activadas" lo suficiente como para resolver razonadamente problemas o conflictos, los cuales se van a ver reflejados en actividades académicas, sociales, familiares, laborales, emocionales etc. Por ejemplo:</p>
      <ul>
        <li>Es muy probable que tenga dificultades para resolver problemas en el que se incluyan las matemáticas o la física.</li>
        <li>Es probable que el evaluado manifieste conductas de   necedad o de conflicto al no poder resolver determinadas situaciones familiares, sociales, emocionales, entre otros.</li>
      </ul>';
      $tratamiento='<p>El Grado de Éxito se encuentra  en riesgo, se recomienda canalización del sujeto a un especialista con el fin de favorecer y "activar"  su desempeño académico, además de otras áreas de oportunidad.</p>';
      $perfil=2;
    } 
    if($raven>=41){
      if($raven>=41 and $raven<=51){
        if($raven==41){$ci=89;}
        if($raven==42){$ci=91;}
        if($raven==43){$ci=93;}
        if($raven==44){$ci=95;}
        if($raven==45){$ci=97;}
        if($raven==46){$ci=99;}
        if($raven==47){$ci=102;}
        if($raven==48){$ci=104;}
        if($raven==49){$ci=106;}
        if($raven==50){$ci=108;}
        if($raven==51){$ci=110;}
        $categoria='TERMINO MEDIO';
      }
      if($raven>=52 and $raven<=55){
        if($raven==52){$ci=112;}
        if($raven==53){$ci=115;}
        if($raven==54){$ci=117;}
        if($raven==55){$ci=119;}      
        $categoria='SUPERIOR AL TERMINO MEDIO';
      }
      if($raven>=56){
        if($raven==56){$ci=122;}
        if($raven==57){$ci=124;}
        if($raven==58){$ci=126;}
        if($raven==59){$ci=128;}
        if($raven>=60){$ci=130;}
        $categoria='MUY SUPERIOR';
      }
      $definicion='<p>En este apartado se considera  al sujeto con un pronóstico Exitoso adecuado para resolver dificultades o problemas de tipo racional (mental) en sus diferentes modalidades, es decir ya sean académicas, profesionales, sociales, familiares, laborales, etc., (independientemente de sus áreas emocionales, las cuales se recomienda analizar).</p>';
      $tratamiento='<p>Se considera al sujeto evaluado, con capacidad cerebral suficiente  para poder llegar al logro de sus Éxitos.</p>';
      $perfil=1;
    }
    $out['ci'] = $ci;
    $out['categoria'] = $categoria;
    $out['definicion'] = $definicion;
    $out['tratamiento'] = $tratamiento;
    $out['perfil'] = $perfil;
    return $out;
  }
  # # # OK # # #
  public function perfil_smp02($indicador,$valor,$sexo){
    //ESTRES
    if($indicador==11){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  muy bajo, dado que el evaluado presenta severos problemas psicológicos y emocionales, los cuales van a estar más representados en enfermedades de tipo fisiológico (en el cuerpo, por ejemplo: dolor de estomago, diarreas, dolor espalda, cabeza, entre otro tipos de malestares nerviosos)</p>';
        $tratamiento='
        <ul>
          <li>Canalización ante un especialista en la materia, a efecto de que exista  una valoración mas profunda con intervenciones (atenciones) oportunas y eficaces y que a su vez le  permita al sujeto  tener una funcionalidad adecuada ante las situaciones o circunstancias que generen estrés en su vida cotidiana.</li>
          <li>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada.</li>
        </ul>';
        $perfil=3;
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>El grado de Éxito del evaluado va a disminuir en la medida en que esta escala se eleve, dado que  el nivel de estrés se encuentra bajo circunstancias que son distinguidas por el individuo con mucha presión, preocupación, tensión corporal, inquietud emocional o corporal, entre otros. De no controlarse esta situación el individuo puede comenzar a manifestar padecimientos (enfermedades) como: Colitis, dolor estomacal, dolor de espalda o de cabeza, entre otro tipo de malestares nerviosos.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona, se requiere que el trabajo pueda ser colegiado (especializado), entre el terapeuta (profesional especializado) y el tutor (padre, psicólogo,  maestro, orientador, entre otros), de tal manera en que se puede recomendar lo siguiente:</p>
        <ul>
          <li>Tratamiento y asesoría en materia de estrés y apoyo para la identificación del causante de este o estos padecimientos.</li>
          <li>Enseñanza y manejo de técnicas de relajación.</li>
          <li>Sugerir de acuerdo al contexto en el que se encuentra el sujeto actividades que pudieran resultar  relajantes.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=5){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //SOLEDAD
    if($indicador==12){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  muy bajo. El evaluado presenta severos problemas para relacionarse,  los cuales van a estar más representados en enfermedades de tipo social.</p>';
        $tratamiento='
        <ul>
          <li>Canalización del sujeto a un especialista con el fin de favorecer  la disminución del distanciamiento en las relaciones familiares, sociales, de pareja, entre otros.</li>
          <li>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</li>
        </ul>';
        $perfil=3;
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>El grado de Éxito del evaluado va a disminuir en la medida en que esta escala se eleve dado que  el sujeto está marcando cada vez más un distanciamiento de las relaciones sociales además de aparentar y mostrar sentimientos y emociones disminuidas (como si no hubiese motivo para mostrar una sonrisa, o ser más agradable). En resumidas cuentas, parece que prefieren emplear el tiempo en sí mismo, antes que con otras personas. Suelen estar casi siempre aislados y prefieren escoger actividades solitarias que no requieran actividades con otras personas e incluso la propia familia.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona, se requiere que la atención sea coordinada entre el tutor (padre, psicólogo, maestro, orientador, entre otros) y el terapeuta (especialista profesional) en donde se pueden realizar acciones como:</p>
        <ul>
          <li>Asesorías individuales y/o grupales a efecto de orientar sobre las relaciones sociales, familiares interpersonales y su importancia en la vida académica, laboral, entre otras.</li>
          <li>Buscar actividades que promuevan una adecuada integración pudiendo ser de tipo  académico, extra académico, laboral, entre otros.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=5){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //TRISTEZA
    if($indicador==13){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  muy bajo. El evaluado presenta severos problemas emocionales, los cuales van a estar  representados por  la decadencia de su acción motivacional.</p>';
        $tratamiento='<ul>
          <li>Se considera necesario sea canalizado el sujeto a un especialista a fin de que se le proporcione una atención y seguimiento  adecuado  a su depresión.</li>
          <li>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</li>
        </ul>';
        $perfil=3;
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>El grado de Éxito del evaluado está disminuyendo dado que el sujeto se encuentra manifestando un periodo de tristeza (o depresión) importante, el cual puede ser temporal o permanente. En la mayoría de los casos, el sujeto relata su estado y así lo ven los demás, como derribado, abatido, débil, con poca energía para realizar actividades, y perdiendo capacidades para resolver problemas como por ejemplo: laboral, académico, social, familiar, de pareja, entre otros.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona, se requiere que la orientación por parte del tutor (padre, psicólogo,  maestro, orientador, entre otros) y el terapeuta (especialista profesional),donde se sugiere:</p>
        <ul>
          <li>Brindar asesoría especializada sobre  la depresión y establecer en la medida de lo posible compromiso departe del sujeto para no violentar su integridad y apegarse en la medida de lo posible a una atención personalizada o bien grupal, dependiendo del nivel de depresión del sujeto.</li>
          <li>Continuar con seguimiento para determinar si la tristeza (depresión)  es transitoria o permanente y así poder brindar un  manejo adecuado.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=5){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //IMPULSIVO
    if($indicador==14){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  muy bajo. El evaluado presenta severos problemas emocionales y de agresividad, los cuales van a estar más representados por constantes manifestaciones de violencia  física.</p>';
        $tratamiento='<p>Canalizar al evaluado con especialista.</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>El grado de Éxito del evaluado está disminuyendo  dado que el sujeto va mostrando cada vez más dificultades en el control de sus impulsos, es decir la agresividad, su forma de actuar es más precipitada. Esto se observa en la dificultad para esperar su turno en la participación de actividades laborales, sociales, académicas, familiares, entre otros. Por ejemplo en el  juego y en la selección de conductas riesgosas y no medir las consecuencias. Son frecuentes las peleas y discusiones, afectando el área social.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que el seguimiento sea especializado y al mismo tiempo el tutor (padre, psicólogo maestro, orientador, entre otros) oriente a este tipo de personas a:</p>
        <ul>
          <li>Identificar emociones como el enojo, miedo, tristeza, etc.</li>
          <li>Establecer, mediante la enseñanza de técnicas de autocontrol,  formas adecuadas de expresar sus emociones.</li>
          <li>Generar actividades de entrenamiento en habilidades sociales como la asertividad.</li>
          <li>Realizar actividades deportivas, donde el sujeto pueda canalizar energía física.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=5){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //INTEGRACION SOCIAL
    if($indicador==15){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  muy bajo. El evaluado presenta severos problemas antisociales (no aceptados por las leyes y reglamentos sociales) o delictivos, los cuales cada vez más  van a estar representados por conductas abiertas (cada vez con mas problemáticas sociales)  y menos aceptadas.</p>';
        $tratamiento='<p>Canalizar al evaluado con especialista.</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>El grado de Éxito del evaluado está disminuyendo  dado que el sujeto muestra conductas no muy agradables socialmente como: astuto de conveniencia, intrigante, calculador, ingrato, premeditado, aprovechado, oportunista, ofensivo, abusador, indiferente, "amante de lo ajeno”, engañador, entre otros.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que el seguimiento sea coordinado entre tutor (padre, psicólogo, maestro, orientador, entre otros)  y terapeuta (especialista profesional) sugiriendo lo siguiente:</p>
        <ul>
          <li>Orientación sobre  normas sociales de convivencia.</li>
          <li>Destacar la importancia de valores individuales y sociales que fomentan adecuadas relaciones interpersonales (amistad, de pareja, familiares, entre otros).</li>
          <li>De ser necesario, apoyo familiar con la intención de modificar patrones de conducta aprendidas en la dinámica (en el comportamiento) de la misma familia.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=5){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //DISTANCIAMIENTO DEL YO
    if($indicador==16){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  muy bajo. El evaluado presenta severos problemas emocionales y autodestructivos, los cuales van a estar mas matizados (combinados, mezclados) de conductas transgresoras (de hacer daño) de sí mismo, o con los demás.</p>';
        $tratamiento='<p>Canalizar al evaluado con especialista.</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=5 and $valor<=7){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo. En la medida en que se eleve este perfil, el sujeto va mostrando signos o comportamientos relacionados con la baja autoestima, la pérdida de sentido de vida, el no tener proyectos ni visualización hacia adelante. "Pareciera que la vida se paró para ellos". Muchas veces lo que dice es ilógico o incoherente, fantasioso, entre otros. Puede manejar  ideas de muerte o de posibles intentos  suicidas, primero piensa que la muerte es una solución, y no sólo para ellos incluso para quienes están alrededor de ellos.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que el seguimiento sea especializado y al mismo tiempo el tutor (padre, psicólogo, maestro, orientador, especialista en el ramo, entre otros) oriente a este tipo de personas a:</p>
        <ul>
          <li>Manejo de agresividad mediante la identificación de causas de la misma.</li>
          <li>Trabajo de autoestima del individuo.</li>
          <li>Entrenamiento en habilidades sociales y asertividad, así como el de prevenir y estar atento para que no se repitan las mismas conductas.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=4){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //ALCOHOLISMO
    if($indicador==17){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo. El evaluado presenta severos problemas de conducta en lo que se refiere a la ingesta de bebidas alcohólicas.</p>';
        $tratamiento='<p>Canalizar al evaluado con especialista o a un centro de atención de  alcoholismo (p. ej. Un centro de integración juvenil, ó Alcohólicos Anónimos).</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=5 and $valor<=7){
        $definicion='<p>El Grado de Éxito se encuentra  disminuyendo dado que el sujeto se encuentra con algunas dificultades para controlar dos cosas importantes: abuso de alcohol y dependencia del alcohol; si bien esta diferenciación no es relevante desde el punto de vista clínico, sin embargo es muy importante el abuso de alcohol en la dependencia psicológica, es decir, la necesidad de consumir alcohol para el funcionamiento mental adecuado, junto con consumo ocasional excesivo y continuación alcohólica a pesar de los problemas sociales.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que el trabajo sea colegiado (especializado), entre el terapeuta (profesional especializado) y el tutor (padre, psicólogo, maestro, orientador, entre otros), de tal manera en que se puede recomendar lo siguiente:</p>
        <ul>
          <li>Orientación y psico-educación sobre alcoholismo (causas-consecuencias individuales, familiares, laborales, académicas y sociales).</li>
          <li>Manejo terapéutico sobre las causas por las que el sujeto bebe (duelos, pérdidas, problemas familiares, de pareja, etc.)</li>
          <li>Manejo conductual sobre el alcoholismo.</li>
          <li>En casos específicos trabajo  de asesoría con los padres y/o tutor del sujeto evaluado.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=4){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //FARMACODEPENDENCIA
    if($indicador==18){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo. El evaluado presenta severos problemas de conducta en lo que se refiere a la ingesta de drogas. Es importante considerar si el evaluado está involucrado en actividades ilícitas de tipo criminal o delictivo, o por el contrario se encuentre consumiendo  medicamentos de tipo psiquiátrico.</p>';
        $tratamiento='<p>Canalizar al evaluado con un especialista en adicciones o bien a un centro especializado en atención de adicciones (p. ej. Un centro de Integración Juvenil).</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido dado que el sujeto va mostrando  cada vez más la necesidad de uso de drogas  y la  dependencia de las mismas (dado que considera que para ser funcional social o emocionalmente, necesita de algún tipo de droga), independientemente de  su búsqueda de satisfacción física (la parte corporal y mental  que exige la administración periódica o continua de la misma).</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que el trabajo sea coordinado entre terapeuta (especialista profesional) y tutor  (padre, psicólogo, maestro, orientador, entre otros) donde se sugiere:</p>
        <ul>
          <li>Orientación en adicciones o drogas hablando sobre causas y consecuencias personales, familiares, académicas, laborales y sociales).</li>
          <li>Identificación de causas por las que el sujeto se droga.</li>
          <li>Manejo conductual sobre la adicción a drogas.</li>
          <li>En casos específicos se sugiere trabajo y asesoría a los padres y/o tutor del sujeto evaluado.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=5){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //GÉNERO
    if($indicador==19){
      if($sexo=='H'){
        if($valor>=8 and $valor<=10){
          $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El evaluado presenta severos conflictos en lo que respecta sus preferencias de género.</p>';
          $tratamiento='<p>Canalizar con especialista.</p>';
          $perfil=3;
        }elseif($valor>=6 and $valor<=7){
          $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido dado que presenta algunas dificultades para entender algunas preferencias de género en cuanto a su sexualidad. Es muy probable que haya presencia de actitudes y conductas conflictivas.</p>';
          $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que un profesional de la salud (muy en especial  psicólogo), dé seguimiento a este tipo de personas.</p>';
          $perfil=2;
        }elseif($valor<=5){
          $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
          $tratamiento='<p></p>';
          $perfil=1;
        }
      }elseif($sexo=='M'){
        if($valor<=3){
          $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El evaluado presenta severos conflictos en lo que respecta sus preferencias de género.</p>';
          $tratamiento='<p>Canalizar con especialista.</p>';
          $perfil=3;
        }elseif($valor>=4 and $valor<=5){
          $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido dado que presenta algunas dificultades para entender algunas preferencias de género en cuanto a su sexualidad. Es muy probable que haya presencia de actitudes y conductas conflictivas.</p>';
          $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que un profesional de la salud (muy en especial  psicólogo), dé seguimiento a este tipo de personas.</p>';
          $perfil=2;
        }elseif($valor>=6 and $valor<=10){
          $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
          $tratamiento='<p></p>';
          $perfil=1;
        }
      }
    }
    //AUTODISCIPLINA
    if($indicador==20){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El evaluado presenta severos problemas de conducta en lo que se refiere a las figuras de autoridad, las cuales cada vez más se van a manifestar de manera retadora, provocadora o impulsiva (no sabe como controlarse).</p>';
        $tratamiento='<p>Canalizar con especialista.</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=5 and $valor<=7){
        $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido ya que la persona evaluada presenta características para el adecuado manejo de la disciplina (no cuenta con el poder para regular sus impulsos, es decir no sabe cómo controlarse). Por ejemplo:</p>
        <ul>
          <li>Tendencia a actuar impulsivamente (no sabe controlarse), sin pensar en lo que se hace.</li>
          <li>Incapacidad para afrontar tensiones propias de la vida (por ejemplo, se enoja, llora, rompe cosas, se va de la casa, se encierra en su cuarto, entre otros). Actitud evasiva frente a los problemas (por ejemplo: pareciera que a pesar del problema existente no se preocupa y toma medidas preventivas)</li>
          <li>Baja tolerancia a la frustración ("por todo se enoja, llora, o huye”), dificultad para aceptar límites y normas (no respeta a las personas con autoridad, se brinca cercados, no espeta semáforos, policía maestros, entre otros).</li>
          <li>Tendencia a ser autosuficiente (es decir, este tipo de personas refiere muchas veces no necesitar de nadie para salir o resolver sus problemas).</li>
          <li>Actitud irrespetuosa, oposicionista, descortés, desafiante.</li>
          <li>Dificultad para expresar sentimientos, emociones y pensamientos.</li>
          <li>Intolerancia al aburrirse (no les gusta estar en actividades de mucha paciencia).</li>
          <li>Pasión por riesgos.</li>
        </ul>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  sugiere que  la intervención pueda ser colegiada entre tutor  (padre, psicólogo,  maestro, orientador, entre otros) y terapeuta (especialista profesional) donde se propone:</p>
        <ul>
          <li>Orientación sobre la conducta impulsiva e indisciplinada y consecuencias de la misma.</li>
          <li>Entrenamiento en habilidades sociales, autocontrol y asertividad.</li>
          <li>Seguimiento para fomentar el apego a las normas institucionales y sociales.</li>
          <li>Fomentar actitudes de responsabilidad ante las consecuencias de su conducta, por medio de la sensibilización.</li>
          <li>En casos específicos se sugiere trabajo y asesoría a los padres y/o tutor del sujeto evaluado.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=4){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //DIFICULTAD EN EL SUPER YO
    if($indicador==21){
      if($valor>=8 and $valor<=10){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El evaluado presenta severos problemas psicológicos en lo que se refiere a la confusión para poder diferenciar la realidad con la fantasía, además de presentar cada vez más aspectos de tipo fantástico.</p>';
        $tratamiento='<p>Canalizar con un especialista.</p>
        <p>Se sugiere que antes de que ingrese a alguna institución educativa o laboral, primero reciba atención especializada, sin embargo, aunque el sujeto lleve adecuadamente su tratamiento  no garantiza un  adecuado progreso del mismo.</p>';
        $perfil=3;
      }elseif($valor>=5 and $valor<=7){
        $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido ya que en la medida en que aumenta este rango, se puede considerar la presencia de ideas fantasiosas (su imaginación va más allá de la realidad) y estas pueden definirse como falsas creencias de diferentes  contenidos  imaginarios y no reales (celos, mentiras, cuentos, ideas, creencias, entre otros). Puede creer que una o un grupo de personas actúan en su contra con ánimo de perjudicarlo, pero estas ideas por supuesto no son reales.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  considera necesario el seguimiento coordinado entre psicólogo con experiencia en psicología clínica y tutor (padre, maestro, orientador, entre otros) donde se aconseja:</p>
        <ul>
          <li>Valoración mental del sujeto, memoria y contenidos del pensamiento los cuales pueden ser realizados en primera instancia mediante un conjunto de pruebas psicológicas. Además de medir la duración de los momentos en que tiene este tipo de fantasías (si estos son frecuentes o irregulares).</li>
          <li>Evaluación de antecedentes heredo- familiares (Identificar si ha habido familiares con los mismos problemas o parecidos)</li>
          <li>Evaluación de uso y/o abuso de drogas y alcohol o bien de medicamentos no prescritos por el médico.</li>
          <li>Seguimiento para ayudar al sujeto a discriminar fantasía de realidad (ubicarlo en lo que es real de lo imaginario).</li>
          <li>Apoyo terapéutico para adecuado manejo de ansiedad (Hay pacientes que pueden sentir  acoso, miedo, angustia, entre otros de manera irreal).</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=4){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    
    $out['definicion'] = $definicion;
    $out['tratamiento'] = $tratamiento;
    $out['perfil'] = $perfil;
    return $out;
  }
  # # # OK # # #
  public function perfil_smp03($indicador,$valor){
    //ADAPTACIÓN FAMILIAR
    if($indicador==22){
      if($valor>=19 and $valor<=24){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El individuo posee serios problemas para relacionarse y adaptarse a su entorno familiar, lo cual generará inestabilidad familiar y por supuesto emocional.</p>';
        $tratamiento='<p>Canalización al especialista.</p>';
        $perfil=3;
      }elseif($valor>=13 and $valor<=18){
        $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido ya que en la medida en que aumenta este rango, se puede considerar la presencia de dificultades  y problemas que va enfrentando la  familia, en la que se pueden estar sumando: violencia intrafamiliar, divorcio, entre otros.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  considera necesario atención y seguimiento por parte del padre o tutor y terapeuta.</p>
        <ul>
          <li>Sesiones para evaluar la dinámica familiar a través de las referencias del evaluado.</li>
          <li>Apoyo terapéutico para enfrentar en caso necesario de una manera funcional alguna problemática familiar.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=12){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //ADAPTACIÓN A LA SALUD
    if($indicador==23){
      if($valor>=18 and $valor<=24){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El evaluado presentará importantes y recurrentes afecciones en la salud física básicamente asociadas situaciones emocionales y/o de ansiedad.</p>';
        $tratamiento='<p>Canalización al especialista.</p>';
        $perfil=3;
      }elseif($valor>=12 and $valor<=17){
        $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido ya que en la medida que  aumente este rango es porque el evaluado se encuentra ya con problemas físicos o de enfermedad causados por un mal manejo de las emociones o porque las circunstancias a las que se encuentra expuesta son muy tensas o estresantes.</p>
        <p>Por ejemplo: Colitis, dolor de cabeza o espalda, diarreas, gripas, pérdida del cuero cabelludo, u otro malestar físico.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  considera necesario  apoyo y seguimiento por parte del padre o tutor y terapeuta.</p>
        <ul>
          <li>Sensibilizar sobre la importancia de cuidar  y mantener una adecuada salud física.</li>
          <li>Orientar sobre los factores emocionales y estresores que afectan la salud física.</li>
          <li>Realizar valoración médica.</li>
          <li>Enseñar técnicas o dinámicas para control de ansiedad.</li> 
        </ul>';
        $perfil=2;
      }elseif($valor<=11){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //ADAPTACIÓN SOCIAL
    if($indicador==24){
      if($valor>=23 and $valor<=24){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  La persona presenta severas dificultades para  establecer relaciones sociales estables y duraderas.</p>';
        $tratamiento='<p>Canalización al especialista.</p>';
        $perfil=3;
      }elseif($valor>=20 and $valor<=22){
        $definicion='<p>El Grado de Éxito de esta persona se encuentra  disminuido ya que  en la medida en que este perfil aumente, nos va señalando las dificultades que el sujeto presenta para tener relaciones sociales estables y ello está afectando la capacidad de adaptarse a los diferentes entornos (social, académico, familiar, entre otros).</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  considera necesario  apoyo y seguimiento  por parte del padre o tutor y terapeuta, sugiriéndose:</p>
        <ul>
          <li>Sesiones de apoyo para sensibilizar sobre la importancia de establecer relaciones sociales significativas en la vida de la persona.</li>
          <li>Sesiones para tratar autoestima y habilidades sociales.</li>
          <li>Dar seguimiento de lo anterior  en el ámbito académico.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=19){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //ADAPTACIÓN EMOCIÓN
    if($indicador==25){
      if($valor>=20 and $valor<=24){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  Habrá una acentuada disminución en la funcionalidad del evaluado debido a los cambios recurrentes del estado emocional, los cuales pueden ser de gran intensidad (enojo, llanto, ira, risa injustificada, entre otros) que afectarán de manera importante la realización de sus actividades en la vida diaria.</p>';
        $tratamiento='<p>Canalización al especialista.</p>';
        $perfil=3;
      }elseif($valor>=16 and $valor<=19){
        $definicion='<p>El Grado de Éxito de  esta persona se encuentra  disminuido ya que  en la medida en que este perfil aumente, el sujeto se va caracterizando por presentar cambios emocionales constantes y en su mayoría no adecuados a las circunstancias como depresión, enojo, llanto, risa injustificada, o en su caso cambios repentinos de tristeza a llanto, o de llanto a enojo, entre otros.</p>';
        $tratamiento='
        <p>Para mejorar el Éxito de esta persona se  considera necesario  la orientación y sensibilización sobre la importancia de la salud mental.</p>
        <p>Es oportuno trabajar de manera conjunta terapeuta, padre o tutor y se sugiere:</p>
        <ul>
          <li>Manejar prevención sobre trastornos emocionales y afectivos como la depresión a través de charlas.</li>
          <li>Sesiones para ayudar al evaluado a descubrir y valorar aspectos importantes de su persona así como cualidades, aptitudes y comportamientos dirigidos a hacerle sentir motivado.</li>
          <li>Sesiones de apoyo para trabajar autoestima.</li>
        </ul>';
        $perfil=2;
      }elseif($valor<=15){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }
    //ADAPTACIÓN PROFESIONAL
    if($indicador==26){
      if($valor>=20 and $valor<=24){
        $definicion='<p>El Grado de Éxito se encuentra  en riesgo.  El individuo presenta un desajuste muy marcado en la realización de actividades  de tipo académico, lo que impedirá que pueda terminar algún proyecto o carrera profesional.</p>';
        $tratamiento='<p>Canalización al especialista.</p>';
        $perfil=3;
      }elseif($valor>=15 and $valor<=19){
        $definicion='<p>El Grado de Éxito de  esta persona se encuentra  disminuido ya que  en la medida en que este perfil se eleve, el sujeto cada vez más mostrará  dificultades y deficiencias en cuanto a sus necesidades y deseos emocionales por iniciar o terminar algún proyecto de tipo profesional. Por ejemplo tienen dificultades para dar seguimiento a: Cursos, talleres, o concluir  una carrera y/o actividad profesional, entre otros.</p>';
        $tratamiento='<p>Para mejorar el Éxito de esta persona se  considera necesario  el apoyo coordinado entre el terapeuta- padre o tutor recomendando:</p>
        <ul>
          <li>Evaluación de capacidades y recursos intelectuales.
          <li>Evaluación sobre habilidades y aptitudes a fin de determinar las áreas profesionales para las que el sujeto sea más adecuado.
          <li>Brindar asesorías sobre la importancia de concluir una carrera profesional para la que sea apto.
        </ul>';
        $perfil=2;
      }elseif($valor<=14){
        $definicion='<p>El Grado de Éxito de esta persona es elevado dado que  no presenta alteraciones en esta área.</p>';
        $tratamiento='<p></p>';
        $perfil=1;
      }
    }  
    $out['definicion'] = $definicion;
    $out['tratamiento'] = $tratamiento;
    $out['perfil'] = $perfil;
    return $out;
  }
  # # # OK # # #
  public function analisis($indicador,$valor){
    if($indicador==53){
      //Dirigente
      if($valor>=8 and $valor<=10){
        $definicion='<p>Persona que desarrolla una serie de habilidades gerenciales o directivas, así como tener la capacidad para tomar la iniciativa, gestionar, promover, motivar y evaluar al personal. De tal forma, que influye en la manera de comportarse de una o más personas provocando que trabajen con mucho entusiasmo logrando fácilmente las metas y objetivos trazados por la organización.</p>';
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>Persona que aún no cumple con las ponderaciones suficientes sin embargo el evaluado puede contar con los elementos necesarios para llevar a cabo el cambio de manera paulatina (siempre y cuando reciba seguimiento o capacitación),  bajo reserva de las demás áreas de oportunidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==54){
      //Dictador
      if($valor>=6 and $valor<=10){
        $definicion='<p>Agresivo y egoísta solo piensa en el "YO”, tiene una mala actitud y le gusta que las cosas se hagan "AHORA”. Necesita tener el mando de todas las situaciones, piensa que todas las personas son iguales y el saber que no es así le provoca impaciencia e intolerancia. Le gusta decir lo que piensa y no busca palabras suaves para hacerlo, no le interesan mucho las personas, le interesan los resultados, no le importan los cumplidos, ni las charlas que no tienen importancia. Por muy intimidada que se sienta una persona, no debe mostrarle sumisión, de lo contrario pensara que es una persona débil que no tiene la menor importancia.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==55){
      //Asesor
      if($valor>=8 and $valor<=10){
        $definicion='<p>Tiene tendencia para asesorar o asesorarse, es decir, le agrada dar y recibir consejos. Su especialidad es la consultoría sobre un determinado tema, ofrece asistencia y consejos sobre área de experiencia.</p>';
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>Persona que aún no cumple con las ponderaciones suficientes sin embargo el evaluado puede contar con los elementos necesarios para llevar a cabo el cambio de manera paulatina  (siempre y cuando reciba seguimiento o capacitación),  bajo reserva de las demás áreas de oportunidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==56){
      //Paternalista 
      if($valor>=6 and $valor<=10){
        $definicion='<p>Ejerce poder sobre otras personas combinando decisiones injustas, brinda protección condicionada con el fin de tener aliados en algún conflicto, es decir: "te apoyo, pero tú me apoyaras cuando tenga un conflicto”. Como un padre, pero sin ser padre. Es negativo, no ayuda en el crecimiento personal o colectivo y esto genera malas fuentes en el control del comportamiento de las personas no permitiendo el crecimiento de la autoestima.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==57){
      //Demostrativo
      if($valor>=8 and $valor<=10){
        $definicion='<p>Se expresa de forma natural mímica y verbalmente, normalmente son atractivos y seductores tienen una tendencia hacia la dramatización, no pasan nunca inadvertidos. Vivir con intensidad produce un impacto estético en el entorno que les rodea. Lenguaje lleno de adjetivos evita dar datos concretos, posee una riqueza verbal en cuanto a metáforas. Capacidad simbólica para hablar de sus emociones y sentimientos, facilidad de expresión mediante un fluido lenguaje y gestos coordinados que le permiten expresarse adecuadamente en áreas del comportamiento como son: mente y cuerpo.</p>';
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>Persona que aún no cumple con las ponderaciones suficientes sin embargo el evaluado puede contar con los elementos necesarios para llevar a cabo el cambio de manera paulatina (siempre y cuando reciba seguimiento o capacitación),  bajo reserva de las demás áreas de oportunidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==58){
      //Tecnócrata 
      if($valor>=6 and $valor<=10){
        $definicion='<p>Tiene habilidad para caer de pie siempre. A pesar de su dudosa moralidad sale mucho mejor librado que sus compañeros de desmanes. Es decir, son estafadores de intachable reputación.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==59){
      //Negociador
      if($valor>=8 and $valor<=10){
        $definicion='<p>Tiene una gran percepción con respecto a la relación existente en el poder negociador, regularmente elige tácticas orientadas y siempre pensando en el aumento de los beneficios mutuos. Implementa estrategias resolutivas y competitivas enfocándose en la consecución de sus propios intereses.  Puede generar confianza en sus adversarios desarrollando una capacidad de dominio en la reconciliación de ambas partes gestionando el tiempo y siendo muy persistentes en la obtención de sus logros mediante el proceso de negociación de cualquier convenio</p>';
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>Persona que aún no cumple con las ponderaciones suficientes sin embargo el evaluado puede contar con los elementos necesarios para llevar a cabo el cambio de manera paulatina (siempre y cuando reciba seguimiento o capacitación),  bajo reserva de las demás áreas de oportunidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==60){
      //Burócrata
      if($valor>=6 and $valor<=10){
        $definicion='<p>Excesivo apego a los reglamentos, su rutina genera una resistencia al cambio, miedo: a la pérdida del trabajo, a las relaciones sociales frente a frente, a tener problemas con superiores desconocidos para él. Tiene actitud pasiva, despersonalizada, irresponsable, se limita a favorecer a los altos mandos permitiendo las jerarquías con la finalidad de conseguir poder colectivo, su vida laboral se limita a los procedimientos impersonales y uniformes, es reconocido porque cumple con las normas administrativas y tiene un amplio dominio legal, pero no por sus facultades personales como son: lealtad e individualidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==61){
      //Competidor
      if($valor>=8 and $valor<=10){
        $definicion='<p>Mediante su esfuerzo logra tener ventajas sobre sus rivales, tales como: calidad y perfección, se involucra en los objetivos enfrentando una competencia personal (consigo mismo), con el fin de obtener resultados en su actividad de experiencia. Busca la competencia para obtener beneficios como: mejorar su escala social, gloria, prestigio, reconocimiento y autoestima. Esto puede ser en actividades comunes y no comunes.</p>';
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>Persona que aún no cumple con las ponderaciones suficientes sin embargo el evaluado puede contar con los elementos necesarios para llevar a cabo el cambio de manera paulatina (siempre y cuando reciba seguimiento o capacitación),  bajo reserva de las demás áreas de oportunidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==62){
      //Contradictorio
      if($valor>=6 and $valor<=10){
        $definicion='<p>Se mantiene en contradicción consigo mismo, pero también se contradice constantemente con otras personas. Su actitud siempre es opuesta entre lo que dice y lo que hace, no sostienen lo que hacen o lo que dicen, tiene el mismo comportamiento en todos los aspectos de su vida y su personalidad gira en entorno a la mentira.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==63){
      //Cooperador
      if($valor>=8 and $valor<=10){
        $definicion='<p>Enfocado en la colaboración, su personalidad es delicada, sensible, atenta, generosa, receptiva, intuitiva, agradable, sincera, tiene una gran imaginación, le agrada seguir ideas de otras personas, cumple ordenes eficaz y eficientemente, le agrada cuidar los detalles y en un ambiente sereno tiene un buen desempeño explotando sus habilidades. Tiene la capacidad de notar las necesidades de otras personas antes de que se lo pidan, es muy apreciada su gentileza, modestia, paciencia y su capacidad de persuasión.</p>';
      }elseif($valor>=6 and $valor<=7){
        $definicion='<p>Persona que aún no cumple con las ponderaciones suficientes sin embargo el evaluado puede contar con los elementos necesarios para llevar a cabo el cambio de manera paulatina (siempre y cuando reciba seguimiento o capacitación),  bajo reserva de las demás áreas de oportunidad.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    if($indicador==64){
      //Evasivo
      if($valor>=6 and $valor<=10){
        $definicion='<p>Se caracteriza por observar las situaciones de "afuera hacia adentro”, le gustaría mantener relación con otras personas, pero es complicado porque le cuesta mucho trabajo tiene que soportar la sensación de que al acercarse a otras personas sea inaceptable, incapaz de ser amado y es difícil cambiar para ellos. Sobreviven alejándose de las personas manteniendo una conducta laboral mínima. Es retraído social, temeroso al maltrato, se siente humillado fácilmente con las críticas y manifestaciones de desaprobación, no tiene amigos en quien confiar solo miembros de su familia, para establecer una relación social debe tener la seguridad de caer bien, evita las actividades donde se desarrolle contacto interpersonal, no acepta promociones si es necesario relacionarse con otras  personas, es reservado en reuniones por miedo: a decir algo inadecuado, vergüenza a sonrojarse, llorar o demostrar intranquilidad a la gente.</p>';
      }elseif($valor<=5){
        $definicion='<p>No presenta ponderaciones significativas en esta área.</p>';
      }
    }
    $out['definicion'] = $definicion;
    return $out;
  }
  # # # OK # # #
  public function machover($indicador,$valor){
    if($indicador==84){
      //Indicador del rol sexual
      if($valor>=1){
        $definicion='<p>El sujeto presenta conflictos de tipo psicosexual, de los cuales pueden destacarse dos características principales, la primera en cuanto la presencia de conflictos relacionados con sus preferencias psicosexuales; la segunda, el conflicto con la figura femenina relacionada a la dinámica de desarrollo psicosexual con la figura femenina (Madre).</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==85){
      //Indicador del conflicto sexual
      if($valor>=1){
        $definicion='<p>Indica conflictos de tipo sexual los cuales se asocian con sujetos que tienden a mostrar inmadurez sexual así como conductas inadecuadas  relacionadas con ésta área.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==86){
      //Indicadores emocionales de rasgos asociados al abuso sexual.
      if($valor>=1){
        $definicion='<p>Indica rasgos o conductas de personalidad que se asocian a conflictos de tipo psicosexual orientados al acoso, abuso sexual, o a la búsqueda del placer sexual sin medir las consecuencias de acuerdo a lo social o moralmente establecido.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==87){
      //Indicadores emocionales de impulsividad
      if($valor>=1){
        $definicion='<p>Indica tendencia a actuar espontáneamente, casi sin premeditación o planeación; a mostrar baja tolerancia a la frustración, control interno débil, inconsistencia; a ser expansivo y a buscar gratificación inmediata. La impulsividad se relaciona, por lo común, con el temperamento de los jóvenes con inmadurez.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==88){
      //Indicadores emocionales suicidas
      if($valor>=1){
        $definicion='<p>Indica rasgos o características de personalidad asociadas al suicidio, ya sea éste de manera consciente o inconsciente. Este tipo de resultados se asocian a sujetos que históricamente cometen actos o conductas de alto riesgo sin medir consecuencias.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==89){
      //Indicadores rasgos narcisistas
      if($valor>=1){
        $definicion='<p>Indica rasgos o características de personalidad asociadas  a ser impacientes o enojarse cuando no se las trata de manera especial. Tener notables problemas interpersonales y ofenderse con facilidad. Reaccionar con ira o desdén y tratan con desprecio a los demás, para dar la impresión de que son superiores. Tener dificultad para regular las emociones y la conducta.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==90){
      //Indicadores emocionales de inseguridad
      if($valor>=1){
        $definicion='<p>Indica un auto concepto bajo, falta de seguridad en sí mismo, preocupación acerca de la adecuación mental, sentimientos de impotencia y una posición insegura. El evaluado se considera como un extraño, no lo suficientemente humano, o como una persona ridícula que tiene dificultades para establecer contacto con los demás.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==91){
      //Indicadores emocionales de ansiedad
      if($valor>=1){
        $definicion='<p>Indica tensión o inquietud de la mente con respecto al cuerpo (ansiedad corporal), a las acciones, al futuro; preocupación, inestabilidad, aflicción; estado prolongado de aprensión. Ansiedad, temor anticipado de un peligro futuro, cuyo origen es desconocido o no se reconoce. Normalmente este tipo de personas cuando no logran canalizar adecuadamente la ansiedad tienden a somatizar (enfermarse) o a realizar algún tipo de conversión fisiológico como por ejemplo: los tips nerviosos, parálisis facial o corporal, entre otros.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==92){
      //Indicadores emocionales para socializar (esquizoides)
      if($valor>=1){
        $definicion='<p>Indica rasgos o conductas de personalidad, en las que el sujeto no cuenta con herramientas suficientes para entablar, mantener o realizar conductas de tipo social. Este tipo de personas, pueden manifestar ansiedad o frustración interpersonal ya que no saben cómo mostrar emociones o sentimientos de tipo social hacia el "otro¨, y suelen alejarse o distanciarse.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==93){
      //Indicadores emocionales de dependencia
      if($valor>=1){
        $definicion='<p>Indica rasgos o conductas de personalidad que se asocian a la dependencia de personas por lo regular del sexo femenino (Madre, esposa, hermana, novia, etc.). Por lo regular a este tipo de sujetos evaluados, les cuesta tomar decisiones y pueden mostrar frustración y conflicto ante situaciones de conflicto si no hay "alguien que les puede apoyar, comentar, ayudar al respecto"</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==94){
      //Indicadores emocionales de timidez
      if($valor>=1){
        $definicion='<p>Indica conducta retraída, cautelosa y reservada; falta de seguridad en sí mismo; tendencias a avergonzarse, tendencia a atemorizarse fácilmente, a apartarse de las circunstancias difíciles o peligrosas. Timidez, limitación o defecto del carácter que impide el desarrollo armónico del yo y que en las personas que la padecen se manifiesta por una inseguridad ante los demás, una torpeza o incapacidad para afrontar y resolver las relaciones sociales.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==95){
      //Indicadores emocionales de depresión
      if($valor>=1){
        $definicion='<p>Indica rasgos o conductas de personalidad asociadas a la tristeza, sensación de vacío, depresión, desesperanza. Cansancio y falta de energía. Baja autoestima, autocrítica o sentirse incapaz o inútil. Es importante indagar si la depresión es de tipo exógena (muerte de algún ser querido, pérdida de empleo o algún familiar, entre otros), o endógena (que la conducta o rasgo es aprendida desde el hogar).</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==96){
      //Indicadores emocionales de agresividad
      if($valor>=1){
        $definicion='<p>Indica conducta cuya finalidad es causar daño a un objeto o persona. La conducta agresiva en el sujeto puede interpretarse como manifestación de un instinto o pulsión de destrucción, como reacción que aparece ante cualquier tipo de frustración o como respuesta aprendida ante situaciones determinadas.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==97){
      //Indicadores emocionales de rasgos antisociales y delictivos
      if($valor>=1){
        $definicion='<p>Indica rasgos o conductas de personalidad que se asocian a actos criminales, delictivos o vandálicos. Este tipo de sujetos evaluados suelen tener una disminución notable en la falta de valores y de compromisos sociales, laborales e interpersonales.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==98){
      //Indicadores de posible daño o deterioro Neurológico
      if($valor>=1){
        $definicion='<p>Indica un autoconcepto bajo de inmadurez o infantilismo  con deterioro psicológico o neurológico (posibles alteraciones a nivel neurológico), en donde se puede ir considerando un problema severo de la personalidad. En este tipo de "dibujos” se recomienda que un profesional de la salud, haga otro tipo de evaluaciones confirmatorias.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    if($indicador==99){
      //Indicadores textuales conflictivos
      if($valor>=1){
        $definicion='<p>Se observan características de conflicto e inestabilidad emocional, es probable que la persona evaluada presente conductas no acordes a lo socialmente establecido.</p>';
        }else{$definicion='<p>No presenta elevaciones en esta área</p>';}
    }
    $out['definicion'] = $definicion;
    return $out;
  }
  # # # OK # # #
  public function gral_test_definicion($indicador,$valor){
    //COMPROMISO A LA ORGANIZACIÓN
    if($indicador==65){
      if($valor>=101){
        $definicion='<p>Eres dueño de esa empresa.... Son personas realmente comprometidas con la vision, tienen una gran fuerza, siendo clave para conseguir los objetivos, aumentar la productividad y hacerla sostenible.</p>';
      }elseif($valor>=76 and $valor<=100){
        $definicion='<p>Te sientes bien en esa organización... Son personas que muy probablemente se sienten bien dado que hay presencia de aspectos que generan placer y confort, pero también hay presencia de visión y fuerza  para conseguir objetivos para aumentar la productividad y hacerla sostenible siempre y cuando haya elementos que favorezcan los mismos tales como capacitación, seguimiento, actualización, entre otros.</p>'; 
      }elseif($valor>=51 and $valor<=75){
        $definicion='<p>Reevalua tu participación en esa organización: Son individuos que no se identifican con la organización y no están dispuestos a trabajar intensamente en su nombre. No se comprometen, por lo que tienen más probalidades de renunciar y aceptar otros empleos. Por no estar comprometidos requieren de más supervisión por que no conocen la importancia y el valor de integrar sus metas con las de la organización.</p>'; 
      }elseif($valor>=26 and $valor<=50){
        $definicion='<p>Estas teniendo muchas dudas: Son individuos que además de no identificarse con la organización pueden generar vicios desagradables, molestias, incomodidades,  desagrado, enojo, entre otros con sus demás compañeros y ello puede generar desgaste emocional, laboral y económico de la Organización.</p>'; 
      }elseif($valor<=25){
        $definicion='<p>Ya deja esa organización: Son individuos que definitivamente no se identifican con la organización y por lo regular son un claro vicio de la misma. Se recomienda hacer un replanteamiento laboral de estos sujetos ya que ello puede generar no nada más perdidas, sino un deterioro significativo de la organización.</p>'; 
      }
    }
    //TIPO DE CULTURA ORGANIZACIONAL
    if($indicador==66){
      if($valor>=22){
        $definicion='<p>Constructivo, humanista, flexible, y de cultura innovadora. Por lo regular se encontrará en  Negocios Imnovadores, Unidades de Investigación, Empresas de publicidad, etc.</p>
        <p>Se divide en 4 tipos:</p>
        <ol>
        <li>Cultura de academia: Cuenta con los elementos académicos para resolver problemas de manera profesional</li>
        <li>Cultura de equipo: Tiene como perfil el riesgo a la innovación, donde adopta recursos humanos talentosos y de experiencia.</li>
        <li>Cultura de experiencia: Tiene antigüedad, dando la lealtad y compromiso proveniente de una adaptación e integración a la organización, también denominada "club”.</li>
        <li>Cultura de fortaleza: Esta orientado a sobrevivir porque generalmente este tipo de personas han pasado por las 3 experiencias anteriores, ofreciendo con ello, grandes desafíos al cambio.</li>
        </ol>';
      }elseif($valor<=21){
        $definicion='<p>Formal, mecánica, orientada a las reglas. Por lo regular ésta se encuentra en grandes organizaciones y agencias gubernamentales, etc.</p>
        <p>Este tipo de cultura se divide en dos:</p>
        <ol>
        <li>Cultura fuerte: ejerce mayor influencia en las personas, logrando en ellas, dinamismo y aceptación de valores. Alimenta la participación y congruencia de la conducta. Al tener esta cultura no se necesita hacer hincapie en numerosas reglas y normas, basta con que todos los miembros compartan las normas y valores.</li>
        <li>Cultura dominante: que expresa valores centrales que comparten la gran mayoría de los miembros de la organización.</li>
        </ol>'; 
      }
    }
    //CLIMA PARA EL CAMBIO
    if($indicador==67){
      if($valor>=57){
        $definicion='<p>No es momento de hacer un cambio; analice los factores que están impidiendo llevar a cabo el cambio: capacitación, estructura, estrategia, estilos, etc.</p><p>Ya que no existe el ambiente en el cual se desempeñe un buen trabajo diariamente, no será obtenido el cambio radical en la actitud de las personas. Porque no tienen la capacidad de adaptación a las diferentes transformaciones que sufre el medio ambiente interno o externo. Y no aceptará fácilmente el conjunto de variaciones estructurales que sufre la organización, no tendrá el nuevo comportamiento deseado dentro de la misma.</p>';
      }elseif($valor>=29 and $valor<=56){
        $definicion='<p>Existe algo de turbulencia para poder efectuar el cambio; sin embargo vale la pena  esforzarse por llevarlo a cabo.</p>';
      }elseif($valor<=28){
        $definicion='<p>El evaluado está preparado para llevar a cabo el cambio de manera paulatina y bajo reserva de las demás áreas de oportunidad.</p>';
      }
    }
    //NIVEL DE ESCUCHA
    if($indicador==68){
      if($valor>=51){
        $definicion='<p>Tiene buenos hábitos para escuchar: Estas personas poseen un nivel de escucha empática, siendo esta la más recomendable. Cuando escucha a los demás es porque este tipo de personas van más allá de lo que se entiende por escucha activa, que básicamente reproduce o imita a la persona que habla, es decir, se esfuerza por ponerse en el "otro" y con ello trata de sentir incluso como se siente la otra persona con lo que esta hablando.</p>';
      }elseif($valor>=26 and $valor<=50){
        $definicion='<p>Tiene que mejorar bastante: Estas personas se encuentran en el nivel de escucha "intermedio" es decir, si lo que se requiere es aumentar la empatía con las personas deberá hacer una clara distinción entre el significado de los verbos "oír y escuchar”. Es una buena forma de empatizar con las personas en general. Lo ideal es que el evaluado interrumpa todo aquello que está haciendo para centrarse en el "otro".</p>';
      }elseif($valor<=25){
        $definicion='<p>No domina la habilidad para escuchar:  Cuando estas personas "escuchan” a veces, escuchan lo que ellos creen o generan presuposiciones basadas en su propia experiencia, lo cual genera en ocasiones una mala información de lo que realmente tenemos que escuchar. Estas personas pueden encontrarse en tres niveles de escucha: escucha ignorada, escucha fingida y escucha selectiva.</p>';
      }
    }
    $out['definicion'] = $definicion;
    return $out;
  }

}