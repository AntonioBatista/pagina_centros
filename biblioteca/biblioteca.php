<? include("../conf_principal.php");?>
<? include "../cabecera.php"; ?>
<? include "../menu.php"; ?>

<div class="span9">
<br><h3 align='center'><i class='icon icon-folder-close'> </i> Consultas en los Fondos de la Biblioteca del Centro<br />
</h3>
<hr />
<div class="span10 offset1">
<div align="center">
<?
mysql_connect ($host, $user, $pass);
mysql_select_db ($db);

if (isset($_POST['autor'])) {
	$autor = $_POST['autor'];
}
elseif (isset($_GET['autor'])) {
	$autor = $_GET['autor'];
}

if (isset($_POST['titulo0'])) {
	$titulo0 = $_POST['titulo0'];
}
elseif (isset($_GET['titulo0'])) {
	$titulo0 = $_GET['titulo0'];
}

if (isset($_POST['editorial'])) {
	$editorial = $_POST['editorial'];
}
elseif (isset($_GET['editorial'])) {
	$editorial = $_GET['editorial'];
}

if (isset($_GET['idfondo'])) {
	$idfondo = $_GET['idfondo'];
}

$AUXSQL == "";
if  (TRIM($autor)=="")
{
	$AUXSQL .= " AND 1=1 ";
}
else
{
	$AUXSQL .= " and Autor like '%$autor%'";
}
if  (TRIM($titulo0)=="")
{
	$AUXSQL .= " AND 1=1 ";
}
else
{
	$AUXSQL .= " and Titulo like '%$titulo0%'";
}
IF (TRIM($editorial)=="")
{
	$AUXSQL .= " AND 1=1 ";
}
else
{
	$AUXSQL .= " and Editorial like '%$editorial%'";
}

if(!(empty($idfondo)))
{
	echo "<legend>Datos del volumen seleccionado</legend><br>";

	$informe = "select  id, Autor, Titulo, Editorial, ISBN, tipoEjemplar, anoEdicion, extension, serie, ubicacion, LugarEdicion from biblioteca where id = '$idfondo'";
	//echo $informe;
	$sqlinforme = mysql_query($informe);
	if($rowinforme = mysql_fetch_array($sqlinforme))
	{
		$id = $rowinforme[0];
		$autor0 = $rowinforme[1];
		$tituloa = $rowinforme[2];
		$editorial0 = $rowinforme[3];
		$isbn = $rowinforme[4];
		$tipofondo = $rowinforme[5];
		$anoedicion = $rowinforme[6];
		$extension = $rowinforme[7];
		$serie = $rowinforme[8];
		$LugarEdicion = $rowinforme[10];
		$ubicacion = $rowinforme[9];
		$numero = "select id from biblioteca where Titulo = '$titulo0' and Autor = '$autor'";
		$numero1 = mysql_query($numero);
		$numero2 = mysql_num_rows($numero1);
		$ejemplares = $numero2;
		echo "<table class='table table-striped table-bordered'>
  <tr>
    <td>T&Iacute;TULO: <span class='text-info'>$tituloa</span></td>
      <td>AUTOR: <span class='text-info'>$autor0</span></td>
    </tr>
  <tr>
    <td>EDITORIAL: <span class='text-info'>$editorial0</span></td>
      <td>ISBN: <span class='text-info'>$isbn</span></td>
    </tr>
    
  <tr>
    <td>TIPO DE FONDO: <span class='text-info'>$tipofondo</span></td>
      <td>AÑO DE EDICI&Oacute;N: <span class='text-info'>$anoedicion</span></td>
    </tr>
    
      <tr>
    <td>P&Aacute;GINAS: <span class='text-info'>$extension</span></td>
      <td>UBICACI&Oacute;N: <span class='text-info'>$ubicacion </span></td>
    </tr>
      <tr>
    <td>N&Uacute;MERO DE EJEMPLARES: <span class='text-info'>$ejemplares</span></td>
      <td>LUGAR DE EDICI&Oacute;N: <span class='text-info'>$LugarEdicion </span></td>
    </tr>
        
  </table><hr />";
	}
}

if (!($autor == "" and $titulo0 == "" and $editorial == "")) {
	$result = mysql_query("select id, Autor, Titulo, Editorial from biblioteca where 1 " . $AUXSQL . " order by Autor asc");
	if (mysql_num_rows($result) > 0) {
		print "<legend>B�squeda de Libros en la Biblioteca</legend><br>";
		echo "<table class='table table-striped table-bordered'>";
		echo "<thead><th>Autor</th><th>T��tulo</th><th>Editorial</th><th></th></thead><tbody>";

		while($row = mysql_fetch_array($result))
		{
			$id = $row[0];
			$autor2 = $row[1];
			$titulo2 = $row[2];
			$editorial2 = $row[3];
			if(substr($row[3],0,1) == ":")
			{
				$limpia = explode(":",$editorial2);
				$editorial2 = $limpia[1];
			}
			// echo $dospuntos;
			$limpia = explode(":",$row[3]);
			printf ("<tr><td class='text-success'>%s</td><td>%s</td><td>%s</td><td><a href='biblioteca.php?idfondo=$id&autor=$autor&titulo0=$titulo0&editorial=$editorial'  rel='Tooltip' title='Ver detalles del volumen'><span class='icon icon-search icon-large'></span></a></td></tr>", $row[1], $row[2], $row[3]);
		}
		echo "</table>";
	}
	else {
		echo ' <br /><div class="alert alert-warning"><h4>Problema en la Consulta de Fondos.</h4>Parece que ning�n volumen de los Fondos de la Biblioteca
	responde a tu criterio de b�squeda, bien porque no existe el texto o bien porque no ha sido a�n registrado. Puedes volver atr�s e intentarlo de nuevo</div><br />';
	}
}

else {
	echo ' <br /><div class="alert alert-warning"><h4>Problema en la Consulta de Fondos.</h4>Debes escribir alg�n dato en los campos "<em>Autor</em>", "<em>T��tulo</em>" o "<em>Editorial</em>" del formulario de la p�gina anterior. Vuelve atr�s e int�ntalo de nuevo rellenando alg�n campo del formulario.</div><br />';
}
?>

<div class="hidden-print"><a href="#" class="btn btn-primary"
	onclick="javascript:print();">Imprimir</a> <a href="index.php"
	class="btn btn-info">Realizar otra consulta</a></div>
</div>
</div>
</div>
<? include "../pie.php"; ?>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
</script>
