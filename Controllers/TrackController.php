<?php

namespace App\Controllers;

class TrackController
{
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
}