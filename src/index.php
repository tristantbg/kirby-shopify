<?php
use \PHPShopify\ShopifySDK as ShopifySDK;

require '../vendor/autoload.php';
require 'helpers.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 2));
$dotenv->load();

$config = [
  'ApiKey' => $_ENV['API_KEY'],
  'Password' => $_ENV['API_PASSWORD'],
  'ShopUrl' => $_ENV['SHOP_URL']
];

$app = new \Slim\App($config);

// install route
$app->get('/', function (Request $request, Response $response) {
  $apiKey = $this->get('apiKey');
  $host = $this->get('host');
  $shop = $request->getQueryParam('shop');
  if (!validateShopDomain($shop)) {
   return $response->getBody()->write("Invalid shop domain!");
  }

  $scope = 'read_products';
  $redirectUri = $host . $this->router->pathFor('oAuthCallback');
  $installUrl = "https://{$shop}/admin/oauth/authorize?client_id={$apiKey}&scope={$scope}&redirect_uri={$redirectUri}";

  return $response->withRedirect($installUrl);
});

// callback route
$app->get('/auth/shopify/callback', function (Request $request, Response $response) {
  $params = $request->getQueryParams();
  $apiKey = $this->get('apiKey');
  $secret = $this->get('secret');
  $validHmac = validateHmac($params, $secret);
  $validShop = validateShopDomain($params['shop']);
  $accessToken = "";

  if ($validHmac && $validShop) {
    $accessToken = getAccessToken($params['shop'], $apiKey, $secret, $params['code']);
  } else {
    return $response->getBody()->write("This request is NOT from Shopify!");
  }

  $shopifyResponse = performShopifyRequest(
    $params['shop'], $accessToken, 'products', array('limit' => 10)
  );
  $products = $shopifyResponse['products'];

  $responseBody = "<h1>Your products:</h1>";
  foreach ($products as $product) {
    $responseBody = $responseBody . '<br>' . $product['title'];
  }

  return $response->getBody()->write($responseBody);
})->setName('oAuthCallback');

$app->run();