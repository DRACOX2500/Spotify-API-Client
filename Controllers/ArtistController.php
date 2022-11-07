<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Entity\Artist;

class ArtistController extends Controller
{
    public function json(): void
    {
        $artistId = Utils::getParams()[2];

        if (isset($artistId)) {
            $artist = self::getArtist($artistId);
            $this->render('artist/index', compact('artist'), 'empty');
        }
        else
        {
            http_response_code(404);
        }

    }

    public function ajax(): void
    {
        $artistId = Utils::getParams()[2];

        if (isset($artistId)) {
            $result = self::getArtist($artistId);
            $artist = Artist::fromJson(json_decode($result, true));
            $this->render('artist/ajax', compact('artist'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    /**
     * @param string $artistID
     * @return bool|string
     */
    public static function getArtist(string $artistID): bool|string
    {
        define("ARTIST_ID", $artistID);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . ARTIST_ID);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}