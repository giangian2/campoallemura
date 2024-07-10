<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni del database
 * * Chiavi segrete
 * * Prefisso della tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni database - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'campoallemura' );

/** Nome utente del database */
define( 'DB_USER', 'spesagian' );

/** Password del database */
define( 'DB_PASSWORD', 'apetuning1' );

/** Hostname del database */
define( 'DB_HOST', 'localhost' );

/** Charset del database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di collazione del database. Da non modificare se non si ha idea di cosa sia. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chiavi univoche di autenticazione e di sicurezza.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tutti i cookie esistenti.
 * Ciò forzerà tutti gli utenti a effettuare nuovamente l'accesso.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'A2&[qv|wCBI5p6w}os%|r?qwv0YW(m6$oh/}P2EeQhzf,&eqGK{:cqI@g7HVR=@{' );
define( 'SECURE_AUTH_KEY',  'p66Vm]FgIDEmq_zb!>;E?pCOX[`qS;<-J&w]|n%LaF#E`l38k|=>)F$p3>(Bf:#+' );
define( 'LOGGED_IN_KEY',    ')8AX!^cp{sKli o]]~z5df*VYV-$wBRmD&=P9I2L#p!j(#,}#KS9>@B;=&jj49Qh' );
define( 'NONCE_KEY',        '^r]gF;H]Y_t-Zsw*7D~ocnB]PoyU?}#=#a,tCD5zS*7Za<HSJDQUcQD[]Ol]ER>D' );
define( 'AUTH_SALT',        'sf*u?b8.NqimO}z~X5CT@eK{)$-q_1&=&.~]Rcw)(Z 5ML~XE=S[6exUu~1^fy[L' );
define( 'SECURE_AUTH_SALT', 'o2yF 3zBpG7s6rCxoz<M1<Hv~,:#dwD3%J>V]2m/6F(HF@^ZPG~>b7A Qa*:3TZ;' );
define( 'LOGGED_IN_SALT',   'r4aH1a_mc/RV`<>^KvQMkkh!z<Z[ {a6v^;B[W.u_o|c:3TjBsY~+{s*C}$9~(]y' );
define( 'NONCE_SALT',       '&(apNG|[AUTDGpM/7N_-8#A<,r=Wt`wNb*zc6NX/U|p+n#JIjr,HO!ED *r|l[?A' );

/**#@-*/

/**
 * Prefisso tabella del database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco. Solo numeri, lettere e trattini bassi!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli sviluppatori di temi e plugin di utilizzare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Aggiungi qualsiasi valore personalizzato tra questa riga e la riga "Finito, interrompere le modifiche". */



/* Finito, interrompere le modifiche! Buona pubblicazione. */

/** Path assoluto alla directory di WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Imposta le variabili di WordPress ed include i file. */
require_once ABSPATH . 'wp-settings.php';
