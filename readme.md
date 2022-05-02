### Serveur Web local

php -d display_errors -S localhost:8000 -t public/

### Style de codage

`composer search fixer`

`composer require friendsofphp/php-cs-fixer --dev`

`php vendor/bin/php-cs-fixer`

`php vendor/bin/php-cs-fixer fix --dry-run`

`php vendor/bin/php-cs-fixer fix --dry-run --diff`

`php vendor/bin/php-cs-fixer fix`