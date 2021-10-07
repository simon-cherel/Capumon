# Capumon
Mini-projet php

Liste des étapes de création du mini-projet

1. Création du projet :
- composer create-project symfony/website-skeleton:"^4.4" capumon-app
- composer require symfony/web-server-bundle --dev

2. Création du Git :
- git init
- git branch -M main
- git remote add origin https://github.com/simon-cherel/capumon-app.git
- git push -u origin main

3. Création des entités de la BDD :
- php bin/console make:entity

4. Création de la BDD :
- composer require symfony/orm-pack
- composer require --dev symfony/maker-bundle
- composer require --dev doctrine/doctrine-fixtures-bundle
- modification de .env DATABASE_URL=sqlite:///%kernel.project_dir%/var/data.db
- php bin/console doctrine:database:drop --force
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:create

5. Ajout des donnés :
- composer require --dev orm-fixtures
- modifier ./src/DataFixtures/AppFixtures.php avec les valeurs donnés
- modifier ./src/DataFixtures/AppFixtures.php avec
use App\Entity\Region;
use App\Entity\Room;
use App\Entity\Owner;
use App\Repository\OwnerRepository;
use App\Repository\RoomRepository;
use App\Repository\RegionRepository;
$room->setCapacity(5);
$room->setSuperficy(45);
$room->setPrice(250);
$room->setSuperficy(45);
$room->setAddress("7 rue Geoffroy St-Hilaire");
delete  $room->addRegion($this->getReference(self::IDF_REGION_REFERENCE));
- puis charger avec php bin/console doctrine:fixtures:load -n

Création des vues à l'aide de start bootstrap :
- dans public ajouter :
wget https://github.com/StartBootstrap/startbootstrap-bare/archive/gh-pages.zip
unzip gh-pages.zip
- composer require symfony/asset
- ajouter à config/packages/framework.yaml :
assets:
        base_path: '/startbootstrap-bare-gh-pages'
- ajouter à templates/base.html.twig :
<!DOCTYPE html>
<html>
    <head>
      ...
      {% block stylesheets %}
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
      {% endblock %} {# stylesheets #}
    </head>