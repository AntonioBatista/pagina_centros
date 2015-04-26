<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <META name="Author" content="Miguel A. García">
    <META name="keywords" content="insituto,monterroso,estepona,andalucia,linux,smeserver,tic">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Páginas del I.E.S. Monterroso</title>
<!-- InstanceEndEditable -->
<link href="http://iesmonterroso.org/estilo.css" rel="stylesheet" type="text/css" media="screen" />
<link href="http://iesmonterroso.org/esquema.css" rel="stylesheet" type="text/css" media="screen" />
  <link rel="alternate" type="application/rss+xml" title="Noticias y Novedades en IES Monterroso" href="http://iesmonterroso.org/rss/novedades.rss">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="http://iesmonterroso.org/favicon.png" type="image/png">
  <link rel="shortcut icon" href="http://iesmonterroso.org/favicon.ico" type="image/x-icon">
  <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<div class="contenedor">
	    <div class="cabecera">    
    <a href="http://iesmonterroso.org"><div id="logo"></div></a>
    <a href="http://iesmonterroso.org"><div id="monterroso"></div></a>
    <a href="http://www.juntadeandalucia.es" target="_blank"><div id="junta"></div></a>
    <?
    include("http://192.168.0.2/menucabecera.html");
    ?>
	</div>
	<div class="central">		           
        <div class="plantilla"	
>
	<!-- InstanceBeginEditable name="EditRegion3" -->
  <div align="center" style="width:740px;margin:auto;">
 <div class="titulogeneral" style="margin-bottom:10px;margin-top:35px;">Actividades Extraescolares en este Curso Escolar</div> <span style="color:#555555; font-size:11px; font-weight:normal; font-family: Arial, Helvetica, sans-serif; letter-spacing:0px; display:block">(Las Fechas son aproximada. Pueden variar en funcion de la Actividad, o bien si la misma se realiza fuera del Centro.)</span></br>
</div>
  <?
  include("/opt/e-smith/conf_principal.php");
  mysql_connect ($hostname, $user, $pass);
  mysql_select_db ($db);
  
   
 if($detalles == '1')
  {
  ?>
  
  <?
  $datos0 = "select * from actividades where id = '$id'";
  $datos1 = mysql_query($datos0);
  $datos = mysql_fetch_array($datos1);
  $fecha0 = explode("-",$datos[7]);
  $fecha = "$fecha0[2]-$fecha0[1]-$fecha0[0]";
  $fecha1 = explode("-",$datos[8]);
  $registro = "$fecha1[2]-$fecha1[1]-$fecha1[0]";
  if(strlen($datos[1]) > 96){
$gr1 = substr($datos[1],0,48)."<br>";
$gr2 = substr($datos[1],48,48)."<br>";
$gr3 = substr($datos[1],96)."<br>";
$grupos = $gr1.$gr2.$gr3;
$grupos0 =  substr($grupos,0,strlen($grupos)-5);
}

elseif(strlen($datos[1]) > 48 and strlen($datos[1]) < 96){
$gr1 = substr($datos[1],0,48)."<br>";
$gr2 = substr($datos[1],48,96)."<br>";
$grupos = $gr1.$gr2;
$grupos0 =  substr($grupos,0,strlen($grupos)-5);

}
elseif(strlen($datos[1]) < 50){
$gr1 = substr($datos[1],0,50)."<br>";
$grupos = $gr1;
$grupos0 =  substr($grupos,0,strlen($grupos)-5);
}
  ?>
<div align="center"><table class="tabla" style="width:450px;;">
  <tr>
   <td id="filaprincipal" style="text-align:center" colspan="2"><? echo $datos[2];?></td>
  </tr>
  <tr>
    <td id="filasecundaria">Grupos</td><td bgcolor="#FFFFFF"><? echo $grupos0;?></td>
  </tr>
  <tr>
    <td id="filasecundaria">Descripción</td><td bgcolor="#FFFFFF"><? echo $datos[3];?></td>
  </tr>
  <tr>
    <td id="filasecundaria">Departamento</td><td bgcolor="#FFFFFF"><? echo $datos[4];?></td>
  </tr>
  <tr>
    <td id="filasecundaria">Profesor</td><td bgcolor="#FFFFFF"><? echo $datos[5];?></td>
  </tr>
  <tr>
    <td id="filasecundaria">Horario</td><td bgcolor="#FFFFFF"><? echo $datos[6];?></td>
  </tr>
  <tr>
    <td id="filasecundaria">Fecha</td><td bgcolor="#FFFFFF"><? echo $fecha;?></td>
  </tr>

      <tr>
    <td id="filasecundaria">Información</td><td bgcolor="#FFFFFF"><? echo $datos[10];?></td>
  </tr>

</table></div>
  <?
 } 
