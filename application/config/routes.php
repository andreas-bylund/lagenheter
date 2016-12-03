<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Public routes
 */
$route['login'] = 'Public_controller/login';
$route['login/send'] = 'Public_controller/login_send';
$route['register'] = 'Public_controller/register';
$route['register/send'] = 'Public_controller/register_send';

$route['activate'] = 'Public_controller/activation_mail';
$route['activate/(:any)'] = 'Public_controller/activate_user/$1';

$route['reset_password'] = 'Public_controller/forgot_password';
$route['reset_password/send'] = 'Public_controller/forgot_password_send';
$route['reset_password/(:any)'] = 'Public_controller/change_password/$1';
$route['reset_password_send/(:any)'] = 'Public_controller/change_password_send/$1';


/*  Member routes */

$route['dashboard'] = 'Member_controller/index';
$route['dashboard/sign_out'] = 'Member_controller/sign_out';

$route['dashboard/settings'] = 'Member_controller/change_settings';
$route['dashboard/settings/send'] = 'Member_controller/change_settings_send';

$route['dashboard/store'] = 'Member_controller/store';
$route['dashboard/support'] = 'Member_controller/zendesk_start';

$route['dashboard/thankyou'] = 'Member_controller/thankyou';

$route['dashboard/subscriptions'] = 'Member_controller/my_subscriptions';
$route['dashboard/subscription/edit/(:any)'] = 'Member_controller/edit_subscription/$1';

/**
 * Städer
 */
$route['dashboard/stad/stockholm'] = 'Member_controller/stockholm_overview';
$route['dashboard/process_subscription/(:any)'] = 'Member_controller/process_subscription/$1';

/**
 * Stoppa prenumeration
 */
$route['dashboard/subscription/delete/(:any)'] = 'Member_controller/stop_subscription/$1';
$route['dashboard/cancel_confirmed'] = 'Member_controller/cancel_confirmed';

/**
 * Återta prenumeration
 */
$route['dashboard/subscription/resume/(:any)/(:any)'] = 'Member_controller/resume_subscription/$1/$2';



/**
 * Standard routes
 */
$route['default_controller'] = 'Public_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
