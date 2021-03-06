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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['login'] = 'admin/auth/login';
$route['logout'] = 'admin/auth/logout';
$route['forgot'] = 'admin/auth/forgot_password';
$route['reset/(:any)'] = 'admin/auth/reset_password/$1';
$route['register'] = 'admin/auth/create_user';
$route['change'] = 'admin/auth/change_password';
$route['dashboard/profile'] = 'admin/dashboard/profile';
$route['profile'] = 'admin/auth/edit_user';

$route['dashboard'] = 'admin/dashboard';
$route['products'] = 'admin/products';
$route['category'] = 'admin/categories';
$route['coupons'] = 'admin/coupons';
$route['orders'] = 'admin/orders';
$route['customers'] = 'admin/customers';

$route['api/products'] = 'admin/api/products';
$route['api/category'] = 'admin/api/product_category';
$route['api/coupons'] = 'admin/api/coupons';
$route['api/customers'] = 'admin/api/customers';
$route['api/orders'] = 'admin/api/orders';
$route['api/pending_orders'] = 'admin/api/pending_orders';

$route['invoice/(:any)'] = 'store/invoice/$1';
$route['store/get_customer_by_code'] = 'store/get_customer_by_code';
$route['store/get_product_by_sku'] = 'store/get_product_by_sku';
$route['store/submit'] = 'store/submit_order';
$route['store/upload_payment/(:any)/(:num)'] = 'store/upload_payment/$1/$2';
$route['store/submit_payment'] = 'store/submit_payment';
$route['store/(:any)'] = 'store/index/$1';
$route['store/(:any)/(:any)'] = 'store/index/$1/$2';
