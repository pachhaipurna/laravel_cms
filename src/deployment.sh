#!/usr/bin/env bash
# Run migration
# Cache route
printf "\n#:::::::::::::::::::::::::::::::::::::::: Caching route\n"
php artisan config:cache

# Cache configurations
printf "\n#:::::::::::::::::::::::::::::::::::::::: Caching configurations\n"
php artisan cache:clear

# Generating laroute
printf "\n#:::::::::::::::::::::::::::::::::::::::: Clearing view\n"
php artisan view:clear

# Optimizing application
printf "\n#:::::::::::::::::::::::::::::::::::::::: Key Generate application\n"
php artisan key:generate

# Optimizing application
printf "\n#:::::::::::::::::::::::::::::::::::::::: Apache2 restart application\n"
sudo service apache2 restart
