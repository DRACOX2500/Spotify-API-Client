<?php

namespace App\Controllers;

use App\Core\Utils;
use App\Entity\Track;

class TrackController extends Controller
{
    public function json(): void
    {
        $trackID = Utils::getParams()[2];

        if (isset($trackID)) {
            $json = self::getTrack($trackID);
            $this->render('track/json', compact('json'), 'empty');
        }
        else
        {
            http_response_code(404);
        }

    }

    public function insert(): void
    {
        $trackID = Utils::getParams()[2];

        if (isset($trackID)) {
            $track = self::insertTrackInDB($trackID);
            $code = is_int($track) ? $track : 200;
            $this->render('track/insert', compact('code', 'track'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    public function delete(): void
    {
        $trackID = Utils::getParams()[2];

        if (isset($trackID)) {

            $code = self::deleteTrackInDB($trackID);
            $this->render('track/delete', compact('code'), 'empty');
        }
        else
        {
            http_response_code(404);
        }
    }

    /**
     * @param string $albumID
     * @param int $limit min: 1, max: 50
     * @return bool|string
     */
    public static function getTracksFromAlbum(string $albumID, int $limit = 20): bool|string
    {
        if (!is_int($limit) || $limit < 1 || $limit > 50) {
            throw new \InvalidArgumentException(sprintf('%s does not int value', $limit));
        }

        $_ch = curl_init();
        curl_setopt($_ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/" . $albumID . '/tracks?limit=' . $limit);
        curl_setopt($_ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
        curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($_ch);
        curl_close($_ch);

        return $result;
    }

    /**
     * @param string $trackID
     * @return bool|string
     */
    public static function getTrack(string $trackID): bool|string
    {

        $_ch = curl_init();
        curl_setopt($_ch, CURLOPT_URL, "https://api.spotify.com/v1/tracks/" . $trackID);
        curl_setopt($_ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
        curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($_ch);
        curl_close($_ch);

        return $result;
    }

    /**
     * @param string $trackID
     * @return int|string
     */
    public static function insertTrackInDB(string $trackID): int|string
    {
        $json = self::getTrack($trackID);
        if (is_bool($json)) return 500;
        $track = Track::fromJson(json_decode($json, true));
//        $res = $track->findBy(['idSpotify' => $track->getIdSpotify()]);
//        if (!empty($res)) return 409;

        unset($track->id);
        $track->create();
        return $json;
    }

    /**
     * @param string $trackID
     * @return int
     */
    public static function deleteTrackInDB(string $trackID): int
    {
        $mock = Track::getDefaultInstance();
        $res = $mock->findBy(['idSpotify' => $trackID]);

        if (empty($res)) return 404;
        $mock->delete($res[0]->id);
        return 200;
    }
}