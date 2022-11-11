<?php
$code = $data['code'];

if ($code === 200) {
    echo '{
        "code": 200,
        "message": "Track deleted successfully !"
    }';
} elseif ($code === 404) {
    echo '{
        "code": 404,
        "message": "Track not found !"
    }';
}
