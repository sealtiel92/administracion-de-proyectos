
<br><br><br><br><br><br>
<?php echo form_open("cliente/login");?>
                    <table cellspacing="25" bgcolor="#609555">
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
                      <div id="link">
                        <td>
                        <a href="<?= base_url().'cliente/forgot_password'?>" id="a" >¿Olvidaste tu Contraseña?</a>
                        </td>
                        <td>
                          <a href="<?= base_url().'cliente/registro'?>" id="a" >Registrar</a>
                        </td>
                        </div>
                      </tr>
                    </table>
                    <?= form_close()?>

</body>

</html>