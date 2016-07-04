<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'haratskz_sql');

/** Имя пользователя MySQL */
define('DB_USER', 'harat_user');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '64nMd#p2');

/** Имя сервера MySQL */
define('DB_HOST', 'srv-db-plesk07.ps.kz:3306');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'V]]DlyS_br4CZ-}0o2B{{tj2P=VVZ`Wx]aydv6`*siV/Tqj5%|q{Le8d8D4^lexR');
define('SECURE_AUTH_KEY',  ':~[KqDuWQE^!~n)]Z};-wM?V`7d5e,nGk|uTJ&k>@g ?W!re+=;tFVaE,BPCMv[?');
define('LOGGED_IN_KEY',    'b-%(tnl,Cr1JM<.w)y$W0o*,NU%e@|LsGd(#rB_{S QRK ii-SMJ.EG3kW|%Ou5-');
define('NONCE_KEY',        'ZZ,*;mrr%f)})CkbK%v9_DRjqHmvs-k/.4h`FUf4C*Yd_m <-Z>Q+W^kFqh5cjz,');
define('AUTH_SALT',        'kx#L697~#|a3aLAP]B>WeOGvPB6;Mu0YJ]Ib;Z<qvO6Z1O}16jv:$]~^*~#9D.Z-');
define('SECURE_AUTH_SALT', 'B 0_bn*jN1Ir@9v#j^b5Q}J@e+`~6>7Y^w{4KcIGUhH;>UOImyRY/3)2r^IZh|C,');
define('LOGGED_IN_SALT',   'pqH[tu4/wcKwDwnJX|dJ/N9ke4DHJ=ZD8<+/1}PUCI1=^r}V2_/|@ QBOHSa~V8K');
define('NONCE_SALT',       '&||Y-4E[h)%ZD7jw=Y0B<=-:-. zQ3e>?4&(p-/;,;d>3WaH_dJw`R-?uXBVT<pT');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
