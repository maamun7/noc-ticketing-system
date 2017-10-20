<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//$route['default_controller'] = "welcome";
$route['default_controller'] = "cdashboard";
$route['dashboard'] = "cdashboard";
$route['dashboard/(:any)'] = "cdashboard/$1";
$route['user'] = "cuser";
$route['user/(:any)'] = "cuser/$1";
$route['role'] = "crole";
$route['role/(:any)'] = "crole/$1";
$route['complain'] = "ccomplain";
$route['complain/(:any)'] = "ccomplain/$1";

$route['404_override'] = '';

//Client
$route['customer'] = "ccustomer";
$route['customer/(:any)'] = "ccustomer/$1";
$route['ticket'] = "cticket";
$route['ticket/(:any)'] = "cticket/$1";
$route['ticket_type'] = "cticket_type";
$route['ticket_type/(:any)'] = "cticket_type/$1";
$route['qhistory'] = "cqhistory";
$route['qhistory/(:any)'] = "cqhistory/$1";
$route['home'] = "chome";
$route['home/(:any)'] = "chome/$1";
$route['query'] = "cquery";
$route['query/(:any)'] = "cquery/$1";
$route['client'] = "cclient";
$route['client/(:any)'] = "cclient/$1";


$route['current_rate'] = "ccurrent_rate";
$route['current_rate/(:any)'] = "ccurrent_rate/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */