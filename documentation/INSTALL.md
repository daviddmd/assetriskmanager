# Requirements and Installation for Production Environment

Asset Risk Manager is a Laravel (PHP) powered web application and runs on all systems that support a modern PHP
installation or support Docker.

## Dependencies

- PHP >= 8.2 with the pdo, ldap, gd and zip extensions installed and loaded
- MySQL >= 8.0, MariaDB >= 10.6 or PostgreSQL
- Optionally, NodeJS >= 18 with npm (For Generating Production/Development CSS and JS files)
- Optionally, Global [Composer](https://getcomposer.org/) (This repository comes bundled with a build of composer).

OR

- Installation of Docker

On Docker, Windows Systems must use WSL2.

An Active Directory or equivalent LDAP Server is required for authentication if LDAP is enabled , otherwise normal
registration will be enabled. Email verification and password reset require a functional email configuration. This
application comes with features (commands) to reset the password and 2FA without using email.

Instructions for both a development environment with Docker and an Ubuntu 22.04 Production Environment are provided,
although this application will run on other GNU/Linux distributions if the dependencies are satisfied.

## Installation on Ubuntu Server 22.04

Ubuntu Server 22.04 or greater is needed because of the PHP >= 8.1 dependency (although it can be used on former Ubuntu
Server versions with alternative repositories).

By default, on the Ubuntu 22.04 repository, PHP defaults to PHP 8.1. On any greater version, replace references of
php8.1 or similar to the next PHP version.

Any previous version of Ubuntu Server (or any GNU/Linux distribution) may be used, as long as it provides PHP 8.1 (or
greater) and a compatible composer, php (with all required extensions) and mysql/mariadb environments.

On **previous versions** of Ubuntu Server (< 22.04), [ondrej PPA](https://launchpad.net/~ondrej/+archive/ubuntu/php)
may be used to install PHP 8.1 (or greater) and its required extensions. To install this PPA:

```shell
sudo apt-get update
sudo apt install lsb-release ca-certificates apt-transport-https software-properties-common -y
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
```

And follow this guide as if you were using Ubuntu Server 22.04.

The name of the created database, users and security/network parameters may vary, as well as their credentials or
transparent database encryption. Such changes must be reflected later on the final Laravel environment file.

```shell
sudo -i
apt update && apt upgrade
apt install mariadb-server
mysql_secure_installation
mysql
```

```mysql
CREATE
    DATABASE arm;
CREATE
    USER 'armuser'@'localhost' IDENTIFIED BY 'armpassword';
GRANT ALL PRIVILEGES ON arm.* TO
    'armuser'@'localhost';
FLUSH
    PRIVILEGES;
```

```shell
exit #leave mariadb shell
apt install php8.1 nginx php8.1-mysql php8.1-fpm php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-curl php8.1-gd php8.1-ldap php8.1-zip git build-essential unzip
systemctl enable nginx php8.1-fpm.service
ufw enable
ufw allow "OpenSSH"
ufw allow 'Nginx Full'
phpenmod ldap
phpenmod gd
mkdir -p /var/www/assetriskmanager
exit #leave root
sudo chown -R $USER:$USER /var/www/assetriskmanager
cd /var/www/assetriskmanager
#Configure beforehand a personal access token if needed or download the zip/tar from the GitHub releases page and extract there
git clone https://github.com/daviddmd/assetriskmanager.git . #git checkout v1.0.x to checkout a specific version
cp .env.example .env
vim .env
```

```ini
APP_NAME = ARM
APP_DEBUG = false
#...
DB_CONNECTION = mysql
DB_HOST = localhost
DB_PORT = 3306
DB_DATABASE = arm
DB_USERNAME = armuser
DB_PASSWORD = armpassword
#...
LDAP_ENABLED = true
LDAP_LOGGING = false
LDAP_CONNECTION = default
LDAP_HOST = 192.168.134.179
LDAP_USERNAME = "cn=Reader,cn=Users,dc=example,dc=com"
LDAP_PASSWORD = "password123"
LDAP_PORT = 389
LDAP_BASE_DN = "dc=example,dc=com"
LDAP_TIMEOUT = 5
LDAP_SSL = false
LDAP_TLS = false
```

To generate the production JS and CSS bundle:

```shell
sudo -i
curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
apt-get install -y nodejs
exit
npm install
npm run build
```

```shell
php composer.phar install --optimize-autoloader --no-dev #or php composer.phar install --optimize-autoloader if faker is needed for seeding the database
php artisan key:generate
php artisan event:cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate #or php artisan migrate:fresh --seed for generating a test environment. Run php artisan migrate:fresh again to reset the database back to the initial (empty) state
sudo vim /etc/nginx/sites-available/assetriskmanager
```

```nginx
server {
    listen 80;
    server_name localhost;
    root /var/www/assetriskmanager/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```shell
sudo ln -s /etc/nginx/sites-available/assetriskmanager /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo systemctl restart php8.1-fpm.service nginx
sudo chown -R www-data:www-data /var/www/assetriskmanager/storage
sudo chown -R www-data:www-data /var/www/assetriskmanager/bootstrap/cache/
```

After this procedure, open the website on the machine's IP and log in as the first administrator (
administrator@example.com).

After the first login, run `php artisan make:admin administrator@example.com`

After this, log in with the next set of users, and with the administrator user set one of them as the security officer
on the Users menu.

To apply updates:

```shell
cd /var/www/assetriskmanager
sudo chown -R $USER:$USER .
git pull #and checkout a version tag if you don't want to checkout to the latest master commit
npm install
npm run build
php artisan migrate
php composer.phar --optimize-autoloader --no-dev install
php artisan event:cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo chown -R www-data:www-data /var/www/assetriskmanager/storage
sudo chown -R www-data:www-data /var/www/assetriskmanager/bootstrap/cache/
sudo systemctl restart nginx php8.1-fpm.service
```

## Installation on Production Docker Environment

Asset Risk Manager officially supports MySQL and Postgres Docker database environments. Make is required for
the [Makefile](../Makefile). The docker environment will create a database container, app container
(based on [php-fpm](https://hub.docker.com/_/php)) and a [nginx](https://hub.docker.com/_/nginx) container that exposes
port 80.

The PHP configuration may be adjusted at the [php.deploy-override.ini](../docker/php/php.deploy-override.ini) file,
the nginx default webserver configuration may be adjusted at the [default.conf](../docker/nginx/default.conf) file and
the mysql configuration may be adjusted with the [my.cnf](../docker/mysql/my.cnf) file. Additional MySQL configuration
files may be added to the mysql docker directory and copied in its Dockerfile.

The program comes with three sample Docker Compose Files, that
target [MariaDB](../docker/compose/docker-compose-mariadb.yml), [MySQL](../docker/compose/docker-compose-mysql.yml) and
[PostgreSQL](../docker/compose/docker-compose-postgres.yml) RDBMS. Copy one of the compose files to the root of
the repository with the `docker-compose.yml` file name and make the required changes.

For the MariaDB/MySQL docker composer files, it's recommended to remove the phpMyAdmin container if graphical database
administration isn't required for security reasons. The credentials to log in phpMyAdmin (that is served by default
on the 8080 port, configurable in the `.env` file), are also defined in the `.env` file on the `DB_USERNAME`
and `DB_PASSWORD` attributes.

Create the `.env` file from the [.env.docker.example](../.env.docker.example) file with the expected LDAP (if
applicable), database and application configurations and run `make install` and `make key-generate`. If example data is
desired, run `make seed`.

The `.env` file and logs directory are synchronized with the host system. If the `.env` file
was changed on the host system, run `make update-cache`. To destroy the containers with its respective volumes (
*including the database*), run `make destroy`.

To *install updates* from the repository, run `git pull` (and optionally switch to a version tag with git
checkout), apply the required patches with `git apply patch_file.patch` and run `make install`.

To remake the docker environment (*which destroys the database in the process*), run `make remake`.

# Requirements and Installation for Development Environment

For a development environment, it's expected that the environment (PHP and CSS/JS assets) is reloaded when anything in
the project is changed. Therefore, a local PHP server or a Laravel Sail (Docker) environment is recommended for
development.

If a local PHP server is chosen for development, a MySQL/MariaDB or PostgreSQL server is required to be installed
alongside with PHP >= 8.1 (and an LDAP/Active Directory server if LDAP is required), with the .env file configured
accordingly from [.env.example](../.env.example).

For both the local PHP server and Docker (with Laravel Sail):

```shell
git clone https://github.com/daviddmd/assetriskmanager
cd assetriskmanager
cp .env.example .env
composer install #or php composer.phar install 
php artisan key:generate
```

## LDAP Configuration

Take note of your LDAP server configuration. If it is an Active Directory LDAP server, no more action is required.

Otherwise, edit `config/auth.php` from:

```
    'providers' => [
        'users' => [
            'driver' => 'ldap',
            'model' => LdapRecord\Models\ActiveDirectory\User::class,
            'rules' => [],
            'database' => [
                'model' => App\Models\User::class,
                'sync_passwords' => true,
                'sync_attributes' => [
                    'name' => config("ldap.name_sync_attribute", "cn"),
                    'email' => config("ldap.username_sync_attribute", "userPrincipalName"),
                ],
            ],
        ],
    ],
```

to:

```
    'providers' => [
        'users' => [
            'driver' => 'ldap',
            'model' => LdapRecord\Models\OpenLDAP\User::class,
            'rules' => [],
            'database' => [
                'model' => App\Models\User::class,
                'sync_passwords' => true,
                'sync_attributes' => [
                    'name' => config("ldap.name_sync_attribute", "cn"),
                    'email' => config("ldap.username_sync_attribute", "userPrincipalName"),
                ],
            ],
        ],
    ],
```

You may also edit the `'name'` or `'email'` mappings to reflect your LDAP environment on the `.env` file.

The email/log-in attribute (LDAP_USERNAME_SYNC_ATTRIBUTE) will be the "username" of the created user, that the user will
use to log in. The name will identify the user in the application, be it as an Asset Manager or the actions that the
user will generate that will be logged.

The default in this application is for the user's email to be the same as the ActiveDirectory `userPrincipalName`,
however, the value may be changed to `email`, `username` or `mail` depending on the LDAP environment.

The name attribute (LDAP_NAME_SYNC_ATTRIBUTE) will be what will be used to authenticate the user (query the LDAP
environment to search an existing user). The attribute depends on the LDAP environment, with possible options
being `uid`, `cn` or other attributes.

At the end of `.env`, edit the LDAP attributes, specially the following:

```
LDAP_USERNAME="cn=Reader,cn=Users,dc=example,dc=com"
LDAP_PASSWORD="password123"
LDAP_PORT=389
LDAP_BASE_DN="dc=example,dc=com"
LDAP_NAME_SYNC_ATTRIBUTE=cn
LDAP_USERNAME_SYNC_ATTRIBUTE=userPrincipalName
```

If LDAP isn't needed, set `LDAP_ENABLED` to false in order to enable local registration. LDAP and non-LDAP users can
coexist, however LDAP users can't update their emails/usernames or passwords. In case the LDAP server is down, LDAP user
authentication will still work if the users logged in at least once (to sync the hashed password).

Depending on the LDAP environment, additional options may be needed for configuring the LDAP connection. Such options
may be set at the `options` array in the LDAP configuration object in [config/ldap.php](../config/ldap.php), specially
if TLS/SSL is needed.

The following instructions will vary depending on if you want to install the application with or without docker.

## With Docker

Laravel makes use of Laravel Sail to create a containerized environment for Laravel development. If on Windows, WSL2
must be the Docker backend. A significant performance impact is expected due to the filesystem translation between Linux
and Windows since the Sail dockerfile uses a bind mount to serve the application files to the application container.

Backup `docker-compose.yml` to `docker-compose-mysql.yml`.

In `.env` edit the following variables to your preference:

```
APP_NAME=ARM
APP_URL=http://arm.test
DB_DATABASE=arm
DB_USERNAME=sail
DB_PASSWORD=password
```

Next, run:

```
composer require laravel/sail --dev
php artisan sail:install
bash ./vendor/laravel/sail/bin/sail up
bash ./vendor/laravel/sail/bin/sail artisan migrate
bash ./vendor/laravel/sail/bin/sail artisan db:seed
bash ./vendor/laravel/sail/bin/sail npm run dev
```

The platform will be accessible at `http://localhost`.

### Without Docker

In `.env` edit the following variables to your preference:

```
APP_NAME=ARM
APP_URL=http://arm.test
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=arm
DB_USERNAME=root
DB_PASSWORD=
```

```
npm install
npm run dev
php artisan migrate
php artisan db:seed
php artisan serve
```

The application will be accessible at `127.0.0.1:8080`.

-------

### After Either

Then log-in with a user you want to make administrator and:

*If on Docker:*

```
bash ./vendor/laravel/sail/bin/sail artisan artisan make:admin "user.email@domain.com"
```

*Otherwise:*

```
php artisan make:admin "user.email@domain.com"
```

### To clean the docker environment:

```
docker rm -f $(docker ps -a -f "name=assetriskmanager" -q)
```

```
docker system prune
```

If you want to delete all associated data with the application (mysql-server docker volume):

```
docker system prune -a
```

# After Installation

## Test Environment

After installation, if a test environment is desired, `php artisan migrate:fresh --seed` or `make fresh` may be run to
generate a test environment with sample data, such as users (a list of 10 users is printed to the screen, with the
password for all of them being `password`; the first is
an Administrator, second Security Officer, third Data Protection Officer and the rest are regular users, with assets
being assigned to each user), assets, permanent contact points, threats, controls, with threats being assigned to assets
and controls being assigned to said threats.

## Importing Existing Data

A Security Officer has access to the **Import Files** menu, accessible in the **Manage** dropdown in the navigation bar.
In that menu, a Security Officer user may import:

- [Asset Types](samples/asset_types.csv)
- [Assets](samples/assets.csv)
- [Controls](samples/controls.csv)
- [Departments](samples/departments.csv)
- [Permanent Contact Points](samples/permanent_contact_points.csv)
- [Security Officer(s)](samples/security_officers.csv)
- [Threats](samples/threats.csv)

With Asset import files in particular, all fields except for manager ID and asset type ID are optional, however, there
are some constraints:

- If the manufacturer contract type isn't set, the
  manufacturer contract beginning date, ending date and provider values will be ignored and the contract type will be
  set to NONE.
- If any appreciation value (integrity, confidentiality or availability) isn't set, is empty or has an invalid value (
  not in the 1-5 range), the respective value will be set as 0.
- For the boolean fields such as active (if the asset is set as active) or export (if it will be exported alongside
  other assets in the CNCS export file), if the value is invalid or empty, the default value is set as false.
- If the asset ID that this asset will link to is empty or invalid (doesn't exist), no asset links to ID will be set.

For the users import:

- If the role isn't set or is invalid, the imported user's role will be the Asset Manager (default) role.
- If the department ID isn't set or is invalid, the user won't be assigned to a department
- If the password isn't set, the user's password will be the default password, set
  at [config/constants.php](../config/constants.php)

A valid asset Manager ID and asset type ID must be provided, otherwise the asset row will be skipped and the asset won't
be created (imported).

For each of these, a sample CSV file is provided. The order of the columns is arbitrary, as long as they have and
match with the first row of the csv file (with the column names).

Duplication checks are ran on different imports depending on their attributes that are set to be unique, in particular
to Asset Types, Controls, Departments and Threats by their *name* attribute and Users by their *email*.

The behavior for each of the import process is documented at [app/Imports](../app/Imports).

## Two-Factor Authentication

Two-Factor authentication may be optionally activated for users in this platform. For that, each user may open their
account menu by selecting the **Profile** option in their name dropdown, followed by Enabling Two-Factor Authentication
and following the instructions. If the user loses their authentication device, a systems administrator may
run `php artisan reset:2fa {user_email}` or with the user's email to remove the 2FA feature from the user's account.

The user's 2FA codes can also be retrieved by a system administrator by running `php artisan display:2fa {user_email}`.

If using Docker, run `docker compose exec app php artisan reset:2fa {user_email}`
or `docker compose exec app php artisan display:2fa {user_email}`.

## Resetting a User's Password

If a user forgets its password, a system administrator may reset it by
running `php artisan reset:password {user_email} {new_password}`
or `docker compose exec app php artisan reset:password {user_email} {new_password}`.

If the user is an LDAP user, on the next login the password will be overridden by the LDAP password if the
authentication
is successful and the LDAP server is accessible.

## Resetting a User's Role

To reset a user role back to the default User role, a system administrator may run `php artisan reset:role {user_email}`
or `docker compose exec app php artisan reset:role {user_email}`.

To make a user an administrator, run `php artisan make:admin {user_email}`
or `docker compose exec app php artisan make:admin {user_email}`.

## Docker Database Export and Administration

To export (dump) a MySQL database in Docker,
run `docker compose exec db mysqldump -u {DATABASE_USERNAME} -p{DATABASE_PASSWORD} {DATABASE_NAME} > export_file.sql`.

For PostgreSQL, run `docker compose exec db pg_dump -U {DATABASE_USERNAME} {DATABASE_NAME} > export_file.sql`.

To administer the Docker database, run `make shell_db` and run the necessary commands with the required credentials.

## Custom Application Logo

A custom application logo can be applied to the navigation bar and login screen. The logo should be placed
in [public/storage](../public/storage) with the name `logo.png`, given that the symbolic link
from [storage/app/public](../storage/app/public) exists, which can be linked with the `php artisan storage:link`
command (on docker the `make install` command links the directory by default, it can be manually relinked
with `make storage-link`).