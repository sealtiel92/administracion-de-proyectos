<html>
<head>
  <title><?= $title?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/application/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/application/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/application/css/bootstrap-theme.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>/application/css/bootstrap-theme.min.css">
  <?= '<link rel="stylesheet" type="text/css" href="'.base_url().'application/css/style.css">' ?>
</head>
<body>
  <div id="panel">
    <ul class="botones">
      <?= '<li><a href="'.base_url().'cliente/index">Inicio</a></li>'?>
      <?= '<li><a href="'.base_url().'cliente/catalogo">Catalogo</a>'?>
        
        <ul class="submenu">
          <?php foreach($producto as $row)
          {
            echo "<li>";
            echo '<a href="'.base_url().'cliente/catalogo/'.$row->idcategoria.'">'.$row->nombre.'</a>';
            echo "</li>";
          } ?>
        </ul>

        </li>
      <?= '<li><a href="'.base_url().'cliente/compras">Compras</a></li>'?>
      <?= '<li><a href="'.base_url().'cliente/quienes">¿Quienes somos?</a></li>'?>
      <?= '<li><a href="'.base_url().'cliente/logout">Salir</a>'?>
        <ul class="submenu">
            <?= '<li><a href="'.base_url().'cliente/pedidos">Mis pedidos #'.$count.'</a></li>'?>
        </ul>
    </ul>
  </div>
  <center>
<br><br><br>