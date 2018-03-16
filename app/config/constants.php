<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
 * ---------------------------------------------------------------------
 * Define Database Message
 * ---------------------------------------------------------------------
 */ 
define('DB_TITLE_SAVE', 	'Saving Data');
define('DB_TITLE_UPDATE', 	'Updating Data');
define('DB_TITLE_DELETE', 	'Deleting Data');
define('DB_TITLE_CLONE', 	'Cloning Data');
define('DB_TITLE_RESULT', 	'Data Result');
define('DB_SUCCESS_SAVE', 	'Data has been saved.');
define('DB_SUCCESS_UPDATE', 'Data has been updated.');
define('DB_SUCCESS_DELETE', 'Data has been deleted.');
define('DB_SUCCESS_CLONE', 	'Data has been cloned.');
define('DB_NULL_RESULT', 	'Record is empty.');
define('ACTION_HISTORY_SAVE', 'Save');
define('ACTION_HISTORY_UPDATE', 'Update');
define('ACTION_HISTORY_DELETE', 'Delete');
define('ACTION_HISTORY_CLONE', 'Clone');
define('ACTION_HISTORY_LOGIN', 'Login');
define('ACTION_HISTORY_LOGOUT', 'Logout');
define('ACTION_HISTORY_FORGOT_PASSWORD', 'Forgot Password');

/*
 * ---------------------------------------------------------------------
 * Define Mail Code
 * ---------------------------------------------------------------------
 */  
define('MAIL_NEW_USER', 'new-user');
define('MAIL_FORGOT_PASSWORD', 'forgot-password');

/*
 * ---------------------------------------------------------------------
 * Define Config
 * ---------------------------------------------------------------------
 */ 
define('WWW_ROOT', 		"/var/www/Global/");
define('BASE_CMS', 		"");
define('BASE_API', 		"");										#GatewayCampaignManagement/API/
define('URL_PLATFORM',	"http://localhost/Global/");			#http://localhost/GatewayCampaignManagement/API/
define('URL_API', 		"");										#http://localhost/GatewayCampaignManagement/API/index.php/
define('ASSETS_CSS', 	"assets/css/");
define('ASSETS_JS', 	"assets/js/");
define('ASSETS_PLUGINS', "assets/plugins/");

#Assets for TOD
define('ASSETS_CSS_TOD', 	"assets/css/frontend/tod/");
define('ASSETS_JS_TOD', 	"assets/js/frontend/tod/");
define('ASSETS_IMAGES_TOD', "assets/images/frontend/tod/");

#Define Variable
define('GOOGLE_RECAPTCHA_SECRET', '6Leg5TkUAAAAAO71I8PE3Qw3pJl_2xXbzqZqYq3e');
define('GOOGLE_RECAPTCHA_VERIFY', 'https://www.google.com/recaptcha/api/siteverify?secret='.GOOGLE_RECAPTCHA_SECRET.'&response={RECAPTCHA-RESPONSE}&remoteip={IP-ADDRESS}');
define('SALT_SECURITY'			, 'PT.1nD0N3s1A_F4n7a5I_j4Ya_t0P_L3aD1n9_94Me_PubL15heR');