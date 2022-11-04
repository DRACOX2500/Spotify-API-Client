<?php
session_start();

require "Envloader.php";
use App\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

$newTokenNeeded = false;
// $_SESSION['expire'] = 0;
if (empty($_SESSION)) {
    $newTokenNeeded = true;
} else {
    if ($_SESSION['expire'] <= time()) {
        $newTokenNeeded = true;
    }
}

if ($newTokenNeeded) {

    $clientId = "99047b88923a48ffb81536af01aab19b";
    $clientSecret = "5283fcfb1e9945b88bbcdd4e3300865d";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'client_credentials'
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $_SESSION['token'] = $result['access_token'] ?? getenv('TOKEN');
    $_SESSION['expire'] = time() + 3600;
}