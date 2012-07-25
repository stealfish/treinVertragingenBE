<?php
require_once 'google-api-php-client/src/apiClient.php';
require_once 'google-api-php-client/src/contrib/apiPlusService.php';

// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start();

$client = new apiClient();
$client->setApplicationName('NMBS vertragingen');
// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('785343024566-rant69kgk0ripkkq2nhq66f8e30djvok.apps.googleusercontent.com');
$client->setClientSecret('41Zn0w25ZDKe5rqmClMDpR7O');
$client->setRedirectUri('http://www.bisdom-gent.be/labs/');
$client->setDeveloperKey('AIzaSyBg1YsEqXGaLWX3qCPA2rN_rO8oyiWKSB0');
$client->setScopes(array('https://www.googleapis.com/auth/fusiontables'));

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
  
  //update via statement
  print("now update this");
}

if ($client->getAccessToken()) {

  // We're not done yet. Remember to update the cached access token.
  // Remember to replace $_SESSION with a real database or memcached.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a href='$authUrl'>Connect Me!</a>";
}
