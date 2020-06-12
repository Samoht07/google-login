<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1005557954568-sqis59i34nhnbiku6jr0uudi3ll6s38o.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('t2QIti1HwKQta9o6W6m1F6Ge');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://projects.bit-academy.nl/~stam/google-login/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>