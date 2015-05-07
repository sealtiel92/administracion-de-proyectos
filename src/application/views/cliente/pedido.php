
<center>
<h1>pedido</h1>

<table align="center" cellspacing="20">
<th>Cantidad</th>
<th>Fecha de solicitud</th>
<th>Fecha de entrega</th>
<th>Descripcion</th>

<?php
	foreach($pedido as $row)
	{
		echo "<tr>";
		echo '<td>'.$row->cantidad.'</td>';
		echo '<td>'.$row->fechaI.'</td>';
		echo '<td>'.$row->fechaE.'</td>';
		echo '<td width="600">'.$row->desc.'</td>';
		echo "</tr>";
	}
?>
</table>

</center>

</body>
</html>