<?
session_start();
include("../conf_principal.php");

if (isset($_POST['clave'])) {

// Se ha enviado la clave	
$clave = $_POST['clave'];
	
if ($_POST['primaria']==1) {
	$clave_al = $_POST['clave'];
}
else{
	$clave_al = $_POST['user'];
}
	$_SESSION['clave_al'] = $clave_al;
	mysql_connect ($host, $user, $pass);
	mysql_select_db ($db);
	$cod_sha = sha1($clave);
	$claveal_sha = sha1($clave_al);
		
	// Es un alumno de Primaria
	$al_primaria = "SELECT distinct APELLIDOS, NOMBRE, matriculas, edad, curso, claveal, unidad, dni, correo, colegio FROM alma_primaria WHERE dnitutor = '$clave_al' or dnitutor2 = '$clave_al' or claveal = '$clave_al'";
	//echo $al_primaria;
	$alum_primaria = mysql_query($al_primaria);
	$es_primaria = mysql_num_rows($alum_primaria);

// Es un alumno de Secundaria
	$al_secundaria = "SELECT distinct APELLIDOS, NOMBRE, matriculas, edad, curso, claveal, unidad, dni, correo, colegio FROM alma_secundaria WHERE dnitutor = '$clave_al' or dnitutor2 = '$clave_al' or claveal = '$clave_al'";
	//echo $al_secundaria;
	$alum_secundaria = mysql_query($al_secundaria);
	$es_secundaria = mysql_num_rows($alum_secundaria);

	$mes = date('m');
if ($es_primaria > 0 and $mes=='06') {
	include("../funciones.php");	
	$_SESSION['aut']="1";
	$datos = mysql_fetch_array($alum_primaria);	
	$_SESSION['esdeprimaria'] = "1";
	$_SESSION['matricula_nueva'] = "1";
	$_SESSION['todosdatos'] = "$datos[1] $datos[0]";
	$_SESSION['alumno'] =  "$datos[0], $datos[1]";
	$_SESSION['curso'] = $datos[4];
	$_SESSION['nivel'] = substr($_SESSION['curso'],0,8);
	$_SESSION['sen_nivel'] = $datos[4];
	$_SESSION['claveal'] = $datos[5];
	$_SESSION['clave_al'] = $datos[5];
	$_SESSION['unidad'] = $datos[6];
	$_SESSION['dni'] = $datos[7];
	$_SESSION['correo'] = $datos[8];
	$_SESSION['colegio'] = $datos[9];
	registraPagina($_SERVER['REQUEST_URI'],$clave_al);
	header('location:datos.php');
	exit();	
	}
	elseif ($es_secundaria > 0 and $mes=='06') {
	include("../funciones.php");	
	$_SESSION['aut']="1";
	$datos = mysql_fetch_array($alum_secundaria);	
	$_SESSION['esdesecundaria'] = "1";
	$_SESSION['matricula_nueva'] = "1";
	$_SESSION['todosdatos'] = "$datos[1] $datos[0]";
	$_SESSION['alumno'] =  "$datos[0], $datos[1]";
	$_SESSION['curso'] = $datos[4];
	$_SESSION['nivel'] = substr($_SESSION['curso'],0,8);
	$_SESSION['sen_nivel'] = $datos[4];
	$_SESSION['claveal'] = $datos[5];
	$_SESSION['clave_al'] = $datos[5];
	$_SESSION['unidad'] = $datos[6];
	$_SESSION['dni'] = $datos[7];
	$_SESSION['correo'] = $datos[8];
	$_SESSION['colegio'] = $datos[9];
	registraPagina($_SERVER['REQUEST_URI'],$clave_al);
	header('location:datos.php');
	exit();	
	}
	else
	{
	// Acceso del Administrador
	$adm = mysql_query("SELECT pass from c_profes where idea='admin'");
	$admi = mysql_fetch_array($adm);
	$pass_admin = $admi[0];

	// Se ha registrado anteriormente

	$alu0 = mysql_query("SELECT control.pass, control.claveal from control, alma WHERE control.claveal=alma.claveal and control.claveal = '$clave_al'");
	$n_pass=mysql_num_rows($alu0);
	$alu00 = mysql_fetch_array($alu0);
	$al1 = "SELECT distinct APELLIDOS, NOMBRE, domicilio, padre, curso, claveal, unidad, dni, correo FROM alma WHERE claveal = '$clave_al'";
	//echo $al1;
	$alumno1 = mysql_query($al1);
	$n_al = mysql_num_rows($alumno1);
	//echo $n_al;
	// Contrase�as coinciden: podemos entrar
	if ($alu00[0]===$cod_sha or $cod_sha==$pass_admin) {
	$_SESSION['aut']="1";
	$alum0 = mysql_fetch_array($alu0);

	$datos = mysql_fetch_row($alumno1);
	if (date('m')=='06') {
		$_SESSION['matricula_nueva'] = "1";
	}
	$_SESSION['todosdatos'] = "$datos[1] $datos[0]";
	$_SESSION['alumno'] =  "$datos[0], $datos[1]";
	$_SESSION['curso'] = $datos[4];
	$_SESSION['sen_nivel'] = $datos[4];
	$_SESSION['claveal'] = $datos[5];
	$_SESSION['unidad'] = $datos[6];
	$_SESSION['dni'] = $datos[7];
	$_SESSION['correo'] = $datos[8];
	$todosdatos = $_SESSION['todosdatos'];
	$alumno = $_SESSION['alumno'];
	$curso = $_SESSION['curso'];
	$sen_nivel = $_SESSION['sen_nivel'];
	$nivel = substr($_SESSION['curso'],0,8);
	$claveal = $_SESSION['claveal'];
	$unidad = $_SESSION['unidad'];
	$dni = $_SESSION['dni'];
	$correo = $_SESSION['correo'];
	//include 'datos.php';
	include("../funciones.php");
	registraPagina($_SERVER['REQUEST_URI'],$clave_al);
	header('location:datos.php');
	exit();
	}
	
	// Alumno del Centro y contrase�a mal escrita
	elseif ($n_pass>0 and $alu00[0]!==$cod_sha){
	session_start();
	
	include ("../cabecera.php");
	include ("../menu.php");
	echo '<div class="span9">
	<div class="span8 offset2">
	<div align="center">
	<h3>Acceso privado para los Alumnos del Centro.</h3>
	<hr />';

	echo "<br /><div class='alert alert-error' style='max-width:450px;margin:auto'><legend>Atenci&oacute;n:</legend><p>La <b>Clave del Alumno</b> que est�s escribiendo no es correcta. Vuelve atr�s e int�ntalo de nuevo.</p></div>";
			session_destroy ();
			exit;		
	}
	
	// No se ha registrado
	elseif ($n_al>0 and ($n_pass<>1 or ($cod_sha === $claveal_sha))) {
		// Comprobamos si es alumno del Centro
	$alu1 = mysql_query("SELECT claveal, apellidos, nombre, unidad, domicilio, padre, curso, dni, correo from alma WHERE claveal = '$clave_al'");
		// Si es alumno no registrado lo enviamos a la p�gina de regsitro
	$ya_al = mysql_fetch_array($alu1);
		if (date('m')=='06') {
		$_SESSION['matricula_nueva'] = "1";
		}
		$_SESSION['clave_al'] = $clave_al;
		$_SESSION['nombre'] = $ya_al[2];
		$_SESSION['apellidos'] = $ya_al[1];
		$_SESSION['unidad'] = $ya_al[3];
		$_SESSION['todosdatos'] = $_SESSION['nombre']." ". $_SESSION['apellidos'];
		$_SESSION['alumno'] = $ya_al[1].", ". $ya_al[2];
		$_SESSION['sen_nivel'] = $ya_al[6];
		$_SESSION['curso'] = $ya_al[6];
		$_SESSION['dni'] = $ya_al[7];
		$_SESSION['correo'] = $ya_al[8];
		$todosdatos = $_SESSION['todosdatos'];
		$alumno = $_SESSION['alumno'];
		$curso = $_SESSION['curso'];
		$sen_nivel = $_SESSION['sen_nivel'];
		$claveal = $_SESSION['claveal'];
		$unidad = $_SESSION['unidad'];
		$dni = $_SESSION['dni'];
		$correo = $_SESSION['correo'];
		include ("clave.php");
		exit ();
		}

		// No es alumno del Centro o no conoce claveal
		elseif (mysql_num_rows($alu0)==0 and $n_al==0)  {
			session_start();
			include ("../cabecera.php");
			include ("../menu.php");
			echo '<div class="span9">
<div class="span8 offset2">
<div align="center">
<h3>Acceso privado para los Alumnos del Centro.</h3>
<hr />';
			echo "<br /><div class='alert alert-error' style='max-width:450px;margin:auto'><legend>Atenci&oacute;n:</legend><p>Debes introducir una <b>Clave del Centro</b> v�lida para entrar en estas p�ginas. Si eres alumno de este Centro, <em>debes conseguir tu clave de acceso a trav�s del Tutor, Administraci�n o Jefatura de Estudios del Centro</em> para poder entrar en estas p�ginas</p></div>";
			session_destroy ();
			exit;
		}
	}
}
?>


