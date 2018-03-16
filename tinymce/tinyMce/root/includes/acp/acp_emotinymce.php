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

/**
* @package acp
*/
class acp_emotinymce
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;
		$form_key = 'acp_emotinymce';
		add_form_key($form_key);


      switch($mode)
      {
         case 'config':
            $this->page_title = $user->lang['ACP_EMOTINYMCE_MOD_TITLE'];
            $this->tpl_name = 'acp_emotinymce';

				$display_vars = array(
					'title'	=> $this->page_title,
					'vars'	=> array(
						'legend1'				=> 'ACP_EMOTINYMCE_LEGEND1',
						'emotinymce_enable'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_ENABLE',			'validate' => 'bool',	'type' => 'radio:enabled_disabled', 'explain' => true),
						'emotinymce_qq'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_QQ',			'validate' => 'bool',	'type' => 'radio:enabled_disabled', 'explain' => true),
						'emotinymce_mobile'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_MOBILE',			'validate' => 'bool',	'type' => 'radio:enabled_disabled', 'explain' => true),
						'emotinymce_allowuser'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_ALLOWUSER',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'emotinymce_spellchecker'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'legend2'				=> 'LEGEND2',
						'emotinymce_width'		=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_WIDTH', 'validate' => 'int:0', 'type' => 'text:6:6', 'method' => false, 'explain' => true,),
						'emotinymce_height'		=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_HEIGHT', 'validate' => 'int:0', 'type' => 'text:6:6', 'method' => false, 'explain' => true,),
						'emotinymce_qwidth'		=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_QWIDTH', 'validate' => 'int:0', 'type' => 'text:6:6', 'method' => false, 'explain' => true,),
						'emotinymce_qheight'		=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_QHEIGHT', 'validate' => 'int:0', 'type' => 'text:6:6', 'method' => false, 'explain' => true,),
						'legend3'				=> 'LEGEND3',
						'emotinymce_lang'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_LANG',		'validate' => 'lang',	'type' => 'select', 'function' => 'language_select', 'params' => array('{CONFIG_VALUE}'), 'explain' => false),
						'emotinymce_rtl'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_DIR',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'emotinymce_caption'		=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_CAPTION',		'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'emotinymce_tip'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_TIP',			'validate' => 'bool',	'type' => 'radio:yes_no', 'explain' => true),
						'emotinymce_skin'			=> array('lang' => 'ACP_EMOTINYMCE_CONFIG_SKIN',		'validate' => 'string',	'type' => 'select', 'method' => 'skins_select', 'explain' => true),
					)
				);
			
            break;
      }

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		foreach ($display_vars['vars'] as $config_name => $null)
		{

			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}

			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($submit)
			{
				set_config($config_name, $config_value);
			}
		
		}

		if ($submit)
		{
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			//'L_TITLE'			=> $user->lang[$display_vars['title']],
			//'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ACTION'			=> $this->u_action)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}

   }


	/**
	* Select skin
	*/
	function skins_select($value, $key)
	{
		global $user, $config;
		
		$skin_options = '';

		foreach ($user->lang['ACP_EMOTINYMCE_skins'] as $skin => $skinval)
		{
			$skin_options .= '<option value="' . $skin . '"' . (($skin == $value) ? ' selected="selected"' : '') . '>';
			$skin_options .= $skinval;
			$skin_options .= '</option>';
		}

		return $skin_options;
	}


}
?>