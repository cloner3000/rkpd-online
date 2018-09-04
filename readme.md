## Sistem Requirements

- PHP >= 7.0.0
- MySQL >= 5.7

## Local Instalation DEV
- Clone from Bitbucket
- seting up .env dan database
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `php artisan storage:link`

## Membersihkan pengaturan
- Run `php artisan config:cache`

## Jika Bermain Dengan VUE
- Run `npm install`
- Run `npm run dev / npm run watch / npm run prod`

## Jika di Server
- Run `git init`
- Run `git remote add origin https://dikaharis@bitbucket.org/jabarweb/rkpd-online.git`
- Run `git pull origin master`
- Run `chown -R nginx:root /var/www/laravel`
- Run `chmod 755 /var/www/laravel/storage`

## Backup Database di Server
- Run `cd /home/rkpdonline/backup/sql/`
- Run `mysqldump -u root -p rkpdonline_db > bac_rkpdonline_db_$(date +\%d_\%m_\%Y_\%H_\%M_\%S).sql`

## Package
- [Larave Permission](https://github.com/spatie/laravel-permission)
- [Active for Laravel](https://github.com/letrunghieu/active)
