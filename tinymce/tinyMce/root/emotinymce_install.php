<?php
/**
*
* @author eMosbat
* @package umil
* @copyright (c) 2013 https://github.com/eMosbat
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'EMOTINYMCE_MOD';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'emotinymce_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
* $mod_name
* 'INSTALL_' . $mod_name
* 'INSTALL_' . $mod_name . '_CONFIRM'
* 'UPDATE_' . $mod_name
* 'UPDATE_' . $mod_name . '_CONFIRM'
* 'UNINSTALL_' . $mod_name
* 'UNINSTALL_' . $mod_name . '_CONFIRM'
*/
$language_file = 'mods/umil_auto_emotinymce';


$versions = array(

	'1.0.0'	=> array(
		// Lets add a config setting named emotinymce_enable and set it to true
		'config_add' => array(
			array('emotinymce_enable', true),
			array('emotinymce_qq', false),
			array('emotinymce_mobile', false),
			array('emotinymce_allowuser', true),
			array('emotinymce_rtl', false),
			array('emotinymce_width', 0),
			array('emotinymce_height', 0),
			array('emotinymce_qwidth', 0),
			array('emotinymce_qheight', 0),
			array('emotinymce_spellchecker', false),
			array('emotinymce_lang', 'en'),
			array('emotinymce_caption', true),
			array('emotinymce_tip', false),
			array('emotinymce_skin', 'default@'),
		),

		// Now to add some permission settings
		'permission_add' => array(
			array('a_emotinymce_mod', true)
		),

		// How about we give some default permissions then as well?
		'permission_set' => array(
			// Global Role permissions
			array('ROLE_ADMIN_FULL', 'a_emotinymce_mod')

		),

		// Lets add a new column to the phpbb_users table named test_time
		'table_column_add' => array(
			array('phpbb_users', 'user_emotinyeditor', array('BOOL', 1)),
		),


		// Alright, now lets add some modules to the ACP
		'module_add' => array(
			// Add a main category
			//array('acp', 0, 'ACP_CAT_DOT_MODS2'),

			// First, lets add a new category named ACP_CAT_EMOTINYMCE_MOD to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'eMosbat TinyMCE Integration'),

			// Now we will add the settings and features modes from the acp_board module to the ACP_CAT_EMOTINYMCE_MOD category using the "automatic" method.
			array('acp', 'eMosbat TinyMCE Integration', array(
					'module_basename'		=> 'emotinymce',
					'modes'					=> array('config'),
				),
			),

		),
	),

	'1.5.9' => array(
		// Nothing changed in this version.
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);


?>