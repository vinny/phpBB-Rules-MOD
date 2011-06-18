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
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_rules
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $template;
		global $config, $phpbb_root_path, $phpEx;
		
		// MOD language file gets added automatically
		$user->add_lang(array('posting'));
		
		// Template and page title
		$this->tpl_name = 'acp_rules';
		$this->page_title = 'ACP_RULES_OVERVIEW';
		
		$form_name = 'acp_rules';
		add_form_key($form_name);

		$form_action = $this->u_action. '&amp;action=add';
		$user->add_lang('mods/rules');
		$lang_mode = $user->lang['ACP_RULE_ADD'];
		$action = (!isset($_GET['action'])) ? '' : $_GET['action'];
		$action = ((isset($_POST['submit']) && !$_POST['id']) ? 'add' : $action );
		$id = request_var('id', 0);
		$title = request_var('title', '', true);
		$content = request_var('content', '');
		
		//Settings
		$uid = $bitfield = $options = '';
		$allow_bbcode = $allow_urls = $allow_smilies = true; 
		$content = utf8_normalize_nfc(request_var('content', '', true));
		generate_text_for_storage($content, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

		//Make SQL Array
		$sql_ary = array(
			'title'				=> $title,
    		'content'			=> $content,
			'bbcode_uid'		=> $uid,
    		'bbcode_bitfield'	=> $bitfield,
		);
		
		switch ($action)
		{
			// Add new Adcode
			case 'add':
				if (!function_exists('display_custom_bbcodes'))
				{
					include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
				}
			if ($title == '' || $content == '')
			{
				if ($title == '' && $content == '')
				{
				trigger_error($user->lang['ACP_NEED_DATA'] . adm_back_link($this->u_action));	
				}
				elseif ($title == '')
				{
				trigger_error($user->lang['ACP_NEED_TITLE'] . adm_back_link($this->u_action));	
				}
				elseif ($content == '')
				{
				trigger_error($user->lang['ACP_NEED_DESC'] . adm_back_link($this->u_action));	
				}
				
			}
			else
			{
				$db->sql_query('INSERT INTO ' . RULES_TABLE .' ' . $db->sql_build_array('INSERT', $sql_ary));
				trigger_error($user->lang['ACP_RULE_CREATED'] . adm_back_link($this->u_action));
			}
				// Assigning custom bbcodes
				display_custom_bbcodes();
			break;

			// Edit Ad
			case 'edit':
				$form_action = $this->u_action. '&amp;action=update';
				$lang_mode = $user->lang['ACP_RULE_EDIT'];
				$sql = 'SELECT *
					FROM ' . RULES_TABLE . ' 
					WHERE id = ' . $id;
				$result = $db->sql_query_limit($sql,1);
				$row = $db->sql_fetchrow($result);
				decode_message($row['content'], $row['bbcode_uid']);
 
				$template->assign_vars(array(
					'ID'			=> $row['id'],
					'TITLE'			=> $row['title'],
					'CONTENT'		=> $row['content'],
					));
			break;

			// Update an Ad
			case 'update':
			
			if ($title == '' || $content == '')
			{
				if ($title == '' && $content == '')
				{
				trigger_error($user->lang['ACP_NEED_DATA'] . adm_back_link($this->u_action));	
				}
				elseif ($title == '')
				{
				trigger_error($user->lang['ACP_NEED_TITLE'] . adm_back_link($this->u_action));	
				}
				elseif ($content == '')
				{
				trigger_error($user->lang['ACP_NEED_DESC'] . adm_back_link($this->u_action));	
				}
				
			}
			else
			{
			
				$db->sql_query('UPDATE ' . RULES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE ID = ' . $id);
				trigger_error($user->lang['ACP_RULE_UPDATED'] . adm_back_link($this->u_action));
			}
			break;

			// Delete 
			case 'delete':
				if (confirm_box(true))
				{
					$sql = 'DELETE FROM ' . RULES_TABLE . "
						WHERE id = $id";
					$db->sql_query($sql);
					trigger_error($user->lang['ACP_RULE_DELETED'] . adm_back_link($this->u_action));
				}
				else
				{
					confirm_box(false, $user->lang['ACP_RULE_DELETE'], build_hidden_fields(array(
						'id'			=> $id,
						'action'	=> 'delete',
					)));
				}
			break;
		}

		//
		// Start output the page
		//
		// List all rules in the System
		$sql = 'SELECT *
			FROM ' . RULES_TABLE . ' 
			ORDER by id';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('rules', array(
				'TITLE'			=> $row['title'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' .$row['id'],
				'U_DEL'			=> $this->u_action . '&amp;action=delete&amp;id=' .$row['id'],

			));
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'U_ACTION'		=> $form_action,
			'L_MODE_TITLE'	=> $lang_mode,
			));
	
	}
}

?>