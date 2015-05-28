<? if ($alumno) { ?>
<?
$ya_hay=mysql_query("select * from transito_datos where claveal='$claveal'");
if (mysql_num_rows($ya_hay)>0) {
	$proc=1;
	while ($ya=mysql_fetch_array($ya_hay)) {
		${$ya[2]}=$ya[3];
	}
}
?>
<? 
 if (stristr($repeticion,"2")==TRUE) {$r2="checked";}
 if (stristr($repeticion,"4")==TRUE) {$r4="checked";}
 if (stristr($repeticion,"6")==TRUE) {$r6="checked";}
 ?>
<? if ($asiste==1) {$as1="checked";}elseif ($asiste==2) {$as2="checked";}elseif ($asiste==3) {$as3="checked";}else{$asiste=="";} ?>
<? 
 if (stristr($dificultad,"1")==TRUE) {$d1="checked";}
 if (stristr($dificultad,"2")==TRUE) {$d2="checked";}
 if (stristr($dificultad,"3")==TRUE) {$d3="checked";}
 if (stristr($dificultad,"4")==TRUE) {$d4="checked";}
 if (stristr($dificultad,"5")==TRUE) {$d5="checked";}
 if (stristr($dificultad,"6")==TRUE) {$d6="checked";}
 if (stristr($dificultad,"7")==TRUE) {$d7="checked";}
?>
<? 
 if (stristr($refuerzo,"Leng")==TRUE) {$ref1="checked";}
 if (stristr($refuerzo,"Mat")==TRUE) {$ref2="checked";}
 if (stristr($refuerzo,"Ing")==TRUE) {$ref3="checked";}
?>
<? 
 if (stristr($adcurrsign,"1")==TRUE) {$acs="checked";}
 if (stristr($adcurrnosign,"1")==TRUE) {$acns="checked";}
 if (stristr($necadcurrsign,"1")==TRUE) {$nacs="checked";}
 if (stristr($necadcurrnosign,"1")==TRUE) {$nacns="checked";}
?>
<? 
 if ($acompanamiento) {$acomp="checked";}
 if ($exento) {$exen="checked";}
?>
<? 
if ($PT_AL=="SI") {$ptal1="checked";}elseif ($PT_AL=="NO") {$ptal2="checked";}
if ($PT_AL_aula=="Aula") {$ptalaula1="checked";}elseif ($PT_AL_aula=="Fuera") {$ptalaula2="checked";}
?>
<? 
 if ($atal) {$atl="checked";}
 if ($necatal) {$necatl="checked";}
?>
<? if ($nacion==1) {$n1="checked";}elseif ($nacion==2) {$n2="checked";}elseif ($nacion==3) {$n3="checked";}elseif ($nacion==4) {$n4="checked";} ?>
<? if ($integra==1) {$int1="checked";}elseif ($integra==2) {$int2="checked";}elseif ($integra==3) {$int3="checked";}elseif ($integra==4) {$int4="checked";}elseif ($integra==5) {$int5="checked";} ?>
<? if ($relacion==1) {$rel1="checked";}elseif ($relacion==2) {$rel2="checked";}elseif ($relacion==3) {$rel3="checked";}?>
<? if ($disruptivo==1) {$dis1="checked";}elseif ($disruptivo==2) {$dis2="checked";}elseif ($disruptivo==3) {$dis3="checked";}?>
<? if ($expulsion==1) {$exp1="checked";}elseif ($expulsion==2) {$exp2="checked";}?>


<form class="form-inline" method="post">
<input type="hidden" name="auth" value="1" />
<input type="hidden" name="colegi" value="<? echo $colegio;?>" />
<input type="hidden" name="unidad" value="<? echo $unidad;?>" />
<input type="hidden" name="alumno" value="<? echo $alumno;?>" />
<legend class="muted">TUTOR</legend>
<label>
  <input type="text" class="input input-xlarge" name="tutor" value="<? echo $tutor;?>" placeholder="Nombre y Apellidos del Tutor del Grupo" required>
</label>
<hr>

<legend class="muted">ÁMBITO ACADÉMICO</legend>

<h5 class="text-info">Cursos Repetidos</h5>
<label class="checkbox inline">
  <input type="checkbox" name="repeticion[]" value="2 " <? echo $r2;?>> 2º Curso
</label>
<label class="checkbox inline">
  <input type="checkbox" name="repeticion[]" value="4 " <? echo $r4;?>> 4º Curso
</label>
<label class="checkbox inline">
  <input type="checkbox" name="repeticion[]" value="6 " <? echo $r6;?>> 6º Curso
</label>
<hr>
<h5 class="text-info">Nº de Suspensos</h5>
<label>1ª Evaluación</label>
<select name="susp1" class="input input-small">
  <option><? echo $susp1;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
</select>
&nbsp;&nbsp;
<label>2ª Evaluación</label>
<select name="susp2" class="input input-small">
  <option><? echo $susp2;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
</select>
&nbsp;&nbsp;
<label>3ª Evaluación</label>
<select name="susp3" class="input input-small">
  <option><? echo $susp3;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  </select>
<hr>
<h5 class="text-info">Notas Finales</h5>
<label>Lengua</label>
<select name="leng" class="input input-mini" required>
<option><? echo $leng;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
</select>
<label>Matemáticas</label>
<select name="mat" class="input input-mini" required>
  <option><? echo $mat;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
</select>
<label>Inglés</label>
<select name="ing" class="input input-mini" required>
<option><? echo $ing;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
</select>
<label>Conocimiento</label>
<select name="con" class="input input-mini" required>
<option><? echo $con;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>8</option>
  <option>10</option>
</select>
<label>Ed. Física</label>
<select name="edfis" class="input input-mini" required>
<option><? echo $edfis;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
</select>
<label>Música</label>
<select name="mus" class="input input-mini" required>
<option><? echo $mus;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
</select>
<label>Plástica</label>
<select name="plas" class="input input-mini" required>
<option><? echo $plas;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
</select>
<hr>
<h5 class="text-info">Asistencia</h5>
<label class="radio inline">
  <input type="radio" name="asiste" value="1" <?echo $as1;?>> Presenta faltas de asistencia
</label>
<label class="radio inline">
  <input type="radio" name="asiste" value="2" <?echo $as2;?>> Falta más de lo normal
</label>
<label class="radio inline">
  <input type="radio" name="asiste" value="3" <?echo $as3;?>> Absentismo
</label>
<hr>
<h5 class="text-info">Dificultades de Aprendizaje</h5>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="1" <? echo $d1;?>> Tiene carencias en aprendizajes básicos: "falta de base"
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="2" <? echo $d2;?>>  Tiene dificultades en la lectura
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="3" <? echo $d3;?>>  Tiene dificultades de comprensión oral / escrita
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="4" <? echo $d4;?>>  Tiene dificultades de expresión oral / escrita
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="5" <? echo $d5;?>>  Tiene dificultades de razonamiento matemático
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="6" <? echo $d6;?>>  Tiene dificultades en hábitos /  método de estudio
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="7" <? echo $d7;?>>  Tiene dificultades de cálculo.
</label>
<hr>
<br>

<legend class="muted">ÁMBITO ACADÉMICO</legend>
<h5 class="text-info">Refuerzos</h5>
<h6 class="text-success">Ha tenido Refuerzo:</h6>
<label class="checkbox inline">
  <input type="checkbox" name="refuerzo[]" value="Lengua " <? echo $ref1;?>> Lengua
</label>
<label class="checkbox inline">
  <input type="checkbox" name="refuerzo[]" value="Matemáticas " <? echo $ref2;?>> Matemáticas
</label>
<label class="checkbox inline">
  <input type="checkbox" name="refuerzo[]" value="Inglés " <? echo $ref3;?>> Inglés
</label>
<h6 class="text-success">Necesita Refuerzo:</h6>
<p class="help-block">En caso necesario señalar orden de preferencia del Refuerzo.</p>
<label>Lengua</label>
<select name="necreflen" class="input input-small">
<option><? echo $necreflen;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
&nbsp;&nbsp;
<label>Matemáticas</label>
<select name="necrefmat" class="input input-small">
<option><? echo $necrefmat;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
&nbsp;&nbsp;
<label>Inglés</label>
<select name="necrefing" class="input input-small">
<option><? echo $necrefing;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>

<h6 class="text-success">Exención</h6>
<label class="checkbox inline">
  <input type="checkbox" name="exento" value="1" <? echo $exen;?>> Alumnado que por sus dificultades no se le recomienda cursar optativa
</label>

<h6 class="text-success">Programa de Acompañamiento Escolar</h6>
<label class="checkbox inline">
  <input type="checkbox" name="acompanamiento" value="1" <? echo $acomp;?>> Se aconseja asistencia al Programa de Acompañamiento Escolar
</label>
<hr>

<h5 class="text-info">Medidas de Atención a la Diversidad</h5>
<h6 class="text-success">Ha tenido Adaptación Curricular:</h6>
<label>Areas cursadas en la Adaptación Curricular Significativa
  <input type="text" class="input input-xlarge" name="areasadcurrsign" value="<? echo $areasadcurrsign;?>">
</label>
<br>
<label>Areas cursadas en la Adaptación Curricular No Significativa
  <input type="text" class="input input-xlarge" name="areasadcurrnosign" value="<? echo $areasadcurrnosign;?>" >
</label>
<h6 class="text-success">Necesita Adaptación Curricular:</h6>
<label>Areas cursadas en la Adaptación Curricular Significativa
  <input type="text" class="input input-xlarge" name="necareasadcurrsign" value="<? echo $necareasadcurrsign;?>">
</label>
<br>
<label>Areas cursadas en la Adaptación Curricular No Significativa
  <input type="text" class="input input-xlarge" name="necareasadcurrnosign" value="<? echo $necareasadcurrnosign;?>" >
</label>

<h6 class="text-success">¿Ha sido atendido por PT o AL?</h6>
<label class="radio inline">
  <input type="radio" name="PT_AL" value="SI" <? echo $ptal1;?>> Sí
</label>
&nbsp;
<label class="radio inline">
  <input type="radio" name="PT_AL" value="NO" <? echo $ptal2;?>> No
</label>
<br>
<label class="radio inline">
  <input type="radio" name="PT_AL_aula" value="Aula" <? echo $ptalaula1;?>> Dentro del Aula
</label>
&nbsp;
<label class="radio inline">
  <input type="radio" name="PT_AL_aula" value="Fuera" <? echo $ptalaula2;?>> Fuera del Aula
</label>
<hr>

<h5 class="text-info">Alumnado de otra nacionalidad</h5>
<label class="radio inline">
  <input type="radio" name="nacion" value="4" <? echo $n4;?>> No conoce el español
</label>
&nbsp;
<label class="radio inline">
  <input type="radio" name="nacion" value="1" <? echo $n1;?>> Nociones básicas de español
</label>
<label class="radio inline">
  <input type="radio" name="nacion" value="2" <? echo $n2;?>> Dificultades en lectura y escritura
</label>
<label class="radio inline">
  <input type="radio" name="nacion" value="3" <? echo $n3;?>> Puede seguir el Currículo
</label>
<br>
<br>
<label class="checkbox">
  <input type="checkbox" name="atal" value="SI" <? echo $atl;?>> Ha sido atendido en el aula de ATAL
</label>
<br>
<label class="checkbox">
  <input type="checkbox" name="necatal" value="SI" <? echo $necatl;?>> Necesita asistir al aula de ATAL
</label>
<hr>
<br>

<legend class="muted">ÁMBITO SOCIAL Y DE LA PERSONALIDAD</legend>
<h5 class="text-info">Integración en el Aula</h5>
<label class="radio inline">
  <input type="radio" name="integra" value="5" <? echo $int5;?> required> Líder
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="1" <? echo $int1;?> required> Integrado
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="2" <? echo $int2;?> required> Poco integrado
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="3" <? echo $int3;?> required> Se aísla
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="4" <? echo $int4;?> required> Alumno rechazado
</label>
<hr>
<h5 class="text-info">Actitud, comportamiento, estilo de aprendizaje</h5>
<p class="help-block">Colaborador/a, Trabajador, Atento, Impulsivo.. Indicar los aspectos más significativos</p>
<textarea name="actitud" rows="5" class="input input-xxlarge" required><? echo $actitud;?></textarea>
<hr>
<h5 class="text-info">Lo que mejor "funciona" con el Alumno</h5>
<textarea name="funciona" rows="5" class="input input-xxlarge"><? echo $funciona;?></textarea>
<hr>
<br>

<legend class="muted">RELACIÓN COLEGIO - FAMILIA</legend>
<h5 class="text-info">Tipo de relación con el Colegio</h5>
<label class="radio">
  <input type="radio" name="relacion" value="3" <? echo $rel3;?> required> Colaboración constante
</label>
<br>
<label class="radio">
  <input type="radio" name="relacion" value="1" <? echo $rel1;?> required> Colaboración sólo cuando el Centro la ha solicitado
</label>
<br>
<label class="radio">
  <input type="radio" name="relacion" value="2" <? echo $rel2;?> required> Demanda constante por parte de los Padres
</label>
<hr>
<h5 class="text-info">Razones para la ausencia de relación con el Colegio</h5>
<p class="help-block">En caso de ausencia completa de relación de los padres con el Colegio señalar si es posible las razones de la misma.</p>
<textarea name="norelacion" rows="3" class="input input-xxlarge"><? echo $norelacion;?></textarea>
<hr>
<br>

<legend class="muted">DISCIPLINA</legend>
<h5 class="text-info">Comportaiento disruptivo</h5>
<label class="radio inline">
  <input type="radio" name="disruptivo" value="3" <? echo $dis3;?> required> Nunca
</label>
<label class="radio inline">
  <input type="radio" name="disruptivo" value="1" <? echo $dis1;?> required> Ocasionalmente
</label>
<label class="radio inline">
  <input type="radio" name="disruptivo" value="2" <? echo $dis2;?> required> Alumno disruptivo
</label>
<hr>
<h5 class="text-info">El alumno ha sido expulsado en alguna ocasión</h5>
<label class="radio inline">
  <input type="radio" name="expulsion" value="1" <? echo $exp1;?> required> No
</label>
<label class="radio inline">
  <input type="radio" name="expulsion" value="2" <? echo $exp2;?> required> Sí
</label>
<hr>
<br>
<legend class="muted">OBSERVACIONES</legend>
<p class="help-block">Otros aspectos a reseñar (agrupamientos, datos médicos, autonomía, etc).</p>
<textarea name="observaciones" rows="10" class="input input-xxlarge"><? echo $observaciones;?></textarea>
<hr>
<input type="submit" class="btn btn-large btn-info hidden-print" name="submit0" value="<? if ($proc==1) {echo "Actualizar datos";}else{echo "Enviar datos";}?>">
</form>
<? 
}
?>


