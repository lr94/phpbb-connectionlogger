<?php
/**
*
* @author Mickaël Salfati (Elglobo) http://www.phpbb-services.com
*
* @package acp
* @version $Id: acp_lc.php 2008-03-07 12:10:00 (local) $
* @copyright (c) 2007 phpBB-Services
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
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
