<? include_once("../conf_principal.php");?>
<?  include("../cabecera.php"); ?>
<? include("../funciones.php");
//variables();
?>
<div class="span8 offset2"><br>
<h3 align="center"><i class='icon icon-folder-open'> </i> Informe de
Tránsito para Alumnos de Primaria.</h3>
<?
// Se ha enviado la clave
$clave = $_POST['clave'];
$cole = $_POST['user'];
$colegi = $_POST['colegi'];
$unidad = $_POST['unidad'];
if (isset($_POST['alumno'])) {
	$alumno = $_POST['alumno'];
	$tr_al = explode(":",$_POST['alumno']);
	$claveal = $tr_al[0];
	$nombre_al = $tr_al[1];
}

$auth = $_POST['auth'];
mysql_connect ($host, $user, $pass);
mysql_select_db ($db);
$cod_sha = sha1($clave);

// Inserción de datos
if ($_POST['submit0']=="Actualizar datos") {
	mysql_query("delete from transito_datos where claveal='$claveal'");
	foreach ($_POST as $clave=>$valor){
		if ($clave!=="auth" and $clave!=="colegi" and $clave!=="unidad" and $clave!=="alumno" and $clave!=="submit0") {
			if (is_array($valor)) {
				$valo="";
				foreach ($valor as $key=>$val){
					$valo.=$val;
					}
					$valor=$valo;
			}
			mysql_query("insert into transito_datos values ('','$claveal','$clave','$valor')");
		}
	}
	echo '<br /><div class="alert alert-success alert-block fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
Los datos se han actualizado correctamente.
</div>';
}
elseif ($_POST['submit0']=="Enviar datos") {
	foreach ($_POST as $clave=>$valor){
		if ($clave!=="auth" and $clave!=="colegi" and $clave!=="unidad" and $clave!=="alumno" and $clave!=="submit0") {
			if (is_array($valor)) {
				$valo="";
				foreach ($valor as $key=>$val){
					$valo.=$val;
					}
					$valor=$valo;
			}
			mysql_query("insert into transito_datos values ('','$claveal','$clave','$valor')");
		}
	}
	echo '<br /><div class="alert alert-success alert-block fade in">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
Los datos se han guardado correctamente. Si necesitas cambiarlos, vuelve a seleccionar al alumno y modíficalos a tu gusto.
</div>';
}
// Control de entrada
$c_prim = mysql_query("SELECT * from transito_control WHERE transito_control.colegio = '$cole' and transito_control.pass = '$cod_sha'");
$num_cole=mysql_num_rows($c_prim);

