<h1>Bli medlem</h1>

<?php

echo $this->session->flashdata('error');

echo validation_errors();

echo form_open('register/send');

$name = array(
  'name'  =>  'name',
  'value' =>  set_value('name')
);

echo form_label('Namn: ', 'name');
echo form_input($name);

$mail = array(
  'name'  =>  'mail',
  'value' =>  set_value('mail')
);

echo form_label('Mailadress:', 'mail');
echo form_input($mail);

$number = array(
  'name'  =>  'number',
  'value' =>  set_value('number')
);

echo form_label('Mobilnummer: ', 'number');
echo form_input($number);

echo form_label('Lösenord: ', 'password');
echo form_password('password');

echo form_submit('submit', 'Bli medlem');

echo form_close();
?>
