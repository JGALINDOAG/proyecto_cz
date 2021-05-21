<style type="text/css">
.texto
{
	font-family:Tahoma;
	font-size:11px;
	color:#616161;
	text-align:justify;
	font-weight:bold;
}
.textoC
{
	font-family:Tahoma;
	font-size:15px;
	color:#616161;
	text-align:center;
	font-weight:bold;
}
.textoCh
{
	font-family:Tahoma;
	font-size:11px;
	color:#616161;
	text-align:center;
	font-weight:bold;
	line-height:11px;
}
.textoVerdeC
{
	font-family:Tahoma; 
	font-size:13px;
	color:#768F3E;
	text-align:center;
	font-weight:bold;	
}
.textoAzulC
{
	font-family:Tahoma;
	font-size:13px;
	color:#5593ca;
	text-align:center;
	font-weight:bold;
}
.OVN
{
	font-family:Tahoma;
	font-size:9px;
	color:#000000;
	text-align:center;
	font-weight:bold;
}
.OV
{
	font-family:Tahoma;
	font-size:8px;
	color:#616161;
	text-align:center;
	font-weight:bold;
	line-height:11px;
}
.textoRojoC
{
	font-family:Tahoma; 
	font-size:10px;
	color:#F00;
	font-weight:bold;
	text-align:center;
	margin-bottom:5px;
}
table.tablaov1{
	border:3px solid #36638A;
	-webkit-border-radius:13px;
	-moz-border-radius:13px;
	-ms-border-radius:13px;
	-o-border-radius:13px;
	border-radius:13px;
}
</style>
<hr><center><h5>ORIENTACI&Oacute;N VOCACIONAL O PROFESIONAL/LABORAL</h5></center>
<table border="0" width="100%" align="center" class="tablaov1 OV">
<tr>
    <td colspan="2" width="100"> </td>
    <td colspan="10"><div class="textoAzulC">I   N   T   E   R   E   S   E   S</div></td>
