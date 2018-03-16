<?php
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'INSTALL_EMOTINYMCE_MOD'				=> 'Install eMosbat TinyMCE Integration Mod',
	'INSTALL_EMOTINYMCE_MOD_CONFIRM'		=> 'Are you ready to install the eMosbat TinyMCE Integration Mod?',

	'EMOTINYMCE_MOD'						=> 'eMosbat TinyMCE Integration Mod',
	'EMOTINYMCE_MOD_EXPLAIN'				=> '',

	'UNINSTALL_EMOTINYMCE_MOD'			=> 'Uninstall eMosbat TinyMCE Integration Mod',
	'UNINSTALL_EMOTINYMCE_MOD_CONFIRM'	=> 'Are you ready to uninstall the eMosbat TinyMCE Integration Mod?  All settings and data saved by this mod will be removed!',
	'UPDATE_EMOTINYMCE_MOD'				=> 'Update eMosbat TinyMCE Integration Mod',
	'UPDATE_EMOTINYMCE_MOD_CONFIRM'		=> 'Are you ready to update the eMosbat TinyMCE Integration Mod?',
));

?>