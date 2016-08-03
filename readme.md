# Laravel PHP Framework

## Install instruction
   1. download or clone repository
   2. make sure, that needed dependences are installed (composer, nodejs, npm, grunt, bower)
   3. in file `.enc` configurate database connect data
   4. in repository folder run:
      1. `npm install`
      2. `bower install`
      3. `grunt prod`
      4. `composer install`
      5. `php artisan migrate`
      6. if need to fill the database with test data `php artisan db:seed`
   5. welcome, you can use appication (you also must config your web server or run buil-in `php artisan serv`)
