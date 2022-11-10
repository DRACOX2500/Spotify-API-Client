<?php
$code = $data['code'];
$album = $data['album'];

if ($code === 200) {
    echo '{
        "code": 200,
        "album": '.$album.'
    }';
} elseif ($code === 409) {
    echo '{
        "code": 409,
        "message": "Conflict : Album already exist in database"
    }';
} else {
    echo '{
        "code": 500,
        "message": "Create Album in Database Failed !"
    }';
}
