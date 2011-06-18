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
* DO NOT CHANGE
*/
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
	'ACP_RULES_OVERVIEW'	=> 'phpBB Rules MOD',
	'ACP_RULES_OVERVIEW_EXPLAIN'	=> 'Here you can manage the rules of your board.',
	'ACP_RULES_CONFIG'		=> 'Rules Settings',
	'ACP_RULE_ID'			=> 'Rule ID',
	'ACP_RULE_TITLE'		=> 'Rule title',
	'ACP_RULE_TITLE_EXPLAIN'=> 'Enter the title of the rule.',
	'ACP_RULE_DESC'			=> 'Rule description',
	'ACP_RULE_DESC_EXPLAIN'	=> 'Enter the description of the rule.',

	'ACP_RULE_ADD'			=> 'Add rule',
	'ACP_RULE_EDIT'			=> 'Edit rule',
	'ACP_RULE_DELETE'		=> 'Are you sure you wish to delete this rule?',
	
	'ACP_RULE_CREATED'		=> 'Rule created successfully',
	'ACP_RULE_DELETED'		=> 'Rule deleted successfully',
	'ACP_RULE_UPDATED'		=> 'Rule updated successfully!',
	
	'ACP_NEED_TITLE'	=> 'You must enter a <strong>title</strong> for this rule.',
	'ACP_NEED_DESC'		=> 'You must enter a <strong>description</strong> for this rule.',
	'ACP_NEED_DATA'		=> 'You must enter a <strong>title</strong> and <strong>description</strong> for this rule.',

	'RULES'					=> 'Rules',
	'NO_RULES'				=> 'No rules',

//	@install
	'ACP_RULES_INSTALL'		=> 'phpBB Rules MOD',

));

?>