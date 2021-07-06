<?php
/**
 * Generic site setup that works the same for multiple totara sites.
 *
 * Note: All PHP code used here MUST support all PHP versions above and including PHP 5.3.29+
 *
 * Main Site Properties:
 * @property string $dbtype Database Type - e.g. 'mysql'
 * @property string $dbhost Database Host - e.g. 'mysql8'
 * @property string $dbname Database Name - e.g. 'my_totara_db'
 * @property string $prefix Prefix for the site database tables - e.g. 'mdl_' or 'ttr_'
 * @property string $dataroot_override Override the default dataroot directory to something like '/var/www/mydataroot'
 *
 * PHPUnit Properties:
 * @property string $phpunit_dbname E.g. 'my_unit_db'
 *
 * Behat Properties:
 * @property bool $behat_debug_mode
 * @property string $behat_dbname E.g. 'my_behat_db'
 * @property-read bool $behat_parallel
 * @property-read string $behat_host
 *
 * Extra Helpers:
 * @property-read string $remote_src E.g. '/var/www/totara/src'
 * @property-read string $remote_data E.g. '/var/www/totara/data'
 * @property-read string $dirroot E.g. '/var/www/totara/src/totara13'
 * @property-read string $site_name E.g. 'totara13'
 * @property-read int $php_version E.g. 56 or 74
 * @property-read float $totara_version Totara version number, e.g. 2.4 or 9 or 13
 * @property-read bool $has_server_dir True if site version is T12 or older
 * @property-read bool $is_multi_site True if there are multiple totara sites running for this docker instance
 */
class docker_dev_config {

    /**
     * @var array
     */
    private $settings;

    /** 
     * @param string $dir Absolute path of the totara site directory, e.g. '/var/www/totara/src/totara13'
     */
    public function __construct($dir) {
        global $CFG;
        $CFG = new stdClass();
        $this->settings = array();

        $this->remote_src = getenv('REMOTE_SRC') ?: '/var/www/totara/src';
        $this->remote_data = getenv('REMOTE_DATA') ?: '/var/www/totara/data';
        $this->dirroot = $dir;
        $this->is_multi_site = $dir !== $this->remote_src;
        $this->site_name = $this->is_multi_site ? basename($dir) : 'totara';
        $this->has_server_dir = file_exists($dir  . '/server/config.php');

        // We don't use phpversion() since it's harder to get a comparable value due to having multiple decimal points
        $this->php_version = (int) str_replace(array('.', 'php-', '-debug', '-cron'), '', getenv('CONTAINERNAME'));

        $this->totara_version = $this->get_current_version();
    }

    /**
     * Actually set the $CFG settings based on what has been passed to $DOCKER_CFG
     */
    public function apply_settings() {
        global $CFG;

        $this->define_wwwroot();
        $this->define_directories();
        $this->define_databases();
        $this->define_behat();

        // Redirects any emails sent by the server
        $CFG->smtphosts = 'mailcatcher:25';

        // GhostScript location - used for adding annotations in courses
        $CFG->pathtogs = '/usr/bin/gs';

        // GraphViz location - used to render XHProf call graphs
        $CFG->pathtodot = '/usr/bin/dot';
    }

    /**
     * Set the URL the site can be accessed by.
     */
    private function define_wwwroot() {
        global $CFG;

        if (!empty($_SERVER['HTTP_X_ORIGINAL_HOST']) && strpos($_SERVER['HTTP_X_ORIGINAL_HOST'], 'ngrok.io') !== false) {
            // using ngrok
            $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_ORIGINAL_HOST'];
            $CFG->wwwroot = 'https://' . $_SERVER['HTTP_HOST'];
        } else if (!empty($_SERVER['HTTP_HOST']) && !empty($_SERVER['REQUEST_SCHEME'])) {
            // accessing it locally via the web
            $hostname = $_SERVER['HTTP_HOST'];
            $hostname_parts = explode('.', $hostname);
            $CFG->wwwroot = $_SERVER['REQUEST_SCHEME'] . '://';

            if (end($hostname_parts) === 'behat') {
                // redirect if using the behat URL
                $hostname = str_replace('.behat', '', $hostname);
            }
            $CFG->wwwroot .= $hostname;

            if ($this->is_multi_site && strpos($hostname, $this->site_name) === false) {
                $CFG->wwwroot .= '/' . $this->site_name;
                if ($this->has_server_dir) {
                    $CFG->wwwroot .= '/server';
                }
            }
        } else {
            // accessing it via CLI
            $CFG->wwwroot = 'http://totara' . $this->php_version;
            if ($this->is_multi_site) {
                $CFG->wwwroot .= '/' . $this->site_name;
            }
            if ($this->has_server_dir) {
                $CFG->wwwroot .= '/server';
            }
        }
    }

