# abz test

# in dir project run command
chmod +x deploy.sh


# run 
./deploy.sh

# next commands after install composer and rebuld docker-compose and up  

docker-compose exec php-fpm sh

php artisan key:generate

php artisan migrate:refresh


php artisan db:seed


# http://localhost:8080/

# set config db connectin in PhpStorm - MySQL

database - app
user - app
pass - secret
port - 33061





# if - problem with aplication and docker - run next commands from deleted old cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear




