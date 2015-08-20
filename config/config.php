<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['module']['staticdata'] = array
(
	'module'		=> 'StaticData',
    'name' 			=> 'StaticData',
	'description'	=> 'Static Data: Countries, Languages',
	'author' 		=> 'CoExec GmbH',
	'project' 		=> 'Ionize CMS',
	'version' 		=> '1.0',

	/*
	'install' => 'install.php',
	'migrate' => 'migrate.php',
	'uninstall' => 'uninstall.php',
	*/

	'uri'			=> 'staticdata',

	'has_admin'		=> FALSE,
	'has_frontend'	=> FALSE,

	// Array of resources
	// These resources will be added to the role's management panel
	// to allow / deny actions on them.
	'resources' => array()
);

return $config['module']['staticdata'];