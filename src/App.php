<?php

namespace MVC;

class App
{
    // Cette propriété contiendra l'instance unique de ma classe App (singleton)
    protected static App $instance;

    // Le service container qui est vide par défaut
    protected array $container = [];

    // Constructeur protégée pour empêcher la création avec new (singleton)
    final protected function __construct() {}

    // Seul point d'entrée pour récupérer une instance de App
    final public static function getInstance(): App
    {
        // Si la propriété statique ne contient pas d'instance, ça veut dire que c'est le premier appel de getInstance(). On vient donc créer une instance de la classe et on la stocke dans la propriété statique
        if (! isset(static::$instance)) {
            static::$instance = new static();
        }

        // Quoi qu'il arrive, on retourne l'instance
        return static::$instance;
    }

    // Ajout des services au service container
    public function boot(): void
    {
        // On enregistre le service request (On créé l'instance avec la méthode createFromGlobals() : https://symfony.com/doc/current/components/http_foundation.html#request)
        $this->singleton('request', fn(App $app) => Request::createFromGlobals());
    }

    // Permet d'ajouter un service au service container
    public function singleton(string $name, \Closure $closure): void
    {
        // Si le service existe déjà, je lance une exception pour ne pas l'écraser par un nouveau
        if (isset($this->container[$name])) {
            throw new \InvalidArgumentException('Un service porte déjà le nom ' . $name);
        }

        // Sinon, j'ajoute bien mon service en exécutant la closure pour récupérer sa valeur de retour (l'instance du service)
        $this->container[$name] = $closure($this);
    }

    // Permet de récupérer un service depuis le service container
    public function make(string $name): mixed
    {
        // Si le service est introuvable, on lance une exception
        if (! isset($this->container[$name])) {
            throw new \InvalidArgumentException('Le service ' . $name . ' n\'existe pas');
        }

        // Sinon, on le retourne
        return $this->container[$name];
    }
}
