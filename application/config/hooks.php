<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
                                'class'    => 'Internet',
                                'function' => 'check_browser',
                                'filename' => 'internet.php',
                                'filepath' => 'hooks'
                                );
$hook['post_controller_constructor'][] = array(
                                'class'    => 'Log',
                                'function' => 'check_login',
                                'filename' => 'log.php',
                                'filepath' => 'hooks'
                                );
$hook['post_controller_constructor'][] = array(
                                'class'    => 'Clave',
                                'function' => 'check_clave',
                                'filename' => 'clave.php',
                                'filepath' => 'hooks'
                                );
/* End of file hooks.php */
/* Location: ./application/config/hooks.php */