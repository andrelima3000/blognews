<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', "blognews2" );


/** Usuário do banco de dados MySQL */
define( 'DB_USER', "root" );


/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', "" );


/** Nome do host do MySQL */
define( 'DB_HOST', "localhost" );


/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );


/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'mG9v1aF24 :R<&) <9_DkkQS}rX=mg$2tm#Fp=K;x-tf>%cWio!v#?kvQvul[Uvb' );

define( 'SECURE_AUTH_KEY',  ';k8%q?Ge1UwG+/Eoys2{lC^gFfQLGC~$&[?LwKzkKOYtTiI2_+lA??JA5[a0aU0Z' );

define( 'LOGGED_IN_KEY',    'WdNQu&|JCFMBe-W!#a%#<^X@7}j9/fTI10p~$X5!*Y4x.I4Fva8!MFs|PR1[hmCi' );

define( 'NONCE_KEY',        '6Et]Ft7.:vn%*a]/mu6PL<33X<Ip(rUgmT<-|[PuDD/[{-;EvgMT1K>OieSBC4wx' );

define( 'AUTH_SALT',        'a-8MbO7Cs%1Y.38_:48c;cNM0nFHn%U4{}>9)}P&*x,$(aeSni3F#I!S@,}J3WSJ' );

define( 'SECURE_AUTH_SALT', 'jj8wJI(`$dCfFOpj<`a~qhjQ,D+[f:4o`|w <97be@}b #e%^R?o.e<9`Pch%sHy' );

define( 'LOGGED_IN_SALT',   '0)Wr-L+Xlo;x,%WNg7t<8$8#)~WXZmHf!(?1M/]:@[WFN?7 `*WK338~EG,/=m|_' );

define( 'NONCE_SALT',       'e$D8!^l]4k+JNL{]O6Z88 nWPKVX?piEkqPxdmJZ@&wRdgGs:7SB:s&xQuObo^Ge' );


/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';


/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