</tr>
<tr>
    <td colspan="2" width="100"> </td>
    <td class="OVN"><?php echo strtoupper($intereses[0]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[0]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[1]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[1]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[2]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[2]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[3]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[3]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[4]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[4]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[5]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[5]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[6]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[6]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[7]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[7]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[8]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[8]['resultado'], '1', 0); ?></div></td>
    <td class="OVN"><?php echo strtoupper($intereses[9]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($intereses[9]['resultado'], '1', 0); ?></div></td>
</tr>
<tr>
    <td rowspan="10"><div class="textoAzulC">A<br /><br />P<br /><br />T<br /><br />I<br /><br />T<br /><br />U<br /><br />D<br /><br />E<br /><br />S</div></td>
    <td class="OVN"><?php echo strtoupper($aptitudes[0]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[0]['resultado'], '1', 0); ?></div></td>
    <td>Trab. Social <br />Enfermería <br />Pedagogía</td>
    <td>Comunicación <br />Comercialización <br />Derecho</td>
    <td>Periodismo <br />Filosofía <br />Derecho</td>
    <td>Profesor de arte <br />Diseñador</td>
    <td>Profesor de <br />música</td>
    <td>Administración <br />Comercialización</td>
    <td>Medicina <br />Biotecnología <br />Psicología <br />Nutrición</td>
    <td>Economía <br />Comercio <br />Administración</td>
    <td>Profesor de <br />materias <br />técnicas</td>
    <td>Trab. Social <br />Biotecnología <br />Prof. Educación <br />Física</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[1]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[1]['resultado'], '1', 0); ?></div></td>
    <td>Comunicación <br />Comercialización <br />Derecho</td>
    <td>Comunicación <br />Derecho <br />Consejero</td>
    <td>Derecho <br />Periodismo <br />Educación <br />Escritor</td>
    <td>Publicidad <br />Artes gráficas <br />Diseño</td>
    <td>Arte escénico <br />Música</td>
    <td>Administración <br />Comercialización <br />Pedagogía</td>
    <td>Ing. Industrial <br />Profesor de <br />Ciencias</td>
    <td>Economía <br />Administración <br />Comercialización</td>
    <td>Ing. Industrial <br />Comercio</td>
    <td>Comunicación <br />social</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[2]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[2]['resultado'], '1', 0); ?></div></td>
    <td>Periodismo <br />Filosofía <br />Derecho</td>
    <td>Derecho <br />Periodismo <br />Educación <br />Escritor</td>
    <td>Periodismo <br />Educación <br />Sociología</td>
    <td>Actuación <br />Escritor <br />Periodismo</td>
    <td>Actuación <br />Profesor de <br />música</td>
    <td>Biblioteconomía <br />Secretariado</td>
    <td>Medicina <br />Pedagogía <br />Psicología</td>
    <td>Contabilidad <br />Profesor de <br />Computación</td>
    <td>Profesor de <br />Arquitectura o <br />Ingeniería</td>
    <td>Periodismo <br />Cronista <br />Historia</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[3]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[3]['resultado'], '1', 0); ?></div></td>
    <td>Profesor de arte <br />Diseñador</td>
    <td>Publicidad <br />Artes gráficas <br />Diseño</td>
    <td>Actuación <br />Escritor <br />Periodismo</td>
    <td>Artes plásticas <br />Diseño</td>
    <td>Compositor <br />musical</td>
    <td>Administración en <br />eventos <br />culturales y <br />recreativos</td>
    <td>Odontología <br />Cirugía <br />Arquitectura</td>
    <td>Diseño <br />Arquitectura</td>
    <td>Ing. Civil <br />Arquitectura</td>
    <td>Diseño urbano <br />Artista plástico</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[4]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[4]['resultado'], '1', 0); ?></div></td>
    <td>Profesor de <br />música</td>
    <td>Arte escénico <br />Música</td>
    <td>Actuación <br />Profesor de <br />música</td>
    <td>Compositor <br />musical</td>
    <td>Música <br />Dirección de <br />orquesta</td>
    <td>Dirección de <br />orquesta <br />Representante <br />musical</td>
    <td>Ing. De sonido <br />Reparación de <br />equipos <br />musicales</td>
    <td>Producción <br />musical</td>
    <td>Ing de sonido <br />Técnico En <br />reparación de <br />equipo musical</td>
    <td>Música</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[5]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[5]['resultado'], '1', 0); ?></div></td>
    <td>Administración <br />Comercialización</td>
    <td>Administración <br />Comercialización <br />Pedagogía</td>
    <td>Biblioteconomía <br />Secretaríado</td>
    <td>Administración <br />en eventos <br />culturales y <br />recreativos</td>
    <td>Dirección de <br />orquesta <br />Representante <br />músical</td>
    <td>Administración <br />Comercialización <br />Estadística <br />Economía</td>
    <td>Ing. Sistemas <br />Informática <br />Matemáticas</td>
    <td>Estadística <br />Contabilidad <br />Biblioteconomía</td>
    <td>Ing. Industrial <br />Informática <br />Procesos de <br />producción</td>
    <td>Ing. Civil <br />Ing. petroquímica</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[6]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[6]['resultado'], '1', 0); ?></div></td>
    <td>Medicina <br />Biotecnología <br />Psicología <br />Nutrición</td>
    <td>Ing. Industrial <br />Prof. Ciencias</td>
    <td>Medicina <br />Pedagogía <br />Psicología</td>
    <td>Odontología <br />Cirugía <br />Arquitectura</td>
    <td>Ing. De sonido <br />Reparación de <br />equipos <br />musicales</td>
    <td>Ing. Sistemas <br />Informática <br />Matemáticas</td>
    <td>Física <br />Matemáticas <br />Astronomía <br />Biología</td>
    <td>Actuaría <br />Química <br />Estadística <br />Sistemas</td>
    <td>Ing. Civil <br />Ing. En minas <br />Ing. electricista</td>
    <td>Veterinaria <br />Biólogos <br />Agronomos <br />Arqueólogos</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[7]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[7]['resultado'], '1', 0); ?></div></td>
    <td>Economía <br />Comercio <br />Administración</td>
    <td>Economía <br />Administración <br />Comercialización</td>
    <td>Contabilidad <br />Profesor de <br />Computación</td>
    <td>Diseño <br />Arquitectura</td>
    <td>Producción <br />musical</td>
    <td>Estadística <br />Contabilidad <br />Biblioteconomía</td>
    <td>Actuaría <br />Química <br />Estadística <br />Sistemas</td>
    <td>Programación <br />Contador <br />Computación <br />Mercadotecnia</td>
    <td>Ing. Civil <br />Ing. Mecánico <br />Electrónica</td>
    <td>Ing. Agrónomo <br />Biotecnología <br />Veterinaria</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[8]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[8]['resultado'], '1', 0); ?></div></td>
    <td>Profesor de <br />materias <br />técnicas</td>
    <td>Ing. Industrial <br />Comercio</td>
    <td>Profesor de <br />arquitectura o <br />ingeniería</td>
    <td>Ing. Civil <br />Arquitectura</td>
    <td>Ing de sonido <br />Técnico en <br />reparación de <br />equipo musical</td>
    <td>Ing. Industrial <br />Informática <br />Procesos de <br />producción</td>
    <td>Ing. Civil <br />Ing. En minas <br />Ing. electricista</td>
    <td>Ing. Civil <br />Ing. Mecánico <br />Electrónica</td>
    <td>Procesos de <br />producción <br />Mantenimiento <br />Industrial</td>
    <td>Ing. Civil <br />Mecánica <br />Topología</td>
