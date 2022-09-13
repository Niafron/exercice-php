#!/bin/bash

echo "- Composer install."
composer install

echo "- Drop db."
php bin/console doctrine:database:drop --env=dev --force --if-exists --no-interaction "$@"
echo "- Create db."
php bin/console doctrine:database:create --env=dev --no-interaction "$@"
echo -e "- Run migrations."
php bin/console doctrine:migrations:migrate --env=dev --no-interaction "$@"
echo "- Insert some dummy data (for env dev)."
php bin/console doctrine:fixtures:load --env=dev --no-interaction "$@"

echo "- Php cs fixer."
./vendor/bin/php-cs-fixer fix --dry-run -v src/ && ./vendor/bin/php-cs-fixer fix --dry-run -v tests/
