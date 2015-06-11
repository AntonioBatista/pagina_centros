<?
session_start();
if($_SESSION['aut']<>1)
{
	header("location:http://iesmonterroso.org");
	exit();
}

$claveal = $_SESSION['clave_al'];
if (isset($_POST['curso'])) {
	$curso = $_POST['curso'];
}

include("../conf_principal.php");
include("../funciones.php");
$connection = mysql_connect($host,$user,$pass) or die ("Imposible conectar con la Base de datos");
mysql_select_db($db) or die ("Imposible seleccionar base de datos!");

//Variable de Religión para repetidores de 1BACH
$rel1b = mysql_query("select religion1b from matriculas_bach");
if(mysql_num_rows($rel1b)>0){}else{mysql_query("ALTER TABLE  matriculas_bach ADD  religion1b VARCHAR( 64 ) NOT NULL");}

// Enfermedades
$enfermedades = array(
array(
													'id'     => 'Celiaquía',
													'nombre' => 'Celiaquía',
),
array(
													'id'     => 'Alergias a alimentos',
													'nombre' => 'Alergias a alimentos',
),
array(
													'id'     => 'Alergias respiratorias',
													'nombre' => 'Alergias respiratorias',
),
array(
													'id'     => 'Asma',
													'nombre' => 'Asma',
),
array(
													'id'     => 'Convulsiones febriles',
													'nombre' => 'Convulsiones febriles',
),
array(
													'id'     => 'Diabetes',
													'nombre' => 'Diabetes',
),
array(
													'id'     => 'Epilepsia',
													'nombre' => 'Epilepsia',
),
array(
													'id'     => 'Insuficiencia cardíaca',
													'nombre' => 'Insuficiencia cardíaca',
),
array(
													'id'     => 'Insuficiencia renal',
													'nombre' => 'Insuficiencia renal',
),
array(
													'id'     => 'Otra enfermedad',
													'nombre' => 'Otra enfermedad',
),
);

// Divorcios
$divorciados = array(
array(
													'id'     => 'Guarda y Custodia compartida por Madre y Padre',
													'nombre' => 'Guarda y Custodia compartida por Madre y Padre',
),
array(
													'id'     => 'Guarda y Custodia de la Madre',
													'nombre' => 'Guarda y Custodia de la Madre',
),
array(
													'id'     => 'Guarda y Custodia del Padre',
													'nombre' => 'Guarda y Custodia del Padre',
),
);


// Asignaturas y Modalidades
$it1 = array("1"=>"Ciencias e Ingeniería y Arquitectura", "2"=>"Ciencias y Ciencias de la Salud", "3"=>"Humanidades", "4"=>"Ciencias Sociales y Jurídicas");
$opt11=array( "TIN1" => "Tecnología Industrial", "TIC1" => "Tecnologías de Información y Comunicación");
$opt12=array("AAP1"=>"Anatomía Aplicada", "TIC11" => "Tecnologías de Información y Comunicación");
$opt13=array(
""=>"",
"LAT1-GRI1-PAC1" => "Latín, Griego, Patrimonio Artístico y Cultural", 
"LAT1-GRI1-CEE1" => "Latín, Griego, Cultura Emprendedora y Empresarial",
"LAT1-GRI1-TIC0" => "Latín, Griego, Tecnologías de la Información y Comunicación",
"LAT1-LUN1-PAC1" => "Latín, Literatura Universal, Patrimonio Artístico y Cultural",
"LAT1-LUN1-CEE1" => "Latín, Literatura Universal, Cultura Emprendedora y Empresarial",
"LAT1-LUN1-TIC0" => "Latín, Literatura Universal, Tecnologías de la Información y Comunicación",
"LAT1-ECO1-PAC1" => "Latín, Economía, Patrimonio Artístico y Cultural",
"LAT1-ECO1-CEE1" => "Latín, Economía, Cultura Emprendedora y Empresarial",
"LAT1-ECO1-TIC0" => "Latín, Economía, Tecnologías de la Información y Comunicación",
"MCS1-GRI1-PAC1" => "Matemáticas Aplicadas a Ciencias Sociales, Griego, Patrimonio Artístico y Cultural", 
"MCS1-GRI1-CEE1" => "Matemáticas Aplicadas a Ciencias Sociales, Griego, Cultura Emprendedora y Empresarial",
"MCS1-GRI1-TIC0" => "Matemáticas Aplicadas a Ciencias Sociales, Griego, Tecnologías de la Información y Comunicación",
"MCS1-LUN1-PAC1" => "Matemáticas Aplicadas a Ciencias Sociales, Literatura Universal, Patrimonio Artístico y Cultural",
"MCS1-LUN1-CEE1" => "Matemáticas Aplicadas a Ciencias Sociales, Literatura Universal, Cultura Emprendedora y Empresarial",
"MCS1-LUN1-TIC0" => "Matemáticas Aplicadas a Ciencias Sociales, Literatura Universal,Tecnologías de la Información y Comunicación",
"MCS1-ECO1-PAC1" => "Matemáticas Aplicadas a Ciencias Sociales, Economía, Patrimonio Artístico y Cultural",
"MCS1-ECO1-CEE1" => "Matemáticas Aplicadas a Ciencias Sociales, Economía, Cultura Emprendedora y Empresarial",
"MCS1-ECO1-TIC0" => "Matemáticas Aplicadas a Ciencias Sociales, Economía, Tecnologías de la Información y Comunicación",
);

$it21 = array("Bachillerato de Ciencias y Tecnología", "Vía de Ciencias e Ingeniería", "Vía de Ciencias de la Naturaleza y la Salud", "Ciencias y Tecnología");
$it22 = array("Bachillerato de Humanidades y Ciencias Sociales", "Vía de Humanidades", "Vía de Ciencias Sociales", "Humanidades y Ciencias Sociales");
$opt21=array("FIS21_DBT21" => "Física, Dibujo Técnico", "FIS21_TIN21" => "Física, Tecnología", "FIS21_QUI21" => "Física, Química", "BIO21_QUI21" => "Biología, Química");
$opt22=array("HAR22_LAT22_GRI22" => "Historia del Arte, Latín, Griego", "HAR22_LAT22_MCS22" => "Historia del Arte, Latín, Matemáticas de las C. Sociales", "HAR22_ECO22_GRI22" => "Historia del Arte, Economía, Griego", "HAR22_ECO22_MCS22" => "Historia del Arte, Economía, Matemáticas de las C. Sociales", "GEO22_ECO22_MCS22" => "Geografía, Economía, Matemáticas de las C. Sociales", "GEO22_ECO22_GRI22" => "Geografía, Economía, Griego", "GEO22_LAT22_MCS22" => "Geografía, Latín, Matemáticas de las C. Sociales", "GEO22_LAT22_GRI22" => "Geografía, Latín, Griego");
$opt23 =array("ingles_25" => "Inglés 2º Idioma","aleman_25" => "Alemán 2º Idioma", "frances_25" => "Francés 2º Idioma", "tic_25" => "T.I.C.", "ciencias_25" => "Ciencias de la Tierra y Medioambientales", "musica_25" => "Historia de la Música y la Danza", "literatura_25" => "Literatura Universal", "edfisica_25"=>"Educación Física", "estadistica_25"=>"Estadística", "salud_25"=>"Introducción a las Ciencias de la Salud");

// Se han enviado los dfatos de la matrícula.

