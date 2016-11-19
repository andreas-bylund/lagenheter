<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'Public_controller/login';
$route['login/send'] = 'Public_controller/login_send';
$route['register'] = 'Public_controller/register';
$route['register/send'] = 'Public_controller/register_send';

$route['activate'] = 'Public_controller/activation_mail';

$route['activate/(:any)'] = 'Public_controller/activate_user/$1';

$route['test'] = 'Public_controller/test';

$route['reset_password'] = 'Public_controller/forgot_password';
$route['reset_password/send'] = 'Public_controller/forgot_password_send';

$route['default_controller'] = 'Public_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
