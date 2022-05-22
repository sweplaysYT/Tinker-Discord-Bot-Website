<?php

require 'database/database.php';

require __DIR__ . '/..//vendor/autoload.php';

session_start();

$provider = new \Wohali\OAuth2\Client\Provider\Discord([
    'clientId' => getenv('CLIENT_ID'),
    'clientSecret' => getenv('CLIENT_SECRET'),
    'redirectUri' => 'https://tinker-discord-bot-website.sweplaysyt.repl.co/backend/login.php'
]);

if (!isset($_GET['code'])) {

    // Step 1. Get authorization code
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

  $database = new Database();

  if ($database->connect()) {
    header('Location: https://tinker-discord-bot-website.sweplaysyt.repl.co/main/dashboard/dashboard.php');
  }
}

?>