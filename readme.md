# Laravel PHP Framework

## Install instruction
   1. download or clone repository
   2. make sure, that needed dependences are installed (composer, nodejs, npm, grunt)
   3. in file `.enc` configurate database connect data
   4. in repository folder run:
      1. `npm install`
      2. `grunt prod`
      3. `composer install`
      4. `php artisan migrate`
      5. if need to fill the database with test data `php artisan db:seed`
   5. welcome, you can use appication (you also must config your web server or run buil-in `php artisan serv`)