</tr>
<tr>
    <td class="OVN"><?php echo strtoupper($aptitudes[9]['indicador']); ?><div class="textoRojoC"><?php echo bcdiv($aptitudes[9]['resultado'], '1', 0); ?></div></td>
    <td>Trab. Social <br />Biotecnología <br />Prof. Educación <br />Física</td>
    <td>Comunicación <br />social</td>
    <td>Periodismo <br />Cronista <br />Historia</td>
    <td>Diseño urbano <br />Artista plástico</td>
    <td>Música</td>
    <td>Ing. Civil <br />Ing. petroquímica</td>
    <td>Veterinaria <br />Biólogos <br />Agrónomos <br />Arqueólogos</td>
    <td>Ing. Agrónomo <br />Biotecnología <br />Veterinaria</td>
    <td>Ing. Civil <br />Mecánica <br />Topología</td>
    <td>Ecología <br />Agronomía <br />Topografía</td>
</tr>
</table><br>
<p>En esta etapa de tu vida, estás a punto de tomar una decisión crucial para tu futuro; ya que el desarrollo pleno de tus capacidades intelectuales depende de que tan acertada sea tu decisión a la hora de elegir profesión. Por lo que, te sugerimos tomar en cuenta las siguientes recomendaciones:</p>
<ul type="disc">
    <li>Elige la carrera que te guste, te agrade, te apasione; nunca elijas una carrera porque es la que está de moda, es la que escogieron tus amigos, es en la que se gana más dinero – según dicen, etc.
    <li>Investiga y revisa el mapa curricular de la carrera que quieres estudiar;  esta tarea te ayudará a comprender qué es lo que se hace en dicha opción.
    <li>Platica con personas que estudiaron o están estudiando la carrera que te interesa, ellos te  pueden orientar acerca de en qué puedes trabajar una vez que terminaste la carrera.
