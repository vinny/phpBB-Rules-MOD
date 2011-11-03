<?php
/**
 *
 * @author _Vinny_ (http://www.suportephpbb.com.br/) vinnykun@hotmail.com
 * @version $Id$
 * @copyright (c) 2011 
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
$mod_name = 'ACP_RULES_OVERVIEW';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'rules_version';


// The language file which will be included when installing
$language_file = 'mods/rules';


/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
//$logo_img = 'styles/prosilver/imageset/site_logo.gif';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'0.0.3' => array(
		
		// Now add the table
		'table_add' => array(
			array('phpbb_rules', array(
				'COLUMNS' => array(
					'id'			=> array('UINT:11', NULL, 'auto_increment'),
					'title'			=> array('VCHAR:255', ''),
					'content'		=> array('MTEXT', ''),
					'bbcode_uid'	=> array('VCHAR:8', ''),
					'bbcode_bitfield'	=> array('VCHAR:255', ''),
				),
				'PRIMARY_KEY'	=> 'id',
			)),

		),
		
		// Now add the module
		'module_add' => array(
			// First, lets add a new category named ACP_RULES_OVERVIEW to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_RULES_OVERVIEW'),
			// next let's add our module
			array('acp', 'ACP_RULES_OVERVIEW', array(
					'module_basename'	=> 'rules',
					'modes'				=> array('settings'),
				),
			),
		),

	),
);

// Include the UMIL Auto file, it handles the rest
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>