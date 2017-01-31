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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin_create'] = 'admin/admin_create';
$route['admin_delete'] = 'admin/admin_delete';
$route['admin_get'] = 'admin/admin_get';
$route['admin_lists'] = 'admin/admin_lists';

$route['article_create'] = 'article/article_create';
$route['article_delete'] = 'article/article_delete';
$route['article_get'] = 'article/article_get';
$route['article_lists'] = 'article/article_lists';

$route['client_create'] = 'client/client_create';
$route['client_delete'] = 'client/client_delete';
$route['client_get'] = 'client/client_get';
$route['client_lists'] = 'client/client_lists';

$route['company_create'] = 'company/company_create';
$route['company_delete'] = 'company/company_delete';
$route['company_get'] = 'company/company_get';
$route['company_lists'] = 'company/company_lists';

$route['check_admin_email'] = 'extra/check_admin_email';
$route['check_admin_username'] = 'extra/check_admin_username';

$route['index'] = 'login/index';
$route['logout'] = 'login/logout';

$route['media_album_create'] = 'media/media_album_create';
$route['media_album_delete'] = 'media/media_album_delete';
$route['media_album_get'] = 'media/media_album_get';
$route['media_album_lists'] = 'media/media_album_lists';

$route['media_create'] = 'media/media_create';
$route['media_delete'] = 'media/media_delete';
$route['media_get'] = 'media/media_get';
$route['media_lists'] = 'media/media_lists';

$route['member_create'] = 'member/member_create';
$route['member_delete'] = 'member/member_delete';
$route['member_get'] = 'member/member_get';
$route['member_lists'] = 'member/member_lists';

$route['preferences_create'] = 'preferences/preferences_create';
$route['preferences_delete'] = 'preferences/preferences_delete';
$route['preferences_get'] = 'preferences/preferences_get';
$route['preferences_lists'] = 'preferences/preferences_lists';

$route['profile'] = 'admin/profile';

$route['program_create'] = 'program/program_create';
$route['program_delete'] = 'program/program_delete';
$route['program_get'] = 'program/program_get';
$route['program_lists'] = 'program/program_lists';

$route['program_sub_create'] = 'program/program_sub_create';
$route['program_sub_delete'] = 'program/program_sub_delete';
$route['program_sub_get'] = 'program/program_sub_get';
$route['program_sub_lists'] = 'program/program_sub_lists';

$route['slider_create'] = 'slider/slider_create';
$route['slider_delete'] = 'slider/slider_delete';
$route['slider_get'] = 'slider/slider_get';
$route['slider_lists'] = 'slider/slider_lists';

$route['testimony_create'] = 'testimony/testimony_create';
$route['testimony_delete'] = 'testimony/testimony_delete';
$route['testimony_get'] = 'testimony/testimony_get';
$route['testimony_lists'] = 'testimony/testimony_lists';
