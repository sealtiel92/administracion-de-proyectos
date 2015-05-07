
<center>
<h1>Consulta</h1>

<table align="center" cellspacing="20">
<th></th>
<th>Nombre</th>
<th>tipo</th>
<th>talla</th>
<th>marca</th>
<th>existencias</th>
<th>color</th>
<?php echo form_open("cliente/compras");?>

<?php
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
		echo '<td>'.$row->existencias.'</td>';
		echo '<td>'.$row->color.'</td>';
		echo "</tr>";
		$arr[$i] = $row->idproducto;
		echo "$arr[$i]";
		$i++;
	}
?>

</table>
<p><?php echo form_submit('submit', ' pedir ');?></p>

<?php echo form_close();?>
</center>
</body>
</html>