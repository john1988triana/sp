<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['supported_languages'] = array(
//									    'en'=> array('name' => 'English', 'folder' => 'english'),
									    'es_CO'=> array('name' => 'Espa&ntilde;ol', 'folder' => 'spanish')
									);
$config['default_language'] = 'es_CO';
setlocale(LC_ALL ,"es_CO");
