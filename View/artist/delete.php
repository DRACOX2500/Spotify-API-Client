<?php
$code = $data['code'];

if ($code === 200) {
    echo '{
        "code": 200,
        "message": "Artist deleted successfully !"
    }';
} elseif ($code === 404) {
    echo '{
        "code": 404,
        "message": "Artist not found !"
    }';
}
