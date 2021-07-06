TravisCI build: [![Build Status](https://travis-ci.com/totara/totara-docker-dev.svg?branch=master)](https://travis-ci.com/totara/totara-docker-dev)

<details>
<summary>Container versions and build status</summary>

Name | Version | Dockerfile | Build
--- | --- | --- | ---
nginx | 1.13.x | [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/nginx/Dockerfile) | [![Build status Nginx](https://img.shields.io/docker/build/totara/docker-dev-nginx.svg)](https://hub.docker.com/r/totara/docker-dev-nginx/)
apache | 2.4.x | [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/apache/Dockerfile) | [![Build status Apache](https://img.shields.io/docker/build/totara/docker-dev-apache.svg)](https://hub.docker.com/r/totara/docker-dev-apache/)
mssql | 2017 | [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/mssql/Dockerfile) | [![Build status Mssql](https://img.shields.io/docker/build/totara/docker-dev-mssql.svg)](https://hub.docker.com/r/totara/docker-dev-mssql/)
php53 | 5.3 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php53/Dockerfile) | [![Build status PHP 5.3](https://img.shields.io/docker/build/totara/docker-dev-php53.svg)](https://hub.docker.com/r/totara/docker-dev-php53/)
php53-debug | 5.3 + xdebug 2.0.5 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php53-debug/Dockerfile) | [![Build status PHP 5.3 Debug](https://img.shields.io/docker/build/totara/docker-dev-php53-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php53-debug/)
php54 | 5.4 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php54/Dockerfile) | [![Build status PHP 5.4](https://img.shields.io/docker/build/totara/docker-dev-php54.svg)](https://hub.docker.com/r/totara/docker-dev-php54/)
php54-debug | 5.4 + xdebug 2.4.1 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php54-debug/Dockerfile) | [![Build status PHP 5.4 Debug](https://img.shields.io/docker/build/totara/docker-dev-php54-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php54-debug/)
php55 | 5.5 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php55/Dockerfile) | [![Build status PHP 5.5](https://img.shields.io/docker/build/totara/docker-dev-php55.svg)](https://hub.docker.com/r/totara/docker-dev-php55/)
php55-debug | 5.5 + xdebug 2.5.5 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php55-debug/Dockerfile) | [![Build status PHP 5.5 Debug](https://img.shields.io/docker/build/totara/docker-dev-php55-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php55-debug/)
php56 | 5.6 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php56/Dockerfile) | [![Build status PHP 5.6](https://img.shields.io/docker/build/totara/docker-dev-php56.svg)](https://hub.docker.com/r/totara/docker-dev-php56/)
php56-debug | 5.6 + xdebug 2.5.5 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php56-debug/Dockerfile) | [![Build status PHP 5.6 Debug](https://img.shields.io/docker/build/totara/docker-dev-php56-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php56-debug/)
php70 | 7.0 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php70/Dockerfile) | [![Build status PHP 7.0](https://img.shields.io/docker/build/totara/docker-dev-php70.svg)](https://hub.docker.com/r/totara/docker-dev-php70/)
php70-debug | 7.0 + xdebug 2.7.2 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php70-debug/Dockerfile) | [![Build status PHP 7.0 Debug](https://img.shields.io/docker/build/totara/docker-dev-php70-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php70-debug/)
php71 | 7.1 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php71/Dockerfile) | [![Build status PHP 7.1](https://img.shields.io/docker/build/totara/docker-dev-php71.svg)](https://hub.docker.com/r/totara/docker-dev-php71/)
php71-debug | 7.1 + xdebug 2.9.6 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php71-debug/Dockerfile) | [![Build status PHP 7.1 Debug](https://img.shields.io/docker/build/totara/docker-dev-php71-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php71-debug/)
php72 | 7.2 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php72/Dockerfile) | [![Build status PHP 7.2](https://img.shields.io/docker/build/totara/docker-dev-php72.svg)](https://hub.docker.com/r/totara/docker-dev-php72/)
php72-debug | 7.2 + xdebug 2.9.6 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php72-debug/Dockerfile) | [![Build status PHP 7.2 Debug](https://img.shields.io/docker/build/totara/docker-dev-php72-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php72-debug/)
php73 | 7.3 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php73/Dockerfile) | [![Build status PHP 7.3](https://img.shields.io/docker/build/totara/docker-dev-php73.svg)](https://hub.docker.com/r/totara/docker-dev-php73/)
php73-debug | 7.3 + xdebug 2.9.6 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php73-debug/Dockerfile) | [![Build status PHP 7.3 Debug](https://img.shields.io/docker/build/totara/docker-dev-php73-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php73-debug/)
php74 | 7.4 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php74/Dockerfile) | [![Build status PHP 7.4](https://img.shields.io/docker/build/totara/docker-dev-php74.svg)](https://hub.docker.com/r/totara/docker-dev-php74/)
php74-debug | 7.4 + xdebug 2.9.6 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php74-debug/Dockerfile) | [![Build status PHP 7.4 Debug](https://img.shields.io/docker/build/totara/docker-dev-php74-debug.svg)](https://hub.docker.com/r/totara/docker-dev-php74-debug/)
php80 | 8.0 |  [Dockerfile](https://github.com/totara/totara-docker-dev/blob/master/php/php80/Dockerfile) | [![Build status PHP 8.0](https://img.shields.io/docker/build/totara/docker-dev-php80.svg)](https://hub.docker.com/r/totara/docker-dev-php80/)
</details>

# A Docker setup for local Totara development

This project aims to provide an easy way to start developing for Totara by providing a Docker setup.

This setup was created and tested extensively on MacOS and Linux. It also works on Windows via WSL2.

Although this project started as a development environment for Totara Learn it can be adapted for use in any other PHP project.

### What You Get
 * [NGINX](https://nginx.org/) as a webserver
 * [Apache](https://httpd.apache.org/) as a webserver
 * [PHP](http://php.net/) 5.3, 5.4, 5.5, 5.6, 7.0, 7.1, 7.2, 7.3, 7.4 to test for different versions
 * [PostgreSQL](https://www.postgresql.org/) (9.3, 9.6, 10, 11, 12), [MariaDB](https://mariadb.org/) (10.2, 10.4 and 10.5) and [MySQL](https://www.mysql.com/) (5.7 and 8), and [Microsoft SQL Server 2017](https://www.microsoft.com/en-us/sql-server/sql-server-2017) support
 * [NodeJS](https://nodejs.org/) for building, developing and testing frontend code
 * A [PHPUnit](https://phpunit.de/) and [Behat](http://behat.org/en/latest/) setup to run tests (including [Selenium](https://www.seleniumhq.org/))
 * A [mailcatcher](https://mailcatcher.me/) instance to view sent emails
 * [Redis](https://redis.io/) for caching and/or session handling
 * [XHProf](https://github.com/tideways/php-xhprof-extension) for profiling
 * [XDebug](https://xdebug.org/) installed, ready for debugging with your favorite IDE

### Requirements
 * [Totara source code](https://help.totaralearning.com/display/DEV/Getting+the+code)
 * [Docker](https://www.docker.com)
 * [Docker-compose](https://docs.docker.com/compose/install) (included in Docker for Mac/Windows)
 * At least 3.25GB of RAM for MSSQL

__Recommended for macOS / Windows machines:__
 * [Mutagen](docs/mutagen.md) v0.10.0+ (significantly improves performance)

## Installation
 1. (Optional, recommended for MacOS/Windows) Install [Mutagen](docs/mutagen.md)
 1. Create a directory that you can clone your Totara sites into (e.g. ```~/totara-sites```)
 1. Copy the file ```.env.dist``` to ```.env``` and set ```LOCAL_SRC``` to the path to your local Totara site folder (e.g. ```LOCAL_SRC=~/totara-sites```)
 1. Copy the file ```shell/aliases.sh.dist``` to ```shell/aliases.sh```
 1. Clone the Totara source code into your site folder and give it a name (e.g. ```cd ~/totara-sites && git clone REPO_URL totara13```)
 1. Copy the file ```config.php``` from this repo into your Totara site repo folder
 1. Add the ```bin/``` folder to your paths (e.g. ```PATH=$PATH:/path/to/docker-dev/bin```)
 1. Configure your terminal to use an [extended font pack](https://github.com/romkatv/nerd-fonts)
 1. Make sure you have all the hosts in your ```/etc/hosts``` file to be able to access them via the browser. Example:
```bash
127.0.0.1 totara53 totara53.debug totara53.behat totara54 totara54.debug totara54.behat totara55 totara55.debug totara55.behat totara55 totara55.debug totara56.behat totara70 totara70.debug totara70.behat totara71 totara71.debug totara71.behat totara72 totara72.debug totara72.behat totara73 totara73.debug totara73.behat totara74 totara74.debug totara74.behat totara80 totara80.behat
```

## Usage

### Databases

Like most content/learning management systems, you will need a database to run Totara.

The easiest way to set up a database is via the ```tdb``` command.
It allows you to easily interact with any of the 4 supported DBMSes in a simple and consistent way.
The script allows you to create, drop, backup and restore any database without having to remember the specific commands for each dbms.

To get started, simply define which database type and host you wish to use in your ```config.php```, then run:
```bash
cd sitefolder # must run the command from the root of your Totara repo
tdb # prints help - shows what commands are available
tdb create
```

Alternatively, you can manually configure your databases via these commands:
<details>
<summary>Commands</summary>

**PostgreSQL**
```bash
tdocker exec pgsql psql -U postgres
```
```sql
CREATE DATABASE my_totara_db;
```

**MySQL 8**
```bash
tdocker exec mysql8 mysql -u root -p"root"
```
```sql
CREATE DATABASE my_totara_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs;
```

**MySQL 5.7 / MariaDB**
```bash
tdocker exec mysql mysql -u root -p"root"
tdocker exec mariadb mysql -u root -p"root"
```
```sql
CREATE DATABASE my_totara_db DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
```

**Microsoft SQL Server 2017**
```bash
tdocker exec php-7.3 /opt/mssql-tools/bin/sqlcmd -S mssql -U SA -P "Totara.Mssql1"
```
```sql
CREATE DATABASE my_totara_db COLLATE Latin1_General_CS_AS ALTER DATABASE my_totara_db SET ANSI_NULLS ON ALTER DATABASE my_totara_db SET QUOTED_IDENTIFIER ON ALTER DATABASE my_totara_db SET READ_COMMITTED_SNAPSHOT ON;
GO
```
</details>
<details>
<summary>Database Login Credentials</summary>

DB | Host | Port | User | Password |
--- | --- | --- | --- | ---
**PostresSQL 12 (latest)** | pgsql | 5432 | postgres | 
**PostresSQL 11** | pgsql11 | 5411 | postgres | 
**PostresSQL 10** | pgsql10 | 5410 | postgres | 
**PostresSQL 9.6** | pgsql96 | 5496 | postgres | 
**PostresSQL 9.3** | pgsql93 | 5493 | postgres | 
**Mysql 8** | mysql8 | 3308 | root | root
**Mysql 5.7** | mysql | 3306 | root | root
**MariaDB 10.5** | mariadb | 3307 | root | root
**MariaDB 10.4** | mariadb104 | 3309 | root | root
**MariaDB 10.2** | mariadb102 | 3302 | root | root
**Mssql** | mssql | 1433 | SA | Totara.Mssql1
</details>

Once you have a database created, you should be able to access the site from the web -
try visiting __[http://totara73/sitename/server](http://totara73/)__ (where ```sitename``` is the folder name of your Totara repo)

### Using Containers

#### Starting Containers

It is recommended to specify the containers you really need.
The minimum you probably need is the db and the php container of your choice,
the nginx container is started automatically alongside the php container.

The scripts for the following commands are located in the ```bin/``` folder of this project.

```bash
# equivalent to: docker-compose up -d pgsql php-7.3
tup pgsql php-7.3
```

If you need additional containers at a later point just run ```tup``` with the container you need:

```bash
tup php-5.6
tup mariadb
tup selenium-hub
```

#### Shell Session

For the PHP containers, you can use the [zsh shell](#oh-my-zsh-shell) to run commands for your Totara site via ```tzsh```:
```bash
cd sitefolder # must run the commands from the root of your Totara repo
tzsh php-7.3
# OR
tzsh php-7.3-debug # for XDebug support
# OR
tzsh php-5.6 # for older Totara versions
```

If required, you can also start a shell session for any container via ```tbash```:
```bash
# It doesn't matter where you run the tbash command from
tbash php-7.3
tbash nginx
tbash pgsql
tbash apache
```

#### Stopping Containers

```bash
# stops the specified containers, equivalent to: docker-compose stop
tstop

# stops all containers, equivalent to: docker-compose down
# also pauses existing mutagen sessions
tdown
```

#### More Commands

This project comes with a few bash scripts to simplify usage across platforms. The scripts are located in the ```bin/``` folder.

```bash
tbash [container]                 # log into a container via bash, i.e. php-7.3
tbuild [container]                # build (all) container(s)
tdb [options]                     # run common actions for your databases
tdocker                           # shortcut to general docker-compose ... command
tdown                             # shutdown all containers
tgrunt [options]                  # run grunt in container, supports running in subfolders
tngrok [host]                     # shortcut to running ngrok with a Totara host such as totara74.debug or totara56
tnpm [options]                    # run npm in container, supports running in subfolders
tpull                             # pull latest images (only those which you already have locally) 
trestart [container]              # restart (all) container(s)
tscale [container] [number]       # scale up the number of containers, i.e. `tscale selenium-chrome 6`
tstats                            # show docker stats including container names
tstop [container]                 # stop (all) container(s)
tunit [container] [folder] [init] # run or init unit tests in given container for given version
tup [containers]                  # start (all) container(s)
tzsh [php container]              # log into a php container via oh my zsh, i.e. php-7.3
```

### Multiple versions

It is recommended to check out each Totara version in a different subfolder below the folder LOCAL_SRC defined in .env. This enables you to access different versions without having to switch branches all the time.

### Running Cron

You can run the cron manually by logging into a php container and running:

```
cron
```

You can also use the cron containers to run the cron automatically using crontab. Just create your own crontab files within the `cron.d` folder and start a cron container like:

```bash
# in the background
tup php-7.3-cron

# in the foreground
tdocker up php-7.3-cron

# access the logs anytime with
tdocker logs -f php-7.3-cron

# stop a daemonized cron container
tstop php-7.3-cron
```

### NodeJS, NPM and grunt 

If you want to use npm you can use ```tnpm``` like this:
```bash
# must run the commands from the root of your Totara repo
cd sitefolder

# Must install first
tnpm install

# Some useful commands - check the package.json to see all the available commands
tnpm run tui-prod
tnpm run tui-dev
tnpm run tui-watch
tnpm run tui-ci
```

If you want to use grunt you can use ```tgrunt``` like this:
```bash
# must run the commands from the root of your Totara repo
cd sitefolder
# if the site is Totara 13 or later, then you must run it from the server/ directory
cd server

tgrunt
tgrunt gherkinlint
tgrunt css
```

Alternatively, you can directly log in to the container directly run node/grunt commands.
<details>
<summary>Example</summary>

```bash
tdocker run nodejs bash
# go to your source directory and
npm install
./node_modules/.bin/grunt
```
</details>

### PHPUnit

If this is the first time you've run PHPUnit for the site, you will need to create another database for it.
```bash
cd sitefolder # must run the command from the root of your Totara repo
tdb create unt_sitefolder
```
(Where ```sitefolder``` is the directory your site is located - e.g. ```totara13```)

Log into one of the PHP containers:
```bash
cd sitefolder # must run the command from the root of your Totara repo
tzsh php-7.3 # or other php containers, as mentioned above
```

If needed, initiate the PHPUnit setup:
```bash
# See shell/aliases.sh.dist for what this alias does
installunit
```

Run tests:
```bash
# See shell/aliases.sh.dist for what these aliases do
# Run all tests (in parallel across 4 processes - it can take a long time!)
unitparallel --processes=4
# Run a single test file
unit relative/path/to/test.php
# Run all tests in a directory
unitdir totara/core
```

### Behat

#### Running Behat (in parallel)

If you just want to run a suite of behat tests, then it is much faster (and recommended) to run behat in parallel mode (i.e. across multiple threads simultaneously)

To get started, you'll need to start the selenium containers. For the following examples, we are going to run behat across 4 threads. You can adjust this number based on your computers performance.
```bash
tup selenium-hub
tscale selenium-chrome 4 # Creates 4 selenium containers for running across 4 threads
```

Log into one of the PHP containers:
```bash
cd sitefolder # must run the command from the root of your Totara repo
tzsh php-7.3 # or other php containers, as mentioned above
```

Initiate the behat tests:
```bash
# See shell/aliases.sh.dist for what these aliases do
installbehat --parallel=4 # Initiates for 4 threads
# If you are wanting to run a specific tag, then you can optimise behat for it
installbehat --parallel=4 --optimise-runs=@totara
```

Run behat with:
```bash
# See shell/aliases.sh.dist for what these aliases do
# Run all scenarios (takes several hours)
behat
# Run a specific tag
behat --tags=@totara
# Run a specific scenario
behat --name="Name of the scenario"
# Run a specific feature file
behat path/to/feature/file
```
To see the status of the selenium containers while they are executing,
go to __[http://localhost:4444/grid/console](http://localhost:4444/grid/console)__ to view the web console.

#### Debugging Behat

You can connect to the selenium container via VNC to view what is being executed in the browser, which is very helpful for when writing/fixing tests.

To do this, you need to set your behat host to ```selenium-chrome-debug``` in your config.php.
If you are using the config.php that comes with docker-dev, simply find ```$DOCKER_DEV->behat_debug_mode``` and set it to ```true```.

Now start the selenium debug container:
```bash
tup selenium-chrome-debug
```

You will then need to re-initialise behat:
```bash
cd sitefolder # must run the command from the root of your Totara repo
tzsh php-7.3 # or other php containers, as mentioned above
installbehat
```
Now you can run it:
```bash
behat --name="Name of the scenario"
```
In a VNC client, connect using the following credentials to view the scenario running:
Host | Port | Password |
--- | --- | ---
localhost | 5901 | secret

If you can't see the scenario executing, it may be because the scenario is missing the ```@javascript``` tag.
If the tag isn't specified for the scenario it will run it in headless mode, meaning selenium won't be used.

### Mailcatcher

The setup comes with mailcatcher support. Mailcatcher allows you to view all emails triggered by your Totara sites.
Go to __[http://localhost:8080](http://localhost:8080)__ to view the mailcatcher GUI.

### Ngrok

__[Ngrok](https://ngrok.com/)__ is a useful tool for making your local Totara site accessible publicly on the web.
This is very useful when testing intergrations with Totara, such as the mobile app, or external services such as Microsoft Teams, LinkedIn Learning, or even if you simply want to make your site available for someone else to look at.

You will first need to [sign up for an account](https://dashboard.ngrok.com/signup), and then install and authenticate ngrok on your machine. You will also need to make sure that the `ngrok` command can be run normally - this may require adding your ngrok installation directory to your `$PATHS` variable.

Once ngrok is set up, you can use the ```tngrok``` command to use it with Totara.

If you have multiple sites set up, you will need to add entries into your ```/etc/hosts``` file, for each Totara host such as ```totara73``` that you wish to use, you will need to add one with your desired site as the subdomain, like ```yoursite.totara73```.

### PHPStorm Integration

PHPStorm is a powerful IDE that integrates well with this docker setup. You integrate docker into PHPStorm, so you can use XDebug and run tests directly from the IDE.
__[See here](docs/phpstorm.md)__ for information on how to set this up.

### Oh My Zsh Shell

Oh My Zsh is an extention for the standard zsh shell. You can use it with the php containers instead of bash by using the `tzsh` command.
It is better than the basic bash shell as it brings colour support, autocompletion, autosuggestions and more. Oh My Zsh is highly configurable - see `shell/.zshrc` for the current configuration and check out the [ohmyzsh](https://github.com/ohmyzsh/ohmyzsh) and [powerline10k](https://github.com/romkatv/powerlevel10k) docs for more ideas on what is possible.

To use it, you will need to configure your terminal to use some [custom fonts](https://github.com/romkatv/nerd-fonts).

### Custom Shell Aliases

The `shell` folder lets you add custom aliases and functions to your php containers. Any file with the `.sh` extension will be sourced into your php container whenever you bash/sh into it. This is useful for when you need to run complex commands often during development, such as initialising tests. To get started, simply copy `aliases.sh.dist` to `aliases.sh` and define your aliases.

### Custom docker-compose Configurations

You can customise the docker compose configurations simply adding your own `.yml` compose files into the `custom` folder. Any containers or other options you have will automatically override any existing default container options.

## Build

By default, prebuilt images from [Docker Hub](https://hub.docker.com/u/totara/) will be used. If you want to modify any of the containers to your needs then you can rebuild them locally with the following command:

```bash
# for an invidual image
tbuild php-7.3
# for all images
tbuild
```

## Contribute

Please check out the [contributing](docs/contributing.md) page for more information on how you can help us.