    /**
     * Set the directories used for the site.
     */
    private function define_directories() {
        global $CFG;
        $CFG->dataroot = $this->remote_data . '/' . $this->site_name . '.' . $this->dbtype;
        $CFG->phpunit_dataroot = $CFG->dataroot . '.t' . $this->totara_version . '.phpunit';
        $CFG->behat_dataroot = $CFG->dataroot . '.t' . $this->totara_version . '.behat';
        if (!empty($this->dataroot_override)) {
            $CFG->dataroot = $this->dataroot_override;
        }

        $CFG->directorypermissions = 02777;

        $this->create_directory($CFG->dataroot);
        $this->create_directory($CFG->phpunit_dataroot);
        $this->create_directory($CFG->behat_dataroot);
    }

    /**
     * Set the database variables.
     */
    private function define_databases() {
        global $CFG;

        $CFG->dbname = $this->dbname;
        $CFG->prefix = $this->prefix;

        $CFG->phpunit_dbname = $this->phpunit_dbname;
        $CFG->phpunit_prefix = 'unt_';

        switch ($this->dbtype) {
            case 'pgsql':
                $CFG->dbtype = 'pgsql';
                $CFG->dbhost = 'pgsql';
                $CFG->dbuser = 'postgres';
                $CFG->dbpass = '';
                break;
            case 'mysql':
                $CFG->dbtype = 'mysqli';
                $CFG->dbhost = 'mysql';
                $CFG->dbuser = 'root';
                $CFG->dbpass = 'root';
                break;
            case 'mariadb':
                $CFG->dbtype = 'mariadb';
                $CFG->dbhost = 'mariadb';
                $CFG->dbuser = 'root';
                $CFG->dbpass = 'root';
                break;
            case 'mssql':
                if ($this->php_version >= 70) {
                    // In newer php versions the mssql plugin is called sqlsrv
                    $CFG->dbtype = 'sqlsrv';
                } else {
                    $CFG->dbtype = 'mssql';
                }
                $CFG->dbhost = 'mssql';
                $CFG->dbuser = 'SA';
                $CFG->dbpass = 'Totara.Mssql1';
                break;
            default:
                throw new InvalidArgumentException('Unrecognised DB Type: ' . $this->dbtype);
        }

        // Override default host if specified.
        if (isset($this->dbhost)) {
            $CFG->dbhost = $this->dbhost;
        }

        $CFG->dblibrary = 'native';

        $CFG->dboptions = array(
            'dbpersist' => false,
            'dbsocket'  => false,
            'dbport'    => ''
        );
    }

