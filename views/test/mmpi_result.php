<script type="text/javascript" language="javascript" src="<?php echo AccesoDatos::ruta(); ?>assets/js/mmpi_jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo AccesoDatos::ruta(); ?>assets/js/mmpi_highcharts.js"></script>
<script type="text/javascript">
$(function () {
    var chart;
    var L=document.getElementById('1').value;
    var F=document.getElementById('2').value;
    var K=document.getElementById('3').value;
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container1',
            type: 'line',
            marginRight: 130,
            marginBottom: 25
        },
        title: {
            text: '',
            x: -20
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['L', 'F', 'K']
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
                }]
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y;
                }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -10,
            y: 100,
            borderWidth: 0
        },
        series: [{
            name: 'Resultado',
            data: [+L, +F, +K]
            },{
            name: 'Media superior',
            data: [70, 70, 70]
            },{
            name: 'Media intermedia',
            data: [50, 50, 50]
            },{
            name: 'Media inferior',
            data: [30, 30, 30]
        }]
    });
});
</script>

<script type="text/javascript">
$(function () {
    var chart;
    var HS=document.getElementById('4').value;
    var D=document.getElementById('5').value;
    var HI=document.getElementById('6').value;
    var DP=document.getElementById('7').value;
    var MF=document.getElementById('8').value;
    var PA=document.getElementById('9').value;
    var PT=document.getElementById('10').value;
    var ES=document.getElementById('11').value;
    var MA=document.getElementById('12').value;
    var LS=document.getElementById('13').value;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['HS', 'D', 'HI', 'DP', 'MF', 'PA', 'PT', 'ES', 'MA', 'LS']
            },
            yAxis: {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+ this.y;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Resultado',
                data: [+HS, +D, +HI, +DP, +MF, +PA, +PT, +ES, +MA, +LS]
                },{
                name: 'Media superior',
                data: [70, 70, 70, 70, 70, 70, 70, 70, 70, 70]
                },{
                name: 'Media intermedia',
                data: [50, 50, 50, 50, 50, 50, 50, 50, 50, 50]
                },{
                name: 'Media inferior',
                data: [30, 30, 30, 30, 30, 30, 30, 30, 30, 30]
            }]
        });
    });
});
</script>

<?php
$r12 = new Reporte();
$mmpi = $r12->res_ind($idDetalle,$list[$l]["id_prueba"]);
//print_r($mmpi);

//ESCALA DE MENTIRA
echo '<input type="hidden" id="1" name="'.$mmpi[0]["id_indicador"].'" value="'.$mmpi[0]["escala"].'"/>';
//ESCALA DE SIMULACION
echo '<input type="hidden" id="2" name="'.$mmpi[1]["id_indicador"].'" value="'.$mmpi[1]["escala"].'"/>';
//ESCALA DE CORRECCION
echo '<input type="hidden" id="3" name="'.$mmpi[2]["id_indicador"].'" value="'.$mmpi[2]["escala"].'"/>';
//ESCALA DE HIPOCONDRIA
echo '<input type="hidden" id="4" name="'.$mmpi[3]["id_indicador"].'" value="'.$mmpi[3]["escala"].'"/>';

//echo '<p><strong>'.$machover[$i]["indicador"].'</strong>: '.$machover[$i]["resultado"].'</p>';
//echo '<p><strong>Definición:</strong></p>'.$int['definicion'];
//echo '<hr>';

