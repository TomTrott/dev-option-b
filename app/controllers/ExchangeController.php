<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class ExchangeController extends Controller {
    public function index() {
        $search = $_GET['search'] ?? '';
        $bookModel = new Book();

        if ($search) {
            $livres = $bookModel->searchAvailable($search);
        } else {
            $livres = $bookModel->getAvailableBooks(); 
        }

        $this->view('exchange/index', ['livres' => $livres]);
    }
}
