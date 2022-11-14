<?php
namespace App\Controllers;


class MainController extends Controller
{
    public function index()
    {
        $this->render('main/index');
    }

    public function json()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/6wCzeOFPJTsMuKo2x1vNJy/tracks");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);

        $this->render('main/json', compact('json'), 'empty');
    }
}