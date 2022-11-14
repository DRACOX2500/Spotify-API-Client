<?php
$code = $data['code'];
$track = $data['track'];

if ($code === 200) {
    echo '{
        "code": 200,
        "track": '.$track.'
    }';
} elseif ($code === 409) {
    echo '{
        "code": 409,
        "message": "Conflict : Track already exist in database"
    }';
} else {
    echo '{
        "code": 500,
        "message": "Create Track in Database Failed !"
    }';
}
