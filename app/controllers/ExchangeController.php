<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class ExchangeController extends Controller {
    public function index() {
        //recherche
        $search = $_GET['search'] ?? '';
        $bookModel = new Book();
// si y un paramètre de recherche on affiche sinon on affiche les livre dispo par deafut
        if ($search) {
            $livres = $bookModel->searchAvailable($search);
        } else {
            $livres = $bookModel->getAvailableBooks(); 
        }

        $this->view('exchange/index', ['livres' => $livres]);
    }
}
