<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Constantes Omma Boos
|--------------------------------------------------------------------------
|
| Variables propias
|
*/

define('PLANTILLA', 'fluidcenter');
define('SITIO_NOMBRE', 'Omma Boos');
define('SITIO_DESC', 'Descripción del sitio');

define('MENU_ID_DEFAULT', 1);
define('MENU_ITEM_ALIAS_DEFAULT', 'inicio');
define('MENU_ITEM_ID_DEFAULT', 1);
define('MENU_SIMBOLO', '~');

define('SIDEBAR_SOLO_EN_INICIO', FALSE);
define('RUTA_IMAGENES', 'assets/images/'); //With trailing slash / Con slash al final
define('RUTA_ASSETS', 'assets/modules/');

/**
 * Componente: Noticias
 */
/**
 * Tipos de vistas de noticias
 */
define('NOTICIAS_VISTA_DEFAULT', 'default');
define('NOTICIAS_VISTA_BLOQUE', 'bloques');
define('NOTICIAS_VISTA_BLOQUE_COLUMNAS_DEFAULT', 3);
define('NOTICIAS_URL_BASE', 'noticias');
define('NOTICIAS_VISTA', NOTICIAS_VISTA_BLOQUE);


/* End of file constants.php */
/* Location: ./application/config/constants.php */