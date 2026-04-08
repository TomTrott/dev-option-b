<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class HomeController extends Controller {

    public function index() {

        $bookManager = new BookManager();
        $livres = $bookManager->getLastBooks(4);

        $this->view('home', ['livres' => $livres]);
    }
}