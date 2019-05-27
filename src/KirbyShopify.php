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

        return self::$shopify->Product->get();

    }

}
