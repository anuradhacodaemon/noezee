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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// category 
$route['api/v1/category/image/upload'] = 'api/v1/file/uploadFile';
$route['api/v1/category/image/uploaddetails'] = 'api/v1/file/uploadFile1';

$route['api/v1/media/upload'] = 'api/v1/file2/uploadFile';
$route['api/v1/media/upload1'] = 'api/v1/file4/uploadFile';
$route['api/v1/media/delete'] = 'api/v1/file/media';


$route['api/v1/media/log'] = 'api/v1/file2/log';

$route['api/v1/media/favorite'] = 'api/v1/file2/favorite';
$route['api/v1/media/favorite/(:any)'] = 'api/v1/file2/favorite/$1';

$route['api/v1/category/image'] = 'api/v1/file/uploadFile';

$route['api/v1/media'] = 'api/v1/file2/uploadFile';
$route['api/v1/media/(:any)'] = 'api/v1/file/uploadFile/$1';

$route['api/v1/category'] = 'api/v1/category';
$route['api/v1/category/(:any)'] = 'api/v1/category/index/$1';

$route['api/v1/user/setdevice'] = 'api/v1/user/userdevice';
$route['api/v1/user/getdevice'] = 'api/v1/user/userdevice';

$route['api/v1/user/Login'] = 'api/v1/user/login';
$route['api/v1/user/signup'] = 'api/v1/user/signup';

//admin route
$route['admin'] = 'admin/home/index';

$route['admin/media'] = 'admin/media/index';
$route['admin/media/(:num)'] = 'admin/media/index/$1';
$route['admin/media/details/(:num)'] = 'admin/media/details/$1';
$route['admin/media/edit/(:num)'] = 'admin/media/edit/$1';


$route['admin/device/details/(:num)/(:num)'] = 'admin/device/details/$1/$2';
$route['admin/device'] = 'admin/device/index';
$route['admin/device/(:num)'] = 'admin/device/index/$1';
$route['admin/user'] = 'admin/user/index';
$route['admin/user/(:num)'] = 'admin/user/index/$1';
$route['admin/feedback'] = 'admin/feedback/index';
$route['admin/feedback/(:num)'] = 'admin/feedback/index/$1';
$route['admin/favorite'] = 'admin/favorite/index';
$route['admin/favorite/(:num)'] = 'admin/favorite/index/$1';

$route['admin/messagelist/(:any)/(:any)'] = 'admin/messagelist/index/$1/$2';
$route['admin/messagelist/(:any)/(:any)/(:any)'] = 'admin/messagelist/index/$1/$2/$3';

$route['admin/senders/(:any)/(:any)'] = 'admin/senders/index/$1/$2';
$route['admin/senders/(:any)/(:any)/(:any)'] = 'admin/senders/index/$1/$2/$3';



//parent route
$route['parent'] = 'parent/home/index';
$route['parent/terms'] = 'parent/home/terms';
$route['parent/privacy'] = 'parent/home/privacy';
$route['parent/welcome'] = 'parent/home/welcome';

$route['parent/media'] = 'parent/media/index';
$route['parent/media/(:num)'] = 'parent/media/index/$1';
$route['parent/media/details/(:num)'] = 'parent/media/details/$1';
$route['parent/media/edit/(:num)'] = 'parent/media/edit/$1';

$route['parent/gallery/(:any)/(:any)'] = 'parent/device/media/$1/$2';
$route['parent/gallery/(:any)/(:any)/(:any)'] = 'parent/device/media/$1/$2/$3';

$route['parent/medialist/(:any)/(:any)'] = 'parent/media/device/$1/$2';

$route['parent/medialist/(:any)/(:any)/(:any)'] = 'parent/media/device/$1/$2/$3';

$route['parent/device/details/(:num)/(:num)'] = 'parent/device/details/$1/$2';
$route['parent/device'] = 'parent/device/index';
$route['parent/device/(:num)'] = 'parent/device/index/$1';


$route['parent/messagelist/(:any)/(:any)'] = 'parent/messagelist/index/$1/$2';
$route['parent/messagelist/(:any)/(:any)/(:any)'] = 'parent/messagelist/index/$1/$2/$3';

$route['parent/senders/(:any)/(:any)'] = 'parent/senders/index/$1/$2';
$route['parent/senders/(:any)/(:any)/(:any)'] = 'parent/senders/index/$1/$2/$3';


$route['parent/user'] = 'parent/user/index';
$route['parent/user/(:num)'] = 'parent/user/index/$1';
$route['parent/feedback'] = 'parent/feedback/index';
$route['parent/feedback/(:num)'] = 'parent/feedback/index/$1';
$route['parent/favorite'] = 'parent/favorite/index';
$route['parent/favorite/(:num)'] = 'parent/favorite/index/$1';
$route['parent/device/favorite/(:any)/(:any)'] = 'parent/device/favorite/$1/$2';
$route['parent/media/delete_inactive/(:num)'] = 'parent/media/delete_inactive/$1';
$route['parent/media/delete_active/(:num)'] = 'parent/media/delete_active/$1';

$route['api/v1/user/password'] = 'api/v1/clientpassword/index';
$route['user/reseturl/(:any)'] = 'clientforgot/forgotpassword/$1';
$route['api/v1/client/changepassword/(:any)'] = 'clientforgot/changepassword/$1';

$route['confirmurl/(:any)'] = 'confirmurl/index/$1';
