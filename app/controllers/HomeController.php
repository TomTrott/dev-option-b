<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../models/Manager/BookManager.php';

class HomeController extends Controller {

    public function index() {

        // récup les derniers livres
        $livres = (new Book())->getLastBooks(4);

        // envoie à la vue
        $this->view('home', ['livres' => $livres]); // home.php
    }
}