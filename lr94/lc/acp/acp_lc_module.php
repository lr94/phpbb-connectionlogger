<?php
namespace lr94\lc\acp;

use phpbb\pagination;

class acp_lc_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	public function main($id, $mode)
	{
		global $db, $user, $auth, $template, $request, $cache, $phpbb_container;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		
		// Set up general var		
		$action		= $request->variable('action', '');
		
		if ($mode == 'connections')
		{
			// Set up specific vars
			$forum_id	= $request->variable('f', 0);
			$start		= $request->variable('start', 0);
			$marked		= $request->variable('mark', array(0));
			$ip			= $request->variable('ip', 'ip');
			$usearch	= utf8_normalize_nfc($request->variable('usearch', '', true));
			$isearch	= $request->variable('isearch', '');
			$asearch	= $request->variable('asearch', 'ACP_LOGS_ALL');
			$deletemark	= (!empty($request->variable('delmarked', '', false, \phpbb\request\request_interface::POST))) ? true : false;
			$deleteall	= (!empty($request->variable('delall', '', false, \phpbb\request\request_interface::POST))) ? true : false;
			
			// Sort keys
			$sort_days	= $request->variable('st', 0);
			$sort_key	= $request->variable('sk', 't');
			$sort_dir	= $request->variable('sd', 'd');
		
			$this->tpl_name = 'acp_lc_view';
			$this->log_type = constant('LOG_CONNECTIONS');

			// Delete entries if requested and able
			if (($deletemark || $deleteall) && $auth->acl_get('a_clearlogs'))
			{
				if (confirm_box(true))
				{
					$where_sql = '';

					if ($deletemark && sizeof($marked))
					{
						$sql_in = array();
						foreach ($marked as $mark)
						{
							$sql_in[] = $mark;
						}
						$where_sql = ' AND ' . $db->sql_in_set('log_id', $sql_in);
						unset($sql_in);
					}

					if ($where_sql || $deleteall)
					{
						$sql = 'DELETE FROM ' . LOG_TABLE . "
							WHERE log_type = {$this->log_type}
							$where_sql";
						$db->sql_query($sql);

						add_admin_log('LOG_CLEAR_CONNECTIONS');
					}
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'start'		=> $start,
						'delmarked'	=> $deletemark,
						'delall'	=> $deleteall,
						'mark'		=> $marked,
						'st'		=> $sort_days,
						'sk'		=> $sort_key,
						'sd'		=> $sort_dir,
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> $action))
					);
				}
			}
			
			// Sorting
			$limit_days = array(0 => $user->lang['ALL_ENTRIES'], 1 => $user->lang['1_DAY'], 7 => $user->lang['7_DAYS'], 14 => $user->lang['2_WEEKS'], 30 => $user->lang['1_MONTH'], 90 => $user->lang['3_MONTHS'], 180 => $user->lang['6_MONTHS'], 365 => $user->lang['1_YEAR']);
			$sort_by_text = array('u' => $user->lang['SORT_USERNAME'], 't' => $user->lang['SORT_DATE'], 'i' => $user->lang['SORT_IP'], 'o' => $user->lang['SORT_ACTION']);
			$sort_by_sql = array('u' => 'u.username_clean', 't' => 'l.log_time', 'i' => 'l.log_ip', 'o' => 'l.log_operation');

			$s_limit_days = $s_sort_key = $s_sort_dir = $u_sort_param = '';
			gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);

			// Define where and sort sql for use in displaying logs
			$sql_where = ($sort_days) ? (time() - ($sort_days * 86400)) : 0;
			$sql_sort = $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'DESC' : 'ASC');

			$l_title = $user->lang['ACP_CONNECTIONS_LOGS'];
			$l_title_explain = $user->lang['ACP_CONNECTIONS_LOGS_EXPLAIN'];

			$this->page_title = $l_title;

			// Grab log data
			$log_data = array();
			$log_count = 0;
			$topic_per_page = (!empty($usearch) || !empty($isearch) || $asearch !== 'ACP_LOGS_ALL') ? '' : $config['topics_per_page'];
			view_log($mode, $log_data, $log_count, $topic_per_page, $start, $forum_id, 0, 0, $sql_where, $sql_sort);

			// Whois (special case)
			if ($action == 'whois')
			{
				include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

				$user->add_lang('acp/users');
				$this->page_title = 'WHOIS';
				$this->tpl_name = 'simple_body';

				$user_ip = $request->variable('user_ip', '');
				$domain = gethostbyaddr($user_ip);
				$ipwhois = user_ipwhois($user_ip);

				$template->assign_vars(array(
					'MESSAGE_TITLE'		=> sprintf($user->lang['IP_WHOIS_FOR'], $domain),
					'MESSAGE_TEXT'		=> nl2br($ipwhois))
				);

				return;
			}
			
			// Actions sorting
			$list_actions = array(
				'ACP_LOGS_ALL',
				'LOG_AUTH_SUCCESS',
				'LOG_AUTH_SUCCESS_AUTO',
				'LOG_ADMIN_AUTH_SUCCESS',
				'LOG_AUTH_FAIL',
				'LOG_AUTH_FAIL_BAN',
				'LOG_AUTH_FAIL_CONFIRM',
				'LOG_AUTH_FAIL_CONVERT',
				'LOG_AUTH_FAIL_INACTIVE',
				'LOG_AUTH_FAIL_UNKNOWN',
				'LOG_ADMIN_AUTH_FAIL',
				'LOG_ADMIN_AUTH_FAIL_NO_ADMIN',
				'LOG_ADMIN_AUTH_FAIL_DIFFER'
			);
			
			$nb_actions = count($list_actions);
			$s_asearch = '<select name="asearch">';
			for ($i = 0; $i < $nb_actions; $i++)
			{
				$selected = ( $list_actions[$i] == $asearch ) ? ' selected="selected"' : '';
				$s_asearch .= '<option value="' . $list_actions[$i] . '"' . $selected . '>' . $user->lang[$list_actions[$i]] . '</option>';
			}
			$s_asearch .= '</select>';
			
			$pagination = $phpbb_container->get('pagination');
			
			$template->assign_vars(array(
				'L_TITLE'		=> $l_title,
				'L_EXPLAIN'		=> $l_title_explain,
				'U_ACTION'		=> $this->u_action,

				'U_IP'			=> $this->u_action . "&amp;usearch=$usearch&amp;isearch=$isearch&amp;asearch=$asearch&amp;start=$start&amp;ip=" . (($ip == 'ip') ? 'hostname' : 'ip'),
				'L_IP'			=> ($ip == 'hostname') ? $user->lang['ACP_LOGS_HOSTNAME'] : $user->lang['IP'],
				'S_ASEARCH'		=> strip_tags($s_asearch, '<select><option>'),
				'S_ON_PAGE'		=> $pagination->on_page($log_count, $config['topics_per_page'], $start),

				//'PAGINATION'	=> ( empty($usearch) && empty($isearch) && $asearch == 'ACP_LOGS_ALL' )? generate_pagination($this->u_action . "&amp;$u_sort_param", $log_count, $config['topics_per_page'], $start, true) : '',

				'S_LIMIT_DAYS'	=> $s_limit_days,
				'S_SORT_KEY'	=> $s_sort_key,
				'S_SORT_DIR'	=> $s_sort_dir,
				'S_CLEARLOGS'	=> $auth->acl_get('a_clearlogs'),
				)
			);
			
			if (!empty($usearch))
			{
				$template->assign_var('USEARCH', $usearch);
			}
			if (!empty($isearch))
			{
				$template->assign_var('ISEARCH', $isearch);
			}
			
			if (empty($usearch) && empty($isearch) && $asearch == 'ACP_LOGS_ALL')
			{
				$pagination->generate_template_pagination($this->u_action . "&amp;$u_sort_param", 'pagination', 'start', $log_count, $config['topics_per_page'], $start);
			}

			foreach ($log_data as $row)
			{
				$data = array();
				
				$date = $user->format_date($row['time']);
				$log_number = ($row['number'] != 1) ? sprintf($user->lang['LOG_LC_INTERVAL'], $row['number'], $config['lc_interval']) : '';
				$action = (!preg_match("#" . $user->lang['ACP_LOGS_FAIL'] . "#", $row['action']) ? '<div class="log-success">' . $row['action'] . '</div>' : '<div class="log-fail">' . $row['action'] . '&nbsp;' . $log_number . '</div>');

				$template->assign_block_vars('log', array(
					'USERNAME'			=> $row['username_full'],
					
					'IP'				=> ($ip == 'hostname') ? gethostbyaddr($row['ip']) : $row['ip'],
					'DATE'				=> $date,
					'ACTION'			=> $action,
					'U_WHOIS'			=> $this->u_action . "&amp;action=whois&amp;user_ip={$row['ip']}",

					'DATA'				=> (sizeof($data)) ? implode(' | ', $data) : '',
					'ID'				=> $row['id'],
					)
				);
			}
			
			//$this->tpl_name = 'acp_lc';
			$this->page_title = $user->lang('ACP_CONNECTIONS_LOGS');
		}
		else if ($mode == 'log_connections')
		{
			// Set up specific var
			$submit = ($request->is_set_post('submit')) ? true : false;
			
			$form_key = 'acp_lc';
			add_form_key($form_key);
			
			$display_vars = array(
				'title'	=> 'ACP_CONNECTIONS_SETTINGS',
				'vars'	=> array(
							'legend1'					=> 'LC_SETTINGS',
							'lc_disable'				=> array(
											'lang'			=> 'LC_DISABLE',
											'validate'		=> 'bool',
											'type'			=> 'radio:yes_no',
											'explain'		=> true
							),
							'lc_acp_disable'			=> array(
											'lang'	 		=> 'LC_ACP_DISABLE',
											'validate'		=> 'bool',
											'type'			=> 'radio:yes_no',
											'explain'		=> true
							),
							'lc_founder_disable'		=> array(
											'lang'			=> 'LC_FOUNDER_DISABLE',
											'validate'		=> 'bool',
											'type'			=> 'radio:yes_no',
											'explain'		=> true
							),
							'lc_admin_disable'			=> array(
											'lang'			=> 'LC_ADMIN_DISABLE',
											'validate'		=> 'bool',
											'type'			=> 'radio:yes_no',
											'explain'		=> true
											),
							'lc_interval'				=> array(
											'lang'			=> 'LC_INTERVAL',
											'validate'		=> 'int',
											'type'			=> 'text:3:4',	
											'explain'		=> true
											),
							'lc_prune_day'				=> array(
											'lang'			=> 'LC_PRUNE_DAY',
											'validate'		=> 'int',
											'type'			=> 'text:3:4',
											'explain'		=> true)
				)
			);

			
			$this->new_config = $config;
			$cfg_array = ($request->is_set('config')) ? utf8_normalize_nfc($request->variable('config', array('' => ''), true)) : $this->new_config;
			$error = array();
			
			// We validate the complete config if whished
			validate_config_vars($display_vars['vars'], $cfg_array, $error);
			
			if ($submit && !check_form_key($form_key))
			{
				$error[] = $user->lang['FORM_INVALID'];
			}
			// Do not write values if there is an error
			if (sizeof($error))
			{
				$submit = false;
			}
			
			// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
			foreach ($display_vars['vars'] as $config_name => $null)
			{
				if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
				{
					continue;
				}

				$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

				if ($submit)
				{
					$config->set($config_name, $config_value);
				}
			}
			
			if ($submit)
			{
				
				add_admin_log('LOG_CONFIG_LOG_CONNECTIONS');

				trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
			}
			
			$this->tpl_name = 'acp_lc';
			$this->page_title = $display_vars['title'];
			
			$template->assign_vars(array(
				'L_TITLE'			=> $user->lang[$display_vars['title']],
				'L_TITLE_EXPLAIN'		=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

				'S_ERROR'			=> (sizeof($error)) ? true : false,
				'ERROR_MSG'			=> implode('<br />', $error),

				'U_ACTION'			=> $this->u_action)
			);
			
			$exclusubmit		= ($request->is_set_post('exclusubmit')) ? true : false;
			$unexclusubmit		= ($request->is_set_post('unexclusubmit')) ? true : false;
			$exclusion			= $request->variable('exclusion', '');		
			$exclusion_options	= $request->variable('exclusion_options', '');
			
			$sql = 'SELECT exclude_id, exclude_ip FROM ' . LOG_LC_EXCLUDE_IP_TABLE . ''; //TODO
			$result = $db->sql_query($sql);
			
			while ($row = $db->sql_fetchrow($result))
			{
				$exclusion_options .= '<option value="' . $row['exclude_id'] . '">' . $row['exclude_ip'] . '</option>';
			}
			
			if ($exclusubmit)
			{
				if (!empty($exclusion))
				{
					$exclusion_list = (!is_array($exclusion)) ? array_unique(explode("\n", $exclusion)) : $exclusion;
					$exclusion_list_log = implode(', ', $exclusion_list);
					
					$sql_ary = array();
					foreach ($exclusion_list as $exclusion_item)
					{				
						if (preg_match('#^([0-9]{1,3})\.([0-9\*]{1,3})\.([0-9\*]{1,3})\.([0-9\*]{1,3})$#', trim($exclusion_item)))
						{
							$sql_ary[] = array('exclude_ip' => $exclusion_item);
						}
						else
						{
							trigger_error($user->lang['LC_EXCLUDE_NO_IP'] . adm_back_link($this->u_action));
						}
					}
					$db->sql_multi_insert(LOG_LC_EXCLUDE_IP_TABLE, $sql_ary);
					$cache->destroy('sql', LOG_LC_EXCLUDE_IP_TABLE);
					
					add_admin_log('LOG_LC_EXCLUDE_IP', $exclusion_list_log);
					trigger_error($user->lang['LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'] . adm_back_link($this->u_action));
				}
			}
			else if ($unexclusubmit)
			{
				$exclusion = $request->variable('unexclusion', array(''));
				$unexclude_sql = array_map('intval', $exclusion);
				
				if ($exclusion)
				{
					$sql = 'SELECT exclude_ip AS unexclude_info
						FROM ' . LOG_LC_EXCLUDE_IP_TABLE . '
						WHERE ' . $db->sql_in_set('exclude_id', $unexclude_sql);
					$result = $db->sql_query($sql);
					
					$l_unexclude_list = '';
					
					while ($row = $db->sql_fetchrow($result))
					{
						$l_unexclude_list .= (($l_unexclude_list != '') ? ', ' : '') . $row['unexclude_info'];
					}
					$db->sql_freeresult($result);
					
					$sql = 'DELETE FROM ' . LOG_LC_EXCLUDE_IP_TABLE . '
						WHERE ' . $db->sql_in_set('exclude_id', $unexclude_sql);
					$db->sql_query($sql);
					$cache->destroy('sql', LOG_LC_EXCLUDE_IP_TABLE);
					
					add_admin_log('LOG_LC_UNEXCLUDE_IP', $l_unexclude_list);
					trigger_error($user->lang['LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'] . adm_back_link($this->u_action));
				}
			}
			
			$template->assign_vars(array(
				'S_EXCLUSION_OPTIONS'	=> ($exclusion_options) ? true : false,
				'EXCLUSION_OPTIONS'		=> $exclusion_options)
			);
			
			// Output relevant page
			foreach ($display_vars['vars'] as $config_key => $vars)
			{
				if (!is_array($vars) && strpos($config_key, 'legend') === false)
				{
					continue;
				}
				
				if (strpos($config_key, 'legend') !== false)
				{
					$template->assign_block_vars('options', array(
						'S_LEGEND'		=> true,
						'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
					);

					continue;
				}
				
				$type = explode(':', $vars['type']);
				
				$l_explain = '';
				if ($vars['explain'] && isset($vars['lang_explain']))
				{
					$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
				}
				else if ($vars['explain'])
				{
					$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
				}

				$template->assign_block_vars('options', array(
					'KEY'			=> $config_key,
					'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
					'S_EXPLAIN'		=> $vars['explain'],
					'TITLE_EXPLAIN'	=> $l_explain,
					'CONTENT'		=> build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
					)
				);
			
				unset($display_vars['vars'][$config_key]);
			}
			
		}
		else
		{
			trigger_error('NO_MODE', E_USER_ERROR);
		}
	}
	
	private function add_admin_log($log_operation)
	{
		global $phpbb_log, $user;
		$phpbb_log->add('admin', $user->data['user_id'], (empty($user->ip)) ? '' : $user->ip, $log_operation, time(), array());
	}
}
