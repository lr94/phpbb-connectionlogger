<?php
/** 
 *
 * Connection logger. An extension for the phpBB Forum Software package.
 * French translation by Elglobo http://www.phpbb-services.com & Galixte (http://www.galixte.com)
 *
 * @copyright (c) 2017 Luca Robbiano (lr94)
 * @license GNU General Public License, version 2 (GPL-2.0-only)
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_CONNECTIONS_LOGS'			=> 'Journal des connexions',
	'ACP_CONNECTIONS_LOGS_EXPLAIN'	=> 'Liste de toutes les connexions effectuées au forum. Il est possible de trier/filtrer les résultats par nom, date, IP ou par action, ainsi que d’effacer individuellement les opérations ou le journal complet.',
	'ACP_LOGS_GOODIES'				=> '<strong>Astuce</strong> : Il est possible de calculer les noms d’hôte des adresses IP en cliquant sur le nom de la colonne en question, ainsi que d’afficher le <em>WHOIS</em> d’une adresse IP en cliquant dessus.',
	'ACP_LOGS_HOSTNAME'				=> 'Noms d’hôte',
	'ACP_LOGS_SORT'					=> 'Trier',
	'ACP_LOGS_ALL'					=> 'Tous',
	'ACP_LOGS_FAIL'					=> 'Connexion échouée',
	
	'LOG_CLEAR_CONNECTIONS'			=> '<strong>Journal des connexions purgé</strong>',
	'LOG_CONFIG_LOG_CONNECTIONS'	=> '<strong>Les paramètres du journal (logs) des connexions ont été modifiés</strong>',
	'LOG_AUTH_SUCCESS'				=> '<strong>Connexion réussie</strong>',
	'LOG_AUTH_SUCCESS_AUTO'			=> '<strong>Connexion réussie (connexion automatique)</strong><br />» %s',
	'LOG_AUTH_FAIL'					=> '<strong>Connexion échouée</strong> : mot de passe incorrect',
	'LOG_AUTH_FAIL_NO_PASSWORD'		=> '<strong>Connexion échouée</strong> : aucun mot de passe indiqué<br />» %s',
	'LOG_AUTH_FAIL_BAN'				=> '<strong>Connexion échouée</strong> : nom d’utilisateur banni',
	'LOG_AUTH_FAIL_CONFIRM'			=> '<strong>Connexion échouée</strong> : code de confirmation incorrect',
	'LOG_AUTH_FAIL_CONVERT'			=> '<strong>Connexion échouée</strong> : mot de passe non converti',
	'LOG_AUTH_FAIL_INACTIVE'		=> '<strong>Connexion échouée</strong> : compte inactif',
	'LOG_AUTH_FAIL_UNKNOWN'			=> '<strong>Connexion échouée</strong> : utilisateur inexistant<br />» %s',
	'LOG_ADMIN_AUTH_FAIL'			=> '<strong>Connexion échouée au PCA</strong> : mot de passe incorrect',
	'LOG_ADMIN_AUTH_FAIL_NO_ADMIN'	=> '<strong>Connexion échouée au PCA</strong> : non autorisé',
	'LOG_ADMIN_AUTH_FAIL_DIFFER'	=> '<strong>Connexion échouée au PCA</strong> : ré-authentifié avec un compte différent<br />» %s',
	'LOG_ADMIN_AUTH_SUCCESS'		=> '<strong>Connexion réussie au PCA</strong>',
	'LOG_LC_EXCLUDE_IP'				=> '<strong>Exclusion d’adresse(s) IP dans le journal (logs) des connexions</strong><br />» %s',
	'LOG_LC_UNEXCLUDE_IP'			=> '<strong>Ré-inclusion d’adresse(s) IP dans le journal (logs) des connexions</strong><br />» %s',
	'LOG_LC_INTERVAL'				=> '(%s tentatives)',
	
	// Settings panel
	'ACP_CONNECTIONS'					=> 'Journal (logs) des connexions',
	'ACP_CONNECTIONS_SETTINGS'			=> 'Paramètres du journal des connexions',
	'ACP_CONNECTIONS_SETTINGS_EXPLAIN'	=> 'Depuis cet écran, il est possible de configurer l’ensemble des options relatives au journal (logs) des connexions.<br />Il est également possible de contrôler les adresses IPs afin de les <em>exclure ou ré-inclure</em> dans le journal (logs) des connexions.',
	'LC_SETTINGS'						=> 'Configuration',
	'LC_PRUNING'						=> 'Auto-délestage',
	'LC_DISABLE'						=> 'Désactiver les enregistrements du journal (logs) des connexions',
	'LC_DISABLE_EXPLAIN'				=> 'Permet de désactiver <em>complètement</em> les enregistrement dans le journal (logs) des connexions.',
	'LC_ACP_DISABLE'					=> 'Désactiver la journalisation des connexions au PCA',
	'LC_ACP_DISABLE_EXPLAIN'			=> 'Permet de d’exclure les connexions au panneau d’administration dans le journal (logs) des connexions. Les connexions <em>en échec</em> au panneau d’administration seront toujours enregistrées.',
	'LC_FOUNDER_DISABLE'				=> 'Désactiver la journalisation des connexions des <em>fondateurs</em>',
	'LC_FOUNDER_DISABLE_EXPLAIN'		=> 'Permet de d’exclure les connexions des membres <em>fondateurs</em> dans le journal (logs) des connexions. Les connexions <em>en échec</em> des membres fondateurs seront toujours enregistrées.',
	'LC_ADMIN_DISABLE'					=> 'Désactiver la journalisation des connexions des <em>administrateurs</em>',
	'LC_ADMIN_DISABLE_EXPLAIN'			=> 'Permet de d’exclure les connexions des membres <em>administrateurs</em> dans le journal (logs) des connexions. Les connexions <em>en échec</em> des membres administrateurs seront toujours enregistrées.',
	'LC_INTERVAL'						=> 'Intervalle d’enregistrements du journal (logs) des connexions',
	'LC_INTERVAL_EXPLAIN'				=> 'Permet de saisir l’intervalle de temps en secondes entre l’enregistrement de 2 évènements de connexions qui sont en <em>échec et identiques</em> dans le journal (logs) des connexions. Saisir la valeur « 0 » pour désactiver cette option.',
	'LC_PRUNE_DAY'						=> 'Auto-délestage du journal (logs) des connexions',
	'LC_PRUNE_DAY_EXPLAIN'				=> 'Permet de saisir le nombre de jours de l’ancienneté maximale des entrées du journal (logs) des connexions. Saisir la valeur « 0 » pour désactiver cette option.',
	
	'LC_MANAGE_IP'						=> 'Gestion des adresses IPs',
	'LC_NO_EXCLUDE_IP'					=> 'Aucune adresse IP exclue.',
	'LC_EXCLUSION_IP'					=> 'Exclure des adresses IPs',
	'LC_EXCLUSION_IP_EXPLAIN'			=> 'Permet de spécifier une ou plusieurs adresses IP, saisir chacune d’elles sur une nouvelle ligne. Il est également possible d’utiliser le caractère « * » comme caractère joker.',
	'LC_UNEXCLUSION_IP'					=> 'Ré-inclure des adresses IPs',
	'LC_UNEXCLUSION_IP_EXPLAIN'			=> 'Permet de ré-inclure plusieurs adresses IP en une seule action. Pour sélectionner plus adresses IP utiliser la combinaison de la touche « CTRL » + du clic gauche.',
	
	'LC_EXCLUDE_NO_IP'					=> 'Au moins une adresse IP n’a pas été correctement saisie',
	'LC_EXCLUDE_IP_UPDATE_SUCCESSFUL'	=> 'La liste des exclusions a été mise à jour.',
	
));
