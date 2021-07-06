<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once('/shared_files/docker_dev_config.php'); ///////////////////////////////////////////////////////////////////////////////
/** @var $CFG core_config|object *//////////////////////////////////////////////////////////////////////////////////////////////////
global $CFG, $DOCKER_CFG; //////////////////////////////////////////////////////////////////////////////////////////////////////////
$DOCKER_CFG = new docker_dev_config(__DIR__); //////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////// MAKE CHANGES BELOW THIS LINE //////////////////////////////////////////////////////




/////////////////////////////////////////////
///////////       MAIN SITE       ///////////
/////////////////////////////////////////////


/**
 * Database Options:
 * +-------------------+---------+------------+
 * | Database          | Type    | Host       |
 * +-------------------+---------+------------+
 * | PostresSQL 12     | pgsql   | pgsql      |
 * +-------------------+---------+------------+
 * | PostresSQL 11     | pgsql   | pgsql11    |
 * +-------------------+---------+------------+
 * | PostresSQL 10     | pgsql   | pgsql10    |
 * +-------------------+---------+------------+
 * | PostresSQL 9.6    | pgsql   | pgsql96    |
 * +-------------------+---------+------------+
 * | PostresSQL 9.3    | pgsql   | pgsql93    |
 * +-------------------+---------+------------+
 * | MySQL 8           | mysql   | mysql8     |
 * +-------------------+---------+------------+
 * | MySQL 5.7         | mysql   | mysql      |
 * +-------------------+---------+------------+
 * | MariaDB 10.5      | mariadb | mariadb    |
 * +-------------------+---------+------------+
 * | MariaDB 10.4      | mariadb | mariadb104 |
 * +-------------------+---------+------------+
 * | MariaDB 10.2      | mariadb | mariadb102 |
 * +-------------------+---------+------------+
 * | MSSQL Server 2017 | mssql   | mssql      |
 * +-------------------+---------+------------+
 */
$DOCKER_CFG->dbtype = 'pgsql'; // See the Type column above ^
$DOCKER_CFG->dbhost = 'pgsql'; // See the Host column above ^

/**
 * By default, the site database name is simply the name of the sub directory you have your site in,
 * or just 'totara' if you only have a single site. It can be accessed by using the `tdb` command.
 *
 * If you want to use a specific database for your site, set it here.
 */
$DOCKER_CFG->dbname = $DOCKER_CFG->site_name;

/**
 * Every table in the site database will be prefixed with this.
 * The most common prefix used is 'mdl_', which is set here by default. 'ttr_' is also widely used.
 */
$DOCKER_CFG->prefix = 'mdl_';

/**
 * By default, the site dataroot directory will be managed for you.
 * You can override it by setting it to a full path here if you know what you are doing.
 */
$DOCKER_CFG->dataroot_override = '';



//////////////////////////////////////////
/////////////     PHPUNIT    /////////////
//////////////////////////////////////////

/**
 * By default, the behat database name is simply the name of the sub directory you have your site in,
 * or just 'totara' if you only have a single site. It can be accessed by using the `tdb` command.
 *
 * If you want to use a specific database for phpunit, set it here.
 */
$DOCKER_CFG->phpunit_dbname = $DOCKER_CFG->dbname;




//////////////////////////////////////////
//////////////     BEHAT    //////////////
//////////////////////////////////////////

/**
 * If false, then you can run behat scenarios in parallel which is faster.
 * If true, then you can view the pages being tested via VNC, although you lose the ability to run in parallel.
 */
$DOCKER_CFG->behat_debug_mode = false;

/**
 * By default, the behat database name is simply the name of the sub directory you have your site in,
 * or just 'totara' if you only have a single site. It can be accessed by using the `tdb` command.
 *
 * If you want to use a specific database for behat, set it here.
 */
$DOCKER_CFG->behat_dbname = $DOCKER_CFG->dbname;

// Useful for seeing what exactly failed on the last behat run.
//$CFG->behat_faildump_path = __DIR__ . '/behat_fails_screenshots';



//////////////////////////////////////////////
///////   DEVELOPMENT MODE SETTINGS    ///////
//////////////////////////////////////////////

$CFG->sitetype = 'development';
//$CFG->sitetype = 'production';

@error_reporting(E_ALL | E_STRICT);
@ini_set('display_errors', '1');
$CFG->debug = (E_ALL | E_STRICT & ~E_DEPRECATED);
$CFG->debugdisplay = 1;
$CFG->perfdebug = 15;

$CFG->legacyadminsettingsmenu = true;
$CFG->langstringcache = false;
$CFG->cachejs = false;
$CFG->cache_graphql_schema = false;
$CFG->forced_plugin_settings['totara_tui'] = array(
    'cache_js' => false,
    'cache_scss' => false,
    'development_mode' => true
);
define('GRAPHQL_DEVELOPMENT_MODE', true);

$CFG->preventexecpath = false;

$CFG->mobile_device_emulator = true;

$CFG->debugallowscheduledtaskoverride = true;

//$CFG->debugstringids = true;
//$CFG->extramemorylimit = '1024M';

// Xhprof Profiling settings
//$CFG->profilingenabled = true;
//$CFG->profilingincluded = '*';



/////////////////////////////////////////////
///////////     EXTRA SETTINGS    ///////////
/////////////////////////////////////////////

$CFG->admin = 'admin';
$CFG->passwordpolicy = false;
$CFG->tool_generator_users_password = '12345';

$CFG->country = 'NZ';
$CFG->defaultcity = 'Wellington';

if ($DOCKER_CFG->totara_version >= 13) {
    /**
     * Available flavours:
     * learn
     * engage
     * perform
     * learn_engage
     * learn_perform
     * perform_engage
     * learn_perform_engage
     */
    $CFG->forceflavour = 'learn_perform_engage';
} else {
    $CFG->forceflavour = 'enterprise';
}






//////////////////////////////////////////////// MAKE CHANGES ABOVE THIS LINE //////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$DOCKER_CFG->apply_settings(); /////////////////////////////////////////////////////////////////////////////////////////////////////
$DOCKER_CFG->totara_version < 13 && require_once(__DIR__  .  '/lib/setup.php'); ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////