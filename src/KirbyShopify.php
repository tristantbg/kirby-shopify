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
    public static $productsPage = null;

    public static function init()
    {

        self::$config = [
            'ApiKey'   => $_ENV['API_KEY'],
            'Password' => $_ENV['API_PASSWORD'],
            'ShopUrl'  => $_ENV['SHOP_URL'],
        ];

        self::$shopify = new \PHPShopify\ShopifySDK(self::$config);
        self::$productsPage = site()->pages()->filterBy('intendedTemplate', 'shopify.products')->first();

    }

    public static function clearCache()
    {

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $shopifyApiCache->set('products', null);
        $shopifyApiCache->set('collections', null);

    }

    public static function clearProductsCache()
    {

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $shopifyApiCache->set('products', null);

    }

    public static function clearCollectionsCache()
    {

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $shopifyApiCache->set('collections', null);

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

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $products        = $shopifyApiCache->get('products');

        if ($products === null) {
            $products      = [];
            $productsCount = self::$shopify->Product->count(['published_status' => 'published']);

            if ($productsCount > 0) {

                $products = self::$shopify->Product->get(['limit' => 250, 'published_status' => 'published']);

                while (count($products) < $productsCount) {
                    $lastItem     = array_values(array_slice($products, -1))[0];
                    $nextProducts = self::$shopify->Product->get(['limit' => 250, 'published_status' => 'published', 'since_id' => $lastItem['id']]);
                    foreach ($nextProducts as $key => $product) {
                        $products[] = $product;
                    }
                }

            }
            $shopifyApiCache->set('products', $products);
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

    public static function getCollections()
    {

        if (!self::$shopify) {
            \KirbyShopify\App::init();
        }

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $collections     = $shopifyApiCache->get('collections');

        if ($collections === null) {
            $collections      = [];
            $collectionsCount = self::$shopify->CustomCollection->count(['published_status' => 'published']);

            if ($collectionsCount > 0) {

                $collections = self::$shopify->CustomCollection->get(['limit' => 250, 'published_status' => 'published']);

                while (count($collections) < $collectionsCount) {
                    $lastItem        = array_values(array_slice($collections, -1))[0];
                    $nextCollections = self::$shopify->CustomCollection->get(['limit' => 250, 'published_status' => 'published', 'since_id' => $lastItem['id']]);
                    foreach ($nextCollections as $key => $collection) {
                        $collections[] = $collection;
                    }
                }

            }
            $shopifyApiCache->set('collections', $collections);
        }

        return $collections;

    }

    public static function verifyWebhook($data, $hmac_header)
    {

        if ($_ENV['SHOPIFY_APP_SECRET']) {
            $calculated_hmac = base64_encode(hash_hmac('sha256', $data, $_ENV['SHOPIFY_APP_SECRET'], true));
            return hash_equals($hmac_header, $calculated_hmac);
        }

    }

}
