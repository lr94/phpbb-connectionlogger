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
	'ACP_CONNECTIONS_LOGS'			=> 'Verbindungsprotokoll',
	'ACP_CONNECTIONS_LOGS_EXPLAIN'	=> 'Dies listet alle im Forum ausgeführten Verbindungen auf. Sie können nach Benutzername, Datum, IP oder Aktion sortieren / filtern. Wenn Sie über entsprechende Berechtigungen verfügen, können Sie auch einzelne Vorgänge oder das Protokoll als Ganzes löschen.',
	'ACP_LOGS_GOODIES'				=> '<strong>Trick</strong>: Sie können alle IPs nachschlagen, indem Sie auf den Namen der Spalte klicken und <u>Whois</u> anzeigen, indem Sie über IP klicken.',
	'ACP_LOGS_HOSTNAME'				=> 'Hostnamen',
	'ACP_LOGS_SORT'					=> 'Sortieren',
	'ACP_LOGS_ALL'					=> 'Alle',
	'ACP_LOGS_FAIL'					=> 'Erfolglose Anmeldung',
	
	'LOG_CLEAR_CONNECTIONS'			=> '<strong>Verbindungsprotokoll gelöscht</strong>',
	'LOG_CONFIG_LOG_CONNECTIONS'	=> '<strong>Geänderte Verbindungsprotokolleinstellungen</strong>',
	'LOG_AUTH_SUCCESS'				=> '<strong>Erfolgreich angemeldet</strong>',
	'LOG_AUTH_SUCCESS_AUTO'			=> '<strong>Erfolgreich angemeldet (Automatisch angemeldet)</strong><br/>» %s',
	'LOG_AUTH_FAIL'					=> '<strong>Erfolglose Anmeldung</strong> - Falsches Passwort eingegeben',
	'LOG_AUTH_FAIL_NO_PASSWORD'     => '<strong>Erfolglose Anmeldung</strong> - Kein Passwort eingegeben<br/>» %s',
	'LOG_AUTH_FAIL_BAN'				=> '<strong>Erfolglose Anmeldung</strong> - Benutzername gesperrt',
	'LOG_AUTH_FAIL_CONFIRM'			=> '<strong>Erfolglose Anmeldung</strong> - Falscher Bestätigungscode',
	'LOG_AUTH_FAIL_CONVERT'			=> '<strong>Erfolglose Anmeldung</strong> - Passwort nicht konvertiert',
	'LOG_AUTH_FAIL_INACTIVE'		=> '<strong>Erfolglose Anmeldung</strong> - Inaktiver Benutzer',
	'LOG_AUTH_FAIL_UNKNOWN'			=> '<strong>Erfolglose Anmeldung</strong> - Nicht existierender Benutzer<br/>» %s',
	'LOG_ADMIN_AUTH_FAIL'			=> '<strong>Erfolglose Anmeldung in den Adminbereich</strong> - Falsches Passwort eingegeben',
	'LOG_ADMIN_AUTH_FAIL_NO_ADMIN'	=> '<strong>Erfolglose Anmeldung in den Adminbereich</strong> - Unerlaubter Anmeldeversuch',
	'LOG_ADMIN_AUTH_FAIL_DIFFER'	=> '<strong>Erfolglose Anmeldung in den Adminbereich</strong> - Als anderer Benutzer erneut authentifiziert<br/>» %s',
	'LOG_ADMIN_AUTH_SUCCESS'		=> '<strong>Erfolgreiche Anmeldung in den Adminbereich</strong>',
	'LOG_LC_EXCLUDE_IP'				=> '<strong>Ausgeschlossene IP im Verbindungsprotokoll</strong><br/>» %s',
	'LOG_LC_UNEXCLUDE_IP'			=> '<strong>Nicht ausgeschlossene IP im Verbindungsprotokoll</strong><br/>» %s',
	'LOG_LC_INTERVAL'				=> '(%s Versuche)',
	
	// Settings panel
	'ACP_CONNECTIONS'				=> 'Verbindungsprotokoll',
	'ACP_CONNECTIONS_SETTINGS'		=> 'Einstellungen für die </br>Verbindungsprotokollierung',
	'ACP_CONNECTIONS_SETTINGS_EXPLAIN'		=> 'In diesem Fenster können Sie alle Einstellungen für das Verbindungsprotokoll konfigurieren. <br/> Sie können einzelne IP-Adressen im Verbindungsprotokoll ausschließen oder nicht ausschließen.',
	'LC_SETTINGS'					=> 'Konfiguration',
	'LC_PRUNING'					=> 'Automatisches Löschen der Protokolleinträge',
	'LC_DISABLE'					=> 'Protokollierung deaktivieren',
	'LC_DISABLE_EXPLAIN'			=> 'Diese Option deaktiviert die vollständige Protokollierung aller Anmeldungen.',
	'LC_ACP_DISABLE'				=> 'Möchten Sie die Protokollierung von Anmeldungen in den Administratorbereich deaktiveren?',
	'LC_ACP_DISABLE_EXPLAIN'		=> 'Die Verbindungen bei erfolglosen Anmeldungen werden immer protokolliert.',
	'LC_FOUNDER_DISABLE'			=> 'Möchten Sie die Protokollierung der Anmeldungen von Forumgründern deaktivieren ?',
	'LC_FOUNDER_DISABLE_EXPLAIN'	=> 'Die Verbindungen bei erfolglosen Anmeldungen bei Gründern werden immer protokolliert.',
	'LC_ADMIN_DISABLE'				=> 'Möchten Sie die Protokollierung der Anmeldungen von Administratoren deaktivieren?',
	'LC_ADMIN_DISABLE_EXPLAIN'		=> 'Die Verbindungen bei erfolglosen Anmeldungen von Administratoren werden immer protokolliert.',
	'LC_INTERVAL'					=> 'Intervall der Protokollierung',
	'LC_INTERVAL_EXPLAIN'			=> 'Zeit in Sekunden zwischen der Protokollierung von 2 Einträgen, die in erfolglosen und erfolgreichen Anmeldungen sind. Wenn Sie diesen Wert auf 0 setzen, wird dieses Verhalten deaktiviert.',
	'LC_PRUNE_DAY'					=> 'Automatisches Löschen der Protokolleinträge',
	'LC_PRUNE_DAY_EXPLAIN'			=> 'Stellen Sie in Tagen das Alter der Verbindungsprotokolle ein. Wenn Sie diesen Wert auf 0 setzen, wird dieses Verhalten deaktiviert.',
	
	'LC_MANAGE_IP'					=> 'Verwalten Sie die IP-Adressen',
	'LC_NO_EXCLUDE_IP'				=> 'Keine ausgeschlossenen IP-Adressen',
	'LC_EXCLUSION_IP'				=> 'IPs ausschließen',
	'LC_EXCLUSION_IP_EXPLAIN'		=> 'Um mehrere verschiedene IPs anzugeben, geben Sie jeweils eine neue Zeile ein. Um einen Platzhalter anzugeben, verwenden Sie “*”.',
	'LC_UNEXCLUSION_IP'				=> 'Keine ausgeschlossenen IP-Adressen',
	'LC_UNEXCLUSION_IP_EXPLAIN'		=> 'Sie können mehrere IP-Adressen auf einmal ausschließen, indem Sie die entsprechende Kombination aus Maus und Tastatur für Ihren Computer und Browser verwenden.',
	
	'LC_EXCLUDE_NO_IP'					=> 'Keine IP-Adressen korrekt definiert!',
	'LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'	=> 'Die Liste der ausgeschlossenen IPs wurde erfolgreich aktualisiert.',
	
));

?>
