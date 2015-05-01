<h1><?php echo lang('forgot_password_heading');?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("cliente/forgot_password");?>
<br><br><br>
<table cellspacing="25">
    <tr>
    <td> <p>
      	<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
      	</td><td> <?php echo form_input($email);?>
    </p></td>
    
    <td><p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?>
    </p></td>
    </tr>

</table>
<?php echo form_close();?>