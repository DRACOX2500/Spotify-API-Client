<?php
$code = $data['code'];
$artist = $data['artist'];

if ($code === 200) {
    echo '{
        "code": 200,
        "artist": '.$artist.'
    }';
} elseif ($code === 409) {
    echo '{
        "code": 409,
        "message": "Conflict : Artist already exist in database"
    }';
} else {
    echo '{
        "code": 500,
        "message": "Create Artist in Database Failed !"
    }';
}
