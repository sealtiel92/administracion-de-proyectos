<html>
<head>
  <title><?= $title?></title>
  <meta charset="utf-8">
  <?= '<link rel="stylesheet" type="text/css" href="'.base_url().'application/css/style.css">' ?>
</head>
<body>
  <div id="panel">
    <ul class="botones">
      <?= '<li><a href="'.base_url().'cliente/index">Inicio</a></li>'?>
      <?= '<li><a href="'.base_url().'cliente/catalogo">catalogo</a>'?>
        
        <ul class="submenu">
          <?php foreach($producto as $row)
          {
            echo "<li>";
            echo '<a href="'.base_url().'cliente/catalogo/'.$row->idproducto.'">'.$row->nombre.'</a>';
            echo "</li>";
          } ?>
        </ul>

        </li>
      <?= '<li><a href="'.base_url().'cliente/compras">Compras</a></li>'?>
      <?= '<li><a href="'.base_url().'cliente/quienes">¿Quienes somos?</a></li>'?>
      <?= '<li><a href="'.base_url().'cliente/logout">Salir</a></li>'?>
    </ul>
  </div>
  <center>
<br><br><br>