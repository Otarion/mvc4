<?php

// Front controller (toutes les requêtes passent par ici)

// Autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// On récupère une instance de la classe App
$app = MVC\App::getInstance();
// Servira à ajouter mes services au conteneur
$app->boot();

//Récupération de l'instance du service router
$router = $app -> make ('router');
//Utilisation de l'instance du service router pour appeler la méthode dispatch()
$router->dispatch();

// On teste si ça fonctionne
dd(
    $app->make('request'),
    require __DIR__ . '/../routes.php'
);