git pull
composer install -W 
php artisan migrate
npm i
npm run build
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
php artisan event:cache
php artisan about