 	
<center>
<h1>Consulta</h1>
<div class="tablaProductos">
<table align="center" cellspacing="20" class="table table-bordered">
<th class="info">Pedir</th>
<th class="info">Nombre</th>
<th class="info">Tipo</th>
<th class="info">Talla</th>
<th class="info">Marca</th>
<th class="info">Existencias</th>
<th class="info">Color</th>
<?php echo form_open("cliente/compras");?>

<?php
if (!empty($productos))
{
	session_start();
$i=0;
$arr=[];
	foreach($productos as $row)
	{
		echo "<tr>";
		echo '<td>'.form_checkbox("check{$i}", 'accept', false).'</td>';
		echo '<td>'.$row->nombre.'</td>';
		echo '<td>'.$row->tipo.'</td>';
		echo '<td>'.$row->talla.'</td>';
		echo '<td>'.$row->marca.'</td>';
		echo '<td>'.$row->cantidad.'</td>';
		echo '<td>'.$row->color.'</td>';
		echo "</tr>";
		array_push($arr,$row->idproducto);
		$i++;
	}
	$_SESSION["array"] = $arr;
	$_SESSION["max"] = $i;  
}


?>

</table>
</div>
<p><?//php echo form_submit('submit', ' pedir ');?></p>
<button class="btn btn-info" type="submit"><strong>Pedir</strong></button>
<?php echo form_close();?>
</center>
</body>
</html>