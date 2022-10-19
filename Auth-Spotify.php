<?php
session_start();
$newTokenNeeded = false;
$_SESSION['expire'] = 0;
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

    $_SESSION['token'] = $result['access_token'];
    //$_SESSION['token'] = "BQDkEGCaLAztivtK523qZajmgivleB0TXp-jMgZKuGCVn9oR7hM1nf5f-XMhsL_dp8Xv9PKOZtUZmb0RApa8PCy1QXESenaWuHY7gNxmTi8MKYWVCtTfW3bdeSyL1z9UZCNAP2BHNBMUTm90X4yNGnzX1ovKsErHy9ls-0YUulGJN2X57YgjEmjqticwBTj-VQ";
    $_SESSION['expire'] = time() + 3600;
}