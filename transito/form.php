<? if ($alumno) { ?>
<?
$ya_hay=mysql_query("select * from transito_datos where claveal='$claveal'");
if (mysql_num_rows($ya_hay)>0) {
	$proc=1;
	while ($ya=mysql_fetch_array($ya_hay)) {
		${$ya[2]}=$ya[3];
		//echo "${$ya[2]} => $ya[3]<br>";
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
 if (stristr($adcurr,"Len")==TRUE) {$ac1="checked";}
 if (stristr($adcurr,"Mat")==TRUE) {$ac2="checked";}
 if (stristr($adcurr,"Ing")==TRUE) {$ac3="checked";}
?>
<? 
 if ($acompanamiento) {$acomp="checked";}
 if ($exento) {$exen="checked";}
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

<legend class="muted">�MBITO ACAD�MICO</legend>

<h5 class="text-info">Cursos Repetidos</h5>
<label class="checkbox inline">
  <input type="checkbox" name="repeticion[]" value="2 " <? echo $r2;?>> 2� Curso
</label>
<label class="checkbox inline">
  <input type="checkbox" name="repeticion[]" value="4 " <? echo $r4;?>> 4� Curso
</label>
<label class="checkbox inline">
  <input type="checkbox" name="repeticion[]" value="6 " <? echo $r6;?>> 6� Curso
</label>
<hr>
<h5 class="text-info">N� de Suspensos</h5>
<label>1� Evaluaci�n</label>
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
<label>2� Evaluaci�n</label>
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
<label>3� Evaluaci�n</label>
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
<label>Matem�ticas</label>
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
<label>Ingl�s</label>
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
<label>Ed. F�sica</label>
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
<label>M�sica</label>
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
<label>Pl�stica</label>
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
  <input type="radio" name="asiste" value="2" <?echo $as2;?>> Falta m�s de lo normal
</label>
<label class="radio inline">
  <input type="radio" name="asiste" value="3" <?echo $as3;?>> Absentismo
</label>
<hr>
<h5 class="text-info">Dificultades de Aprendizaje</h5>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="1" <? echo $d1;?>> Tiene carencias en aprendizajes b�sicos: "falta de base"
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="2" <? echo $d2;?>>  Tiene dificultades en la lectura
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="3" <? echo $d3;?>>  Tiene dificultades de comprensi�n oral / escrita
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="4" <? echo $d4;?>>  Tiene dificultades de expresi�n oral / escrita
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="5" <? echo $d5;?>>  Tiene dificultades de razonamiento matem�tico
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="6" <? echo $d6;?>>  Tiene dificultades en h�bitos /  m�todo de estudio
</label><br>
<label class="checkbox">
  <input type="checkbox" name="dificultad[]" value="7" <? echo $d7;?>>  Tiene dificultades de c�lculo.
</label>
<hr>

<h5 class="text-info">Refuerzos o Adaptaciones</h5>
<h6 class="text-success">Ha tenido Refuerzo:</h6>
<label class="checkbox inline">
  <input type="checkbox" name="refuerzo[]" value="Lengua " <? echo $ref1;?>> Lengua
</label>
<label class="checkbox inline">
  <input type="checkbox" name="refuerzo[]" value="Matem�ticas " <? echo $ref2;?>> Matem�ticas
</label>
<label class="checkbox inline">
  <input type="checkbox" name="refuerzo[]" value="Ingl�s " <? echo $ref3;?>> Ingl�s
</label>
<h6 class="text-success">Necesita Refuerzo:</h6>
<p class="help-block">En caso necesario se�alar orden de preferencia del Refuerzo.</p>
<label>Lengua</label>
<select name="necreflen" class="input input-small">
<option><? echo $necreflen;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
&nbsp;&nbsp;
<label>Matem�ticas</label>
<select name="necrefmat" class="input input-small">
<option><? echo $necrefmat;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
&nbsp;&nbsp;
<label>Ingl�s</label>
<select name="necrefing" class="input input-small">
<option><? echo $necrefing;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
<h6 class="text-success">Ha tenido Adaptaci�n Curricular:</h6>
<label class="checkbox inline">
  <input type="checkbox" name="adcurr[]" value="Lengua " <? echo $ac1;?>> Lengua
</label>
<label class="checkbox inline">
  <input type="checkbox" name="adcurr[]" value="Matem�ticas " <? echo $ac2;?>> Matem�ticas
</label>
<label class="checkbox inline">
  <input type="checkbox" name="adcurr[]" value="Ingl�s " <? echo $ac3;?>> Ingl�s
</label>
<h6 class="text-success">Necesita Adaptaci�n:</h6>
<p class="help-block">En caso necesario se�alar orden de preferencia del Refuerzo.</p>
<label>Lengua</label>
<select name="necaclen" class="input input-small">
<option><? echo $necaclen;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
&nbsp;&nbsp;
<label>Matem�ticas</label>
<select name="necacmat" class="input input-small">
<option><? echo $necacmat;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
&nbsp;&nbsp;
<label>Ingl�s</label>
<select name="necacing" class="input input-small">
<option><? echo $necacing;?></option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
</select>
<h6 class="text-success">Exenci�n</h6>
<label class="checkbox inline">
  <input type="checkbox" name="exento" value="1" <? echo $exen;?>> Alumnado que por sus dificultades no se le recomienda cursar optativa
</label>
<h6 class="text-success">Programa de Acompa�amiento Escolar</h6>
<label class="checkbox inline">
  <input type="checkbox" name="acompanamiento" value="1" <? echo $acomp;?>> Se aconseja asistencia al Programa de Acompa�amiento Escolar
</label>
<hr>
<h5 class="text-info">Alumnado de otra nacionalidad</h5>
<label class="radio inline">
  <input type="radio" name="nacion" value="4" <? echo $n4;?>> No conoce el espa�ol
</label>
&nbsp;
<label class="radio inline">
  <input type="radio" name="nacion" value="1" <? echo $n1;?>> Nociones b�sicas de espa�ol
</label>
<label class="radio inline">
  <input type="radio" name="nacion" value="2" <? echo $n2;?>> Dificultades en lectura y escritura
</label>
<label class="radio inline">
  <input type="radio" name="nacion" value="3" <? echo $n3;?>> Puede seguir el Curr�culo
</label>
<hr>
<br>

<legend class="muted">�MBITO SOCIAL Y DE LA PERSONALIDAD</legend>
<h5 class="text-info">Integraci�n en el Aula</h5>
<label class="radio inline">
  <input type="radio" name="integra" value="5" <? echo $int5;?> required> L�der
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="1" <? echo $int1;?> required> Integrado
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="2" <? echo $int2;?> required> Poco integrado
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="3" <? echo $int3;?> required> Se a�sla
</label>
<label class="radio inline">
  <input type="radio" name="integra" value="4" <? echo $int4;?> required> Alumno rechazado
</label>
<hr>
<h5 class="text-info">Actitud, comportamiento, estilo de aprendizaje</h5>
<p class="help-block">Colaborador/a, Trabajador, Atento, Impulsivo.. Indicar los aspectos m�s significativos</p>
<textarea name="actitud" rows="5" class="input input-xxlarge" required><? echo $actitud;?></textarea>
<hr>
<h5 class="text-info">Lo que mejor "funciona" con el Alumno</h5>
<textarea name="funciona" rows="5" class="input input-xxlarge"><? echo $funciona;?></textarea>
<hr>
<br>

<legend class="muted">RELACI�N COLEGIO - FAMILIA</legend>
<h5 class="text-info">Tipo de relaci�n con el Colegio</h5>
<label class="radio">
  <input type="radio" name="relacion" value="3" <? echo $rel3;?> required> Colaboraci�n constante
</label>
<br>
<label class="radio">
  <input type="radio" name="relacion" value="1" <? echo $rel1;?> required> Colaboraci�n s�lo cuando el Centro la ha solicitado
</label>
<br>
<label class="radio">
  <input type="radio" name="relacion" value="2" <? echo $rel2;?> required> Demanda constante por parte de los Padres
</label>
<hr>
<h5 class="text-info">Razones para la ausencia de relaci�n con el Colegio</h5>
<p class="help-block">En caso de ausencia completa de relaci�n de los padres con el Colegio se�alar si es posible las razones de la misma.</p>
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
<h5 class="text-info">El alumno ha sido expulsado en alguna ocasi�n</h5>
<label class="radio inline">
  <input type="radio" name="expulsion" value="1" <? echo $exp1;?> required> No
</label>
<label class="radio inline">
  <input type="radio" name="expulsion" value="2" <? echo $exp2;?> required> S�
</label>
<hr>
<br>
<legend class="muted">OBSERVACIONES</legend>
<p class="help-block">Otros aspectos a rese�ar (agrupamientos, datos m�dicos, autonom�a, etc).</p>
<textarea name="observaciones" rows="10" class="input input-xxlarge"><? echo $observaciones;?></textarea>
<hr>
<input type="submit" class="btn btn-large btn-info" name="submit0" value="<? if ($proc==1) {echo "Actualizar datos";}else{echo "Enviar datos";}?>">
</form>
<? 
}
?>


