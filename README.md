# Evironnement

WampServer    Apache 2.4   -   MySQL 5 & 8,
Composer 1.10.10,
Symfony 5.1,
Postman,
PHP 7.3

# Pour tester l'API
Après l'installation de Wamp, Symfony et composer : placer les sources dans un dossier du www.

Mise en service de la base de données, exécuter les commandes suivantes depuis votre répertoire source:
```bash
php bin/console doctrine:database:create #création de la base
php bin/console doctrine:schema:update --force #création des tables
php bin/console doctrine:fixtures:load #remplissage des données tests
```
# OpenAPI Doc

Le lien vers la doc OpenApi est dispo dans votre localhost à l'url suivante : 

{baseurl}/public/index.php/api/doc

NB : Vous pouvez tester les apis directement depuis le lien ci-dessus.
