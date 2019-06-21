<?php

use \Dotenv\Dotenv;
use \PHPShopify\ShopifySDK;

namespace KirbyShopify;

// require 'helpers.php';

$dotenv = new \Dotenv\Dotenv(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 1));
$dotenv->load();

class App
{
    private static $config  = [];
    private static $shopify = null;

    public static function init()
    {

        self::$config = [
            'ApiKey'   => $_ENV['API_KEY'],
            'Password' => $_ENV['API_PASSWORD'],
            'ShopUrl'  => $_ENV['SHOP_URL'],
        ];

        self::$shopify = new \PHPShopify\ShopifySDK(self::$config);

    }

    public static function clearCache()
    {

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $shopifyApiCache->set('products', null);

    }

    public static function clearKirbyCache()
    {

        kirby()->impersonate('kirby');
        kirby()->site()->homepage()->update();

    }

    public static function getProducts()
    {

      if (!self::$shopify) {
          \KirbyShopify\App::init();
      }

      $products = [];
      $productCount = self::$shopify->Product->count();

      if ($productCount > 0) {

        $products = self::$shopify->Product->get(['limit' => 250]);

        while (count($products) < $productCount) {
          $lastItem = array_values(array_slice($products, -1))[0];
          $nextProducts = self::$shopify->Product->get(['limit' => 250, 'since_id' => $lastItem['id']]);
          foreach ($nextProducts as $key => $product) {
            $products[] = $product;
          }
        }

      }

      return $products;

    }

    public static function getProduct($id)
    {

        if (!self::$shopify) {
            \KirbyShopify\App::init();
        }

        return $id ? self::$shopify->Product($id)->get() : null;

    }

    public static function verifyWebhook($data, $hmac_header)
    {

        if ($_ENV['API_SECRET']) {
          $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $_ENV['API_SECRET'], true));
          return hash_equals($hmac_header, $calculated_hmac);
        }

    }

}
