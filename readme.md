### Serveur Web local

php -d display_errors -S localhost:8000 -t public/

### Style de codage

`composer search fixer`

`composer require friendsofphp/php-cs-fixer --dev`

`php vendor/bin/php-cs-fixer`

`php vendor/bin/php-cs-fixer fix --dry-run`

`php vendor/bin/php-cs-fixer fix --dry-run --diff`

`php vendor/bin/php-cs-fixer fix`


Ajout d'un script "run-server" qui permet de lancer le serveur php sans limite de temps d'execution `composer run-server`


ajout des script : `test:cs` et `fix:cs`


## Configuration de la base de données

le fichier .mypdo.ini permet de remplacer la commande `MyPDO::setConfiguration`