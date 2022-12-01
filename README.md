composer config http-basic.backpackforlaravel.com 46246897 YLRizEJAen5G
php artisan key:generate
composer install
npm i
npm run build

its important to change APP url to your current app url
APP_URL=http://poker.test

//initialize database and dummy data
php artisan migrate
php artisan db:seed
php artisan storage:link

so you can upload image
chmod -R 775 public/tmp

admin access
{APP_URL}/admin

credentials (run the seeder if you cannot login)
user:  admin@chanzglobal.com
password:  admin

WEB DEBUGGING

Must be an admin to access the logs
You can check the application logs via {APP_URL}/admin/logs

admin@chanzglobal.com is the only account who can access telescope
You can also check the request logs via {APP_URL}/telescope


PUSH Notification
Soketi

.env

BROADCAST_DRIVER=pusher

install soketi

npm install -g @soketi/soketi
pm2 start soketi-pm2 -- start

you can check if soketi is working when you go to PUSHER_HOST:PUSHER_PORT eg: https://push.lifeofpoker.com:6002/
and there's an 'OK' text. Then it's all good

if push notif doesn't work, try to change the env QUEUE_DRIVER to 'sync'
host shouldn't have protocol. eg lifeofpoker.com, push.lifeofpoker.com

live

PUSHER_APP_KEY=app-key
PUSHER_APP_ID=app-id
PUSHER_APP_SECRET=app-secret
PUSHER_HOST=push.lifeofpoker.com
PUSHER_PORT=6002
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

local

install soketi globally via

npm install -g @soketi/soketi
soketi start

by default, it will start a server at 127.0.0.1:6001

PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http

Testing
PEST testsuite

use this command to test the CRUD if it's all saving data and validating correctly
./vendor/bin/pest --parallel



