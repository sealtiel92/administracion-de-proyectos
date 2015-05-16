

<h1>Compras</h1>
<center>
<script type="text/javascript" src="<?=base_url()?>application/css/validation.js"></script>

<?php	$data = array('onsubmit' => 'return validation('.$_SESSION["max"].');');?>

<?= form_open("cliente/nuevopedido",$data);?>
<div id="infoMessage"><?php echo $message;?></div>
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
echo "<th class='info'>Descripcion</th>";

 $data = array(
          'name'        => 'username',
          'id'          => 'username',
          'class'       => 'username',
          'value'       => 'username',
        );

$i=0;
$ids = array();
	foreach ($productos as $row) {
		$cant = "txtcant".$i;
		$desc = "txtdesc".$i;
		echo "<tr>";
		echo '<td>'.$row->nombre.'</td>';
		echo '<td>'.$row->tipo.'</td>';
		echo '<td>'.$row->talla.'</td>';
		echo '<td>'.$row->marca.'</td>';
		echo '<td>'.$row->color.'</td>';
		echo "<td > <input name='$cant' type='number' id='$cant' min='1' max='1000'></td>";
		echo '<td>'.form_textarea(array('name' => $desc,'id'=> $desc)).'</td>';
		echo '</tr>';
		array_push($ids, $row->idproducto);
		$i++;
	}

$_SESSION["max"] = $i;
$_SESSION["ids"] = $ids;

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