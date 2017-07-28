# BluBox
![Logo](http://i.imgur.com/PlkORdO.png)
BluBox is web application for storing informations about movies, tv shows and torrents from transmission server. Built on the Laravel Framework and using AngularJS for frontend! BluBox is offering a API for managing transmissions torrents and files on a server or NAS.

*You can see screenshots of application in the screenshots folder.*

## Requirements
* [Unbuntu](https://www.ubuntu.com) >= 16.04
* [**PHP**](https://php.net) >= 7.0
* [MySQL](https://www.mysql.com) or any database supported by [laravel](https://laravel.com/docs/5.4/database#introduction)
* [Composer](https://getcomposer.org)
* [NPM](https://www.npmjs.com)
* [NGINX](https://www.nginx.com)
* [Python](https://www.python.org)
* python-libtorrent (libtorrent-rasterbar version 0.16 or later) on ubuntu: `sudo apt-get install python-libtorrent -y`
* [transmission](https://transmissionbt.com/)

## Guide (Informational Use)
![Logo](https://community-cdn-digitalocean-com.global.ssl.fastly.net/assets/tutorials/images/large/Install_LEMP-twitter.png)

* [LEMP Installation Guide By Digital Ocean](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-in-ubuntu-16-04)

## Installation
0. update `.env` file, set at least `APP_URL` `DB_*` `TRANSMISSION_*`
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
- [x] Shifting to Laravel 5.4
- [ ] Tests
- [ ] Web Installer
- [ ] HTML5 Video Streaming
- [ ] Convert Downloaded Torrents To MP4 + AAC For HTML5 Web Player Compadibility
- [ ] Theme Selector
- [ ] Light Theme
- [ ] Auto Pull Meta Info From TMDB API
- [ ] More Fancy

## License
Private Git
