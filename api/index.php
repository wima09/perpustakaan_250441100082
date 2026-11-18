<?php

// Pintu masuk Vercel: seluruh request diteruskan ke front controller Laravel.
// Vercel ada di belakang proxy HTTPS, jadi PHP diberi tahu bahwa request ini aman.
$_SERVER['HTTPS'] = 'on';

// Skrip ini ada di folder /api, padahal aplikasi Laravel berada di root.
// Tanpa ini, Symfony menganggap "/api" sebagai base URL dan membuangnya dari path,
// sehingga route /api/* tidak pernah cocok.
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

require __DIR__ . '/../public/index.php';