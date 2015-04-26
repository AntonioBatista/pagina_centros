<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/notas.dwt" codeOutsideHTMLIsLocked="false" -->
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
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<div class="contenedor">

	    <div class="cabecera">    
    <a href="http://iesmonterroso.org"><div id="logo"></div></a>
    <a href="http://iesmonterroso.org"><div id="monterroso"></div></a>
    <a href="http://www.juntadeandalucia.es" target="_blank"><div id="junta"></div></a>
    <?
    include("http://iesmonterroso.org/menucabecera.html");
    ?>
	</div>

	<div class="central">
	<?php  include("control.php");	?>		               
		<div class="menunotas" style="margin-top:0px;">
        <? include("consultas.php");?>
        </div>
        
            <div class="cuerponotas">

<!-- InstanceBeginEditable name="EditRegion3" -->
	
	
    <?
  while( $dato = mysql_fetch_row($alumno1))
     {
$todosdatos = "$dato[1] $dato[0]";
$curso = $dato[2].$dato[3];
   echo "<div class='subtitulogeneral' style='margin-bottom:6px;margin-top:0px;'>$todosdatos</div><div align=center style='color:#555;font-weight:normal;'>$dato[4]</div>";
   echo "<span class='titulogeneralsin'>Actividades Complementarias y Extraescolares del Grupo $dato[2]-$dato[3]</span>";
	?>
	
    <?
  $datos0 = "select * from actividades where grupos like '%$curso%'";
  $datos1 = mysql_query($datos0);
  while($datos = mysql_fetch_array($datos1))
  {
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
    <div align="center"><table class="tabla" width="600px" style="margin-top:3px;">
      <tr>
        <td id="filaprincipal" colspan="2"><? echo $datos[2];?></td>
    </tr>
      <tr>
        <td width="18%"  id="filasecundaria">Grupos</td><td><div align="left"><? echo $grupos0;?></div></td>
    </tr>
      <tr>
        <td width="18%" height="25" id="filasecundaria">Descripción</td><td><div align="left"><? echo $datos[3];?></div></td>
    </tr>
      <tr>
        <td width="18%" height="25" id="filasecundaria">Departamento</td><td><div align="left"><? echo $datos[4];?></div></td>
    </tr>
      <tr>
        <td width="18%" height="25" id="filasecundaria">Profesor</td><td><div align="left"><? echo $datos[5];?></div></td>
    </tr>
      <tr>
        <td width="18%" height="25" id="filasecundaria">Horario</td><td><div align="left"><? echo $datos[6];?></div></td>
    </tr>
      <tr>
        <td width="18%" height="25" id="filasecundaria">Fecha</td><td><div align="left"><? echo $fecha;?></div></td>
    </tr>
      
      <tr>
        <td width="18%" height="25" id="filasecundaria">Información</td><td><div align="left"><? echo $datos[10];?></div></td>
    </tr>
      
  </table>
    </div>
    <?
 }}  
?>


	<!-- InstanceEndEditable -->
    
    		</div>
   </div><!-- Central -->
</div><!-- Contenedor -->
</body>
<!-- InstanceEnd --></html>
