<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Entity\Artist;

class ArtistController extends Controller
{
    public function favorites(): void
    {
        $res = Artist::getDefaultInstance()->findAll();
        $artists = array_map(function($item) {
            return Artist::fromDB($item);
        }, $res);
        $this->render('artist/favorites', compact('artists'));
    }

    public function json(): void
    {
        $artistId = Utils::getParams()[2];

        if (isset($artistId)) {
            $artist = self::getArtist($artistId);
            $this->render('artist/json', compact('artist'), 'empty');
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
            $res = $artist->findBy(['idSpotify' => $artist->getIdSpotify()]);
            if (!empty($res)) $artist->id = $res[0]->id;

            $this->render('artist/ajax', compact('artist'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    public function insert(): void
    {
        $artistID = Utils::getParams()[2];

        if (isset($artistID)) {

            $artist = ArtistController::insertArtistInDB($artistID);
            $code = is_int($artist) ? $artist : 200;
            $this->render('artist/insert', compact('code', 'artist'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    public function delete(): void
    {
        $artistID = Utils::getParams()[2];

        if (isset($artistID)) {

            $code = ArtistController::deleteArtistInDB($artistID);
            $this->render('artist/delete', compact('code'), 'empty');
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

    /**
     * @param string $artistID
     * @return int|string
     */
    public static function insertArtistInDB(string $artistID): int|string
    {
        $json = ArtistController::getArtist($artistID);
        if (is_bool($json)) return 500;
        $artist = Artist::fromJson(json_decode($json, true));
        $res = $artist->findBy(['idSpotify' => $artist->getIdSpotify()]);
        if (!empty($res)) return 409;

        unset($artist->id);
        $artist->create();
        return $json;
    }

    /**
     * @param string $artistID
     * @return int
     */
    public static function deleteArtistInDB(string $artistID): int
    {
        $mock = Artist::getDefaultInstance();
        $res = $mock->findBy(['idSpotify' => $artistID]);

        if (empty($res)) return 404;
        $mock->delete($res[0]->id);
        return 200;
    }
}