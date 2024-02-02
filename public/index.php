<?php

// Front controller (toutes les requêtes passent par ici)

// Autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// On récupère une instance de la classe App
$app = MVC\App::getInstance();
// Servira à ajouter mes services au conteneur
$app->boot();


// On teste si ça fonctionne
dd(
    $app->make('request'),
    require __DIR__ . '/../routes.php'
);