    /**
     * Set the behat variables.
     */
    private function define_behat() {
        global $CFG;
        $this->behat_parallel = !$this->behat_debug_mode;

        $CFG->behat_dbname = $this->behat_dbname;
        $CFG->behat_prefix = 'bht_';

        $CFG->behat_wwwroot = 'http://totara' . $this->php_version . '.behat';
        if ($this->is_multi_site) {
            $CFG->behat_wwwroot .= '/' . $this->site_name;
        }
        if ($this->has_server_dir) {
            $CFG->behat_wwwroot .= '/server';
        }

        define('BEHAT_MAX_CMD_LINE_OUTPUT', 180);

        if ($this->totara_version < 2.9) {
            // Parallel mode was only introduced in 2.9, so older versions don't support it.
            $this->behat_parallel = false;
        }

        if ($this->behat_parallel) {
            $this->behat_host = 'selenium-hub';

            // Generate a big parallel config.
            $parallel_run = array();
            for ($i = 1; $i <= 8; $i++) {
                $parallel_run[] = array(
                    'dbname' => $this->behat_dbname,
                    'behat_prefix' => 'bh' . $i  . '_',
                    'wd_host' => 'http://selenium-hub:4444/wd/hub'
                );
            }
            $CFG->behat_parallel_run = $parallel_run;
        } else {
            $this->behat_host = 'selenium-chrome-debug';
        }

        if ($this->totara_version >= 10) {
            $CFG->behat_profiles['default'] = array(
                'browser' => 'chrome',
                'wd_host' => 'http://' . $this->behat_host . ':4444/wd/hub',
                'capabilities' => array(
                    'browserVersion' => 'ANY',
                    'platform' => 'ANY',
                    'version' => 'ANY',
                    'extra_capabilities' => array(
                        'chromeOptions' => array(
                            'args' => array(
                                '--disable-infobars',
                                '--disable-background-throttling'
                            ),
                            'prefs' => array(
                                'credentials_enable_service' => false,
                            )
                        )
                    )
                )
            );
        } else {
            $CFG->behat_config = array(
                'default' => array(
                    'extensions' => array(
                        'Behat\MinkExtension\Extension' => array(
                            'browser_name' => 'chrome',
                            'default_session' => 'selenium2',
                            'selenium2' => array(
                                'browser' => 'chrome',
                                'wd_host' => 'http://' . $this->behat_host . ':4444/wd/hub',
                                'capabilities' => array(
                                    'version' => '',
                                    'platform' => 'LINUX'
                                )
                            )
                        )
                    )
                )
            );
            if ($this->behat_parallel) {
                $CFG->behat_profiles = array(
                    'default' => array(
                        'browser' => 'chrome',
                        'wd_host' => 'http://' . $this->behat_host .':4444/wd/hub',
                        'capabilities' => array(
                            'browser' => 'chrome',
                            'browserVersion' => 'ANY',
                            'version' => '',
                            'chrome' => array(
                                'switches' => array(
                                    '--disable-infobars',
                                    '--disable-background-throttling'
                                )
                            )
                        )
                    )
                );
            }
        }
    }


    /*************************************************************
     * Helpers                                                   *
     *************************************************************/

    /**
     * Create the specified directory if it doesn't exist.
     *
     * @param string $dir_name
     */
    private function create_directory($dir_name) {
        global $CFG;

        if (file_exists($dir_name)) {
            return;
        }

        mkdir($dir_name, $CFG->directorypermissions, true);
        chgrp($dir_name, 'www-data');
        chown($dir_name, 'www-data');
        chmod($dir_name, $CFG->directorypermissions);
    }

    /**
     * Get the version constant value from the site version.php
     *
     * @return float
     */
    private function get_current_version() {
        $version_file_path = $this->dirroot  . '/version.php';
        if ($this->has_server_dir) {
            $version_file_path = $this->dirroot  . '/server/version.php';
        }
        $version_file_contents = file_get_contents($version_file_path);

        // Check for t2
        $version = $this->get_version_string_from_version_file($version_file_contents, "/version[\s]*=[\s]*\'[1-2]{1}\.[0-9]{1}/");
        if ($version) {
            return (float) $version;
        }

        // Check for t9 and newer
        $version = $this->get_version_string_from_version_file($version_file_contents, "/version[\s]*=[\s]*\'[0-9]+/");
        if ($version) {
            return (float) $version;
        }

        // So this is probably a really old totara version or it could be moodle
        return -1.0;
    }

    /**
     * @param string $version_file_contents
     * @param string $regex_pattern
     * @return string|null
     */
    private function get_version_string_from_version_file($version_file_contents, $regex_pattern) {
        $matches = array();
        preg_match_all($regex_pattern, $version_file_contents, $matches);
        if (!empty($matches) && isset($matches[0][0])) {
            $result = $matches[0][0];
            $matches = array();
            preg_match("/\'(.+)$/", $result, $matches);
            return $matches[1];
        }
        return null;
    }


    /*************************************************************
     * Magic Methods                                             *
     *************************************************************/

    /**
     * @param string $name
     * @param mixed|null $value
     */
    public function __set($name, $value) {
        $this->settings[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name) {
        $get_method = 'get_' . $name;
        if (method_exists(get_called_class(), $get_method)) {
            return $this->$get_method();
        }
        if (isset($this->settings[$name])) {
            return $this->settings[$name];
        }
        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name) {
        $get_method = 'get_' . $name;
        if (method_exists(get_called_class(), $get_method)) {
            return true;
        }
        return isset($this->settings[$name]);
    }

}
