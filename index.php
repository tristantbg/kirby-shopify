<?php

@include_once __DIR__ . '/vendor/autoload.php';

@include_once __DIR__ . '/src/KirbyShopify.php';

@include_once __DIR__ . '/src/models/shopify.products.php';
@include_once __DIR__ . '/src/models/shopify.product.php';
@include_once __DIR__ . '/src/models/shopify.collections.php';
@include_once __DIR__ . '/src/models/shopify.collection.php';

Kirby::plugin('tristanb/kirby-shopify', [
    'options' => [
      'cache.api' => true
    ],
    'collections' => [
      'kirby-shopify.productsPage' => function ($site) {
        return $site->pages()->filterBy('intendedTemplate', 'shopify.products')->first();
      },
      'kirby-shopify.products' => function ($site) {
        return collection('kirby-shopify.productsPage')->children();
      },
      'kirby-shopify.collectionsPage' => function ($site) {
        return $site->pages()->filterBy('intendedTemplate', 'shopify.collections')->first();
      },
      'kirby-shopify.collections' => function ($site) {
        return collection('kirby-shopify.collectionsPage')->children();
      }
    ],
    'pageModels' => [
        'shopify.products' => 'ShopifyProductsPage',
        'shopify.product' => 'ShopifyProductPage',
        'shopify.collections' => 'ShopifyCollectionsPage',
        'shopify.collection' => 'ShopifyCollectionPage',
    ],
    'blueprints' => [
        'pages/shopify.products' => __DIR__ . '/src/blueprints/shopify.products.yml',
        'pages/shopify.product' => __DIR__ . '/src/blueprints/shopify.product.yml',
        'pages/shopify.collections' => __DIR__ . '/src/blueprints/shopify.collections.yml',
        'pages/shopify.collection' => __DIR__ . '/src/blueprints/shopify.collection.yml'
    ],
    'routes' => [
      [
        'pattern' => 'kirby-shopify/api/cache/clear',
        'method' => 'POST',
        'action'  => function () {
          $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
          $data = file_get_contents('php://input');
          $verified = \KirbyShopify\App::verifyWebhook($data, $hmac_header);

          if ($verified) {
            \KirbyShopify\App::clearCache();
            \KirbyShopify\App::clearKirbyCache();
            return Response::json(["status" => "success", "code" => 200, "message" => "Cache cleared"]);
          } else {
            return Response::json(["status" => "success", "code" => 200, "message" => "Identication failed"]);
          }
        }
      ],
      [
        'pattern' => 'kirby-shopify/api/cache/products/clear',
        'method' => 'POST',
        'action'  => function () {
          $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
          $data = file_get_contents('php://input');
          $verified = \KirbyShopify\App::verifyWebhook($data, $hmac_header);

          if ($verified) {
            \KirbyShopify\App::clearProductsCache();
            \KirbyShopify\App::clearKirbyCache();
            return Response::json(["status" => "success", "code" => 200, "message" => "Cache cleared"]);
          } else {
            return Response::json(["status" => "success", "code" => 200, "message" => "Identication failed"]);
          }
        }
      ],
      [
        'pattern' => 'kirby-shopify/api/cache/collections/clear',
        'method' => 'POST',
        'action'  => function () {
          $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
          $data = file_get_contents('php://input');
          $verified = \KirbyShopify\App::verifyWebhook($data, $hmac_header);

          if ($verified) {
            \KirbyShopify\App::clearCollectionsCache();
            \KirbyShopify\App::clearKirbyCache();
            return Response::json(["status" => "success", "code" => 200, "message" => "Cache cleared"]);
          } else {
            return Response::json(["status" => "success", "code" => 200, "message" => "Identication failed"]);
          }
        }
      ]
    ]
]);
