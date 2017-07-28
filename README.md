# BluBox

BluBox is web application for storing informations about movies, tv shows and torrents from transmission server. Built on the Laravel Framework and using AngularJS for frontend! BluBox is offering a API for managing transmissions torrents and files on a server or NAS.

You can see screenshots of application in the screenshots folder.

## Requirements
* ubuntu >= 16.04
* composer
* npm
* php >= 7.0
* mysql or any database supported by [laravel](https://laravel.com/docs/5.4/database#introduction)
* nginx or any modern webserver
* python
* python-libtorrent (libtorrent-rasterbar version 0.16 or later) on ubuntu: `sudo apt-get install python-libtorrent -y`
* transmission server

## Installation
0. `update `.env` file, set at least `APP_URL` `DB_*` `TRANSMISSION_*`
1. `composer install`
2. `npm install`
3. `gulp`
4. you may want to change admin account login/password you can do it in `database/seeds/CreateAdminAccount.php` or later in command line, see below
5. migrate and seed database, in directory /var/www run `php artisan migrate --seed`

## Users and passwords
Application supports multiple users and accounts but there is not any user management yet so you have to change default admin password, also you can create new users.

### Changing admin password
Replace YOUR_NEW_PASSWORD_HERE with your password.

1. In /var/www run `php artisan tinker` then type following commands:
2. `$admin = \BluBox\Modules\User\User::first();`
3. `$admin->password = bcrypt('YOUR_NEW_PASSWORD_HERE');`
4. `$admin->save();`

### Creating new user
Replace USER_NAME with user name and NEW_USER_PASSWORD with user password.

1. In /var/www run `php artisan tinker` then type following commands:
2. `\BluBox\Modules\User\User::create(['login' => 'USER_NAME', 'password' => bcrypt('NEW_USER_PASSWORD')]);`

### Removing user
Replace USER_NAME with user name.

1. In /var/www run `php artisan tinker` then type following commands:
2. `\BluBox\Modules\User\User::where('login', 'USER_NAME')->delete();`

## Todo
- [ ] User Management System
- [ ] Translations
- [ ] Shifting to Laravel 5.4
- [ ] Tests
- [ ] Web Installer
- [ ] HTML5 Video Streaming
- [ ] Convert Downloaded Torrents To MP4 + AAC For HTML5 Web Player Compadibility
- [ ] Theme Selector
- [ ] Light Theme
- [ ] Auto Pull Meta Info From TMDB API

## License
Private Git
