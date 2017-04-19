<?php

/**
*
* @copyright (c) 2017 Luca Robbiano (lr94)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace lr94\lc\migrations;

use phpbb\db\migration\migration;

class lc_1_0_0 extends migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('lc_version', '1.0.0')),
			array('config.add', array('lc_ext_enable', false)),
			array('config.add', array('lc_disable', false)),
			array('config.add', array('lc_acp_disable', false)),
			array('config.add', array('lc_founder_disable', false)),
			array('config.add', array('lc_admin_disable', false)),
			array('config.add', array('lc_prune_entries', false)),
			array('config.add', array('lc_prune_day', 0)),
			array('config.add', array('lc_interval', 60)),

			array('module.add', array('acp',
					'ACP_FORUM_LOGS', array(
						'module_basename'	 => '\lr94\lc\acp\acp_lc_module',
						'modes'				 => array('connections'),
				 	)
				)
			),

			array('module.add', array('acp',
					'ACP_BOARD_CONFIGURATION', array(
						'module_basename'		=> '\lr94\lc\acp\acp_lc_module',
						'modes'					=> array('log_connections'),
					)
				)
			)
		);
	}
	
	public function effectively_installed()
	{
		return isset($this->config['lc_version']);
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
							LOG_TABLE => array(
								'log_number'	 => array('UINT', 1),
									  ),
						 ),
			'add_tables'	 => array(
							$this->table_prefix . 'log_lc_exclude_ip'   => array(
									'COLUMNS'	=> array(
										'exclude_id'		=> array('UINT', NULL, 'auto_increment'),
										'exclude_ip'		=> array('VCHAR:40', ''),				
									 ),
									'PRIMARY_KEY'	=> 'exclude_id',
							),
			)
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
							LOG_TABLE => array(
								'log_number',
							),
			),
			'drop_tables'	 => array($this->table_prefix . 'log_lc_exclude_ip'),
		);
	}
}
