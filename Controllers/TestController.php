<?php
namespace App\Controllers;


class TestController extends Controller
{
    public function index()
    {
        $this->render('test/index');
    }

    public function test()
    {
        $this->render('test/test');
    }
}