</ul>
<p>La finalidad del "test vocacional" que acabas de realizar, es el de orientarte acerca de qué carrera se ajusta mejor a tus expectativas personales; por lo que, te pedimos atiendas a las siguientes indicaciones:</p>
<ol>
    <li>Para interpretar los resultados de orientación vocacional o  profesional antes descritos en la parte de arriba es importante localices el puntaje más  elevado en la línea de intereses.</li>
    <p>Ejemplo:</p>
    <table width="60%" border="0" align="center" class="tablaov1 OV">
        <tr>
            <td></td>
            <td colspan="4"><div class="textoAzulC">I   N   T   E   R   E   S   E   S</div></td>
        </tr>
        <tr>
            <td rowspan="4"><div class="textoAzulC">A<br /><br />P<br /><br />T<br /><br />I<br /><br />T<br /><br />U<br /><br />D<br /><br />E<br /><br />S</div></td>
            <td class="OVN"> </td>
            <td class="OVN" >SOCIAL<div class="textoRojoC">42</div></td>
            <td class="OVN">PERSUASIVO<div class="textoRojoC">25</div></td>
            <td class="OVN" bgcolor="#999999">VERBAL<div class="textoRojoC" >75</div></td>
        </tr>
        <tr>
            <td height="50" class="OVN">SOCIAL<div class="textoRojoC">50</div></td>
            <td>Trabajo social <br />Enfermería <br />Pedagogía</td>
            <td>Comunicación <br />Comercialización <br />Derecho</td>
            <td>Periodismo <br />Filosofía <br />Derecho</td>
        </tr>
        <tr>
            <td height="50" class="OVN">PERSUASIVO<div class="textoRojoC">75</div></td>
            <td>Comunicación <br />Comercialización <br />Derecho</td>
            <td>Comunicación <br />Derecho <br />Consejero</td>
            <td>Derecho <br />Periodismo <br />Educación</td>
        </tr>
        <tr>
            <td class="OVN">VERBAL<div class="textoRojoC">17</div></td>
            <td>Comunicación <br />Comercialización <br />Derecho</td>
            <td>Derecho <br />Periodismo <br />Educación</td>
            <td>Periodismo <br />Educación <br />Sociología</td>
        </tr>
    </table><br>
    <li>Una vez ubicados los resultados de intereses procede a  realizar lo mismo en la línea de aptitudes.</li>
    <p>Ejemplo:</p>
    <table width="60%" border="0" align="center" class="tablaov1 OV">
        <tr>
            <td></td>
            <td colspan="4"><div class="textoAzulC">I   N   T   E   R   E   S   E   S</div></td>
        </tr>
        <tr>
            <td rowspan="4"><div class="textoAzulC">A<br /><br />P<br /><br />T<br /><br />I<br /><br />T<br /><br />U<br /><br />D<br /><br />E<br /><br />S</div></td>
            <td class="OVN"> </td>
            <td class="OVN">SOCIAL<div class="textoRojoC">42</div></td>
            <td class="OVN">PERSUASIVO<div class="textoRojoC">25</div></td>
            <td class="OVN">VERBAL<div class="textoRojoC">75</div></td>
        </tr>
        <tr>
            <td height="50" class="OVN">SOCIAL<div class="textoRojoC">50</div></td>
            <td>Trabajo social <br />Enfermería <br />Pedagogía</td>
            <td>Comunicación <br />Comercialización <br />Derecho</td>
            <td>Periodismo <br />Filosofía <br />Derecho</td>
        </tr>
        <tr>
            <td height="50" class="OVN" bgcolor="#999999">PERSUASIVO<div class="textoRojoC">75</div></td>
            <td>Comunicación <br />Comercialización <br />Derecho</td>
            <td>Comunicación <br />Derecho <br />Consejero</td>
            <td>Derecho <br />Periodismo <br />Educación</td>
        </tr>
        <tr>
            <td class="OVN">VERBAL<div class="textoRojoC">17</div></td>
            <td>Comunicación <br />Comercialización <br />Derecho</td>
            <td>Derecho <br />Periodismo <br />Educación</td>
            <td>Periodismo <br />Educación <br />Sociología</td>
        </tr>
    </table><br>
    <li>Finalmente puedes trazar una línea sobre la columna y la fila entre  los puntajes más altos, donde crucen ambas líneas encierra el cuadro en un  círculo o coloréalo; ahí encontrarás las opciones que se ajustan a tus  alternativas profesionales o vocacionales.</li>
    <p>Ejemplo:</p>
    <table width="60%" border="0" align="center" class="tablaov1 OV">
    <tr>
        <td> </td>
        <td colspan="4"><div class="textoAzulC">I   N   T   E   R   E   S   E   S</div></td>
    </tr>
    <tr>
        <td rowspan="4"><div class="textoAzulC">A<br /><br />P<br /><br />T<br /><br />I<br /><br />T<br /><br />U<br /><br />D<br /><br />E<br /><br />S</div></td>
        <td class="OVN"> </td>
        <td class="OVN">SOCIAL<div class="textoRojoC">42</div></td>
        <td class="OVN">PERSUASIVO<div class="textoRojoC">25</div></td>
        <td class="OVN" bgcolor="#999999">VERBAL<div class="textoRojoC">75</div></td>
    </tr>
    <tr>
        <td height="50" class="OVN">SOCIAL<div class="textoRojoC">50</div></td>
        <td>Trabajo social <br />Enfermería <br />Pedagogía</td>
        <td>Comunicación <br />Comercialización <br />Derecho</td>
        <td bgcolor="#999999">Periodismo <br />Filosofía <br />Derecho</td>
    </tr>
    <tr>
        <td height="50" class="OVN" bgcolor="#999999">PERSUASIVO<div class="textoRojoC">75</div></td>
        <td bgcolor="#999999">Comunicación <br />Comercialización <br />Derecho</td>
        <td bgcolor="#999999">Comunicación <br />Derecho <br />Consejero</td>
        <td bgcolor="#3399FF">Derecho <br />Periodismo <br />Educación</td>
    </tr>
    <tr>
        <td class="OVN">VERBAL<div class="textoRojoC">17</div></td>
        <td>Comunicación <br />Comercialización <br />Derecho</td>
        <td>Derecho <br />Periodismo <br />Educación</td>
        <td>Periodismo <br />Educación <br />Sociología</td>
    </tr>
    </table><br>
    <table width="60%" border="0" align="center" class="tablaov1 texto">
        <tr>
        <td colspan="2"><div class="textoAzulC">PONDERACIONES DEL TEST DE ORIENTACIÓN VOCACIONAL</div>
            Es preponderante considerar que en cada una de las elevaciones (Intereses y Aptitudes) de manera general, se pueda establecer  como “la fuerza de sus deseos” en estudiar alguna carrera profesional, de acuerdo a la siguiente ponderación: </td>
        </tr>
        <tr>
        <td width="17%" class="textoVerdeC">De 75 a 100</td>
        <td width="83%">Intereses y aptitudes  Profesionales: <br />
            El evaluado se encuentra bien definido en cuanto a sus intereses vocacionales y profesionales. </td>
        </tr>
        <tr>
        <td class="textoVerdeC">De 50 a 74</td>
        <td>Intereses y aptitudes Sub-profesionales: <br />
            El evaluado esta regularmente decidido en sus intereses vocacionales y profesionales. Es muy probable que haya duda, sin embargo,  con una adecuada orientación vocacional y seguimiento con algún experto, el evaluado puede tener una mejor toma de decisiones. </td>
        </tr>
        <tr>
        <td class="textoVerdeC">De 25 a 49</td>
        <td>Intereses y aptitudes comunes: <br />
            El evaluado necesita el apoyo de un experto en motivación y de orientación vocacional para decidir y estructurar proyecto de vida. </td>
        </tr>
        <tr>
        <td class="textoVerdeC">De 0 a 24</td>
        <td>Falta de motivación: <br />
            El evaluado muy probablemente carece de elementos emocionales para establecer o definir alguna expectativa personal, profesional o vocacional. Es muy recomendable que en estos casos el evaluado asista y reciba el apoyo de un profesional en la materia. </td>
        </tr>
    </table><br>
</ol>