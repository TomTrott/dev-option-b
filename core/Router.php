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

        // 1/ je récupère l'url
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $segments = explode('/', $url);

        // 2/ controleur (par défaut HomeController
        $nomControleur = !empty($segments[0]) 
            ? ucfirst($segments[0]) . 'Controller'
            : 'HomeController';

        // 3/ méthode 
        $methode = !empty($segments[1]) 
            ? $segments[1]
            : 'index';

        // 4/ chemin du fichier
        $fichierControleur = __DIR__ . '/../app/controllers/' . $nomControleur . '.php';

        // 5/ verif si le fichier existe
        if (!file_exists($fichierControleur)) {
            die("Controller introuvable");
        }

        require_once $fichierControleur;

        // 6/ crée le controleur
        $controleur = new $nomControleur();

        // 7/ bloque certaines méthodes pour sécuriser un peu
        if ($methode == '__construct' || $methode == '__destruct') {
            die("Méthode interdite");
        }

        // 8/ vérif si la méthode existe
        if (!method_exists($controleur, $methode)) {
            die("Méthode introuvable");
        }

        // 9/ appel de la méthode
        $controleur->$methode();
    }
}