<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* Page routes */

/* 
|  Accounts routes
*/
$route['login']            = 'Accounts/login';
$route['signup']           = 'Accounts/signUp';
$route['forgot-password']  = 'Accounts/forgotPassword';
$route['logout']           = 'Accounts/logoutUser';

// Users
$route['dashboard']           = 'Home/dashboard';
$route['dfy-templates']       = 'Home/dfyTemplates';
$route['my-sites']            = 'Home/userSites';
$route['profile']             = 'Home/userProfile';
$route['settings']            = 'Home/userSettings';
$route['plans']               = 'Home/plansList';
$route['sites-response']      = 'Home/sitesResponse';

$route['template/preview/?(:num)?']        = 'Home/previewTemplate/$1';
$route['dfy-template/preview/?(:num)?']    = 'Home/previewDfyTemplate/$1';
$route['template/edit/?(:num)?']           = 'Home/editTemplate/$1';

$route['purchase/?(:any)?']           = 'Payment/order_payment/$1';

// hosting
$route['e/?(:any)?']           = 'Host/getSite/$1';

$route['four-zero-four']       = 'Host/fourZeroFour';

// $route['default_controller'] = 'welcome';
