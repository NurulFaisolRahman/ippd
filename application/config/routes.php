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
$route['default_controller'] = 'Beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// E-LKPJ Routes
$route['Instansi/PengisianTinjutRekomendasiDPRDn-1'] = 'Instansi/PengisianTinjutRekomendasiDPRDn1';
$route['Instansi/PengisianTinjutRekomendasiDPRDn-1/(.+)'] = 'Instansi/PengisianTinjutRekomendasiDPRDn1/$1';
$route['Instansi/BAB3_4'] = 'Instansi/BAB3_4';
$route['Instansi/BAB3_4/(.+)'] = 'Instansi/BAB3_4/$1';
$route['Instansi/Bab3_4'] = 'Instansi/BAB3_4';
$route['Instansi/Bab3_4/(.+)'] = 'Instansi/BAB3_4/$1';
$route['Instansi/bab3_4'] = 'Instansi/BAB3_4';
$route['Instansi/bab3_4/(.+)'] = 'Instansi/BAB3_4/$1';
$route['Instansi/BAB3_4A'] = 'Instansi/BAB3_4A';
$route['Instansi/BAB3_4A/(.+)'] = 'Instansi/BAB3_4A/$1';
$route['Instansi/Bab3_4A'] = 'Instansi/BAB3_4A';
$route['Instansi/Bab3_4A/(.+)'] = 'Instansi/BAB3_4A/$1';
$route['Instansi/bab3_4a'] = 'Instansi/BAB3_4A';
$route['Instansi/bab3_4a/(.+)'] = 'Instansi/BAB3_4A/$1';
$route['Instansi/SinkronIkuDaerah'] = 'Instansi/SinkronIkuDaerah';
$route['Instansi/GetBab3IkuCapaian'] = 'Instansi/GetBab3IkuCapaian';
$route['Instansi/SaveBab3IkuCapaian'] = 'Instansi/SaveBab3IkuCapaian';
$route['Instansi/DeleteBab3IkuCapaian'] = 'Instansi/DeleteBab3IkuCapaian';
$route['Instansi/GetBab3IkuPerkembangan'] = 'Instansi/GetBab3IkuPerkembangan';
$route['Instansi/SaveBab3IkuPerkembangan'] = 'Instansi/SaveBab3IkuPerkembangan';
$route['Instansi/DeleteBab3IkuPerkembangan'] = 'Instansi/DeleteBab3IkuPerkembangan';
$route['Instansi/SalinIndikatorDariAtas'] = 'Instansi/SalinIndikatorDariAtas';
$route['Instansi/ResetBab3_4A'] = 'Instansi/ResetBab3_4A';
$route['Instansi/GenerateNarasiIkuPerkembangan'] = 'Instansi/GenerateNarasiIkuPerkembangan';
$route['Instansi/SaveNarasiIkuPerkembangan'] = 'Instansi/SaveNarasiIkuPerkembangan';
$route['Instansi/BAB3_4B'] = 'Instansi/BAB3_4B';
$route['Instansi/BAB3_4B/(.+)'] = 'Instansi/BAB3_4B/$1';
$route['Instansi/Bab3_4B'] = 'Instansi/BAB3_4B';
$route['Instansi/Bab3_4B/(.+)'] = 'Instansi/BAB3_4B/$1';
$route['Instansi/bab3_4b'] = 'Instansi/BAB3_4B';
$route['Instansi/bab3_4b/(.+)'] = 'Instansi/BAB3_4B/$1';
$route['Instansi/GenerateNarasiIkdPerkembangan'] = 'Instansi/GenerateNarasiIkdPerkembangan';
$route['Instansi/SaveNarasiIkdPerkembangan'] = 'Instansi/SaveNarasiIkdPerkembangan';
$route['Instansi/GetBab3IkdPerkembangan'] = 'Instansi/GetBab3IkdPerkembangan';
$route['Instansi/SaveBab3IkdPerkembangan'] = 'Instansi/SaveBab3IkdPerkembangan';
$route['Instansi/SinkronIkdDaerah'] = 'Instansi/SinkronIkdDaerah';

// BAB 3.5 Penghargaan Routes
$route['Instansi/BAB3_5'] = 'Instansi/BAB3_5';
$route['Instansi/BAB3_5/(.+)'] = 'Instansi/BAB3_5/$1';
$route['Instansi/Bab3_5'] = 'Instansi/BAB3_5';
$route['Instansi/Bab3_5/(.+)'] = 'Instansi/BAB3_5/$1';
$route['Instansi/bab3_5'] = 'Instansi/BAB3_5';
$route['Instansi/bab3_5/(.+)'] = 'Instansi/BAB3_5/$1';
$route['Instansi/PengisianPenghargaan'] = 'Instansi/BAB3_5';
$route['Instansi/PengisianPenghargaan/(.+)'] = 'Instansi/BAB3_5/$1';
$route['Instansi/GetPenghargaan'] = 'Instansi/GetPenghargaan';
$route['Instansi/SavePenghargaan'] = 'Instansi/SavePenghargaan';
$route['Instansi/DeletePenghargaan'] = 'Instansi/DeletePenghargaan';
$route['Instansi/ExportPenghargaanExcel'] = 'Instansi/ExportPenghargaanExcel';

// IPPD Routes
$route['Instansi/TabelIPPD'] = 'Instansi/TabelIPPD';
$route['Instansi/TabelIPPD/(.+)'] = 'Instansi/TabelIPPD/$1';
$route['Instansi/IPPD'] = 'Instansi/TabelIPPD';