if($_POST['enviar'] =="Enviar los datos de la Matrícula"){
	foreach($_POST as $key => $val)
	{
		${$key}=$val;
		//echo "$key = $val<br>";
	}
	
	// Comprobación de campos vacíos
	$nacimiento = str_replace("/","-",$nacimiento);
	$fecha0 = explode("-",$nacimiento);
	$fecha_nacimiento = "$fecha0[2]-$fecha0[1]-$fecha0[0]";
	$campos = "apellidos nombre nacido provincia nacimiento domicilio localidad padre dnitutor telefono1 telefono2 religion colegio sexo nacionalidad ";
	$itinerario1=substr($mod1,-1);
	$itinerario2=substr($mod2,-1);
	
	foreach($_POST as $key => $val)
	{
		if ($mod1==1) {$optativa1=$optativa11;}elseif ($mod1==2) {$optativa1=$optativa12;}elseif($mod1==3 or $mod1==4){$optativa1=$optativa13;}else{$optativa1="";}
		if ($key=="mod1") {
						if($optativa11=="" and $optativa12=="" and $optativa13==""){
							$vacios.= "optativas de modalidad de 1BACH, ";
							$num+=1;
						}

		}
		if ($key=="mod2"){
			foreach (${opt2.$itinerario2} as $opt => $n_opt){
				foreach ($_POST as $clave=>$valor){
					if ($valor==$opt) {
						$n_o+=1;
						${optativa.$n_o}=$valor;
						if(${optativa.$n_o} == ""){
							$vacios.= "optativa".$n_o.", ";
							$num+=1;
						}
						$tr_o = explode(", ",$n_opt);
						$optativa2=$valor;
					}
				}
				$n_o="";
				$num="";
				foreach (${opt23} as $opt => $n_opt){
					foreach ($_POST as $clave=>$valor){
						if ($clave==$opt) {
							$n_o+=1;
							${optativa2b.$n_o}=$valor;
							if(${optativa2b.$n_o} == ""){
								$vacios.= "optativa2b".$n_o.", ";
								$num+=1;
							}
						}
					}
				}
			}
		}
		if(strstr($campos,$key." ")==TRUE){
			if($val == ""){
				$vacios.= $key.", ";
				$num+=1;
			}
		}
	}

	if ($religion == "") {
		$vacios.= "religion, ";
		$num+=1;
	}
	if ($idioma1 == "") {
		$vacios.= "1º idioma, ";
		$num+=1;
	}
	if ($religion1b == "" and $curso=="2BACH") {
		$vacios.= "religion o alternativa de 1BACH, ";
		$num+=1;
	}
	
	if ($idioma2 == "" and $curso=="1BACH") {
		$vacios.= "2º idioma, ";
		$num+=1;
	}
	if ($curso=="2BACH" and $repetidor == "" and empty($itinerario2)) {
		$vacios.= "modalidad de 2, ";
		$num+=1;
	}
	if ($curso=="2BACH" and $repetidor == ""  and (empty($itinerario1))) {
		$vacios.= "modalidad de 1, ";
		$num+=1;
	}
	if ($curso=="2BACH" and $repetidor == "1" and empty($itinerario2)) {
		$vacios.= "modalidad de 2, ";
		$num+=1;
	}
	if ($curso=="1BACH" and empty($itinerario1)) {
		$vacios.= "modalidad de 1º, ";
		$num+=1;
	}
	
	

	

	if ($sexo == "") {
		$vacios.= "sexo, ";
		$num+=1;
	}
	// Control de errores
	if($num > 0){
		$adv = substr($vacios,0,-2);
		echo '
<script> 
 alert("Los siguientes datos son obligatorios y no los has rellenado en el formulario de inscripción:\n ';
		$num_cur = substr($curso,0,1);
		$num_cur_ant = $num_cur - 1;
		$cur_act = substr($curso,0,1)."º de BACHILLERATO";
		$cur_ant = $num_cur_ant . "º de BACHILLERATO";
		for ($i=1;$i<8;$i++){
			$adv= str_replace("optativa$i", "optativa de $cur_ant $i", $adv);
		}
		for ($i=1;$i<5;$i++){
			$adv= str_replace("optativa$i", "optativa de $cur_act  $i", $adv);
		}
		echo $adv.'.\n';
		echo 'Rellena los campos mencionados y envía los datos de nuevo para poder registrar tu solicitud correctamente.")
 </script>
';
	}
	else{

		if (substr($curso,0,1)==2){
			for ($i = 1; $i < 11; $i++) {
				for ($z = $i+1; $z < 11; $z++) {
					if (${optativa2b.$i}>0) {
						if (${optativa2b.$i}==${optativa2b.$z}) {
							$opt_rep="1";
						}
					}
				}
			}
		}
		
		if ($curso=="2BACH" and $repetidor <> "1") {
			if ($itinerario2==1 and $itinerario1>2){
				$incompat = 1;
			}
			if ($itinerario2==2 and $itinerario1<3){
				$incompat = 1;
			}
		}

		/*if ($curso=="2BACH" and $repetidor <> "1") {
			if ($itinerario1=="1"){
				if ($optativa1=="BYG11" and (strstr($optativa2,"BIO")==FALSE and strstr($optativa2,"QUI")==FALSE)) {
					$incompat = 1;
				}
				if (strstr($optativa1,"BYG")==FALSE and (strstr($optativa2,"BIO")==TRUE or strstr($optativa2,"QUI")==TRUE)) {
					$incompat = 1;
				}
			}
			else
			{
				$n_opcs="";
				$it_csh = explode("-",$optativa1);
				foreach ($it_csh as $o_cs1){
					$o_cs1 = substr($o_cs1,0,3);
					if (strstr($optativa2,$o_cs1)==TRUE) {
						$n_opcs+=1;
					}
				}
				if ($n_opcs<>2) {
					$incompat = 1;
				}
			}
		}*/

		if (substr($curso,0,1)==1 and ($idioma1==$idioma2)){
			$idioma_rep="1";
		}
		if($colegio == "Otro Centro" and ($otrocolegio == "" or $otrocolegio == "Escribe aquí el nombre del Centro")){
			$vacios.="otrocolegio ";
			echo '
<script> 
 alert("No has escrito el nombre del Centro del que procede el alumno.\n';
			echo 'Rellena el nombre del Centro y envía los datos de nuevo para poder registrar tu solicitud correctamente.")
 </script>
';
		}
		elseif(strstr($nacimiento,"-") == FALSE){
			echo '
<script> 
 alert("ATENCIÓN:\n ';
			echo 'La fecha de nacimiento que has escrito no es correcta.\nEl formato adecuado para la fecha  es: dia-mes-año (01-01-1998).")
 </script>
';
		}
		elseif(strlen($ruta_este) > 0 and strlen($ruta_oeste) > 0){
			echo '
<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado dos rutas incompatibles para el Transporte Escolar, y sólo puedes seleccionar una ruta, hacia el Este o hacia el Oeste de Estepona.\nElige una sola parada y vuelve a enviar los datos.")
 </script>
';
			$ruta_error = "";
		}
		elseif($enfermedad == "Otra enfermedad" and ($otraenfermedad == "" or $otraenfermedad == "Escribe aquí el nombre de la enfermedad")){
			$vacios.="otraenfermedad ";
			$msg_error = "No has escrito el nombre de la enfermedad del alumno. Rellena el nombre de la enfermedad y envía los datos de nuevo para poder registrar tu solicitud correctamente.";
		}
		elseif ($opt_rep=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado el mismo número de preferencia para varias optativas, y cada optativa debe tener un número de preferencia distinto.\nElige las optativas sin repetir el número de preferencia e inténtalo de nuevo.")
 </script>
';
		}
		elseif ($idioma_rep=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado el mismo idioma como primera y segunda, y cada idioma debe ser distinto.\nElige los idiomas sin repetir e inténtalo de nuevo.")
 </script>
';
		}
		elseif($incompat=="1"){
			echo '
						<script> 
 alert("ATENCIÓN:\n';
			echo 'Parece que has seleccionado una modalidad de 1º de Bachillerato incompatibles con la modalida elegida en 2º de Bachillerato. Si quieres optar por esta posibilidad ponte en contacto con Jefatura de Estudios.")
 </script>
';			
		}
		else{
			if (strlen($claveal) > 3) {$extra = " claveal = '$claveal'";}
			elseif (strlen($dni) > 3) {$extra = " dni = '$dni'";}
			else {$extra = " dnitutor = '$dnitutor' ";}

			// El alumno ya se ha registrado anteriormente
			$ya_esta = mysql_query("select id from matriculas_bach where $extra");
			if (mysql_num_rows($ya_esta) > 0) {
				$ya = mysql_fetch_array($ya_esta);
				if (strlen($ruta_este) > 0 or strlen($ruta_oeste) > 0) {$transporte = '1';}
				if (empty($foto)) { $foto = "0";}
				$act_datos = "update matriculas_bach set apellidos='$apellidos', nombre='$nombre', nacido='$nacido', provincia='$provincia', nacimiento='$fecha_nacimiento', domicilio='$domicilio', localidad='$localidad', dni='$dni', padre='$padre', dnitutor='$dnitutor', madre='$madre', dnitutor2='$dnitutor2', telefono1='$telefono1', telefono2='$telefono2', religion='$religion', colegio='$colegio', otrocolegio='$otrocolegio', letra_grupo='$letra_grupo', idioma1='$idioma1', idioma2='$idioma2', religion = '$religion', observaciones = '$observaciones', promociona='$promociona', transporte='$transporte', ruta_este='$ruta_este', ruta_oeste='$ruta_oeste', curso='$curso', sexo = '$sexo', hermanos = '$hermanos', nacionalidad = '$nacionalidad', claveal = '$claveal', itinerario1 = '$itinerario1', itinerario2 = '$itinerario2', optativa1='$optativa1', optativa2='$optativa2', optativa2b1 = '$optativa2b1', optativa2b2 = '$optativa2b2', optativa2b3 = '$optativa2b3', optativa2b4 = '$optativa2b4', optativa2b5 = '$optativa2b5', optativa2b6 = '$optativa2b6', optativa2b7 = '$optativa2b7', optativa2b8 = '$optativa2b8', optativa2b9 = '$optativa2b9', optativa2b10 = '$optativa2b10', repite = '$repetidor', enfermedad = '$enfermedad', otraenfermedad = '$otraenfermedad', foto='$foto', bilinguismo='$bilinguismo', divorcio='$divorcio', religion1b='$religion1b' where id = '$ya[0]'";
				//echo $act_datos."<br>";
				mysql_query($act_datos);
			}
			else{

				if (strlen($ruta) > 0) {$transporte = '1';}
				if (empty($foto)) { $foto = "0";}
				$con_matr =  "insert into matriculas_bach (apellidos, nombre, nacido, provincia, nacimiento, domicilio, localidad, dni, padre, dnitutor, madre, dnitutor2, telefono1, telefono2, colegio, otrocolegio, letra_grupo, correo, idioma1, idioma2, religion, optativa1, optativa2, optativa2b1, optativa2b2, optativa2b3, optativa2b4, optativa2b5, optativa2b6, optativa2b7, optativa2b8, optativa2b9, optativa2b10, observaciones, curso, fecha, promociona, transporte, ruta_este, ruta_oeste, sexo, hermanos, nacionalidad, claveal, itinerario1, itinerario2, repite, enfermedad, otraenfermedad, foto, bilinguismo, divorcio, religion1b) VALUES ('$apellidos',  '$nombre', '$nacido', '$provincia', '$fecha_nacimiento', '$domicilio', '$localidad', '$dni', '$padre', '$dnitutor', '$madre', '$dnitutor2', '$telefono1', '$telefono2', '$colegio', '$otrocolegio', '$letra_grupo', '$correo', '$idioma1', '$idioma2', '$religion', '$optativa1', '$optativa2', '$optativa2b1', '$optativa2b2', '$optativa2b3', '$optativa2b4', '$optativa2b5', '$optativa2b6', '$optativa2b7', '$optativa2b8', '$optativa2b9', '$optativa2b10', '$observaciones', '$curso', now(), '$promociona', '$transporte', '$ruta_este', '$ruta_oeste', '$sexo', '$hermanos', '$nacionalidad', '$claveal', '$itinerario1', '$itinerario2', '$repetidor', '$enfermedad', '$otraenfermedad', '$foto', '$bilinguismo', '$divorcio', '$religion1b')";
				//echo $con_matr;
				mysql_query($con_matr);
			}
			$ya_esta1 = mysql_query("select id from matriculas_bach where $extra");
			$ya_id = mysql_fetch_array($ya_esta1);
			$id = $ya_id[0];
			if ($nuevo=="1") {
				include("imprimir.php");
			}
			else{
				?>
<!DOCTYPE html>
<html>
<head>
<title>Solicitud n&ordm;:</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<META name="Author" content="Miguel A. García">
<META name="keywords"
	content="insituto,monterroso,estepona,andalucia,linux,smeserver,tic">
<title>Páginas del I.E.S. Monterroso</title>
<link rel="stylesheet"
	href="http://<? echo $dominio;?>css/<? echo $css_estilo; ?>">
<link rel="stylesheet"
	href="http://<? echo $dominio;?>css/bootstrap_personal.css">
<link href="http://<? echo $dominio;?>css/bootstrap-responsive.min.css"
	rel="stylesheet">
<link rel="stylesheet"
	href="http://<? echo $dominio;?>font-awesome/css/font-awesome.min.css">
</head>
<body>
<br />
<br />
<br />
<br />
<div class="alert alert-success"
	style="width: 600px; margin: auto; text-align: justify;"><br />
Los datos de la Matrícula se han registrado correctamente. En los
próximos días, el Director del Centro o Tutor entregará la documentación
al alumno. Este la llevará a casa para ser firmada por sus padres o
tutores legales. Una vez firmada se entregará en la Administración del
Centro con los documentos complementarios (fotocopia del DNI o Libro de
Familia, etc.). Si tienen alguna duda o surge algún problema, no duden
en ponerse en contacto con la Adminsitración o Dirección del Centro. <br />
<br />
<form action="../notas/datos.php" method="post"
	enctype="multipart/form-data">
<center><input type="submit"
	value="Volver a la página personal del alumno"
	class="btn btn-primary btn-block btn-large" /></center>
</form>
				<?
				exit();
			}
		}
	}
}
?> <!DOCTYPE html>
<html>
<head>
<title>Solicitud n&ordm;:</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<META name="Author" content="Miguel A. García">
<META name="keywords"
	content="insituto,monterroso,estepona,andalucia,linux,smeserver,tic">
<title>Páginas del I.E.S. Monterroso</title>
<link rel="stylesheet"
	href="http://<? echo $dominio;?>css/<? echo $css_estilo; ?>">
<link rel="stylesheet"
	href="http://<? echo $dominio;?>css/bootstrap_personal.css">
<link href="http://<? echo $dominio;?>css/bootstrap-responsive.min.css"
	rel="stylesheet">
<link rel="stylesheet"
	href="http://<? echo $dominio;?>font-awesome/css/font-awesome.min.css">

<script type="text/javascript">
function confirmacion() {
	if (confirm("ATENCIÓN:\n Los datos que estás a punto de enviar pueden ser modificados a través de esta página hasta el próximo día 16 de Junio, fecha en la que se procederá al bloqueo del formulario para imprimirlo y entregarlo a los alumnos. Si necesitas cambiar los datos después de esa fecha deberás hacerlo a través de la Jefatura de Estudios. \nSi estás seguro que los datos son correctos y las opciones elegidas son las adecuadas, pulsa el botón ACEPTAR. De lo contrario, el boton CANCELAR te devuelve al formulario de matriculación, donde podrás realizar los cambios que consideres oportunos."))
		{
			document.form1.submit();
	}
}
</script>

<script language="javascript">

function dimePropiedades(){ 
   	var indice = document.form1.colegio.selectedIndex 
   	var textoEscogido = document.form1.colegio.options[indice].text 
   	if(textoEscogido == "Otro Centro"){
    document.getElementById('otrocolegio').style.visibility='visible'; 
	}
	 }

function dimeEnfermedad(){ 
   	var indice = document.form1.enfermedad.selectedIndex 
   	var textoEscogido = document.form1.enfermedad.options[indice].text 
   	if(textoEscogido == "Otra enfermedad"){
    document.getElementById('otraenfermedad').style.visibility='visible'; 
	}
	 }
	 
function borrar()
{
document.form1.otrocolegio.value = "";
}

function contar(form,name) {
	  n = document.forms[form][name].value.length;
	  t = 300;
	  if (n > t) {
	    document.forms[form][name].value = document.forms[form][name].value.substring(0, t);
	  }
	  else {
	    document.forms[form]['result'].value = t-n;
	  }
	}
	
</script>
</head>

<body>

<?
// Rellenar datos a partir de las tablas alma o matriculas.

if ($claveal or $id) {
	if (!empty($id)) {
		$conditio = " id = '$id'";
	}
	else{
		if (strlen($claveal) > 3) {$conditio = " claveal = '$claveal'"; $conditio1 = $conditio;}
	}

	$curso = str_replace(" ","",$curso);
	$ya_matricula = mysql_query("select claveal, apellidos, nombre, id from matriculas_bach where ". $conditio ."");
	$ya_secundaria = mysql_query("select claveal, apellidos, nombre from alma_secundaria where ". $conditio1 ."");
	$ya_alma = mysql_query("select claveal, apellidos, nombre, unidad from alma where (curso like '1º de B%' or curso like '2º de B%' or curso like '4º de E%') and (". $conditio1 .")");

	// Comprobamos si el alumno se ha registrado ya
	$ya = mysql_query("select apellidos, nombre, nacido, provincia, nacimiento, domicilio, localidad, dni, padre, dnitutor, madre,
	dnitutor2, telefono1, telefono2, colegio, otrocolegio, letra_grupo, correo, idioma1, idioma2, religion, 
	itinerario1, itinerario2, optativa1, optativa2, optativa2b1, optativa2b2, optativa2b3, 
	optativa2b4, optativa2b5, optativa2b6, optativa2b7, optativa2b8, optativa2b9, optativa2b10, observaciones, curso, fecha, 
	promociona, transporte, ruta_este, ruta_oeste, sexo, hermanos, nacionalidad, claveal, itinerario1, itinerario2, repite, foto, enfermedad, otraenfermedad, bilinguismo, divorcio, religion1b from matriculas_bach where ". $conditio ."");

	// Ya se ha matriculado
	if (mysql_num_rows($ya) > 0) {
		$datos_ya = mysql_fetch_object($ya);
		$naci = explode("-",$datos_ya->nacimiento);
		$nacimiento = "$naci[2]-$naci[1]-$naci[0]";
		$apellidos = $datos_ya->apellidos; $id = $datos_ya->id; $nombre = $datos_ya->nombre; $nacido = $datos_ya->nacido; $provincia = $datos_ya->provincia; $domicilio = $datos_ya->domicilio; $localidad = $datos_ya->localidad; $dni = $datos_ya->dni; $padre = $datos_ya->padre; $dnitutor = $datos_ya->dnitutor; $madre = $datos_ya->madre; $dnitutor2 = $datos_ya->dnitutor2; $telefono1 = $datos_ya->telefono1; $telefono2 = $datos_ya->telefono2; $colegio = $datos_ya->colegio; $correo = $datos_ya->correo; $otrocolegio = $datos_ya->otrocolegio; $letra_grupo = $datos_ya->letra_grupo; $religion = $datos_ya->religion; $observaciones = $datos_ya->observaciones; $promociona = $datos_ya->promociona; $transporte = $datos_ya->transporte; $ruta_este = $datos_ya->ruta_este; $ruta_oeste = $datos_ya->ruta_oeste; $sexo = $datos_ya->sexo; $hermanos = $datos_ya->hermanos; $nacionalidad = $datos_ya->nacionalidad; $claveal = $datos_ya->claveal; $curso = $datos_ya->curso;  $itinerario1 = $datos_ya->itinerario1; $itinerario2 = $datos_ya->itinerario2; $optativa1 = $datos_ya->optativa1; $optativa2 = $datos_ya->optativa2; $optativa2b1 = $datos_ya->optativa2b1; $optativa2b2 = $datos_ya->optativa2b2; $optativa2b3 = $datos_ya->optativa2b3; $optativa2b4 = $datos_ya->optativa2b4; $optativa2b5 = $datos_ya->optativa2b5; $optativa2b6 = $datos_ya->optativa2b6; $optativa2b7 = $datos_ya->optativa2b7; $optativa2b8 = $datos_ya->optativa2b8; $optativa2b9 = $datos_ya->optativa2b9; $optativa2b10 = $datos_ya->optativa2b10; $repetidor = $datos_ya->repite; $idioma1 = $datos_ya->idioma1; $idioma2 = $datos_ya->idioma2; $foto = $datos_ya->foto; $enfermedad = $datos_ya->enfermedad; $otraenfermedad = $datos_ya->otraenfermedad; $bilinguismo = $datos_ya->bilinguismo; $divorcio = $datos_ya->divorcio; $religion1b = $datos_ya->religion1b;
		$n_curso = substr($curso,0,1);
		if ($ruta_error == '1') {
			$ruta_este = "";
			$ruta_oeste = "";
		}
	}

	// Viene de Colegio de Secundaria
	elseif (mysql_num_rows($ya_secundaria) > 0){
		$alma = mysql_query("select apellidos, nombre, provinciaresidencia, fecha, domicilio, localidad, dni, padre, dnitutor, concat(PRIMERAPELLIDOTUTOR2,' ',SEGUNDOAPELLIDOTUTOR2,', ',NOMBRETUTOR2), dnitutor2, telefono, telefonourgencia, correo, concat(PRIMERAPELLIDOTUTOR,' ',SEGUNDOAPELLIDOTUTOR,', ',NOMBRETUTOR), curso, sexo, nacionalidad, unidad, claveal, colegio from alma_secundaria where ". $conditio1 ."");
		if (mysql_num_rows($alma) > 0) {
			$al_alma = mysql_fetch_array($alma);
			$apellidos = $al_alma[0];  $nombre = $al_alma[1]; $nacido = $al_alma[5]; $provincia = $al_alma[2]; $nacimiento = $al_alma[3]; $domicilio = $al_alma[4]; $localidad = $al_alma[5]; $dni = $al_alma[6]; $padre = $al_alma[7]; $dnitutor = $al_alma[8];
			if (strlen($al_alma[9]) > 3) {$madre = $al_alma[9];	}else{ $madre = ""; }
			; $dnitutor2 = $al_alma[10]; $telefono1 = $al_alma[11]; $telefono2 = $al_alma[12]; $correo = $al_alma[13]; $padre = $al_alma[14];
			$n_curso_ya = $al_alma[15]; $sexo = $al_alma[16]; $nacionalidad = $al_alma[17]; $letra_grupo = substr($al_alma[18],0,-1); $claveal= $al_alma[19]; $colegio= $al_alma[20];
			$nacimiento= str_replace("/","-",$nacimiento);
			$curso="1BACH";
			$n_curso=substr($curso, 0, 1);
		}
	}

	// Es alumno del Centro
	elseif (mysql_num_rows($ya_alma) > 0){
		$alma = mysql_query("select apellidos, nombre, provinciaresidencia, fecha, domicilio, localidad, dni, padre, dnitutor, concat(PRIMERAPELLIDOTUTOR2,' ',SEGUNDOAPELLIDOTUTOR2,', ',NOMBRETUTOR2), dnitutor2, telefono, telefonourgencia, correo, concat(PRIMERAPELLIDOTUTOR,' ',SEGUNDOAPELLIDOTUTOR,', ',NOMBRETUTOR), curso, sexo, nacionalidad, grupo, claveal, unidad, combasi, curso, matriculas from alma where (curso like '1º de B%' or curso like '2º de B%' or curso like '4º de E%') and (". $conditio1 .")");
		if (mysql_num_rows($alma) > 0) {
			$al_alma = mysql_fetch_array($alma);
			if (empty($curso)) {
				if (stristr("1º de B%",$al_alma[15])){$curso="2BACH";}
				if (stristr("2º de B%",$al_alma[15])){$curso="2BACH";}
				if (stristr("4º de E%",$al_alma[15])){$curso="1BACH";}
			}
			else{
				if (stristr("4º de E%",$al_alma[15])){$curso="1BACH";}
			}
			$n_curso = substr($curso,0,1);

			$apellidos = $al_alma[0];  $nombre = $al_alma[1]; $nacido = $al_alma[5]; $provincia = $al_alma[2]; $nacimiento = $al_alma[3]; $domicilio = $al_alma[4]; $localidad = $al_alma[5]; $dni = $al_alma[6]; $padre = $al_alma[7]; $dnitutor = $al_alma[8];
			if ($madre == "") { if (strlen($al_alma[9]) > 3) {$madre = $al_alma[9];	}else{ $madre = ""; }}
			if ($dnitutor2 == "") { $dnitutor2 = $al_alma[10];} if ($telefono1 == "") { $telefono1 = $al_alma[11]; } if ($telefono2 == "") { $telefono2 = $al_alma[12];} if ($correo == "") { $correo = $al_alma[13];} $padre = $al_alma[14];
			$n_curso_ya = $al_alma[15]; $sexo = $al_alma[16]; $nacionalidad = $al_alma[17]; $letra_grupo = $al_alma[18]; $claveal= $al_alma[19]; $combasi = $al_alma[21]; $unidad = $al_alma[20]; $curso_largo = $al_alma[22]; $matriculas = $al_alma[23];
			if (substr($curso,0,1) == substr($n_curso_ya,0,1)) {
				echo '
<script> 
 if(confirm("ATENCIÓN:\n ';
				echo 'Has elegido matricularte en el mismo Curso( ';
				echo strtoupper($n_curso_ya);
				echo ') que ya has estudiado este año. \nEsta situación sólo puede significar que estás absolutamente seguro de que vas a repetir el mismo Curso. Si te has equivocado al elegir Curso para el próximo año escolar, vuelve atrás y selecciona el curso correcto. De lo contrario, puedes continuar.")){}else{history.back()};
 </script>';
				/*if ($n_curso=="1") {
				 $repetidor = '1';
				 $repetidor1 = "1";
				 }*/
				$repetidor = '1';
				// ${repetidor.$n_curso} = "1";
			}
			$nacimiento= str_replace("/","-",$nacimiento);
			$colegio = 'IES Monterroso';
		}
	}
	?>
<br />

<table align="center" class="table table-bordered" style="width:1000px;">
	<form id="form1" name="form1" method="post"
		action="matriculas_bach.php">
	<tr>
		<td colspan="3"><img src="../img/encabezado.jpg" width="96%"
			align="center" /></td>
	</tr>
	<tr>
		<td colspan="3"><?
		if (empty($n_curso)){$n_curso = substr($curso,0,1);}
		if ($curso=="1BACH") {$curso_matricula="PRIMERO";}
		if ($curso=="2BACH") {$curso_matricula="SEGUNDO";}
		?>
		<p align=center
			style='text-align: center; font-size: 16px; font-weight: bold; line-height: 50px;'><b>SOLICITUD
		DE MATR&Iacute;CULA EN <? echo $curso_matricula; ?> DE BACHILLERATO</b></p>
		</td>
	</tr>

	<?
	if (substr($curso,0,1) == substr($n_curso_ya,0,1) and (substr($n_curso_ya,0,1) == "1") and $cargo == '1') {$repite_1bach = "1";}
	if (substr($curso,0,1) == substr($n_curso_ya,0,1) and (substr($n_curso_ya,0,1) == "2") and $cargo == '1') {$repite_2bach = "1";}
	?>

	<tr>
		<td colspan="3"
			style='text-align: center; font-size: 14px; font-weight: bold; background-color: #E0E0E0; height: 24px;'>
		<b>Datos personales del alumno y Representantes Legales</b></td>
	</tr>
	<tr>
		<td valign=top width="33%" colspan="2"><strong>Apellidos del alumno/a:<br />
		<input type="text" name="apellidos"
		<? echo "value = \"$apellidos\""; ?>
		<? if(strstr($vacios,"apellidos, ")==TRUE){echo ' style="background-color:#FFFF66;"';}?>
			required class="input-xlarge" /> </strong></td>
		<td valign=top width="33%"><strong>Nombre</strong>:<br />
		<input type="text" name="nombre" <? echo "value = \"$nombre\""; ?>
		<? if(strstr($vacios,"nombre, ")==TRUE){echo ' style="background-color:#FFFF66;"';}?>
			required class="input-xlarge" /> <br />
		</td>
	</tr>
	<tr>
		<td valign=top><strong>Nacido en:<br />
		<input required type="text" name="nacido"
		<? echo "value = \"$nacido\""; ?>
		<? if(strstr($vacios,"nacido, ")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		</strong></td>
		<td valign=top><strong>Provincia de</strong>:<br />
		<input required type="text" name="provincia"
		<? echo "value = \"$provincia\""; ?>
		<? if(strstr($vacios,"provincia,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		</td>
		<td valign=top><strong>Fecha de nacimiento </strong>(dia-mes-año:
		01-01-1998)<br />
		<input type="text" name="nacimiento" required
		<? echo "value = \"$nacimiento\""; ?> size="10" maxlength="10"
		<? if(strstr($vacios,"nacimiento,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		</td>
	</tr>
	<tr>
		<td align=top><strong>Domicilio</strong>:<br />
		<input required type="text" name="domicilio"
		<? echo "value = \"$domicilio\""; ?>
		<? if(strstr($vacios,"domicilio,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		</td>
		<td valign=top><strong>Localidad</strong>:<br />
		<input required type="text" name="localidad"
		<? echo "value = \"$localidad\""; ?>
		<? if(strstr($vacios,"localidad,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		</td>
		<td valign=top><strong>D.N.I.</strong><br />
		<input required type="text" name="dni" <? echo "value = \"$dni\""; ?>
			maxlength="13"
			<? if(strstr($vacios,"dni,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		</td>
	</tr>
	<tr>
		<td valign="middle"><strong>Sexo</strong>:<br />
		<label class="radio"><input type="radio" name="sexo" value="mujer"
		<? if($sexo == 'mujer' or $sexo == 'M'){echo "checked";} ?> /> Mujer</label>
		<label class="radio"><input type="radio" name="sexo" value="hombre"
		<? if($sexo == 'hombre' or $sexo == 'H'){echo "checked";} ?> /> Hombre</label>
		</td>
		<td valign=top><strong>Nº de Hermanos</strong>:<br />
		<input type="text" name="hermanos" <? echo "value = \"$hermanos\""; ?>
			size="4" /> <br />
		</td>
		<td valign=top><strong>Nacionalidad</strong><br />
		<input required type="text" name="nacionalidad"
		<? echo "value = \"$nacionalidad\""; ?>
		<? if(strstr($vacios,"nacionalidad,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		</td>
	</tr>
	<tr>
		<td valign=top colspan="2"><strong>Apellidos y nombre del
		Representante o Guardador legal 1</strong> (<span
			style="font-weight: normal;">con quien convive el alumno</span>):<br />
		<input required type="text" name="padre"
		<? echo "value = \"$padre\""; ?> class="input-xlarge"
		<? if(strstr($vacios,"padre,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		</td>
		<td valign=top><strong>DNI</strong>:<br />
		<input required type="text" name="dnitutor"
		<? echo "value = \"$dnitutor\""; ?> size="13" maxlength="13"
		<? if(strstr($vacios,"dnitutor,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		<br />
		</td>
	</tr>
	<tr>
		<td valign=top colspan="2"><strong>Apellidos y nombre del
		Representante o Guardador legal 2</strong>:<br />
		<input type="text" name="madre" <? echo "value = \"$madre\""; ?>
			class="input-xlarge" /></td>
		<td valign=top><strong>DNI</strong>:<br />
		<input type="text" name="dnitutor2"
		<? echo "value = \"$dnitutor2\""; ?> size="13" maxlength="13" /> <br />
		</td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2" valign=top><strong>Tel&eacute;fono casa</strong>
		<input required type="text" name="telefono1"
		<? echo "value = \"$telefono1\""; ?> size="10"
		<? if(strstr($vacios,"telefono1,")==TRUE){echo ' style="background-color:#FFFF66;"';}?> />
		<br />
		<strong>Tel&eacute;fono m&oacute;vil padres</strong> <input type="text" name="telefono2" size="10" <? echo "value = \"$telefono2\""; ?> style="margin-top:6px;<? if(strstr($vacios,"telefono2")==TRUE){echo 'background-color:#FFFF66;';}?>" />
		<br />
		Nota: Es muy importante registrar un tel&eacute;fono m&oacute;vil para
		poder recibir comunicaciones del Centro v&iacute;a SMS.</td>
		<td valign=top align="center"><strong>Centro Escolar de procedencia:</strong>
		<select name="colegio" id="" onChange="dimePropiedades()">
			<option><? echo $colegio; ?></option>
			<?
			if ($curso == "1BACH") {
				?>
			<option>IES Mediterraneo</option>
			<option>IES Cancelada</option>
			<option>Otro Centro</option>
			<?
			}
			else{
				echo "<option>IES Monterroso</option>
      <option>Otro Centro</option>";            	
			}
			?>
		</select> <br />
		<center><input style="<?  if ($colegio == 'Otro Centro') {	echo "visibility:visible;";}else{	echo "visibility:hidden;background-color:#FFFF66;";}?>margin-top:6px;" id = "otrocolegio" name="otrocolegio" <? if(!($otrocolegio == 'Escribe aquí el nombre del Centro')){echo "value = \"$otrocolegio\"";} ?>type="text" class="input-xlarge" value="Escribe aquí el nombre del Centro" placeholder="Escribe aquí el nombre del Centro" onClick="borrar()" /></center>
		<input type="hidden" name="letra_grupo"	<? echo "value = \"$letra_grupo\""; ?> />
		</td>
	</tr>

	<tr>
		<td valign=top colspan=""><span style="margin: 2 '       x 2px;"><strong>Correo
		electr&oacute;nico padres</strong>:</span> <input type="text"
			name="correo" <? echo "value = \"$correo\""; ?> size="48" /></td>
	</tr>

	<tr>
		<td
			style="background-color: #E0E0E0; height: 24px; text-align: center;"
			colspan="3"><strong>Solicitud de Transporte Escolar</strong></td>
	</tr>
	<tr>
		<td valign=top colspan='3'>
		<center><br />
		Ruta Este: <select name="ruta_este">
			<option><?php  echo $ruta_este;?></option>
			<option>Urb. Mar y Monte</option>
			<option>Urb. Diana - Isdabe</option>
			<option>Benamara - Benavista</option>
			<option>Bel Air</option>
			<option>Parada Bus Portillo Cancelada</option>
			<option>Parque Antena</option>
			<option>El Pirata</option>
			<option>El Velerín</option>
			<option>El Padrón</option>
			<option>Mc Donald's</option>
		</select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ruta Oeste: <select
			name="ruta_oeste">
			<option><?php  echo $ruta_oeste;?></option>
			<option>Buenas Noches</option>
			<option>Costa Galera</option>
			<option>Bahía Dorada</option>
			<option>Don Pedro</option>
			<option>Bahía Azul</option>
			<option>G. Shell - H10</option>
			<option>Seghers Bajo (Babylon)</option>
			<option>Seghers Alto (Ed. Sierra Bermeja)</option>
		</select></center>
		<br />
		</td>
	</tr>
	<tr>
		<td style="background-color: #E0E0E0; height: 24px;" align=center><strong>Primer
		Idioma Extranjero</strong></td>
		<td style="background-color: #E6E6E6; height: 24px;" align=center><?
		if ($curso==1) {
			?> <strong>Segundo Idioma Extranjero</strong> <?
		}
		?></td>
		<td style="background-color: #E0E0E0; height: 24px;" align=center><strong>Enseñanza
		Religiosa o Alternativa </strong>(se&ntilde;ale una)</td>

	</tr>
	<tr>
		<td valign=top style="width: 300px;" align=center><br />
		<?
		echo '<select name="idioma1" style="width: 60%">';
		if(!(empty($idioma1))){
			echo "<option>$idioma1</option>";
		}
		$comb1=mysql_query("select combasi from alma where claveal = '$claveal'");
		$comb2=mysql_fetch_array($comb1);
		$comba = explode(":", $comb2[0]);
		foreach ($comba as $com1){
			//echo $com1;
			$abrv1 = mysql_query("select abrev, nombre from asignaturas where codigo = '$com1' and (abrev = 'ING' or abrev = 'FRA')");
			//echo "select abrev, nombre from asignaturas where codigo = '$com1' and unidad like '1B%' and (abrev = 'ING' or abrev = 'FRA')";
			$abrev1 = mysql_fetch_array($abrv1);
			if (!(empty($abrev1[1])) and $n_curso=="2") {
				$idio = "1";
				$id_1b = $abrev1[1];
				echo "<option>$abrev1[1]</option>";
			}

		}
		if ($idio<>1) {
			echo "
						<option>Inglés</option>
						<option>Francés</option>";				
		}
		?> </select><br />
		<?
		if ($idio==1) {
			echo '<span style="font-size: 10px;">(El Idioma de 2º de Bachillerato debe ser el mismo que el Idioma de 1º de Bachillerato. Para otras opciones, consulta en Jefatura de Estudios.)</span>';
		}
		?></td>
		<td valign=top style="width: 300px;" align=center><?
		if ($curso==1) {
			?> <br />
		<select name="idioma2" style="width: 60%">
		<?
		if(!(empty($idioma2))){
			echo "<option>$idioma2</option>";
		}
		?>
			<option>Alemán</option>
			<option>Francés</option>
			<option>Inglés</option>
		</select> <?
		}
		?></td>
		<td valign=top>
		<table style="width: 100%; border: none;">
			<tr>
				<td valign=top style="border: none;width:50%">
				<input type="radio" name="religion" value="Religión Catolica"
					style="margin: 2px 2px"
		<? if($religion == 'Religión Catolica'){echo "checked";} ?> />
				Religi&oacute;n Cat&oacute;lica<br />
				<input type="radio"
					name="religion" value="Religión Islámica" style="margin: 2px 2px"
		<? if($religion == 'Religión Islámica'){echo "checked";} ?> />
				Religi&oacute;n Isl&aacute;mica<br />
				<input type="radio" name="religion" value="Religión Judía"
					style="margin: 2px 2px"
		<? if($religion == 'Religión Judía'){echo "checked";} ?> />
				Religi&oacute;n Jud&iacute;a
				</td>
				<td valign=top style="border: none"><input type="radio"
					name="religion" value="Religión Evangélica" style="margin: 2px 2px"
		<? if($religion == 'Religión Evangélica'){echo "checked";} ?> />

				Religi&oacute;n Evang&eacute;lica<br />
				<? if ($curso==1) {?>
				<input type="radio" name="religion" value="Cultura Científica"
					style="margin: 2px 2px"
		<? if($religion == 'Cultura Científica'){echo "checked";} ?> />
				Cultura Científica<br />
				<? } ?>
				<input type="radio" name="religion" value="Valores Éticos"
					style="margin: 2px 2px"
		<? if($religion == 'Valores Éticos'){echo "checked";} ?> />
				<?php if($n_curso == 1){?>Educación para la Ciudadanía y los Derechos Humanos<? } else { ?>Atención Educativa<? } ?> </td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="background-color: #CCCCCC; text-align: center;" colspan="3"><strong>MODALIDAD
		Y ASIGNATURAS OPTATIVAS DE <? echo $n_curso; ?>º DE BACHILLERATO </strong>
		<?php if($curso == "1BACH"){ ?>
		<p class="muted" style="color:#666; font-size:11px;">Si eliges la Modalidad de Humanidades o Ciencias Sociales y Jurídicas <b>debes seleccionar un bloque de Asignaturas Optativas</b> en el campo desplegable que aparecerá al marcar la casilla. Si eliges una Modalidad de Ciencias las Asignaturas no son opcionales.
		</p>
		<?php } else{ ?>
		<p class="muted" style="color:#666; font-size:11px;">Las Asignaturas Optatives de 2º de BACHILLERATO están vinvuladas necesariamente con la Modalidad cursada en 1º de BACHILLERATO. Si decides cambiar de Modalidad al cursar 2º de BACHILLERATO debes indicarlo en la Jefatura de Estudios.
		</p>
		<? } ?>
		</td>
	</tr>

	
	<?php if($curso == "1BACH"): ?>
		<tr>
		<td colspan='3'>
		<table class="table table-bordered" style="width:100%">
		<tr>
		<?php foreach ($it1 as $n_it1=>$itiner1){ ?>
			<td style="width:25%">
			
			
			<label class="radio"> <input required type="radio" name="mod1" value="<?php echo $n_it1; ?>" <?php echo ($itinerario1 == $n_it1) ? 'checked' : ''; ?> /><strong><?php echo $itiner1; ?></strong></label>
			
			
			</td>
			<?php } ?>
		</tr>
		<tr>
		<?php for ($i = 1; $i <= 3; $i++){ ?>
		
		<?php if ($i<3) {?>
		<td style="width:25%;" >

		<? if ($i==1) { echo "<p>Matemáticas<br>Física y Química<br>Dibujo Técnico</p>";}elseif($i==2){echo "<p>Matemáticas<br>Física y Química<br>Biología y Geología</p>";}?>
		<select class="input input-xlarge" name="optativa1<?echo $i;?>"  <? if(stristr($vacios,"optativas de modalidad de 1B")==TRUE and $mod1 == $i){echo 'style="background-color:#FFFF66;"';}?>>
		<option></option>
		<?php foreach (${opt1.$i} as $optit_1 => $nombre){ ?>
				<option value="<?php echo $optit_1; ?>"
				<?php echo (isset($optativa1) && $optativa1 == $optit_1) ? 'selected' : ''; ?>><? echo $nombre; ?></option>

				
		<?php }?>
		</select>
		</td>		
		<?php } else {?>
                <td colspan="2" style="width:50%;">
		<p>Historia del Mundo Contemporáneo</p>	
		<select class="input input-xxlarge" name="optativa13"  <? if(stristr($vacios,"optativas de modalidad de 1B")==TRUE and $mod1 > 2){echo 'style="background-color:#FFFF66;"';}?>>
		<?php foreach (${opt1.$i} as $optit_1 => $nombre){ ?> ?>		

				<option value="<?php echo $optit_1; ?>"
				<?php echo (isset($optativa1) && $optativa1 == $optit_1) ? 'selected' : ''; ?>><? echo $nombre; ?></option>
				<?php }?>
				</select>
		</td>
		
		<?php }?>
		<?php }?>
		</tr>
		</table>
		</td>
		</tr>
		<?php endif;?>
	<?
	if($curso == "2BACH")
	{
		if (empty($curso_largo)) {
			$cl = mysql_query("select curso from alma where claveal='$claveal'");
			$cl0 = mysql_fetch_array($cl);
			$curso_largo = $cl0[0];
		}
		echo " <tr><td colspan='3'>";
		echo "<table class='table table-bordered table-striped' style='width:100%'><tr>";
		for ($i = 1; $i < 3; $i++) {
			echo "<td align='center' width='25%' valign='bottom'><strong style='font-size:14px'>";

			echo "".${it2.$i}[0]."</strong></td>";
		}
		echo "</tr><tr>";
		for ($i = 1; $i < 3; $i++) {
			echo "<td align='left' class='it' valign='top'>";

			$num1="3";
			$num_it=count(${opt2.$i});
			foreach (${opt2.$i} as $optit_1 => $nombre){
				$num1+=1;
				if (${optativa.$num1}=="0") {${optativa.$num1}="";}
				echo '<input type="radio" value="'.$optit_1.'" name="mod2" ';
				if ($optativa2 == $optit_1) {
					echo ' checked';
				}
				else{
					if(strstr($curso_largo,${it2.$i}[3])==FALSE and !(empty($curso_largo))){
						echo " disabled";
					}
				}

				echo ' style="margin: 2px 2px" >';
				echo '<span style="margin:2px 2px" >'.$nombre.'</span><br />';
			}
			echo "</td>";
		}
		echo "</tr></table></td></tr>";

		?>
	<tr>
		<td style="background-color: #eee;" COLSPAN="3" align=center><strong>OTRAS
		ASIGNATURAS OPTATIVAS DE 2º DE BACHILLERATO</strong><br />
		<span style="font-size: 10px;">(Marca con 1, 2, 3, 4, etc. por orden
		de preferencia)</span></td>

	</tr>
	<tr>
		<td colspan="3"
		<? if ($opt_rep == "1") {
			echo " style='background-color:yellow;'";
		} ?>><?
			echo "<table class='table table-bordered table-striped' style='width:100%'><tr>";
			$num1="";
			foreach ($opt23 as $optit_1 => $nombre){

				if (strstr($nombre,$id_1b)==FALSE) {
					$num1+=1;
					if ($num1==1 or $num1==4 or $num1==7 or $num1==10) {
						echo "<td valign=top style='width:33%'>";
					}
					echo '<select class="input-small" name="'.$optit_1.'" id=""';
					echo ' required>';

					if (strlen(${optativa2b.$num1})>0) {
						echo '<option>'.${optativa2b.$num1}.'</option>';
					}
					else{
						$num_opt = $num1;
						echo '<option>'.$num_opt.'</option>';
					}
					for ($z=1;$z<11;$z++){
						echo '<option>'.$z.'</option>';
					}

					echo '</select>';
					echo '<span style="margin:2px 2px" >'.$nombre.'</span><br />';
					if ($num1==3 or $num1==6 or $num1==9) {
						echo "</td>";
					}
				}
			}

			?>
	
	</tr>

</table>
</td>
</tr>
			<?

			if ($repetidor <> 1) {


				?>
<tr id='no_repite1'>
	<td style="background-color: #CCCCCC;" colspan="3" align="center"><strong>OPCIONES DE MATRICULACIÓN EN 1º DE BACHILLERATO</strong>
	<p class="help-block" style="color:orange; font-size:11px;">Debido a la entrada en vigor de la nueva legislación educativa (LOMCE) las asignaturas optativas de este nivel son provisionales. Si se produjeran cambios de última hora el Centro se pondría en contacto con los alumnos para ajustar la matriculación a la nueva situación.<br>
	<span style="font-size: 10px;color:#666">(Para solicitar una modalidad o vía
	diferente a la que ya has cursado debes pasar por Jefatura de
	Estudios.)</span></p></td>
</tr>
<tr>
	<td colspan="3">
	<div class="form-group">
	<div class="checkbox"><label> <input type="checkbox" name="bilinguismo"
		value="Si" <? if($bilinguismo == 'Si'){echo "checked";} ?>> El
	alumno/a solicita participar en el programa de bilingüismo (Inglés) en 1º de BACHILLERATO </label></div>
	</div>
	</td>
</tr>
<tr>
<tr>
	<td style="background-color: #eee;" colspan="3">
	<strong>Religión, Educación para la Ciudadanía o Cultura Científica</strong>
	</td>
</tr>
<tr>
		
			<td colspan="3">
			
			
			<table style="width: 100%; border: none;<? if(stristr($vacios,"religion o alternativa de 1BACH")==TRUE){echo ' background-color:#FFFF66;"';}else{ echo '"';} ?> >
			<tr>
				<td valign=top style="border: none;width:50%">
				<input type="radio" name="religion1b" value="Religión Catolica"
					style="margin: 2px 2px"
		<? if($religion1b == 'Religión Catolica'){echo "checked";} ?> required />
				Religi&oacute;n Cat&oacute;lica<br />
				<input type="radio"
					name="religion1b" value="Religión Islámica" style="margin: 2px 2px"
		<? if($religion1b == 'Religión Islámica'){echo "checked";} ?>  required />
				Religi&oacute;n Isl&aacute;mica<br />
				<input type="radio" name="religion1b" value="Religión Judía"
					style="margin: 2px 2px"
		<? if($religion1b == 'Religión Judía'){echo "checked";} ?>  required />
				Religi&oacute;n Jud&iacute;a
				</td>
				<td valign=top style="border: none"><input type="radio"
					name="religion1b" value="Religión Evangélica" style="margin: 2px 2px"
		<? if($religion1b == 'Religión Evangélica'){echo "checked";} ?>  required />

				Religi&oacute;n Evang&eacute;lica<br />
				<input type="radio" name="religion1b" value="Cultura Científica"
					style="margin: 2px 2px"
		<? if($religion1b == 'Cultura Científica'){echo "checked";} ?>  required />
				Cultura Científica<br />
				<input type="radio" name="religion1b" value="Valores Éticos"
					style="margin: 2px 2px"
		<? if($religion1b == 'Valores Éticos'){echo "checked";} ?>  required />
				Educación para la Ciudadanía y los Derechos Humanos </td>
			</tr>
		</table>
			
			</td>
			
		</tr>

				<tr>
	<td style="background-color: #eee;" colspan="3">
	<strong>Modalidades y Optativas de 1º Bachillerato</strong>
	</td>
</tr>






		<td colspan='3'>
		<table class="table table-bordered" style="width:100%">	

		<tr>
		<?php foreach ($it1 as $n_it1=>$itiner1){ ?>
			<td style="width:25%" <? if(stristr($vacios,"modalidad de 1º")==TRUE){echo 'style="background-color:#FFFF66;"';}?>>
			
			
			<label class="radio"> <input required type="radio" name="mod1" value="<?php echo $n_it1; ?>" <?php echo ($itinerario1 == $n_it1) ? 'checked' : ''; ?> /><strong><?php echo $itiner1; ?></strong></label>
			
			
			</td>
			<?php } ?>
		</tr>
		<tr>
		<?php for ($i = 1; $i <= 3; $i++){ ?>
		
		<?php if ($i<3) {?>
                <td style="width:25%;">
		<? if ($i==1) { echo "<p>Matemáticas<br>Física y Química<br>Dibujo Técnico</p>";}elseif($i==2){echo "<p>Matemáticas<br>Física y Química<br>Biología y Geología</p>";}?>
		<select class="input input-xlarge" name="optativa1<?echo $i;?>" <? if(stristr($vacios,"optativas de modalidad de 1B")==TRUE and $mod1 == $i){echo 'style="background-color:#FFFF66;"';}?>>
		<option></option>
		<?php foreach (${opt1.$i} as $optit_1 => $nombre){ ?>
				<option value="<?php echo $optit_1; ?>"
				<?php echo (isset($optativa1) && $optativa1 == $optit_1) ? 'selected' : ''; ?>><? echo $nombre; ?></option>

				
		<?php }?>
		</select>
		</td>		
		<?php } else {?>
		<td colspan="2" style="width:50%;">

		<p>Historia del Mundo Contemporáneo</p>	
		<select class="input input-xxlarge" name="optativa13"<? if(stristr($vacios,"optativas de modalidad de 1B")==TRUE and $mod1 > 2){echo 'style="background-color:#FFFF66;"';}?>>
		<?php foreach (${opt1.$i} as $optit_1 => $nombre){ ?> ?>		

				<option value="<?php echo $optit_1; ?>"
				<?php echo (isset($optativa1) && $optativa1 == $optit_1) ? 'selected' : ''; ?>><? echo $nombre; ?></option>
				<?php }?>
				</select>
		</td>
		
		<?php }?>
		<?php }?>
		</tr>
		</table>
		</td>
		</tr>



				<?
			}
	}


	?>

<!-- BILINGÜISMO -->
	<?php if(substr($curso, 0, 1) < 2): ?>
<tr>
	<td colspan="3">
	<div class="form-group">
	<div class="checkbox"><label> <input type="checkbox" name="bilinguismo"
		value="Si" <? if($bilinguismo == 'Si'){echo "checked";} ?>> El
	alumno/a solicita participar en el programa de bilingüismo (Inglés) </label></div>
	</div>
	</td>
</tr>
	<? endif; ?>
	
<!-- ENFERMEDADES -->
<tr>
	<th style="background-color:#eee" colspan="3">ENFERMEDADES DEL ALUMNO
	</th>
</tr>
<tr>
	<td colspan="2" style="border-top: 0;">
	<p class="help-block"><small> Señalar si el alumno tiene alguna
	enfermedad que es importante que el Centro conozca por poder afectar a
	la vida académica del alumno.</small></p>

	<label for="enfermedad">Enfermedades del Alumno</label> <select
		class="form-control" id="enfermedad" name="enfermedad"
		onChange="dimeEnfermedad()">
		<option value=""></option>
		<?php for ($i = 0; $i < count($enfermedades); $i++): ?>
		<option value="<?php echo $enfermedades[$i]['id']; ?>"
		<?php echo (isset($enfermedad) && $enfermedad == $enfermedades[$i]['id']) ? 'selected' : ''; ?>><?php echo $enfermedades[$i]['nombre']; ?></option>
		<?php endfor; ?>
	</select> &nbsp;&nbsp;&nbsp;&nbsp; <input style="<?  if ($enfermedad == 'Otra enfermedad') {	echo "visibility:visible;";}else{	echo "visibility:hidden;background-color:#eec;";}?>" id = "otraenfermedad" name="otraenfermedad" <? if(!($otraenfermedad == 'Escribe aquí el nombre de la enfermedad')){echo "value = \"$otraenfermedad\"";} ?>type="text" class="input-xlarge" placeholder="Escribe aquí el nombre de la enfermedad" onClick="borrar()" />
	</td>
	<td style="border-top: 0;">
			<p class="help-block"><small>
			Señalar si el alumno procede de padres divorciados y cual es la situación legal de la Guarda y Custodia respecto al mismo.</small></p>
			<label for="divorcio">Alumno con padres divorciados</label>					 
			<select
				class="input input-xlarge" id="divorcio" name="divorcio">
			<option value=""></option>	
				<?php for ($i = 0; $i < count($divorciados); $i++): ?>
				<option value="<?php echo $divorciados[$i]['id']; ?>"
				<?php echo (isset($divorcio) && $divorcio == $divorciados[$i]['id']) ? 'selected' : ''; ?>><?php echo $divorciados[$i]['nombre']; ?></option>
				<?php endfor; ?>
			</select>
			</td>
</tr>

<!-- FOTO -->
<tr>
<th style="background-color:#eee" colspan="3">FOTOGRAFÍA DEL ALUMNO
	</th>
</tr>
<tr>
	<td colspan="3" style="border-top: 0;">
	<p class="help-block"><small> Desmarcar si la familia tiene algún
	inconveniente en que se publiquen en nuestra web fotografías del alumno
	por motivos educativos (Actividades Complementarias y Extraescolares,
	etc.)</small></p>
	<div class="checkbox"><label for="foto"> <? if ($foto==1 or $foto=="") { $extra_foto = "checked";	} else {$extra_foto="";} ?>
	<input type="checkbox" name="foto" id="foto" value="1"
	<? echo $extra_foto;?>> Foto del Alumno </label></div>
	</td>
</tr>

<!-- OBSERVACIONES -->
<tr>
	<td valign=top colspan="3"><strong>OBSERVACIONES</strong>: <br />
	Indique aquellas cuestiones que considere sean importantes para
	conocimiento del Centro <br />
	<textarea name="observaciones" id="textarea" rows="5"
		style="width: 98%" onKeyDown="contar('form1','observaciones')"
		onkeyup="contar('form1','observaciones')"><? echo $observaciones; ?></textarea>
	</td>
</tr>

<tr>
	<td colspan="3" style="border-bottom: none">

	<center>
	<input type="hidden" name="curso" value="<? echo $curso;?>" /> <input
		type="hidden" name="nuevo" value="<? echo $nuevo;?>" /> <input
		type="hidden" name="curso_matricula"
		value="<? echo $curso_matricula;?>" /> <input type="hidden"
		name="claveal" <? echo "value = \"$claveal\""; ?> /> <input
		type="hidden" name="repetidor" value="<? echo $repetidor;?>" /> 
		<?
		if (date('m')=='06' and (date('d')>'01' and date('d')<'19')) {
			echo '<input type=hidden name="enviar" value="Enviar los datos de la Matrícula" />';
			echo '<input type=button onClick="confirmacion();" value="Enviar los datos de la Matrícula" class="no_imprimir btn btn-primary btn-large" />';
		}
		?> <br />
	</center>
	</td>
</tr>
</form>
</table>

		<?
}
?>
<br />

<?php include("../pie.php"); ?>
