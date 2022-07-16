<img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Asterisk.svg" alt="Asset Risk Manager">

# Asset Risk Manager

Asset Risk Manager is a Laravel/PHP application to help organization or entities manage the risk of their assets.

## Requirements and Installation

Asset Risk Manager is a Laravel (PHP) powered web application and runs on all systems that support a modern PHP
installation or support Docker.

### Dependencies

- PHP >= 8.1 with the pdo, ldap, gd and zip extensions installed and loaded
- NodeJS >= 15 with npm
- MySQL >= 8.0, MariaDB >= 10.6 or PostgreSQL
- [Composer](https://getcomposer.org/)

OR

- Installation of Docker
- [Composer](https://getcomposer.org/)
- PHP

On Docker, Windows Systems must use WSL2. A significant performance penalty is expected.

An Active Directory or Equivelent LDAP Server is required for authentication.

Instructions for both a development environment and an Ubuntu 22.04 Production Environment are provided.

### Installation on Ubuntu Server 22.04

Ubuntu Server 22.04 or greater is needed because of the PHP >= 8.1 dependency.

By default, on the Ubuntu 22.04 repository, php defaults to PHP 8.1. On any greater version, replace references of
php8.1 or similar to the next PHP version.

Any previous version of Ubuntu Server (or any GNU/Linux distribution) may be used, as long as it provides PHP 8.1 and a
compatible composer, php (with all required extensions) and mysql/mariadb environments.

On **previous versions** of Ubuntu Server (< 22.04), [this PPA](https://launchpad.net/~ondrej/+archive/ubuntu/php) may
be used to
install PHP 8.1 and its required extensions:

```shell
sudo apt update
sudo apt install lsb-release ca-certificates apt-transport-https software-properties-common -y
sudo add-apt-repository ppa:ondrej/php
sudo apt update
```

And follow this guide as if you were using Ubuntu Server 22.04.

```shell
sudo -i
apt update && apt upgrade
apt install mariadb-server
mysql_secure_installation
mysql
```

```sql
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
apt install php8.1 nginx php8.1-mysql php8.1-fpm php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-curl php8.1-gd php8.1-ldap php8.1-zip composer git build-essential
systemctl enable nginx php8.1-fpm.service
ufw enable
ufw allow "OpenSSH"
ufw allow 'Nginx Full'
phpenmod ldap
phpenmod gd
curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
apt-get install -y nodejs
mkdir -p /var/www/assetriskmanager
exit #leave root
sudo chown -R $USER:$USER /var/www/assetriskmanager
cd /var/www/assetriskmanager
git clone https://github.com/daviddmd/assetriskmanager.git . #Configure beforehand a personal access token if needed
cp .env.example .env
vim .env
```

```apacheconf
APP_NAME=ARM
APP_DEBUG=false
#...
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=arm
DB_USERNAME=armuser
DB_PASSWORD=armpassword
#...
LDAP_LOGGING=false
LDAP_CONNECTION=default
LDAP_HOST=192.168.134.179
LDAP_USERNAME="cn=Reader,cn=Users,dc=example,dc=com"
LDAP_PASSWORD="password123"
LDAP_PORT=389
LDAP_BASE_DN="dc=example,dc=com"
LDAP_TIMEOUT=5
LDAP_SSL=false
LDAP_TLS=false
```

```shell
composer install --optimize-autoloader --no-dev #or composer install --optimize-autoloader if faker is needed for seeding the database
php artisan key:generate
npm install
npm run production
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
sudo chown -R www-data.www-data /var/www/assetriskmanager/storage
sudo chown -R www-data.www-data /var/www/assetriskmanager/bootstrap/cache/
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
git pull
npm run production
php artisan migrate
composer --optimize-autoloader --no-dev install
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo chown -R www-data.www-data /var/www/assetriskmanager/storage
sudo chown -R www-data.www-data /var/www/assetriskmanager/bootstrap/cache/
sudo systemctl restart nginx php8.1-fpm.service
```

### Installation for Development Environment

For either option, clone the repository

```
git clone https://github.com/daviddmd/assetriskmanager
cd assetriskmanager
cp .env.example .env
composer install
php artisan key:generate
```

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
                    'name' => 'cn',
                    'email' => 'userPrincipalName',
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
                    'name' => 'cn',
                    'email' => 'email',
                ],
            ],
        ],
    ],
```

You may also edit the `'name'` or `'email'` mappings to reflect your LDAP environment. The default in this application
is for the user's email to be the same as
the ActiveDirectory userPrincipalName.

At the end of `.env`, edit the LDAP attributes, specially the following:

```
LDAP_USERNAME="cn=Reader,cn=Users,dc=example,dc=com"
LDAP_PASSWORD="password123"
LDAP_PORT=389
LDAP_BASE_DN="dc=example,dc=com"
```

The following instructions will vary depending on if you want to install the application with or without docker.

#### With Docker

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
php artisan sail:install
bash ./vendor/laravel/sail/bin/sail up
bash ./vendor/laravel/sail/bin/sail artisan migrate
bash ./vendor/laravel/sail/bin/sail artisan db:seed
```

The platform will be accessible at `http://localhost`.

#### Without Docker

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
npm run watch
php artisan migrate
php artisan db:seed
php artisan serve
```

-------

#### After Either

Then log-in with a user you want to make administrator and:

*If on Docker:*

```
bash ./vendor/laravel/sail/bin/sail artisan artisan make:admin "user.email@domain.com"
```

*Otherwise:*

```
php artisan make:admin "user.email@domain.com"
```

#### To clean the docker environment:

```
docker rm -f $(docker ps -a -f "name=assetriskmanager" -q)
```

```
docker system prune
```

If you want to delete all associated data with the application (mysql-server docker volume):

```
docker system prune --volumes
```

