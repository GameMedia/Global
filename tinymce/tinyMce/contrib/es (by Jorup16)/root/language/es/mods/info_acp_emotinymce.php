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
	'ACP_EMOTINYMCE_CONFIG_TITLE'					=> 'Opciones del editor',
	'ACP_EMOTINYMCE_TITLE'							=> 'Opciones del editor',
	'ACP_EMOTINYMCE_LEGEND1'						=> 'General',
	'ACP_EMOTINYMCE_LEGEND2'						=> 'Tama&ntilde;o',
	'ACP_EMOTINYMCE_LEGEND3'						=> 'Interfaz',
	'ACP_EMOTINYMCE_CONFIG_ENABLE'					=> 'Estado',
	'ACP_EMOTINYMCE_CONFIG_ENABLE_EXPLAIN'			=> '&iquest;Activar el editor TinyMCE?',
	'ACP_EMOTINYMCE_CONFIG_QQ'						=> 'Cita r&aacute;pida',
	'ACP_EMOTINYMCE_CONFIG_QQ_EXPLAIN'				=> '(Se requiere complento de Respuesta R&aacute;pida)',
	'ACP_EMOTINYMCE_CONFIG_MOBILE'					=> 'Activar para m&oacute;viles',
	'ACP_EMOTINYMCE_CONFIG_MOBILE_EXPLAIN'			=> 'Activar editor para dispositivos m&oacute;viles (no se recomienda)',
	'ACP_EMOTINYMCE_CONFIG_ALLOWUSER'				=> 'Permitor a los usuarios cambiar de editor',
	'ACP_EMOTINYMCE_CONFIG_ALLOWUSER_EXPLAIN'		=> 'Permitir a los usuarios seleccionar el editor predeterminado o enriquecido',
	'ACP_EMOTINYMCE_CONFIG_DIR'						=> 'Direcci&oacute;n RTL',
	'ACP_EMOTINYMCE_CONFIG_DIR_EXPLAIN'				=> 'Idiomas de derecha a izquierda',
	'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER'			=> 'Corrector ortogr&aacute;fico',
	'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER_EXPLAIN'	=> '&iquest;Activar corrector ortogr&aacute;fico?',
	'ACP_EMOTINYMCE_CONFIG_WIDTH'					=> 'Editor en ancho completo',
	'ACP_EMOTINYMCE_CONFIG_WIDTH_EXPLAIN'			=> '0 = predeterminado',
	'ACP_EMOTINYMCE_CONFIG_HEIGHT'					=> 'Editor con altura completa',
	'ACP_EMOTINYMCE_CONFIG_HEIGHT_EXPLAIN'			=> '0 = predeterminado',
	'ACP_EMOTINYMCE_CONFIG_QWIDTH'					=> 'Ancho de respuesta r&aacute;pida',
	'ACP_EMOTINYMCE_CONFIG_QWIDTH_EXPLAIN'			=> 'Si el complemento est&aacute; instalado. (0 = predeterminado)',
	'ACP_EMOTINYMCE_CONFIG_QHEIGHT'					=> 'Altura de la respuesta r&aacute;pida',
	'ACP_EMOTINYMCE_CONFIG_QHEIGHT_EXPLAIN'			=> 'Si el complemento est&aacute; instalado. (0 = predeterminado)',
	'ACP_EMOTINYMCE_CONFIG_LANG'					=> 'Idioma',
	'ACP_EMOTINYMCE_CONFIG_CAPTION'					=> 'Texto del bot&oacute;n',
	'ACP_EMOTINYMCE_CONFIG_CAPTION_EXPLAIN'			=> '&iquest;Mostrar texto en los botones?',
	'ACP_EMOTINYMCE_CONFIG_TIP'						=> 'Informaci&oacute;n de bot&oacute;n',
	'ACP_EMOTINYMCE_CONFIG_TIP_EXPLAIN'				=> '&iquest;Mostrar ayuda para los botones?',
	'ACP_EMOTINYMCE_CONFIG_SKIN'					=> 'Piel',
	'ACP_EMOTINYMCE_CONFIG_SKIN_EXPLAIN'			=> 'Editor de pieles',
	
	'ACP_EMOTINYMCE_skins'							=> array(
															'default@' => 'Default',
															 'o2k7@' => 'o2k7',
															 'o2k7@sliver' => 'o2k7 Sliver',
															 'o2k7@black' => 'o2k7 Black',
														),
));
?>