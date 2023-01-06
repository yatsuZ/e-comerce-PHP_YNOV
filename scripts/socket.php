<?php

use ElephantIO\Client;
$url = 'http://localhost';
$client = new Client(Client::engine(Client::CLIENT_4X, $url));
$client->initialize();
$client->of('/');

if (!empty($_COOKIE[md5('AUTH_KEY')])) {
    $currentUser = [$_COOKIE[md5('AUTH_KEY')]];
    $client->emit('currentUser', $currentUser);
}

?>