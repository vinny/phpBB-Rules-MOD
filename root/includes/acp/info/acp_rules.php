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

class acp_rules_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_rules',
			'title'		=> 'ACP_RULES_OVERVIEW',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'	=> array(
					'title'			=> 'ACP_RULES_CONFIG',
					'auth'			=> 'acl_a_board',
					'cat'			=> array('ACP_RULES_OVERVIEW'),
				),
			),
		);
	}
}

?>