?>
 <br />
<table class="tabla" style="width:650px;margin:auto;">
  <tr>
    <td id="filaprincipal">Actividad</td>
    <td id="filaprincipal">Grupos</td>
    <td id="filaprincipal">Departamento</td>
    <td width="115" id="filaprincipal">Fecha</td>
    <td id="filaprincipal"></td>

  </tr>
<?
$meses = "select distinct month(fecha) from actividades order by fecha";
$meses0 = mysql_query($meses);
while ($mes = mysql_fetch_array($meses0))
{
$mes1 = $mes[0];
 echo "<tr>
  <td bgcolor=#FFFFFF colspan=5 height=20 style='background-color: #eeeccc;color:#C46200;padding:5px;font-weight:normal;'>";
  echo "<div align=center>";
  if($mes1 ==  "01") $mes2 = "Enero";
  if($mes1 ==  "02") $mes2 = "Febrero";
  if($mes1 ==  "03") $mes2 = "Marzo";
  if($mes1 ==  "04") $mes2 = "Abril";
  if($mes1 ==  "05") $mes2 = "Mayo";
  if($mes1 ==  "06") $mes2 = "Junio";
  if($mes1 ==  "09") $mes2 = "Septiembre";
  if($mes1 ==  "10") $mes2 = "Octubre";
  if($mes1 ==  "11") $mes2 = "Noviembre";
  if($mes1 ==  "12") $mes2 = "Diciembre";
   echo "$mes2";
 echo "</td>
  </tr>";
  echo "</div>";
$datos0 = "select * from actividades where month(fecha) = '$mes1' order by fecha";
  $datos1 = mysql_query($datos0);
while($datos = mysql_fetch_array($datos1))
{
if(strlen($datos[1]) > 96){
$gr1 = substr($datos[1],0,48)."<br>";
$gr2 = substr($datos[1],48,48)."<br>";
$gr3 = substr($datos[1],96)."<br>";
$grupos = $gr1.$gr2.$gr3;
$grupos0 =  substr($grupos,0,strlen($grupos)-5);
}

elseif(strlen($datos[1]) > 48 and strlen($datos[1]) < 96){
$gr1 = substr($datos[1],0,48)."<br>";
$gr2 = substr($datos[1],48,96)."<br>";
$grupos = $gr1.$gr2;
$grupos0 =  substr($grupos,0,strlen($grupos)-5);

}
elseif(strlen($datos[1]) < 50){
$gr1 = substr($datos[1],0,50)."<br>";
$grupos = $gr1;
$grupos0 =  substr($grupos,0,strlen($grupos)-5);
}
$fecha0 = explode("-",$datos[7]);
$fecha = "$fecha0[2]-$fecha0[1]-$fecha0[0]";
?>
  <tr>
    <td bgcolor="#FFFFFF" style="color:#333; font-size:11px; background-color:#f1f5fa; width:300px;"><? echo $datos[2];?></td>
    <td bgcolor="#FFFFFF" width="33%"><? echo $grupos0;?></td>
    <td bgcolor="#FFFFFF"><? echo $datos[4];?></td>
    <td width="115" bgcolor="#FFFFFF"><? echo $fecha;?></td>

    <td valign="middle"  class="titulomenu" style="padding:5px;"><a href="index.php?id=<? echo $datos[0];?>&amp;detalles=1"><img src='../imag/buscar.gif' title='Detalles'></a>
    </td>
  </tr>
<? }}?>
</table>

  <!-- InstanceEndEditable -->
		</div><!-- Plantilla -->
        
        	<div class="menu"> 
<?
include('http://192.168.0.2/menu.html');
?>
		</div><!-- Menu -->

   </div><!-- Central -->
</div><!-- Contenedor -->
</body>
<!-- InstanceEnd --></html>
