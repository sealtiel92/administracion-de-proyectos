<link rel="stylesheet" type="text/css" href="style.css">
<div id="alineador" align="center">
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("cliente/login");?>
<br><br><br><br><br><br><br>
<table bgcolor="#BABEBF" cellspacing="20" >
  <tr>
    <p>
    <td><?= 'Usuario'?></td>
    <td><?php echo form_input($identity);?></td>
    </p>
  </tr>
  <tr>
    <p>
    <td><?= 'Contraseña'?></td>
    <td><?php echo form_input($password);?></td>
    </p>
  </tr>
  <tr>
    <td><p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p></td>
  <td>
    <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>
  </td>
  </tr>
  <tr>
    <td>
    <a href="<?= base_url().'cliente/forgot_password'?>"><?php echo '¿Olvidaste tu Contraseña?';?></a>
    </td>
    <td>

      <a href="<?= base_url().'cliente/registro'?>"><?php echo 'Registrar';?></a>
    </td>
  </tr>

</table>


<?php echo form_close();?>

</div>