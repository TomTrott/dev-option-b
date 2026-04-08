<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class ExchangeController extends Controller {

    public function index() {

        $search = $_GET['search'] ?? '';
        $bookManager = new BookManager();

        if ($search) {
            $livres = $bookManager->searchAvailable($search);
        } else {
            $livres = $bookManager->getAvailableBooks();
        }

        $this->view('exchange/index', ['livres' => $livres]);
    }
}