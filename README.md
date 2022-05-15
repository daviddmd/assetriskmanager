<img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Asterisk.svg" alt="Asset Risk Manager">

# Asset Risk Manager

<img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Asterisk.svg" alt="Asset Risk Manager">

## Requirements and Installation

Asset Risk Manager is a Laravel (PHP) powered web application and runs on all systems that support a modern PHP
installation or support Docker.

### Dependencies

- PHP >= 8.1 with the pdo and ldap extensions enabled
- NodeJS >= 15 with npm
- MySQL >= 8.0, MariaDB >= 10.6 or PostgreSQL
- Composer

OR

- Installation of Docker

An Active Directory or Equivelent LDAP Server is required for authentication.

### Installation

For either option, clone the repository

```
git clone https://github.com/daviddmd/assetriskmanager
```

```
cd assetriskmanager
```

```
cp .env.example .env
```

```
composer install
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
```

```
bash ./vendor/laravel/sail/bin/sail up
```

```
bash ./vendor/laravel/sail/bin/sail artisan migrate
```

```
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
npm run dev
```

```
php artisan migrate
```

```
php artisan db:seed
```

```
php artisan serve
```

-------

#### After Either

```
php artisan key:generate
```

Then log-in with a user you want to make administrator and:

*If on Docker:*

```
bash ./vendor/laravel/sail/bin/sail artisan artisan make:admin "user.email@domain.com"
```

*Otherwise:*

```
php artisan make:admin "user.email@domain.com"
```
