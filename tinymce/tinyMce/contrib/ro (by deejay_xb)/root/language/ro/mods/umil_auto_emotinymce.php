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
	'INSTALL_EMOTINYMCE_MOD'				=> 'Instalare mod eMosbat TinyMCE',
	'INSTALL_EMOTINYMCE_MOD_CONFIRM'		=> 'Ești pregătit să instalezi mod eMosbat TinyMCE?',

	'EMOTINYMCE_MOD'						=> 'Mod eMosbat TinyMCE',
	'EMOTINYMCE_MOD_EXPLAIN'				=> '',

	'UNINSTALL_EMOTINYMCE_MOD'			=> 'Dezinstalare eMosbat TinyMCE',
	'UNINSTALL_EMOTINYMCE_MOD_CONFIRM'	=> 'Ești pregătit să dezinstalezi mod eMosbat TinyMCE?  Toate setările acestui mod vor fi șterse!',
	'UPDATE_EMOTINYMCE_MOD'				=> 'Actualizare mod eMosbat TinyMCE',
	'UPDATE_EMOTINYMCE_MOD_CONFIRM'		=> 'Ești pregătit să actualizezi mod eMosbat TinyMCE?',
));

?>