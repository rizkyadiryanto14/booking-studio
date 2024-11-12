<?php
defined('BASEPATH') or exit('No direct script access allowed');

//default controller
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login'] = 'Auth';
$route['auth/logout'] = 'Auth/logout';
$route['auth/registrasi'] = 'Auth/registrasi';
$route['auth/register'] = 'Auth/register';
$route['auth/login_proccess'] = 'Auth/login';

//dashboard
$route['dashboard'] = 'Backend/Dashboard';

//admin
$route['admin/studio'] = 'Backend/Admin/Studio';
$route['admin/get_data_studio'] = 'Backend/Admin/Studio/get_data_studio';
$route['admin/tambah_studio'] = 'Backend/Admin/Studio/AddStudio';
$route['admin/studio/insert'] = 'Backend/Admin/Studio/insert';
$route['admin/studio/delete/(:num)'] = 'Backend/Admin/Studio/delete/$1';
$route['admin/studio/edit/(:num)'] = 'Backend/Admin/Studio/edit/$1';
$route['admin/studio/update'] = 'Backend/Admin/Studio/update';
$route['admin/studio/update/(:num)'] = 'Backend/Admin/Studio/update/$1';
$route['admin/profile'] = 'Backend/Admin/Profile';
$route['admin/update_profile'] = 'Backend/Admin/Profile/update_profile';

//jadwal
$route['admin/jadwal_studio'] = 'Backend/Admin/Jadwal';
$route['admin/api/jadwal'] = 'Backend/Admin/Jadwal/listing_studio';
$route['admin/get_data_jadwal'] = 'Backend/Admin/Jadwal/get_data_jadwal';
$route['admin/tambah_jadwal'] = 'Backend/Admin/Jadwal/AddJadwal';
$route['admin/jadwal/insert'] = 'Backend/Admin/Jadwal/insert';
$route['admin/jadwal/insert'] = 'Backend/Admin/Jadwal/insert';
$route['admin/jadwal/delete/(:num)'] = 'Backend/Admin/Jadwal/delete/$1';
$route['admin/jadwal/get_jadwal_by_id'] = 'Backend/Admin/Jadwal/get_jadwal_by_id';
$route['admin/jadwal/update_jadwal'] = 'Backend/Admin/Jadwal/update';

//users
$route['admin/users'] = 'Backend/Admin/Users';
$route['admin/users/get_data_users'] = 'Backend/Admin/Users/get_data_users';
$route['admin/users/insert'] = 'Backend/Admin/Users/insert';
$route['admin/users/delete/(:num)'] = 'Backend/Admin/Users/delete/$1';
$route['admin/users/get_pengguna_by_id'] = 'Backend/Admin/Users/get_pengguna_by_id';

//user routes
$route['users/studio_tersedia'] = 'Backend/Users/Booking';
$route['users/studio_detail/(:num)'] = 'Backend/Users/Booking/available_studios_with_slots/$1';
$route['booking/pesan_slot/(:num)/(:any)'] = 'Backend/Users/Booking/pesan_slot/$1/$2';

//pemesanan
$route['users/pemesanan'] = 'Backend/Users/Pemesanan';
$route['pembayaran/get_snap_token/(:num)'] = 'Backend/Users/Pembayaran/get_snap_token/$1';