echo '<p><strong>'.strtoupper($mmpi[3]['descripcion']).'</strong></p>';
if($mmpi[3]['escala'] >= 75){
    echo '<p>La persona presenta muy baja comprensión de problemas psicológicos personales. Preocupación excesiva por la salud, y con ello la inmadurez para enfrentar problemas propios, tales como pesimismo, negativismo, infelicidad, insatisfacción,  dificultad para expresarse verbalmente. Sienten que están verdaderamente enfermos y buscan ayuda médica. En algunos de los casos si presentaran algún problema médico, es probable que sea una manifestación más psicológica que física en donde hay presencia de los síntomas de la enfermedad. Una de las características de estas personas es el deseo de hacer sufrir a los demás por la forma en "como están sufriendo". Puede haber  fracasado en la psicoterapia, o criticar al médico o al psicólogo por no realizar bien su Diagnóstico, entre otros.</p>';
}elseif($mmpi[3]['escala'] >= 70 and $mmpi[3]['escala'] <= 74){
    echo '<p>Tendencia a un mecanismo de defensa o de protesta hacia el medio, puesto que la soledad u otros sentimientos inaceptables se transforman en auto reproche y continuas quejas por enfermedades somáticas (corporales, orgánicas o físicas) los cuales se presentan entre otros casos, por dos principales características:
        La primera: Por el mal manejo de aspectos emocionales como el estrés o la ansiedad.
        La segunda: Cuando la persona considera la presencia de enfermedades inexistentes, a pesar de contar con resultados médicos que evidencian la ausencia de enfermedad. Es un síndrome psicológico formado  por la preocupación excesiva y angustiosa de pensar en enfermarse de “algo” y con ello tener una ganancia constructiva o destructiva,  consciente o inconsciente.</p>';
}elseif($mmpi[3]['escala'] <= 69){
    echo '<p>Persona con buen desempeño en la vida cotidiana y por ello cuentan con buen pronóstico para el manejo de su salud física.</p>';
}
//ESCALA DE DEPRESION
echo '<input type="hidden" id="5" name="'.$mmpi[4]["id_indicador"].'" value="'.$mmpi[4]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[4]['descripcion']).'</strong></p>';
if($mmpi[4]['escala'] >= 75){
    echo '<p>El evaluado presenta graves sentimientos de culpa y de auto desprecio, infelicidad, inutilidad, tristeza, excesiva preocupación. Pesimismo, negativismo, falta de interés hacia el futuro. Sentimientos de fracaso en los estudios, laborales, sociales o sentimentales. Continúas quejas de debilidad, padecimientos físicos o de cansancio. Depresión oculta manifestada por la llamada "depresión sonriente". Falta de confianza en sí mismo, se da por vencido rápidamente, evita enfrentamientos y solución de problemas, dificultad para tomar decisiones. Tendencia a la soledad y aislamiento, retraimiento, se niega a conversar de sus problemas. Llanto, irritabilidad, nerviosismo, agitación. Distanciamiento de actividades que gustaba realizar.  </p>';
}elseif($mmpi[4]['escala'] >= 70 and $mmpi[4]['escala'] <= 74){
    echo '<p>El evaluado se caracteriza por presentar pensamientos tristes o pesimistas, sentimientos de inutilidad y falta de confianza en uno mismo. Desorden emocional caracterizado por una respuesta inadaptada a los estímulos emocionales sobre todo de "alegría o emoción", de tal manera que quien la padece se muestra apático, sin ánimo y con poca iniciativa; generando alteraciones del sueño y la alimentación. </p>';
}elseif($mmpi[4]['escala'] <= 69){
    echo '<p>Presentan una proyección optimista de la vida, autoconfianza, estabilidad emocional, bajos o nulos niveles de depresión y sentimientos de culpa.</p>';
}
//ESCALA DE HISTERIA
echo '<input type="hidden" id="6" name="'.$mmpi[5]["id_indicador"].'" value="'.$mmpi[5]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[5]['descripcion']).'</strong></p>';
if($mmpi[5]['escala'] >= 75){
    echo '<p>Persona con conductas elevadas de inseguridad, inmadurez, infantilismo. Pueden ser egocéntricos y narcisistas. Tienden a inventar enfermedades de manera consciente para evadir responsabilidades, dichas enfermedades aparecen y desaparecen rápidamente. Tienden a ser manipuladores para obtener gratificaciones emocionales, atención y simpatía de acuerdo a sus intereses personales, sociales, familiares, laborales, de pareja, entre otros. Sus relaciones son superficiales e inmaduras, siente constantemente rechazo por su grupo social y suele mantenerlo con manipulaciones de todo tipo.  Le cuesta comprender los orígenes de su propio comportamiento y suele tener problemas con las figuras de autoridad.</p>';
}elseif($mmpi[5]['escala'] >= 70 and $mmpi[5]['escala'] <= 74){
    echo '<p>Persona con elevados problemas psicológicos ya que presenta conductas inadecuadas para el manejo  de las relaciones, familiares, sociales, laborales, entre otras. Presenta constantes quejas y demandas emocionales en donde no puede contener la ira o el llanto.</p>';
}elseif($mmpi[5]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad emocional para el manejo de sus relaciones interpersonales en esta área.</p>';
}
//ESCALA DE DESVIACION PSICOPATA
echo '<input type="hidden" id="7" name="'.$mmpi[6]["id_indicador"].'" value="'.$mmpi[6]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[6]['descripcion']).'</strong></p>';
if($mmpi[6]['escala'] >= 75){
    echo '<p>Persona con conductas sumamente ambiciosas, manipuladoras, rebeldes, rechazo a las normas sociales y legales. Problemas familiares y legales, inadaptación social y sexual. Impulsividad manifiesta, agresividad, sarcasmo, rencor, poco sentimiento de culpa aunque la manifiesta cuando está en problemas. Personas con tendencias delictivas como mentir, robar, estafar, abuso de alcohol u otras drogas, rebeldía hacia la autoridad. Personas narcisistas, exhibicionistas, egocéntricas y egoístas. Impaciencia y poca tolerancia a la frustración. Sujetos que delegan las responsabilidades de sus actos a otras personas (familia, amigos). Problemas de pareja. Escasa sensibilidad hacia los sentimientos ajenos. Antecedentes escolares y laborales deficientes que revelan conflicto con los compañeros. Inteligencia, seguridad e intelectualización. Individuos amistosos, amables, conversadores, aventureros. No tiene síntomas psicóticos. Incapacidad de establecer vínculos profundos o íntimos con los demás. Respuestas superficiales. Pronóstico terapéutico poco favorable, aunque acepta ir a terapia para evitarse problemas legales, pero con la intención de manipular la situación a favor</p>';
}elseif($mmpi[6]['escala'] >= 70 and $mmpi[6]['escala'] <= 74){
    echo '<p>Indica Persona que manifiesta algunas características antisociales de la personalidad, en un patrón general de desprecio y violación de los derechos de los demás, que comienza en la infancia o el principio de la adolescencia y continúa en la edad adulta. Falta de remordimiento por sus actos delictivos, búsqueda de satisfacción a largo plazo, negligencia laboral o escolar, indiferencia hacia los sentimientos ajenos, narcisismo, predisposición a la adicción de estupefacientes u otras drogas, tendencia al suicidio. Decisiones importantes tomadas al azar.</p>';
}elseif($mmpi[6]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad emocional para el manejo de lo social, ético y moralmente establecido.</p>';
}
//ESCALA DE MASCULINIDAD
echo '<input type="hidden" id="8" name="'.$mmpi[7]["id_indicador"].'" value="'.$mmpi[7]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[7]['descripcion']).'</strong></p>';
if($mmpi[7]['escala'] >= 75){
    echo '<p>Persona con elevados conflictos psicosexuales. Es muy probable que el evaluado se encuentre pasando por periodos de mucha tensión y conflicto ante la necesidad de manifestar sus deseos relacionados con el rol sexual en conflicto, es decir, la homosexualidad manifiesta o reprimida y ello genere deterioro en su rendimiento académico, laboral, familiar, de pareja, entre otros.</p>';
}elseif($mmpi[7]['escala'] >= 70 and $mmpi[7]['escala'] <= 74){
    echo '<p>Persona con algunos conflictos de tipo sexual. Es probable que el evaluado este presentando algunas dificultades en cuanto a sus deseos, preferencias, hábitos, relacionados al rol sexual, y ello le este generando algunos conflictos emocionales para el adecuado desempeño, académico, laboral, social, familiar, entre otros.</p>';
}elseif($mmpi[7]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad emocional para el manejo de sus relaciones interpersonales en esta área.</p>';
}
//ESCALA DE PARANOIA
echo '<input type="hidden" id="9" name="'.$mmpi[8]["id_indicador"].'" value="'.$mmpi[8]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[8]['descripcion']).'</strong></p>';
if($mmpi[8]['escala'] >= 75){
    echo '<p>Persona que manifiesta tendencias sumamente irracionales con relación a lo real y lo fantástico y por ello suelen ser quejumbrosos, recelosos, desconfiados, susceptibles. Hostilidad, rigidez en sus convicciones. Poca capacidad de establecer relaciones fuera del contexto familiar inclusive con el terapeuta o psicólogo. Poca capacidad de entender lo que le sucede, mucho menos delimitar lo real de lo fantasioso, con síntomas psicóticos y de pensamientos perturbados y delirantes. Usualmente son diagnosticados como esquizofrénicos o paranoicos.</p>';
}elseif($mmpi[8]['escala'] >= 70 and $mmpi[8]['escala'] <= 74){
    echo '<p>Personas que son descritas por los demás como evasivas, reservadas, desconfiadas y obstinadas con falta de interés. Insatisfechas, sensibles, egocéntricas, con convicciones rígidas, poco exitosas. Torpes descorteses, rudas. Susceptibles. Una característica especial de estos sujetos, es la sensibilidad a creer más "más allá de lo real", con tendencias a la fantasía. Dichos procesos fantásticos pueden causar inhibición en los procesos laborales, sociales, familiares, interpersonales, entre otros.</p>';
}elseif($mmpi[8]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad mental para el manejo de sus relaciones interpersonales en esta área.</p>';
}
//ESCALA DE PSICASTENIA
echo '<input type="hidden" id="10" name="'.$mmpi[9]["id_indicador"].'" value="'.$mmpi[9]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[9]['descripcion']).'</strong></p>';
if($mmpi[9]['escala'] >= 75){
    echo '<p>Persona que manifiesta tendencias sumamente irracionales con relación a lo real y lo fantástico y por ello suelen ser quejumbrosos, recelosos, desconfiados, susceptibles. Hostilidad, rigidez en sus convicciones. Poca capacidad de establecer relaciones fuera del contexto familiar inclusive con el terapeuta o psicólogo. Poca capacidad de entender lo que le sucede, mucho menos delimitar lo real de lo fantasioso, con síntomas psicóticos y de pensamientos perturbados y delirantes. Usualmente son diagnosticados como esquizofrénicos o paranoicos.</p>';
}elseif($mmpi[9]['escala'] >= 70 and $mmpi[9]['escala'] <= 74){
    echo '<p>Persona con algunas fobias y conductas obsesivas compulsivas. Las fobia es un miedo intenso y persistente a objetos o situaciones claramente discernibles y circunscritos. Las fobias agrupan todo tipo de miedos o temores sin causa aparente, ilógicos de cualquier cosa o situación, y en la mayoría de los casos con reacciones de mucha carga emocional. </p>';
}elseif($mmpi[9]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad mental para el manejo de sus relaciones interpersonales en esta área.</p>';
}
//ESCALA DE ESQUIZOFRENIA
echo '<input type="hidden" id="11" name="'.$mmpi[10]["id_indicador"].'" value="'.$mmpi[10]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[10]['descripcion']).'</strong></p>';
if($mmpi[10]['escala'] >= 75){
    echo '<p>Persona con elevaciones graves para el manejo de la realidad, es decir, pueden ya estar diagnosticadas con un trastorno psicótico. Manifiestan confusión, desorganización y desorientación. Sus objetivos son vagos, indeterminados, inalcanzables o exagerados. Evaden la realidad, refugiándose en sus sueños y fantasías, evitando de esta manera afrontar situaciones nuevas, conflictivas y/o de contacto personal. Conflictos para diferenciar la fantasía de la realidad. Pueden tener delirios y alucinaciones. Tienen poca tolerancia a la frustración, prefieren confinarse de manera creativa, imaginativa y fantasiosa. Tienen escasa capacidad de juicio. Experimentan ansiedad generalizada y una aguda agitación psicológica. Pueden manifestar haber tenido experiencias peculiares, alucinaciones, pensamientos inusuales. Manifiestan poca actividad en relaciones sociales con tendencias esquizoides. Son apáticas, impulsivas, manifiestan hostilidad, desordenadas, resentidas, incomprendidas, inadaptadas, excéntricas, nerviosas, prolijas. Algunas veces son descritas como tranquilas, amigables, generosas y románticas.</p>';
}elseif($mmpi[10]['escala'] >= 70 and $mmpi[10]['escala'] <= 74){
    echo '<p>Persona que se caracteriza por la escisión de la personalidad (personalidad dualista)  y por una ruptura de los mecanismos psíquicos normales, lo que provoca una conducta incomprensible y  poco a poco pérdida del contacto con la realidad,  por alteraciones de todas las funciones de la personalidad, más notablemente del pensamiento, la afectividad y la conducta.  </p>';
}elseif($mmpi[10]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad mental para el manejo de sus relaciones interpersonales en esta área.</p>';
}
//ESCALA DE HIPOMANIA
echo '<input type="hidden" id="12" name="'.$mmpi[11]["id_indicador"].'" value="'.$mmpi[11]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[11]['descripcion']).'</strong></p>';
if($mmpi[11]['escala'] >= 75){
    echo '<p>Persona que manifiesta megalomanía, incapacidad de reconocer limitaciones propias, alucinaciones, delirio de grandeza, labilidad emocional, fuga de ideas. Excitación, hiperactividad, irritabilidad, hostilidad injustificada e irracional, agitación, rapidez psicomotora, poca tolerancia a la frustración. Estado de ánimo elevado. Insatisfacción con periodos depresivos. Tendencia al aburrimiento ante situaciones rutinarias. Inestabilidad y preocupación exagerada. Poca capacidad de control de impulsos. Gusto por las relaciones sociales. Rebelión ante relaciones superficiales, son descritos como personas sociables, amigueras, manipuladoras y de poca confianza. </p>';
}elseif($mmpi[11]['escala'] >= 70 and $mmpi[11]['escala'] <= 74){
    echo '<p>Persona que se caracteriza por manifestar personalidad ligada a la hiperproductividad del pensamiento y la conducta, se relaciona con ideas de grandeza, actividad elevada, relaciones sociales y familiares, etc. Se observan delirios de grandeza, poder, riqueza u omnipotencia, incapacidad de reconocer limitaciones propias, alucinaciones, labilidad emocional, fuga de ideas.</p>';
}elseif($mmpi[11]['escala'] <= 69){
    echo '<p>Persona con adecuada estabilidad mental para el manejo emocional en esta área. Sujetos que valoran la posición social, económica y el reconocimiento de sí mismos. </p>';
}
//ESCALA DE INTROVERSION
echo '<input type="hidden" id="13" name="'.$mmpi[12]["id_indicador"].'" value="'.$mmpi[12]["escala"].'"/>';
echo '<p><strong>'.strtoupper($mmpi[12]['descripcion']).'</strong></p>';
if($mmpi[12]['escala'] >= 75){
    echo '<p>Persona sumamente introvertida con graves problemas para relacionarse. En la mayoría de los casos cuando se trata de integrar a grupos sociales a este tipo de personas sin un seguimiento profesional, es probable que manifiesten ansiedad y perturbación. Muestra Incomodidad ante el sexo opuesto, por tanto pueden manifestar problemas de pareja. Depresión.  Dificultad para tomar decisiones. Apatía, timidez, reflexión, inseguridad, irritabilidad, ansiedad, malhumor.</p>';
}elseif($mmpi[12]['escala'] >= 70 and $mmpi[12]['escala'] <= 74){
    echo '<p>Persona con características de la personalidad o del comportamiento "cerrada en sí misma", es decir, tiene dificultades para relacionarse socialmente y en algunos casos hasta con la familia. Son sujetos observados con problemas neuróticos, baja autoestima con "aplanamiento emocional", es decir "pareciera que no muestras emociones o sentimientos ante situaciones sociales o familiares".</p>';
}elseif($mmpi[12]['escala'] <= 69){
    echo '<p>Persona expresiva, inteligente, vigorosa, sociable, amigable, carismática, sincera en sus relaciones. Gusta de estar relacionada con mucha gente. </p>';
}
?>
<p></p>
<div id="container1"></div>
<p></p>
<div id="container2"></div>