<html>
<head>
<center>
<h1>Pedidos</h1>
<div class="tablaPedidos">
<link rel="stylesheet" href="style.css">
</div>
<body>

<table class="tabla"> 
<tr>
<td>Cantidad</td>
<td>Fecha de solicitud</td>
<td>Fecha de entrega</td>
<td>Descripción</td>
</tr>

<tr>
<td>1</td>
<td>Jueves</td>
<td>Lunes</td>
<td>Poco</td>	
</tr>

<tr>
<td>2</td>
<td>Martes</td>
<td>Viernes</td>
<td>Poco</td>	
</tr>

<tr>
<td>3</td>
<td>Viernes</td>
<td>Domingo</td>
<td>Mucho</td>	
</tr>
</table>
<?php


	if($pedido != null)
	{
		echo '<table align="center" cellspacing="20" class="table table-bordered">';
		echo "<th class='info'>Cantidad</th>";
		echo "<th class='info'>Fecha de solicitud</th>";
		echo "<th class='info'>Fecha de entrega</th>";
		echo "<th class='info'>Descripcion</th>";
		
		foreach($pedido as $row)
		{
		echo "<tr>";
		echo '<td>'.$row->cant.'</td>';
		echo '<td>'.$row->fechaI.'</td>';
		echo '<td>'.$row->fechaE.'</td>';
		echo '<td width="600">'.$row->desc.'</td>';
		echo "</tr>";
		}
	}else
	{
		echo "<br><br><br><h2>No hay pedidos</h2>";
	}

?>

</center>
<footer id="piePagina">
	<br>COPYRIGHT 2015. TODOS LOS DERECHOS RESERVADOS.</br>
</footer>
</body>
</html>
