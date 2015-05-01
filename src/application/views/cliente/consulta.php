<!DOCTYPE html>
<html>
<head>
	<title><?= $title?></title>
</head>
<body>
<center>
<h1>Consulta</h1>
</center>

<table align="center" cellspacing="20">
<th>Nombre</th>
<th>tipo</th>
<th>talla</th>
<th>marca</th>
<th>cantidad</th>
<th>color</th>
<th></th>
<?php
	foreach($productos as $row)
	{
		echo "<tr>";
		echo '<td>'.$row->nombre.'</td>';
		echo '<td>'.$row->tipo.'</td>';
		echo '<td>'.$row->talla.'</td>';
		echo '<td>'.$row->marca.'</td>';
		echo '<td>'.$row->cantidad.'</td>';
		echo '<td>'.$row->color.'</td>';
		echo '<td> <a href="'.base_url().'cliente/pedido/'.$row->idproducto.'"> pedir </a></td>';
		echo "</tr>";
	}
?>
</table>

</body>
</html>