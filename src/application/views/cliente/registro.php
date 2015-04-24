<center>
<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>
</center>

<div id="infoMessage"><?php echo $message;?></div>

<table cellspacing="25" align="center">

<?php echo form_open("cliente/registro");?>

      <tr><p>
            <td><?php echo lang('create_user_fname_label', 'first_name');?></td>
            <td><?php echo form_input($first_name);?></td>
      </p></tr>

      <tr><p>
            <td><?php echo lang('create_user_lname_label', 'last_name');?> </td>
            <td><?php echo form_input($last_name);?></td>
      </p></tr>

      <tr><p>
            <td><?php echo lang('create_user_email_label', 'email');?> </td>
            <td><?php echo form_input($email);?></td>
      </p></tr>

      <tr><p>
            <td><?php echo lang('create_user_phone_label', 'phone');?> </td>
            <td><?php echo form_input($phone);?></td>
      </p></tr>

      <tr><p>
            <td><?php echo lang('create_user_password_label', 'password');?> </td>
            <td><?php echo form_input($password);?></td>
      </p></tr>

      <tr><p>
            <td><?php echo lang('create_user_password_confirm_label', 'password_confirm');?> </td>
            <td><?php echo form_input($password_confirm);?></td>
      </p></tr>

      <tr><td></td>
      <td><p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p></td>
      </tr>
<?php echo form_close();?>

</table>