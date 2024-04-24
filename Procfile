web: $(composer config bin-dir)/heroku-php-nginx -C nginx.conf public/
release: php artisan migrate --force --step && php artisan storage:link --force && php artisan optimize
