<?php

/**
*
* Stop forum Spam extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 Luca Robbiano (lr94)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace lr94\lc\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\user;
use \phpbb\config\config;
use phpbb\db\driver\driver_interface as db_interface;
use \phpbb\controller\helper;
use \phpbb\template\template;
use \phpbb\request\request;

class main_listener implements EventSubscriberInterface
{
	protected $config;
	protected $db;
	protected $user;
	protected $template;
	protected $request;
	protected $table_prefix;

	public function __construct(config $config, db_interface $db, user $user, helper $helper, template $template, request $request, $table_prefix)
	{
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->helper = $helper;
		$this->template = $template;
		$this->request = $request;
		
		$this->table_prefix = $table_prefix;
	}
	
	private function add($mode, $user_id, $log_operation, $additional_data = '')
	{
		global $phpbb_log;
		$phpbb_log->add($mode, $user_id, $this->user->ip, $log_operation, false, array($additional_data));
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.common'								=> 'define_constants',
			'core.add_log'								=> 'add_log_modify',
			'core.auth_login_session_create_before'		=> 'auth_login',
			'core.session_create_after'					=> 'log_autologin',
			'core.get_logs_modify_type'					=> 'get_logs_modify',
			'core.get_logs_modify_entry_data'			=> 'log_modify_entry'
		);
	}
	
	public function log_autologin($event)
	{
		// Check if the event has already been logged
		global $lr94_lc_already_logged; // TODO...is this actually necessary?

		if (!isset($lr94_lc_already_logged) && $event['session_data']['session_autologin'])
		{
			if(!($this->config['lc_founder_disable'] && $this->user->data['user_type'] == USER_FOUNDER) // Logs disabled for successful founder connection?
			&& !($this->config['lc_admin_disable'] && $this->is_admin($event['session_data']['session_user_id']))) // Logs disabled for successful admin connection?)
			{
				$this->add('connections', $event['session_data']['session_user_id'], 'LOG_AUTH_SUCCESS_AUTO', $event['session_data']['session_page']);
			}
		}
	}
	
	public function define_constants($event)
	{
		if (!defined('LOG_CONNECTIONS'))
		{
			define('LOG_CONNECTIONS', 4);
			define('LOG_LC_EXCLUDE_IP_TABLE', $this->table_prefix . 'log_lc_exclude_ip');
		}
	}
	
	public function add_log_modify($event)
	{
		$db = $this->db;
		$user = $this->user;
		$config = $this->config;
		$mode = $event['mode'];
		$action = $event['log_operation'];
		$additional_data = $event['additional_data'];
		$sql_ary = $event['sql_ary'];
		$user_id = $event['user_id'];
		
		$data = (!empty($additional_data)) ? serialize($additional_data) : '';
		
		if ($mode == 'connections')
		{
			// Prevent log connections if installer has not been run
			if (!isset($this->config['lc_version']))
			{
				return;
			}
			
			$current_time = time();
			$cache_ttl = 3600;
			$lc_interval = $config['lc_interval'];
			
			if (!$config['lc_disable'])
			{
				// Check for excluded IPs
				$sql = 'SELECT exclude_ip FROM ' . LOG_LC_EXCLUDE_IP_TABLE;
				$result = $db->sql_query($sql, $cache_ttl);
				while ($row = $db->sql_fetchrow($result))
				{
					if (preg_match('#^' . str_replace('\*', '.*?', preg_quote($row['exclude_ip'], '#')) . '$#i', $sql_ary['log_ip']))
					{
						return false;
					}
				}
				$db->sql_freeresult($result);
			
				//Check intervall for log failed
				if ( strpos($action, 'FAIL') !== FALSE && $lc_interval > 0 )
				{
					$sql = 'SELECT log_id
						FROM ' . LOG_TABLE . '
						WHERE log_type = ' . LOG_CONNECTIONS . "
						AND log_operation = '" . $db->sql_escape($action) . "'
						AND log_data = '" . $data . "'
						AND log_ip = '" . $db->sql_escape($user->ip) . "'
						AND user_id = $user_id
						AND log_time > ($current_time - $lc_interval) 
						ORDER BY log_id DESC";
					$result = $db->sql_query($sql);
				
					if ($row = $db->sql_fetchrow($result))
					{
						$sql = 'UPDATE ' . LOG_TABLE . "
							SET log_number	= log_number + 1,
							log_time = $current_time
							WHERE log_id = " . $row['log_id'];
						$db->sql_query($sql);
						return false;
					}
				}				
				//Check for founder user
				if ( $config['lc_founder_disable'] && $user->data['user_type'] == USER_FOUNDER && strpos($action, 'SUCCESS') !== FALSE )
				{				
					return false;
				}
				//Check for admin user
				if ( $config['lc_admin_disable'] && $user->data['user_type'] == USER_NORMAL && strpos($action, 'SUCCESS') !== FALSE )
				{
					if ( $user_id == $user->data['user_id'] )
					{
						$data = $user->data;
					}
					else
					{
						$sql = 'SELECT * FROM ' . USERS_TABLE . " WHERE user_id =" . $user_id;
						$result = $db->sql_query($sql);
						$data = $db->sql_fetchrow($result);
					}
					$auth_temp = new auth();
					$auth_temp->acl($data);
					$droit_admin = $auth_temp->acl_get('a_');
					if ($droit_admin)
					{
						return false;
					}
				}
				else
				{				
					$sql_ary['log_type'] = LOG_CONNECTIONS;
				}
			}
			else
			{
				// return false;
			}
		}
		
		$sql_ary['log_data'] = $data;
		$event['sql_ary'] = $sql_ary;
	}
	
	public function auth_login($event)
	{
		global $lr94_lc_already_logged;
		if ($this->config['lc_disable'])
		{
			return;
		}
	
		$login = $event['login'];
		$admin = $event['admin'];
		$username = $event['username'];
		$autologin = $event['autologin'];
		$user = $this->user;
		
		$row = $login['user_row'];
		
		if ($login['status'] == LOGIN_SUCCESS)
		{
			if (!$admin && !defined('IN_CHECK_BAN')
					&& !($this->config['lc_founder_disable'] && $row['user_type'] == USER_FOUNDER) // Logs disabled for successful founder connection?
					&& !($this->config['lc_admin_disable'] && $this->is_admin($row['user_id'])) // Logs disabled for successful admin connection?
				)
			{
				if ($autologin)
				{
					// TODO does it work?
					$this->add('connections', $row['user_id'], 'LOG_AUTH_SUCCESS_AUTO', $user->data['session_page']);
				}
				else
				{
					$this->add('connections', $row['user_id'], 'LOG_AUTH_SUCCESS');
				}
			}
			else if (!$admin && defined('IN_CHECK_BAN'))
			{
				$this->add('connections', $row['user_id'], 'LOG_AUTH_FAIL_BAN');
			}
			else if ($admin && !defined('IN_CHECK_BAN') && !$config['lc_acp_disable'])
			{
				$this->add('connections', $row['user_id'], 'LOG_ADMIN_AUTH_SUCCESS');
			}
		}
		else
		{
			switch ($login['error_msg'])
			{
				case 'NO_PASSWORD_SUPPLIED':
					if (!$user->data['is_registered'])
					{
						$this->add('connections', ANONYMOUS, 'LOG_AUTH_FAIL_NO_PASSWORD', $username);
					}
					break;
				case 'LOGIN_ERROR_USERNAME':
					if (!$user->data['is_registered'])
					{
						$this->add('connections', ANONYMOUS, 'LOG_AUTH_FAIL_UNKNOWN', $username);
					}
					break;
				case 'LOGIN_ERROR_PASSWORD':
					if (!$user->data['is_registered'])
					{
						$this->add('connections', $row['user_id'], 'LOG_AUTH_FAIL');
					}
					else if ($admin)
					{
						$this->add('connections', $row['user_id'], 'LOG_ADMIN_AUTH_FAIL');
					}
					break;
				case 'ACTIVE_ERROR':
					$this->add('connections', $row['user_id'], 'LOG_AUTH_FAIL_INACTIVE');
					break;
				case 'LOG_AUTH_FAIL_CONVERT':
					if (!$user->data['is_registered'])
					{
						$this->add('connections', $row['user_id'], 'LOG_AUTH_FAIL_CONVERT');
					}
					break;					
				default:
			}
		}
		
		$lr94_lc_already_logged = true;
	}
	
	public function get_logs_modify($event)
	{
		$mode = $event['mode'];
		$db = $this->db;
		
		if ($mode == 'connections')
		{
			if ( $this->config['lc_prune_day'] > 0 )
			{
				$sql = 'DELETE FROM ' . LOG_TABLE . '
							WHERE log_type = ' . LOG_CONNECTIONS . '
							AND log_time < ' . (time() - $this->config['lc_prune_day']*86400);
				$this->db->sql_query($sql);
			}
			
			$usearch = utf8_normalize_nfc($this->request->variable('usearch', '', true));
			$isearch = $this->request->variable('isearch', '');
			$asearch = $this->request->variable('asearch', 'ACP_LOGS_ALL');
			
			$sql_where = '';
			
			if (!empty($usearch))
			{
				$sql_where = " AND u.username_clean " . $db->sql_like_expression($db->get_any_char() . utf8_clean_string($usearch) . $db->get_any_char()) . ' ';
			}
			
			if (!empty($isearch))
			{
				$sql_where = " AND l.log_ip " . $db->sql_like_expression($isearch . $db->get_any_char()) . ' ';
			}
			
			if ($asearch !== 'ACP_LOGS_ALL')
			{
				$sql_where = " AND l.log_operation " . $db->sql_like_expression($asearch) . ' ';
			}
			
			$event['log_type'] = LOG_CONNECTIONS;
			$event['sql_additional'] = $sql_where;
		}
	}
	
	public function log_modify_entry($event)
	{
		$log_entry_data = $event['log_entry_data'];
		$log_entry_data['number'] = !empty($event['row']['log_number']) ? $event['row']['log_number'] : '';
		$event['log_entry_data'] = $log_entry_data;
	}

	/* When this function is called the session hasn't been created yet, so I guess this is the only
	   way we have to know if the user is an administrator or not... */
	private function is_admin($user_id)
	{
		$sql = $this->db->sql_build_query('SELECT', array(
			'SELECT'	=> 'count(*) AS is_admin',
			'FROM'		=> array(
				USERS_TABLE			=> 'u',
				GROUPS_TABLE		=> 'g',
				USER_GROUP_TABLE	=> 'ug'
			),
			'WHERE'		=> "u.user_id = ug.user_id
							AND
							g.group_id = ug.group_id
							AND
							g.group_name = 'ADMINISTRATORS'
							AND
							u.user_id = " . (int)$user_id
		));

		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);

		return $row['is_admin'] > 0;
	}
}

