
<center>
<h1>pedido</h1>
<div class="tablaPedidos">
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
</table>
</div>
</center>

</body>
</html>