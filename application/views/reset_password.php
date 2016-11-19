<h1>Reset Password</h1>
<p>Skriv in din mail för att återställa ditt lösenord</p>



<?php

echo $this->session->flashdata('error');

echo validation_errors();

echo form_open('reset_password/send');

echo form_input('mail');

echo form_submit('submit', 'Återställ lösenordet');

echo form_close();

?>
