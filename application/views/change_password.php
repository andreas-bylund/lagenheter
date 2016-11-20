<h1>Change password</h1>
<p>Mailadress: <?php echo $mail; ?></p>
<?php

echo $this->session->flashdata('error');

echo validation_errors();

echo form_open('reset_password_send/'.$token.'');

echo form_label('Nya lösenordet:');
echo form_password('password');

echo form_label('Nya lösenordet igen:');
echo form_password('password_two');

echo form_submit('submit', 'Ändra lösenord');

echo form_close();

?>
