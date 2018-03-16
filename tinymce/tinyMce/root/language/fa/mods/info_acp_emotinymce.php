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
	'ACP_EMOTINYMCE_CONFIG_TITLE'					=> 'تنظیمات ویرایشگر',
	'ACP_EMOTINYMCE_TITLE'							=> 'تنظیمات ویرایشگر',
	'ACP_EMOTINYMCE_LEGEND1'						=> 'عمومی',
	'ACP_EMOTINYMCE_LEGEND2'						=> 'اندازه',
	'ACP_EMOTINYMCE_LEGEND3'						=> 'واسط کاربری',
	'ACP_EMOTINYMCE_CONFIG_ENABLE'					=> 'وضعیت',
	'ACP_EMOTINYMCE_CONFIG_ENABLE_EXPLAIN'			=> 'فعال بودن ویرایشگر پیشرفته؟',
	'ACP_EMOTINYMCE_CONFIG_QQ'						=> 'نقل قول سریع',
	'ACP_EMOTINYMCE_CONFIG_QQ_EXPLAIN'				=> '(افزونه ویرایشگر سریع لازم است)',
	'ACP_EMOTINYMCE_CONFIG_MOBILE'					=> 'فعال برای موبایل',
	'ACP_EMOTINYMCE_CONFIG_MOBILE_EXPLAIN'			=> 'فعال کردن ویرایشگر برای دستگاه های موبایل (پیشنهاد نمی شود)',
	'ACP_EMOTINYMCE_CONFIG_ALLOWUSER'				=> 'اجازه انتخاب ویرایشگر',
	'ACP_EMOTINYMCE_CONFIG_ALLOWUSER_EXPLAIN'		=> 'اجازه انتخاب ویرایشگر پیش فرض یا پیشرفته به کاربران',
	'ACP_EMOTINYMCE_CONFIG_DIR'						=> 'راست چین',
	'ACP_EMOTINYMCE_CONFIG_DIR_EXPLAIN'				=> 'راست چین کردن ویرایشگر',
	'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER'			=> 'غلط یاب',
	'ACP_EMOTINYMCE_CONFIG_SPELLCHECKER_EXPLAIN'	=> 'فعال بودن غلط یاب؟',
	'ACP_EMOTINYMCE_CONFIG_WIDTH'					=> 'عرض ویرایشگر کامل',
	'ACP_EMOTINYMCE_CONFIG_WIDTH_EXPLAIN'			=> '0 = پیش فرض',
	'ACP_EMOTINYMCE_CONFIG_HEIGHT'					=> 'ارتفاع ویرایشگر کامل',
	'ACP_EMOTINYMCE_CONFIG_HEIGHT_EXPLAIN'			=> '0 = پیش فرض',
	'ACP_EMOTINYMCE_CONFIG_QWIDTH'					=> 'عرض ویرایشگر سریع',
	'ACP_EMOTINYMCE_CONFIG_QWIDTH_EXPLAIN'			=> 'درصورت نصب بودن افزونه. (0 = پیش فرض)',
	'ACP_EMOTINYMCE_CONFIG_QHEIGHT'					=> 'ارتفاع ویرایشگر سریع',
	'ACP_EMOTINYMCE_CONFIG_QHEIGHT_EXPLAIN'			=> 'درصورت نصب بودن افزونه. (0 = پیش فرض)',
	'ACP_EMOTINYMCE_CONFIG_LANG'					=> 'زبان',
	'ACP_EMOTINYMCE_CONFIG_CAPTION'					=> 'متن دکمه',
	'ACP_EMOTINYMCE_CONFIG_CAPTION_EXPLAIN'			=> 'نمایش متن دکمه ها؟',
	'ACP_EMOTINYMCE_CONFIG_TIP'						=> 'نکته دکمه',
	'ACP_EMOTINYMCE_CONFIG_TIP_EXPLAIN'				=> 'نمایش متن نکته دکمه ها؟',
	'ACP_EMOTINYMCE_CONFIG_SKIN'					=> 'پوسته',
	'ACP_EMOTINYMCE_CONFIG_SKIN_EXPLAIN'			=> 'پوسته ویرایشگر',
	
	'ACP_EMOTINYMCE_skins'							=> array(
															'default@' => 'پیش فرض',
															 'o2k7@' => 'o2k7',
															 'o2k7@sliver' => 'o2k7 نقره ای',
															 'o2k7@black' => 'o2k7 مشکی',
														),
));
?>