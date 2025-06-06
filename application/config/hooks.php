<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Hooks
  | -------------------------------------------------------------------------
  | This file lets you define "hooks" to extend CI without hacking the core
  | files.  Please see the user guide for info:
  |
  |	https://codeigniter.com/user_guide/general/hooks.html
  |
 */
/*
  | -------------------------------------------------------------------------
  | Track Visitor
  | -------------------------------------------------------------------------
  | log visitor info
  |
 */
$hook['post_controller_constructor'][] = array(
    'class' => 'Track_visitor',
    'function' => 'visitor_track',
    'filename' => 'Track_visitor.php',
    'filepath' => 'hooks'
);

$hook['pre_system'][] = array(
	'class'    => 'Maintenance_hook',
	'function' => 'offline_check',
	'filename' => 'Maintenance_hook.php',
	'filepath' => 'hooks'
	);
