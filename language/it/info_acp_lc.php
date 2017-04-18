<?php
/**
*
* acp_lc [English]
*
* @author Mickaël Salfati (Elglobo) http://www.phpbb-services.com
*
* @package acp
* @version $Id: info_acp_lc.php 2010-01-25 (local) $
* @copyright (c) 2007 phpBB-Services
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
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
	'ACP_CONNECTIONS_LOGS'			=> 'Log connessioni',
	'ACP_CONNECTIONS_LOGS_EXPLAIN'	=> 'Elenca tutte le connessioni alla Board. Puoi ordinare e filtrare per username, data, IP or azione. Se hai i permessi appropriati puoi anche cancellare singoli eventi o l\'intero log.',
	'ACP_LOGS_GOODIES'				=> '<strong>Suggerimento</strong>: Puoi fare il look up di tutti gli IPs cliccando sul nome della colonna e mostrare il <em>whois</em> cliccando su IP.',
	'ACP_LOGS_HOSTNAME'				=> 'Hostname',
	'ACP_LOGS_SORT'					=> 'Ordina',
	'ACP_LOGS_ALL'					=> 'Tutti',
	'ACP_LOGS_FAIL'					=> 'Errore',
	
	'LOG_CLEAR_CONNECTIONS'			=> '<strong>Log connessioni cancellato</strong>',
	'LOG_CONFIG_LOG_CONNECTIONS'	=> '<strong>Impostazioni del log connessioni modificate</strong>',
	'LOG_AUTH_SUCCESS'				=> '<strong>Connesso con successo</strong>',
	'LOG_AUTH_SUCCESS_AUTO'			=> '<strong>Connesso con successo (Autologged)</strong><br />» %s',
	'LOG_AUTH_FAIL'					=> '<strong>Errore</strong> - password errata',
	'LOG_AUTH_FAIL_NO_PASSWORD'     => '<strong>Errore</strong> - nessuna password inserita<br />» %s',
	'LOG_AUTH_FAIL_BAN'				=> '<strong>Errore</strong> - username bannato',
	'LOG_AUTH_FAIL_CONFIRM'			=> '<strong>Errore</strong> - codice di conferma non valido',
	'LOG_AUTH_FAIL_CONVERT'			=> '<strong>Errore</strong> - password non convertita',
	'LOG_AUTH_FAIL_INACTIVE'		=> '<strong>Errore</strong> - utente inattivo',
	'LOG_AUTH_FAIL_UNKNOWN'			=> '<strong>Errore</strong> - utente inesistente <br />» %s',
	'LOG_ADMIN_AUTH_FAIL'			=> '<strong>Errore PCA</strong> - password errata',
	'LOG_ADMIN_AUTH_FAIL_NO_ADMIN'	=> '<strong>Errore PCA</strong> - utente non autorizzato',
	'LOG_ADMIN_AUTH_FAIL_DIFFER'	=> '<strong>Errore PCA</strong> - ri-autenticato come utente diverso<br />» %s',
	'LOG_ADMIN_AUTH_SUCCESS'		=> '<strong>Connesso con successo al PCA</strong>',
	'LOG_LC_EXCLUDE_IP'				=> '<strong>IP esclusi dal log delle connessioni</strong><br />» %s',
	'LOG_LC_UNEXCLUDE_IP'			=> '<strong>IP reinclusi nel log delle connessioni</strong><br />» %s',
	'LOG_LC_INTERVAL'				=> '(%s tentativi)',
	
	// Settings panel
	'ACP_CONNECTIONS'				=> 'Log connessioni',
	'ACP_CONNECTIONS_SETTINGS'		=> 'Impostazioni dei log delle connessioni',
	'ACP_CONNECTIONS_SETTINGS_EXPLAIN'		=> 'Qui puoi configurare tutte le impostazioni dei log delle connessioni.<br />Puoi anche <em>escludere (or o reincludere)</em> indirizzi IP nei log.',
	'LC_SETTINGS'					=> 'Configurazione',
	'LC_PRUNING'					=> 'Auto-pruning',
	'LC_DISABLE'					=> 'Disabilita il logging delle connessioni',
	'LC_DISABLE_EXPLAIN'			=> 'Questa opzione disabilita <em>completamente</em> il logging delle connessioni.',
	'LC_ACP_DISABLE'				=> 'Disabilita il logging delle connessioni al PCA',
	'LC_ACP_DISABLE_EXPLAIN'		=> 'Le connessioni <em>fallite</em> saranno sempre registrate.',
	'LC_FOUNDER_DISABLE'			=> 'Disabilita il logging delle connessioni dei <em>Fondatori</em>',
	'LC_FOUNDER_DISABLE_EXPLAIN'	=> 'Le connessioni <em>fallite</em> ad account di Fondatori saranno sempre registrate.',
	'LC_ADMIN_DISABLE'				=> 'Disabilita il logging delle connessioni degli <em>amministratori</em>',
	'LC_ADMIN_DISABLE_EXPLAIN'		=> 'Le connessioni <em>fallite</em> ad account di amministratori saranno sempre registrate.',
	'LC_INTERVAL'					=> 'Intervallo dei logs',
	'LC_INTERVAL_EXPLAIN'			=> 'Tempo in secondi tra due eventi <em>"errore" identici</em>. Impostare a 0 disabilita questa funzione.',
	'LC_PRUNE_DAY'					=> 'Auto-pruning del log delle connessioni',
	'LC_PRUNE_DAY_EXPLAIN'			=> 'Impostare la durata in giorni. Impostare a 0 disabilita questa funzione.',
	
	'LC_MANAGE_IP'					=> 'Gestisci indirizzi IP',
	'LC_NO_EXCLUDE_IP'				=> 'Nessun indirizzo IP escluso',
	'LC_EXCLUSION_IP'				=> 'Escludi indirizzi IP',
	'LC_EXCLUSION_IP_EXPLAIN'		=> 'Per specificare diversi indirizzi IP inserire ciascuno su una nuova linea. Usare “*” come carattere wildcard.',
	'LC_UNEXCLUSION_IP'				=> 'Reincludi IPs',
	'LC_UNEXCLUSION_IP_EXPLAIN'		=> 'Puoi reincludere più indirizzi IP in una volta.',
	
	'LC_EXCLUDE_NO_IP'					=> 'Nessun indirizzo IP correttamente definito',
	'LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'	=> 'La lista delle esclusioni è stata modificata con successo.',
	
));

?>
