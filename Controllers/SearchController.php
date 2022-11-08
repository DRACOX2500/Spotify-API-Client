<?php
namespace App\Controllers;


use App\Core\Utils;
use App\Entity\Album;
use App\Entity\Artist;

class SearchController extends Controller
{
    public function index()
    {
        $this->render('search/index');
    }

    public function json()
    {
        $query = $_GET['query'] ?? '';
        $type = $_GET['type'] ?? 'artist,album';
        $limit = $_GET['limit'] ?? 20;

        $json = self::getSearch($query, $type, $limit);

        $this->render('search/json', compact('json'), 'empty');
    }

    public function ajax()
    {

        $query = $_GET['query'] ?? '';
        $type = $_GET['type'] ?? 'artist,album';
        $limit = $_GET['limit'] ?? 20;

        $json = self::getSearch($query, $type, $limit);
        $result = json_decode($json, true);
        $albums = [];
        $artists = [];

        if (isset($result['albums']) && !empty($result['albums']['items'])) {
            $albums = array_map(function($item) {
                return Album::fromJson($item);
            }, $result['albums']['items']);
        }

        if (isset($result['artists']) && !empty($result['artists']['items'])) {
            $artists = array_map(function($item) {
                return Artist::fromJson($item);
            }, $result['artists']['items']);
        }


        $this->render('search/ajax', compact('artists', 'albums'), 'empty');
    }

    /**
     * @param string $query
     * @param string $type
     * @param int $limit min: 1, max: 50
     * @return bool|string
     */
    public static function getSearch(string $query, string $type = '', int $limit = 20): bool|string
    {
        if (!is_int($limit) || $limit < 1 || $limit > 50) {
            throw new \InvalidArgumentException(sprintf('%s does not int value', $limit));
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=' . $query . '&type=' . $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}