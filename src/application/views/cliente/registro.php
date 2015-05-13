<center>
<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>
</center>

<div id="infoMessage"><?php echo $message;?></div>
<div class='tablaRegistro'>
<table cellspacing="25" align="center" class="table table-bordered">

<?php echo form_open("cliente/registro");?>

      <tr><p>
            <th class="info"><?php echo lang('create_user_fname_label', 'first_name');?></th>
            <td><?php echo form_input($first_name);?></td>
      </p></tr>

      <tr><p>
            <th class="info"><?php echo lang('create_user_lname_label', 'last_name');?> </th>
            <td><?php echo form_input($last_name);?></td>
      </p></tr>

      <tr><p>
            <th class="info"><?php echo lang('create_user_email_label', 'email');?> </th>
            <td><?php echo form_input($email);?></td>
      </p></tr>

      <tr><p>
            <th class="info"><?php echo lang('create_user_phone_label', 'phone');?> </th>
            <td><?php echo form_input($phone);?></td>
      </p></tr>

      <tr><p>
            <th class="info"><?php echo lang('create_user_password_label', 'password');?> </th>
            <td><?php echo form_input($password);?></td>
      </p></tr>

      <tr><p>
            <th class="info"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?> </th>
            <td><?php echo form_input($password_confirm);?></td>
      </p></tr>



</table>
<button class="btn btn-info" type="submit"><strong>Pedir</strong></button> 
<?php echo form_close();?>
 </div>