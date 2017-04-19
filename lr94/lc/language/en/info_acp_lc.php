<?php

/**
*
* @copyright (c) 2017 Luca Robbiano (lr94)
* @copyright (c) ???? Mickaël Salfati (Elglobo)
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

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

$lang = array_merge($lang, array(
	'ACP_CONNECTIONS_LOGS'			=> 'Connection log',
	'ACP_CONNECTIONS_LOGS_EXPLAIN'	=> 'This lists all the connections done on board. You can sort/filter by username, date, IP or action. If you have appropriate permissions you can also clear individual operations or the log as a whole.',
	'ACP_LOGS_GOODIES'				=> '<strong>Trick</strong>: You can look up all IPs by clicking on the name of the column and display <em>Whois</em> by clicking above IP.',
	'ACP_LOGS_HOSTNAME'				=> 'Hostnames',
	'ACP_LOGS_SORT'					=> 'Sort',
	'ACP_LOGS_ALL'					=> 'All',
	'ACP_LOGS_FAIL'					=> 'Failure',
	
	'LOG_CLEAR_CONNECTIONS'			=> '<strong>Cleared connection log</strong>',
	'LOG_CONFIG_LOG_CONNECTIONS'	=> '<strong>Altered connection log settings</strong>',
	'LOG_AUTH_SUCCESS'				=> '<strong>Connected successfully</strong>',
	'LOG_AUTH_SUCCESS_AUTO'			=> '<strong>Connected successfully (Autologged)</strong><br />» %s',
	'LOG_AUTH_FAIL'					=> '<strong>Failure</strong> - incorrect password',
	'LOG_AUTH_FAIL_NO_PASSWORD'     => '<strong>Failure</strong> - no password supplied<br />» %s',
	'LOG_AUTH_FAIL_BAN'				=> '<strong>Failure</strong> - username banned',
	'LOG_AUTH_FAIL_CONFIRM'			=> '<strong>Failure</strong> - incorrect confirmation code',
	'LOG_AUTH_FAIL_CONVERT'			=> '<strong>Failure</strong> - password not converted',
	'LOG_AUTH_FAIL_INACTIVE'		=> '<strong>Failure</strong> - inactive user',
	'LOG_AUTH_FAIL_UNKNOWN'			=> '<strong>Failure</strong> - non-existent user<br />» %s',
	'LOG_ADMIN_AUTH_FAIL'			=> '<strong>Failure to ACP</strong> - incorrect password',
	'LOG_ADMIN_AUTH_FAIL_NO_ADMIN'	=> '<strong>Failure to ACP</strong> - unauthorized',
	'LOG_ADMIN_AUTH_FAIL_DIFFER'	=> '<strong>Failure to ACP</strong> - re-authenticated as a different user<br />» %s',
	'LOG_ADMIN_AUTH_SUCCESS'		=> '<strong>Connected successfully to ACP</strong>',
	'LOG_LC_EXCLUDE_IP'				=> '<strong>Excluded IP in connection log</strong><br />» %s',
	'LOG_LC_UNEXCLUDE_IP'			=> '<strong>Un-excluded IP in connection log</strong><br />» %s',
	'LOG_LC_INTERVAL'				=> '(%s attempts)',
	
	// Settings panel
	'ACP_CONNECTIONS'				=> 'Connection log',
	'ACP_CONNECTIONS_SETTINGS'		=> 'Connection log settings',
	'ACP_CONNECTIONS_SETTINGS_EXPLAIN'		=> 'From this panel you can configure all settings for connection log.<br />You can also <em>exclude (or un-exclude)</em> IP addresses in connection log.',
	'LC_SETTINGS'					=> 'Configuration',
	'LC_PRUNING'					=> 'Auto-pruning',
	'LC_DISABLE'					=> 'Disable logging',
	'LC_DISABLE_EXPLAIN'			=> 'This option disable <em>entirely</em> logging of connection.',
	'LC_ACP_DISABLE'				=> 'Disable logging of connections in ACP',
	'LC_ACP_DISABLE_EXPLAIN'		=> 'The connections <em>in failure</em> will be always logged.',
	'LC_FOUNDER_DISABLE'			=> 'Disable logging of connections from <em>Founders</em>',
	'LC_FOUNDER_DISABLE_EXPLAIN'	=> 'The connections <em>in failure</em> on account of founders will be always logged.',
	'LC_ADMIN_DISABLE'				=> 'Disable logging of connections from <em>administrators</em>',
	'LC_ADMIN_DISABLE_EXPLAIN'		=> 'The connections <em>in failure</em> on account of administrators will be always logged.',
	'LC_INTERVAL'					=> 'Interval of logs',
	'LC_INTERVAL_EXPLAIN'			=> 'Time in seconds between the logging of 2 entries which are in <em>failure and identical</em>. Setting this value to 0 disables this behaviour.',
	'LC_PRUNE_DAY'					=> 'Auto-pruning of connection log',
	'LC_PRUNE_DAY_EXPLAIN'			=> 'Set in days age of connection logs. Setting this value to 0 disables this behaviour.',
	
	'LC_MANAGE_IP'					=> 'Manage IP addresses',
	'LC_NO_EXCLUDE_IP'				=> 'No excluded IP addresses',
	'LC_EXCLUSION_IP'				=> 'Exclude IPs',
	'LC_EXCLUSION_IP_EXPLAIN'		=> 'To specify several different IPs enter each on a new line. To specify a wildcard use “*”.',
	'LC_UNEXCLUSION_IP'				=> 'Un-exclude IPs',
	'LC_UNEXCLUSION_IP_EXPLAIN'		=> 'You can un-exclude multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser.',
	
	'LC_EXCLUDE_NO_IP'					=> 'No IP addresses correctly defined',
	'LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'	=> 'The exclude-list has been updated successfully.',
	
));

?>
