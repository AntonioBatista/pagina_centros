<!DOCTYPE html>
<html>
  <head>
    <title><? echo $nombre_del_centro;?>
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META name="Author" content="Miguel A. García">
    <META name="keywords" content="insituto,<? echo $nombre_del_centro;?>,andalucia,linux,smeserver,tic">
<title>Páginas del I.E.S. Monterroso</title>
<link rel="stylesheet" href="http://<? echo $dominio;?>css/<? echo $css_estilo; ?>">
<link rel="stylesheet" href="http://<? echo $dominio;?>css/bootstrap_personal.css">
<link href="http://<? echo $dominio;?>css/bootstrap-responsive.min.css" rel="stylesheet"> 
<link rel="stylesheet" href="http://<? echo $dominio;?>font-awesome/css/font-awesome.min.css">
</head>
<body>
  <?
$activo1="";
$activo2="";
$activo3="";
if (strstr($_SERVER['REQUEST_URI'],'index.php')==TRUE) {$activo1 = ' class="active" ';}
elseif (strstr($_SERVER['REQUEST_URI'],'notas')==TRUE){ $activo2 = ' class="active" ';}
elseif (strstr($_SERVER['REQUEST_URI'],'doc')==TRUE){ $activo3 = ' class="active" ';}
include("conf_principal.php");
?>
<div class="navbar hidden-print">
  <div class="navbar-inner" style="padding-left:0px">
      <img src="http://<? echo $dominio;?>logo.gif" class="img-polaroid img-rounded pull-left"  width="60" style="margin:5px;margin-right:30px;padding:3px;background-color:#fafafa"/>
		    <div class="container-fluid">
		      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>
		      <a class="brand" href="http://<? echo $dominio;?>"><? echo $nombre_del_centro;?></a>
		      <div class="nav-collapse collapse">
		        <ul class="nav">
  		  <li <? echo $activo1;?>> <a href="http://<? echo $dominio;?>index.php">Inicio</a></li>
          <li <? echo $activo2;?>><a href="http://<? echo $dominio;?>notas/">Acceso para Alumnos</a></li>
          <li <? echo $activo3;?>><a href="http://<? echo $dominio;?>doc">Documentos</a></li>
 		  <? if ($moodle==1) { ?>
 		  <li><a href="<? echo $enlace_moodle;?>">Moodle</a></li>
 		  <? } ?>
		        </ul>
<? if (strstr($_SERVER['REQUEST_URI'],'index.php')==TRUE) {
?>
                      <form class="form-search navbar-search pull-right"  action="http://www.google.com/custom" method="get">
    <input type="hidden" name="sitesearch" value="<? echo $dominio;?>" checked="checked" />                 
    <input type="hidden" name="cof" value="S:http://<? echo $dominio;?>;AH:center;L:ies.gif;AWFID:12e022daa787c23d;" />
    <input type="hidden" name="domains" value="<? echo $dominio;?>" />
    <div class="form-search">
      	<div class="input-append">
    <input type="text" class="" name="q" placeholder="Buscar en <? echo $nombre_del_centro;?>" onClick="this.value=''">
    <button type="submit" class="btn btn-success"><i class="icon icon-search"></i></button>
  		</div> 
  		</div>   
</form>
<? } ?>
		      </div>
		      </div>
		    </div>
		  </div>
		</div>
    </div>
  </div>
</div>


<div class="container-fluid">
<div class="row-fluid">