// Contraseña coincide: podemos entrar
if ($num_cole>0 or $auth=="1") {
	if (isset($cole)){$colegio=$cole;}else{$colegio=$colegi;}
	?>
<div class="hidden-print" align="center">
<form class="form-inline" method="post"><input type="hidden" name="auth"
	value="1" /> <input type="hidden" name="colegi"
	value="<? echo $colegio;?>" /> <label for="unidad">
<h2 align="left"><small>Selecciona Grupo </h2>
</small></label> <select id="unidad" name="unidad" class="input-large"
	onchange="submit()" />
<option><? echo $unidad;?></option>
	<?
	$al_primaria = "SELECT distinct unidad FROM alma_primaria where colegio = 'C.E.I.P. $colegio' order by unidad";
	$alum_primaria = mysql_query($al_primaria);
	while ($cole=mysql_fetch_array($alum_primaria)) {
		echo "<option>$cole[0]</option>";
	}
	?> </select> &nbsp;&nbsp;&nbsp;&nbsp; <label for="alumno">
<h2 align="left"><small>Selecciona Alumno </h2>
</small></label> <select id="alumno" name="alumno" class="input-xlarge"
	onchange="submit()" />
<option vlaue="<? echo "$claveal:$nombre_al";?>"><? echo $nombre_al;?></option>
	<?
	$al = "SELECT distinct claveal, apellidos, nombre FROM alma_primaria where colegio = 'C.E.I.P. $colegio' and unidad = '$unidad' order by apellidos, nombre";
	$alum = mysql_query($al);
	while ($alumn=mysql_fetch_array($alum)) {
		echo "<option value='$alumn[0]:$alumn[1], $alumn[2]'>$alumn[1], $alumn[2]</option>";
	}
	?> </select>
	</form>
</div>

	<?
	$result = mysql_query("select distinct alma_primaria.claveal, alma_primaria.DNI, alma_primaria.fecha, alma_primaria.domicilio, alma_primaria.telefono, alma_primaria.padre, alma_primaria.matriculas, telefonourgencia, paisnacimiento, correo, nacionalidad, edad, curso, alma_primaria.unidad, numeroexpediente, apellidos, nombre from alma_primaria where alma_primaria.claveal= '$claveal' order BY alma_primaria.apellidos");
	if ($row = mysql_fetch_array($result)):
	$nombre_alumn = $row['nombre']." ". $row['apellidos'];
	?>
<div class="row well">
<div align="center">
<p class="lead muted">C.E.I.P. <? echo $colegi;?></p>
<h4>Expediente académico del alumno/a <small> Curso académico: <? echo $curso_actual?></small></h4>
<legend class="text-error"><?php echo $nombre_alumn; ?> </legend></div>
<div class="span5 offset1">

<dl class="dl-horizontal">
	<dt>DNI / Pasaporte</dt>
	<dd><?php echo ($row['DNI'] != "") ? $row['DNI']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Fecha de nacimiento</dt>
	<dd><?php echo ($row['fecha'] != "") ? $row['fecha']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Edad</dt>
	<dd><?php echo ($row['edad'] != "") ? $row['edad'].' años': '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Domicilio</dt>
	<dd><?php echo ($row['domicilio'] != "") ? $row['domicilio']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Nacionalidad</dt>
	<dd><?php echo ($row['nacionalidad'] != "") ? $row['nacionalidad']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Teléfono</dt>
	<dd><?php echo ($row['telefono'] != "") ? '<a href="tel:'.$row['telefono'].'">'.$row['telefono'].'</a>': '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Teléfono urgencias</dt>
	<dd><?php echo ($row['telefonourgencia'] != "") ? '<a href="tel:'.$row['telefonourgencia'].'">'.$row['telefonourgencia'].'</a>': '<span class="text-muted">Sin registrar</span>'; ?></dd>
</dl>

</div>

<div class="span5">
<dl class="dl-horizontal">
	<dt><abbr data-bs="tooltip" title="Número de Identificación Escolar">N.I.E.</abbr></dt>
	<dd><?php echo ($row['claveal'] != "") ? $row['claveal']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Nº Expediente</dt>
	<dd><?php echo ($row['numeroexpediente'] != "") ? $row['numeroexpediente']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Curso</dt>
	<dd><?php echo ($row['curso'] != "") ? $row['curso']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Unidad</dt>
	<dd><?php echo ($row['unidad'] != "") ? $row['unidad']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Repetidor/a</dt>
	<dd><?php echo ($row['matriculas'] > 1) ? 'Sí': 'No'; ?></dd>
	<dt>Representante legal</dt>
	<dd><?php echo ($row['padre'] != "") ? $row['padre']: '<span class="text-muted">Sin registrar</span>'; ?></dd>
	<dt>Correo electrónico</dt>
	<dd><?php echo ($row['correo'] != "") ? '<a href="mailto:'.$row['correo'].'">'.$row['correo'].'</a>' : '<span class="text-muted">Sin registrar</span>'; ?></dd>
</dl>

</div>
</div>
	<?
	endif;
}

else  {
	echo '<div class="span8 offset2">
<div align="center">
<hr />';
	echo "<br /><div class='alert alert-error' style='max-width:450px;margin:auto'><legend>Atenci&oacute;n:</legend><p>Debes introducir una <b>Clave del Centro</b> válida para entrar en estas páginas. Si eres alumno de este Centro, <em>debes conseguir tu clave de acceso a través del Tutor, Administración o Jefatura de Estudios del Centro</em> para poder entrar en estas páginas</p></div>";
	exit;
}

?> <br />
<?
if (isset($claveal)) {
	include 'form.php';
}
?></div>

<? include("../pie.php"); ?>


