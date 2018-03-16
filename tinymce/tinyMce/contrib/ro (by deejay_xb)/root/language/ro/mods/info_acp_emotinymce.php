<?php

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
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
	'ACP_EMOTINYMCE_MOD_TITLE'						=> 'eMosbat TinyMCE Integration',
	'ACP_EMOTINYMCE_CONFIG_TITLE'					=> 'Configurare Editor',
	'ACP_EMOTINYMCE_TITLE'							=> 'Configurare Editor',
	'ACP_EMOTINYMCE_LEGEND1'						=> 'General',
	'ACP_EMOTINYMCE_LEGEND2'						=> 'Dimensiune',
	'ACP_EMOTINYMCE_LEGEND3'						=> 'Interfață',
	'ACP_EMOTINYMCE_CONFIG_ENABLE'					=> 'Stare',
	'ACP_EMOTINYMCE_CONFIG_ENABLE_EXPLAIN'			=> 'Activează editor TinyMCE?',
	'ACP_EMOTINYMCE_CONFIG_QQ'						=> 'Citat Rapid',
	'ACP_EMOTINYMCE_CONFIG_QQ_EXPLAIN'				=> '(este necesar mod Răspuns Rapid - Quick Reply)',
	'ACP_EMOTINYMCE_CONFIG_MOBILE'					=> 'Activ pentru Mobile',
	'ACP_EMOTINYMCE_CONFIG_MOBILE_EXPLAIN'			=> 'activează editor pentru dispozitive mobile (ne-recomandat)',
	'ACP_EMOTINYMCE_CONFIG_ALLOWUSER'				=> 'Permite utilizatorilor să modifice Editor',
	'ACP_EMOTINYMCE_CONFIG_ALLOWUSER_EXPLAIN'		=> 'se permite utilizatorilor să aleagă editorul implicit sau editorul îmbunătățit',
	'ACP_EMOTINYMCE_CONFIG_DIR'						=> 'RTL direcție',
	'ACP_EMOTINYMCE_CONFIG_DIR_EXPLAIN'				=> 'Right to Left limbi',
	'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER'			=> 'Verificare scriere',
	'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER_EXPLAIN'	=> 'Activează Verificare scriere?',
	'ACP_EMOTINYMCE_CONFIG_WIDTH'					=> 'Lățime Editor',
	'ACP_EMOTINYMCE_CONFIG_WIDTH_EXPLAIN'			=> '0 = implicit',
	'ACP_EMOTINYMCE_CONFIG_HEIGHT'					=> 'Înălțime Editor',
	'ACP_EMOTINYMCE_CONFIG_HEIGHT_EXPLAIN'			=> '0 = implicit',
	'ACP_EMOTINYMCE_CONFIG_QWIDTH'					=> 'Lățime Răspuns Rapid',
	'ACP_EMOTINYMCE_CONFIG_QWIDTH_EXPLAIN'			=> 'dacă modul este instalat. (0 = implicit)',
	'ACP_EMOTINYMCE_CONFIG_QHEIGHT'					=> 'Înălțime Răspuns Rapid',
	'ACP_EMOTINYMCE_CONFIG_QHEIGHT_EXPLAIN'			=> 'dacă modul este instalat. (0 = implicit)',
	'ACP_EMOTINYMCE_CONFIG_LANG'					=> 'Limbă',
	'ACP_EMOTINYMCE_CONFIG_CAPTION'					=> 'Buton Text',
	'ACP_EMOTINYMCE_CONFIG_CAPTION_EXPLAIN'			=> 'Arată Text în butoane?',
	'ACP_EMOTINYMCE_CONFIG_TIP'						=> 'Ajutor Buton',
	'ACP_EMOTINYMCE_CONFIG_TIP_EXPLAIN'				=> 'Arată Ajutor în butoane?',
	'ACP_EMOTINYMCE_CONFIG_SKIN'					=> 'Interfață',
	'ACP_EMOTINYMCE_CONFIG_SKIN_EXPLAIN'			=> 'Interfață Editor',
	
	'ACP_EMOTINYMCE_skins'							=> array(
															'default@' => 'Implicit',
															 'o2k7@' => 'o2k7',
															 'o2k7@sliver' => 'o2k7 Sliver',
															 'o2k7@black' => 'o2k7 Black',
														),
));
?>