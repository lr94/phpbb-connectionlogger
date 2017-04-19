<?php

/**
*
* @copyright (c) 2017 Luca Robbiano (lr94)
* @copyright (c) ???? Mickaël Salfati (Elglobo)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace lr94\lc\acp;

class acp_lc_info
{
	public function module()
	{
		return array(
			'filename'	=> '\lr94\lc\acp\acp_lc_module',
			'title'		=> 'ACP_CONNECTIONS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'log_connections'	=> array(
								'title'	=> 'ACP_CONNECTIONS_SETTINGS',
								'auth'	=> 'ext_lr94/lc && acl_a_board',
								'cat'	=> array('ACP_CONNECTIONS')
								),
				'connections'		=> array(
								'title'	=> 'ACP_CONNECTIONS_LOGS',
								'auth'	=> 'ext_lr94/lc && acl_a_viewlogs',
								'cat'	=> array('ACP_CONNECTIONS')),
			),
		);
	}
}
?>
