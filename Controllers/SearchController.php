<?php
namespace App\Controllers;


class SearchController extends Controller
{
    public function index()
    {
        $this->render('search/index');
    }
}