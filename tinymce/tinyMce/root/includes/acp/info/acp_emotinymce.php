<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_emotinymce_info
{
    function module()
    {
        return array(
            'filename'    => 'acp_emotinymce',
            'title'        => 'ACP_EMOTINYMCE_MOD_TITLE',
            'version'    => '1.0.0',
            'modes'        => array(
                'config'		=> array(
            								'title' => 'ACP_EMOTINYMCE_CONFIG_TITLE',
            								'auth' => 'acl_a_emotinymce_mod',
            								'cat' => array('ACP_CAT_DOT_MODS')
            							),
            ),
        );
    }

    function install()
    {
    }

    function uninstall()
    {
    }
}
?>