<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Entity\Album;

class AlbumController extends Controller
{

    public function json(): void
    {
        $artistId = Utils::getParams()[2];
        $limit = Utils::getParams()[3] ?? 20;

        if (isset($artistId)) {
            $json = self::getAlbumsFromArtist($artistId, $limit);
            $this->render('album/json', compact('json'), 'empty');
        }
        else
        {
            http_response_code(404);
        }

    }


    public function json2(): void
    {
        $albumId = Utils::getParams()[2];

        if (isset($albumId)) {
            $json = self::getAlbum($albumId);
            $this->render('album/json', compact('json'), 'empty');
        }
        else
        {
            http_response_code(404);
        }

    }

    /**
     * /artist/html/{param2}/{param3}
     * param2: artist ID
     * param3: limit (optional)
     * @return void
     */
    public function ajax(): void
    {
        $artistId = Utils::getParams()[2];
        $limit = Utils::getParams()[3] ?? 20;

        if (isset($artistId)) {
            $json = self::getAlbumsFromArtist($artistId, $limit);
            $result = json_decode($json, true);

            if (isset($result['error'])) {
                http_response_code($result['status']);
                return;
            }

            $albums = array_map(static function ($data) {
                $album = Album::fromJson($data);
                $album->id = -1;
                return $album;
            }, $result['items']);

            $favorites = Album::getDefaultInstance()->findAll();
            if (!empty($favorites)) {
                foreach ($favorites as $fav) {
                    $array = json_decode(json_encode($albums),true);
                    $key = array_search($fav->idSpotify, array_column($array, 'idSpotify'));
                    if (is_bool($key)) continue;
                    $albums[$key]->id = $fav->id;
                }
            }

            foreach ($albums as $album) {
                $trackJson = TrackController::getTracksFromAlbum($album->getIdSpotify(), 50);
                $trackResult = json_decode($trackJson, true);
                $album->setTracksFromJson($trackResult['items']);
            }


            $this->render('album/ajax-multi', compact('albums'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    /**
     * /artist/html/{param2}/{param3}
     * param2: album ID
     * param3: limit (optional)
     * @return void
     */
    public function ajax2(): void
    {
        $albumId = Utils::getParams()[2];
        $limit = Utils::getParams()[3] ?? 20;

        if (isset($albumId)) {
            $json = self::getAlbum($albumId);
            $album = Album::fromJson(json_decode($json, true));

            $trackJson = TrackController::getTracksFromAlbum($album->getIdSpotify(), 50);
            $trackResult = json_decode($trackJson, true);
            $album->setTracksFromJson($trackResult['items']);


            $this->render('album/ajax-single', compact('album'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    public function insert(): void
    {
        $albumID = Utils::getParams()[2];

        if (isset($albumID)) {

            $album = AlbumController::insertAlbumInDB($albumID);
            $code = is_int($album) ? $album : 200;
            $this->render('album/insert', compact('code', 'album'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    public function delete(): void
    {
        $albumID = Utils::getParams()[2];

        if (isset($albumID)) {

            $code = AlbumController::deleteAlbumInDB($albumID);
            $this->render('album/delete', compact('code'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }


    /**
     * @param string $albumID
     * @return bool|string
     */
    public static function getAlbum(string $albumID): bool|string
    {
        define("ALBUM_ID", $albumID);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/" . ALBUM_ID);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * @param string $artistID
     * @param int $limit min: 1, max: 50
     * @return bool|string
     */
    public static function getAlbumsFromArtist(string $artistID, int $limit = 20): bool|string
    {
        if (!is_int($limit) || $limit < 1 || $limit > 50) {
            throw new \InvalidArgumentException(sprintf('%s does not int value', $limit));
        }
        define("ARTIST_ID", $artistID);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . ARTIST_ID . '/albums?limit=' . $limit);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * @param string $albumID
     * @return int|string
     */
    public static function insertAlbumInDB(string $albumID): int|string
    {
        $json = AlbumController::getAlbum($albumID);
        if (is_bool($json)) return 500;
        $album = Album::fromJson(json_decode($json, true));
        $res = $album->findBy(['idSpotify' => $album->getIdSpotify()]);
        if (!empty($res)) return 409;

        $album->create();
        return $json;
    }

    /**
     * @param string $albumID
     * @return int
     */
    public static function deleteAlbumInDB(string $albumID): int
    {
        $mock = Album::getDefaultInstance();
        $res = $mock->findBy(['idSpotify' => $albumID]);

        if (empty($res)) return 404;
        $mock->delete($res[0]->id);
        return 200;
    }
}