<h1>Login page</h1>

<?php

echo $this->session->flashdata('error');

echo validation_errors();

echo form_open('login/send');

echo form_input('mail');
echo form_password('password');

echo form_submit('submit', 'Logga in');

echo form_close();

?>

<a href="<?php echo base_url('reset_password');?>">Glömt lösenordet?</a>
