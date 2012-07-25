<?php
require_once 'google-api-php-client/src/apiClient.php';
require_once 'google-api-php-client/src/contrib/apiPlusService.php';

// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start();

$client = new apiClient();
$client->setApplicationName('Google+ PHP Starter Application');
// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId('insert_your_oauth2_client_id');
$client->setClientSecret('insert_your_oauth2_client_secret');
$client->setRedirectUri('insert_your_oauth2_redirect_uri');
$client->setDeveloperKey('insert_your_simple_api_key');
$plus = new apiPlusService($client);

if (isset($_GET['code'])) {
  $client->authenticate();
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $activities = $plus->activities->listActivities('me', 'public');
  print 'Your Activities: <pre>' . print_r($activities, true) . '</pre>';

  // We're not done yet. Remember to update the cached access token.
  // Remember to replace $_SESSION with a real database or memcached.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a href='$authUrl'>Connect Me!</a>";
}