<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
    // Application extends the core
    require APPPATH.'classes/Kohana'.EXT;
}
else
{
    // Load empty core extension
    require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('ua');

if (isset($_SERVER['SERVER_PROTOCOL']))
{
    // Replace the default protocol.
    HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
    Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http';

Kohana::init(array(
    'base_url'   => '/',//$protocol.'://woodstone.com.ua/',
    'index_file' => FALSE,
    'errors' => TRUE,
    'profiling'=>TRUE,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

Cookie::$salt = '1234567890';

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
    'auth'       => MODPATH.'auth',       // Basic authentication
    'cache'      => MODPATH.'cache',      // Caching with multiple backends
    // 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
    'database'   => MODPATH.'database',   // Database access
    'image'      => MODPATH.'image',      // Image manipulation
    // 'minion'     => MODPATH.'minion',     // CLI Tasks
    'orm'        => MODPATH.'orm',        // Object Relationship Mapping
    'captcha'        => MODPATH.'captcha',        // Captcha
    // 'unittest'   => MODPATH.'unittest',   // Unit testing
    // 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
    'email'       => MODPATH.'email', // E-mail
));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

/**Route::set('about', '(<lang>/)(<controller>(/<action>(/<id>)))', array('lang' => 'ua|ru|en'))
    ->defaults(array(
	'directory'  => 'frontend',
        'controller' => 'about',
        'action'     => 'index',
    ));

*/  

Route::set('widgets', 'widgets/(<controller>(/<action>(/<id>)))', array('param' => '.+'))
    ->defaults(array(
        'directory'  => 'widgets',
        'action'     => 'index',
    ));

Route::set('auth', '<action>',  array('action' => 'login|logout|register'))
    ->defaults(array(
        'directory'  => 'backend',
        'controller' => 'auth',
    ));

Route::set('admin_seo', 'admin/seo/view(/<id>)')
    ->defaults(array(
        'directory'  => 'backend',
        'controller' => 'seo',
        'action'     => 'view',
    ));

Route::set('admin_production', 'admin(/<controller>(/<action>(/<production>)(/<id>)(/<sub>)))', array('id' => 'ua|ru|en|add',
    'production' => '[0-9]+',
    'sub' => '[0-9]+'))
    ->defaults(array(
        'directory'  => 'backend',
        'controller' => 'main',
        'action'     => 'edit',
    ));

Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))', array('id' => 'ua|ru|en'))
    ->defaults(array(
        'directory'  => 'backend',
        'controller' => 'main',
        'action'     => 'edit',
    ));

Route::set('products', '(<lang>/)products(/<id>)', array('lang' => 'ua|ru'))
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'products',
        'action'     => 'index',

    ));

Route::set('default', '(<lang>)(/)(<controller>)(/<action>)(/<id>)', array('lang' => 'ua|ru'))
    ->defaults(array(
        'directory'  => 'frontend',
        'controller' => 'main',
        'action'     => 'index',
	
    ));       

    