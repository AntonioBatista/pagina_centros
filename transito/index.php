<? include_once("../conf_principal.php");?>
<?  include("../cabecera.php"); ?>
<?  include("../menu.php"); ?>
<? include("../funciones.php"); ?>
<div class="span9">
<div class="span10 offset1">
            <div align="center">
           <br>
           <h3><i class='icon icon-lock'> </i> Informe de Tránsito para Alumnos de Primaria.</h3>
            <br /><br />
<div class="well well-large" style="width:450px; margin:auto; text-align:center">
<form action="control.php" method="post" align="center" class="form-signin" name="form1">
<label for="user"><h2 align="left"><small>Selecciona Colegio </h2></small></label>
<select id="user" name="user" class="input-block-level input-large" required />
<option></option>option>
<?
	mysql_connect ($host, $user, $pass);
	mysql_select_db ($db);		

	$al_primaria = "SELECT distinct colegio FROM transito_control order by colegio";
	$alum_primaria = mysql_query($al_primaria);
	while ($cole=mysql_fetch_array($alum_primaria)) {
		echo "<option>$cole[0]</option>";
	}
?>
</select>

<label for="clave"><h2 align="left"><small>Clave del Colegio </small><input id="clave" type="password" name="clave" class="input-block-level input-large" required /></h2></label>
<br />
<button type="submit" name="submit" value="Entrar" class="btn btn-large btn-primary btn-block"><i class="icon icon-signin icon-white icon-large"></i> &nbsp;Entrar</button>
</form>
</div>
<br />
</div>
</div>                                                 
</div>
 <? include("../pie.php"); ?>

