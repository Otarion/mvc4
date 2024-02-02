<?php declare(strict_types=1);

namespace MVC;

// La classe Router gère le routage des requêtes vers les contrôleurs appropriés.
class Router {
    // Propriété pour stocker l'objet Request qui contient les détails de la requête.
    protected $request;
    
    // Propriété pour stocker les routes définies dans le fichier 'routes.php'.
    protected $routes;

    // Le constructeur prend un objet Request en paramètre pour initialiser la classe.
    public function __construct(Request $request) {
        // Stocke l'objet Request.
        $this->request = $request;

        // Charge les routes depuis le fichier 'routes.php'.
        $this->routes = include '../routes.php';
    }

    // La méthode dispatch traite la requête en fonction des routes définies.
    public function dispatch() {
        // Récupère la méthode (GET, POST, etc.) de la requête.
        $method = $this->request->getMethod();
        
        // Récupère l'URI de la requête.
        $uri = $this->request->getPathInfo();
    
        // Parcourt les routes définies pour trouver une correspondance.
        foreach ($this->routes as $route) {
            // Vérifie si la méthode et le chemin de la route correspondent à la requête.
            if ($method === $route->method && preg_match('#^' . $route->uri . '$#', $uri)) {
                //
                $route -> setParams();
                // Instancie le contrôleur spécifié dans la route.
                $controller = new $route ->controller;
                
                // Appelle la méthode d'action spécifiée dans la route.
                $action = $route->action;
                $controller->$action();
                
                // Termine la boucle car la route correspondante a été trouvée et traitée.
                break;
            }
        }
    }
}
