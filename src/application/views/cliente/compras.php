

<h1>Compras</h1>
<center>
<?= form_open("cliente/pedido");?>

<?php 
if(!empty($productos))
{
echo "<div class='tablaProductos'>";
echo "<table align='center' cellspacing='20' class='table table-bordered'>";
echo "<th class='info'>Articulo</th>";
echo "<th class='info'>Tipo</th>";
echo "<th class='info'>Talla</th>";
echo "<th class='info'>Marca</th>";
echo "<th class='info'>Color</th>";
echo "<th class='info'>Cantidad</th>";
	foreach ($productos as $row) {
		echo "<tr>";
		echo '<td>'.$row->nombre.'</td>';
		echo '<td>'.$row->tipo.'</td>';
		echo '<td>'.$row->talla.'</td>';
		echo '<td>'.$row->marca.'</td>';
		echo '<td>'.$row->color.'</td>';
		echo "<td>".form_input()."</td>";
		echo "</tr>";
	}



}else{
	echo "<br><br><br><h3>No solicito nada</h3>";
}

?>
</table>
</div>
<?php
if(!empty($productos))
echo "<button class='btn btn-info' type='submit'><strong>Pedir</strong></button>";
?>

<?= form_close();?>

</center>
</body>
</html>