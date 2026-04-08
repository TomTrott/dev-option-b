<?php
// Mon premier router php (version simple)

/*
Ce router sert à diriger l'utilisateur vers la bonne page du site.

Comment ça marche :
- Il récupère l'URL ex: article/show
- Il découpe l'URL en morceaux
- Le premier morceau = nom du controleur (ArticleController)
- Le deuxième morceau = méthode à appeler (show)
- Ensuite il charge le bon fichier contrôleur
- Il vérifie que tout existe (fichier + méthode)
- Puis il exécute la méthode demandée

Exemple :
URL : index.php?url=article/show
→ Va appeler : ArticleController -> show()
*/

class Router {

    public function route() {

        // 1/ je récupère l'URL
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $segments = explode('/', $url);

        // 2/ controleur (par défaut HomeController)
        $nomControleur = !empty($segments[0]) 
            ? ucfirst($segments[0]) . 'Controller'
            : 'HomeController';

        // 3/ méthode
        $methode = !empty($segments[1]) 
            ? $segments[1]
            : 'index';

        // 4/ chemin du fichier
        $fichierControleur = __DIR__ . '/../app/controllers/' . $nomControleur . '.php';

        // 5/ vérif si le fichier existe
        if (!file_exists($fichierControleur)) {
            $this->error404();
            return;
        }

        require_once $fichierControleur;

        // 6/ crée le controleur
        $controleur = new $nomControleur();

        // 7/ bloque certaines méthodes pour sécuriser
        if ($methode == '__construct' || $methode == '__destruct') {
            $this->error404();
            return;
        }

        // 8/ vérif si la méthode existe
        if (!method_exists($controleur, $methode)) {
            $this->error404();
            return;
        }

        // 9/ appel de la méthode
        $controleur->$methode();
    }

    private function error404() {
        http_response_code(404);
        $fichier404 = __DIR__ . '/../app/views/errors/404.php';
        if (file_exists($fichier404)) {
            require $fichier404;
        } else {
            echo "<h1>404 - Page introuvable</h1>";
        }
        exit;
    }
}