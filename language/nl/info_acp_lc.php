<?php

/**
*
* @copyright (c) 2017 Luca Robbiano (lr94)
* @copyright (c) ???? Mickaël Salfati (Elglobo)
* Nederlandse vertaling @ Solidjeuh <https://www.muziekpromo.net>
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
	'ACP_CONNECTIONS_LOGS'			=> 'Verbindingslog',
	'ACP_CONNECTIONS_LOGS_EXPLAIN'	=> 'Hierin staan alle verbindingen die gedaan zijn op je forum. U kunt sorteren/filteren op gebruikersnaam, datum, IP of actie. Als u over de juiste permissies beschikt, kunt u ook individuele acties of het logboek als geheel wissen.',
	'ACP_LOGS_GOODIES'				=> '<strong>Truc</strong>: U kunt alle IP’s opzoeken door op de naam van de kolom te klikken en <em>Whois</em> weer te geven door op boven IP te klikken.',
	'ACP_LOGS_HOSTNAME'				=> 'hostnamen',
	'ACP_LOGS_SORT'					=> 'Sorteer',
	'ACP_LOGS_ALL'					=> 'Alle',
	'ACP_LOGS_FAIL'					=> 'Mislukt',
	
	'LOG_CLEAR_CONNECTIONS'			=> '<strong>Verbindings logbestand gewist</strong>',
	'LOG_CONFIG_LOG_CONNECTIONS'	=> '<strong>Gewijzigde verbindingslog instellingen</strong>',
	'LOG_AUTH_SUCCESS'				=> '<strong>Succesvol verbonden</strong>',
	'LOG_AUTH_SUCCESS_AUTO'			=> '<strong>Succesvol verbonden (Auto login)</strong><br />» %s',
	'LOG_AUTH_FAIL'					=> '<strong>Mislukt</strong> - Foutief wachtwoord',
	'LOG_AUTH_FAIL_NO_PASSWORD'		=> '<strong>Mislukt</strong> - Geen wachtwoord opgegeven<br />» %s',
	'LOG_AUTH_FAIL_BAN'				=> '<strong>Mislukt</strong> - Gebruikersnaam verbannen',
	'LOG_AUTH_FAIL_CONFIRM'			=> '<strong>Mislukt</strong> - Foutieve bevestigingscode',
	'LOG_AUTH_FAIL_CONVERT'			=> '<strong>Mislukt</strong> - Wachtwoord niet geconverteerd',
	'LOG_AUTH_FAIL_INACTIVE'		=> '<strong>Mislukt</strong> - Inactieve gebruiker',
	'LOG_AUTH_FAIL_UNKNOWN'			=> '<strong>Mislukt</strong> - Niet bestaande gebruiker<br />» %s',
	'LOG_ADMIN_AUTH_FAIL'			=> '<strong>Mislukt in Beheerderspaneel</strong> - Foutief wachtwoord',
	'LOG_ADMIN_AUTH_FAIL_NO_ADMIN'	=> '<strong>Mislukt in Beheerderspaneel</strong> - Onbevoegd',
	'LOG_ADMIN_AUTH_FAIL_DIFFER'	=> '<strong>Mislukt in Beheerderspaneel</strong> - Opnieuw geauthenticeerd als een andere gebruiker<br />» %s',
	'LOG_ADMIN_AUTH_SUCCESS'		=> '<strong>Succesvol verbonden in Beheerderspaneel</strong>',
	'LOG_LC_EXCLUDE_IP'				=> '<strong>Uitgesloten IP in verbindingslog</strong><br />» %s',
	'LOG_LC_UNEXCLUDE_IP'			=> '<strong>Niet uitgesloten in verbindingslog</strong><br />» %s',
	'LOG_LC_INTERVAL'				=> '(%s pogingen)',
	
	// Settings panel
	'ACP_CONNECTIONS'					=> 'Verbindingslog',
	'ACP_CONNECTIONS_SETTINGS'			=> 'Verbindingslog instellingen',
	'ACP_CONNECTIONS_SETTINGS_EXPLAIN'	=> 'Vanuit dit paneel kunt u alle instellingen configureren voor het verbindings logboek.<br />U kunt IP-adressen in het verbindings logboek ook <em>(uitsluiten of niet uitsluiten)</em>.',
	'LC_SETTINGS'						=> 'Configuratie',
	'LC_PRUNING'						=> 'Auto opschonen',
	'LC_DISABLE'						=> 'Logboek registratie uitschakelen',
	'LC_DISABLE_EXPLAIN'				=> 'Met deze optie schakelt u <em>volledig</em> het loggen van verbindingen uit.',
	'LC_ACP_DISABLE'					=> 'Logboek registratie van verbindingen in beheerderspaneel uitschakelen',
	'LC_ACP_DISABLE_EXPLAIN'			=> 'De <em>mislukte</em> verbindingen worden altijd gelogd.',
	'LC_FOUNDER_DISABLE'				=> 'Logboek registratie van verbindingen van <em>Oprichters</em> uitschakelen',
	'LC_FOUNDER_DISABLE_EXPLAIN'		=> 'De <em>mislukte</em> verbindingen bij de accounts van oprichters zullen altijd gelogd worden.',
	'LC_ADMIN_DISABLE'					=> 'Logboek registratie van verbindingen van <em>beheerders</em> uitschakelen.',
	'LC_ADMIN_DISABLE_EXPLAIN'			=> 'De <em>mislukte</em> verbindingen voor beheerders worden altijd gelogd.',
	'LC_INTERVAL'						=> 'Interval van logboeken',
	'LC_INTERVAL_EXPLAIN'				=> 'Tijd in seconden tussen het loggen van 2 items die <em>mislukken of identiek</em> zijn. Als u deze waarde instelt op 0, wordt dit gedrag uitgeschakeld.',
	'LC_PRUNE_DAY'						=> 'Automatisch opschonen van verbindingslog',
	'LC_PRUNE_DAY_EXPLAIN'				=> 'Stel in “dagen” de leeftijd in van verbindings logboeken. Als u deze waarde instelt op 0, wordt dit gedrag uitgeschakeld.',
	
	'LC_MANAGE_IP'						=> 'Beheer IP-adressen',
	'LC_NO_EXCLUDE_IP'					=> 'Geen uitgesloten IP-adressen',
	'LC_EXCLUSION_IP'					=> 'IP’s uitsluiten',
	'LC_EXCLUSION_IP_EXPLAIN'			=> 'Als u meerdere verschillende IP’s wilt opgeven, voert u deze allemaal in op een nieuwe regel. Om een wildcard te specificeren gebruik: “*”.',
	'LC_UNEXCLUSION_IP'					=> 'Uitgesloten IP’s verwijderen',
	'LC_UNEXCLUSION_IP_EXPLAIN'			=> 'U kunt meerdere IP-adressen in één keer verwijderen met de juiste combinatie van muis en toetsenbord voor uw computer en browser.',
	
	'LC_EXCLUDE_NO_IP'					=> 'Geen IP-adressen correct gedefinieerd',
	'LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'	=> 'De uitsluiting lijst is succesvol bijgewerkt.',
	
));
