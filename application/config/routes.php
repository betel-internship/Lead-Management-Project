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
|	https://codeigniter.com/user_guide/general/routing.html
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
// Page Redirect URL
$route['default_controller'] = 'SupportController';


$route['admin-login']='SupportController/login_admin';
$route['admin-dashboard']='SupportController/index';
$route['Logout']='SupportController/support_user_logout';
$route['change_password_process']='SupportController/change_password_process';
$route['change_password']='SupportController/change_password';
$route['employee']='SupportController/employee';
$route['create_lead']='SupportController/create_lead';
$route['detail_lead_details']='SupportController/detail_lead_details';
$route['employee_created_leads']='SupportController/employee_created_leads';
// API Link
$route['registration_employee']='Api_Controller/registration_employee';
$route['change_status_employee']='Api_Controller/change_status_employee';
$route['updates_employee']='Api_Controller/updates_employee';
$route['lead_creation_process']='Api_Controller/lead_creation_process';
$route['update_creation_process']='Api_Controller/update_creation_process';
$route['submitted_your_commenting']='Api_Controller/submitted_your_commenting';
$route['get_notification_users']='Api_Controller/get_notification_users';
$route['update_notification_count']='Api_Controller/update_notification_count';
$route['lead_creation_process_employee']='Api_Controller/lead_creation_process_employee';
$route['update_creation_process_employee']='Api_Controller/update_creation_process_employee';
$route['backend_curl_execute']='Api_Controller/backend_curl_execute';
// Pagination Links
$route['employee_listing_paging']='Datatables_Controller/employee_listing_paging';
$route['lead_details_pagination']='Datatables_Controller/lead_details_pagination';
$route['lead_details_pagination_details']='Datatables_Controller/lead_details_pagination_details';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
