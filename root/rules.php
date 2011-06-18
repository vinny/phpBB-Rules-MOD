<?php
/**
*
* @package phpBB Rules MOD
* @version $Id$
* @copyright (c) 2011 _Vinny_ vinny@suportephpbb.com.br http://www.suportephpbb.com.br
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @Based on phpBB3 Partners by djchrisnet <mods@djchrisnet.de>
* Original MOD: http://www.phpbb.com/community/viewtopic.php?f=70&t=1251215
* MOD Author Profile: http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=351327
* MOD Author Homepage: http://www.mods.djchrisnet.de/
*
**/

/**
* @ignore
*/

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' .$phpEx);
include($phpbb_root_path . 'includes/bbcode.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/rules');

	//Catch data from DB but only aktiv partners
	$sql = 'SELECT id, title, content, bbcode_uid, bbcode_bitfield
				FROM ' . RULES_TABLE . '
				WHERE id <> 0
			ORDER BY id ASC';
	$result = $db->sql_query($sql);
	
while ($row = $db->sql_fetchrow($result))
{

$content = generate_text_for_display($row['content'], $row['bbcode_uid'], $row['bbcode_bitfield'], 7);

$template->assign_block_vars('rules', array(
	'ID'		=> censor_text($row['id']),
	'TITLE'		=> censor_text($row['title']),
	'CONTENT'		=> $content,
));	
}


if (!$row)
{
	$template->assign_vars(array(
		'NO_ENTRY'	=> ($user->lang['NO_RULES']),
	));
}

// Show MOD name in navbar
$template->assign_block_vars('navlinks', array(
	'FORUM_NAME' => $user->lang['RULES'],
	'U_VIEW_FORUM' => append_sid('rules.'.$phpEx),
));

// Output page
page_header($user->lang['RULES']);

$template->set_filenames(array(
	'body' => 'rules_body.html')
);

page_footer();
?>