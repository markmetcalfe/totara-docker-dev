<?php
/**
 * Helper script that consolidates all the various ways of running behat into a single command,
 * that can be used regardless of what Totara version you are using and whether you are running in parallel mode or not.
 *
 * Note: All PHP code used here MUST support all PHP versions above and including PHP 5.3.29+
 */

function print_behat_error($error) {
    echo 'echo "\x1B[33m' . addcslashes($error, '"') . '\x1B[0m"';
    exit(1);
}

function run_behat_command($command) {
    $safe_command = addcslashes(trim($command), '"');
    echo 'echo "\x1B[2mCommand: \x1B[4m' . $safe_command . '\x1B[0m";';
    echo addcslashes($command, '"');
    exit(0);
}

// Don't care about the first arg
array_shift($argv);

define('CLI_SCRIPT', 1);

global $CFG, $DOCKER_CFG;
$base_dir = array_shift($argv);
if (file_exists($base_dir . '/server/config.php')) {
    require $base_dir . '/server/config.php';
} else if (file_exists($base_dir . '/config.php')) {
    require $base_dir . '/config.php';
} else {
    print_behat_error("Couldn't locate a config.php file - are you running this from your site root?");
}

if (!isset($DOCKER_CFG)) {
    print_behat_error("\$DOCKER_CFG isn't set - are you using the correct docker-dev version and is your config.php set up correctly?");
}
if ($DOCKER_CFG->totara_version <= 2.5) {
    print_behat_error("This script doesn't currently support Totara 2.5 or earlier.\nIf you know how to make it work, please contribute a solution.");
}
if ($DOCKER_CFG->php_version >= 74) {
    print_behat_error("PHP versions greater than 7.3 aren't working with behat yet.\nIf you know how to make it work, please contribute a solution.");
}


// We don't want the behat.yml that sits around in the site code to interfere with anything.
// Make sure that we delete the existing one and copy the correct one.
@unlink($base_dir . '/behat.yml');
@unlink($base_dir . '/behat_local.yml');
if ($DOCKER_CFG->totara_version >= 13) {
    $dataroot_behat_yml = $CFG->behat_dataroot . '/behatrun/behat/behat.yml';
    $source_behat_yml = $base_dir . '/behat_local.yml';
} else {
    $dataroot_behat_yml = $CFG->behat_dataroot . '/behat/behat.yml';
    $source_behat_yml = $base_dir . '/behat.yml';
}
if (file_exists($dataroot_behat_yml)) {
    copy($dataroot_behat_yml, $source_behat_yml);
}

// Handle installation
if (isset($argv[0]) && $argv[0] === 'install') {
    array_shift($argv);

    $install_script = 'admin/tool/behat/cli/init.php';
    if ($DOCKER_CFG->has_server_dir) {
        $install_script = 'server/' . $install_script;
    }
    run_behat_command('php ' . $install_script . ' ' . implode(' ', $argv));
}


// Check if the correct selenium container is up and running
set_time_limit(0);
$is_selenium_running = @fsockopen($DOCKER_CFG->behat_host, '4444', $errno, $errstr, 1);
if (!$is_selenium_running) {
    $error_message = "The {$DOCKER_CFG->behat_host} container must be running in order to use behat.";
    if ($DOCKER_CFG->behat_parallel) {
        $error_message .= "\n(Also don't forget to create multiple selenium-chrome instances)";
    }
    print_behat_error($error_message);
}


if (!file_exists($dataroot_behat_yml) && !$DOCKER_CFG->behat_parallel) {
    print_behat_error("Couldn't locate a behat.yml at " . $dataroot_behat_yml . "\nHave you initialised behat?");
}
// If T13+ has been checked out after running behat for an older version,
// then there will be a leftover vendor directory that needs to be removed.
if ($DOCKER_CFG->totara_version >= 13 && file_exists($base_dir . '/vendor/bin/behat')) {
    rmdir($base_dir . '/vendor/bin/behat');
}


// Build the actual command to be run.
if ($DOCKER_CFG->behat_parallel) {
    $command_to_run = 'php ' . $CFG->dirroot . '/admin/tool/behat/cli/run.php';
} else if ($DOCKER_CFG->totara_version >= 13) {
    $command_to_run = $base_dir . '/test/behat/vendor/bin/behat --config ' . $dataroot_behat_yml;
} else {
    $command_to_run = $CFG->dirroot . '/vendor/bin/behat --config ' . $source_behat_yml;
}

foreach ($argv as $arg) {
    $matches = array();
    preg_match("/\.feature$/", $arg, $matches);
    if (!empty($matches) && isset($matches[0])) {
        // The specified arg is a file path, so prefix it with the full directory path.
        $arg = $base_dir . '/' . $arg;
    }

    $command_to_run .= ' ' . addcslashes(escapeshellcmd($arg), " '\"");
}

run_behat_command($command_to_run);
