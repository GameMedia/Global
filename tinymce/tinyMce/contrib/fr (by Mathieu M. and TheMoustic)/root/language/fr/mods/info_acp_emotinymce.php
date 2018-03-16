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
    'ACP_EMOTINYMCE_CONFIG_TITLE'            		=> 'Paramètres de l’éditeur',
    'ACP_EMOTINYMCE_TITLE'							=> 'Paramètres de l’éditeur',
    'ACP_EMOTINYMCE_LEGEND1'                        => 'Général',
    'ACP_EMOTINYMCE_LEGEND2'						=> 'Dimension',
    'ACP_EMOTINYMCE_LEGEND3'						=> 'Interface',
    'ACP_EMOTINYMCE_CONFIG_ENABLE'                  => 'Statut',
    'ACP_EMOTINYMCE_CONFIG_ENABLE_EXPLAIN'          => 'Activer l’éditeur TinyMCE ?',
    'ACP_EMOTINYMCE_CONFIG_QQ'                      => 'Citation rapide',
    'ACP_EMOTINYMCE_CONFIG_QQ_EXPLAIN'              => '(L’add-on Réponse rapide est nécessaire)',
    'ACP_EMOTINYMCE_CONFIG_MOBILE'                 	=> 'Activer sur les mobiles',
    'ACP_EMOTINYMCE_CONFIG_MOBILE_EXPLAIN'          => 'Activer sur les appareils mobiles (non recommandé)',
    'ACP_EMOTINYMCE_CONFIG_ALLOWUSER'               => 'Autoriser les utilisateurs à changer l’éditeur',
    'ACP_EMOTINYMCE_CONFIG_ALLOWUSER_EXPLAIN'       => 'Autoriser les utilisateurs à sélectionner l’éditeur par défaut ou l’éditeur avancé',
    'ACP_EMOTINYMCE_CONFIG_DIR'                     => 'Direction RTL',
    'ACP_EMOTINYMCE_CONFIG_DIR_EXPLAIN'             => 'Lecture de droite à gauche',
    'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER'            => 'Vérifier l’orthographe',
    'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER_EXPLAIN'	=> 'Activer la vérification d’orthographe ?',
    'ACP_EMOTINYMCE_CONFIG_WIDTH'                   => 'Largeur de l’éditeur complet',
    'ACP_EMOTINYMCE_CONFIG_WIDTH_EXPLAIN'           => '0 = défaut',
    'ACP_EMOTINYMCE_CONFIG_HEIGHT'                  => 'Hauteur de l’éditeur complet',
    'ACP_EMOTINYMCE_CONFIG_HEIGHT_EXPLAIN'          => '0 = défaut',
    'ACP_EMOTINYMCE_CONFIG_QWIDTH'                  => 'Largeur de la réponse rapide',
    'ACP_EMOTINYMCE_CONFIG_QWIDTH_EXPLAIN'          => 'Uniquement si l’add-on est installé. (0 = défaut)',
    'ACP_EMOTINYMCE_CONFIG_QHEIGHT'                 => 'Hauteur de la réponse rapide',
    'ACP_EMOTINYMCE_CONFIG_QHEIGHT_EXPLAIN'         => 'Uniquement si l’add-on est installé. (0 = défaut)',
    'ACP_EMOTINYMCE_CONFIG_LANG'                    => 'Langue',
    'ACP_EMOTINYMCE_CONFIG_CAPTION'                 => 'Texte du bouton',
    'ACP_EMOTINYMCE_CONFIG_CAPTION_EXPLAIN'         => 'Afficher les textes de boutons ?',
    'ACP_EMOTINYMCE_CONFIG_TIP'                    	=> 'Astuce pour le bouton',
    'ACP_EMOTINYMCE_CONFIG_TIP_EXPLAIN'            	=> 'Afficher les astuces pour les boutons ?',
    'ACP_EMOTINYMCE_CONFIG_SKIN'                    => 'Thème',
    'ACP_EMOTINYMCE_CONFIG_SKIN_EXPLAIN'            => 'Thème de l’éditeur',
    
    'ACP_EMOTINYMCE_skins'               			=> array(
														'default@' 		=> 'Défaut',
														'o2k7@' 		=> 'o2k7',
														'o2k7@sliver' 	=> 'o2k7 Sliver',
														'o2k7@black' 	=> 'o2k7 Black',
														),
));
?>