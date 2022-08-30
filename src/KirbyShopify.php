<?php
namespace KirbyShopify;

use \Dotenv\Dotenv;
use \PHPShopify\ShopifySDK;

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
            // 'AccessToken' => empty($_ENV['ACCESS_TOKEN']) ? null : $_ENV['ACCESS_TOKEN'],
            // 'SharedSecret' => empty($_ENV['SHARED_SECRET']) ? null : $_ENV['SHARED_SECRET'],
        ];

        self::$shopify = new \PHPShopify\ShopifySDK(self::$config);
        self::$productsPage = collection('kirby-shopify.productsPage');

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
        foreach (collection('kirby-shopify.collections') as $key => $c) {
          $shopifyApiCache->set('collection-'.$c->shopifyID(), null);
        }
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
            $productsCount = self::$shopify->Product->count(['published_status' => 'published', 'status' => 'active']);

            if ($productsCount > 0) {

                $products = self::$shopify->Product->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active']);

                while (count($products) < $productsCount) {
                    $lastItem     = array_values(array_slice($products, -1))[0];
                    $nextProducts = self::$shopify->Product->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active', 'since_id' => $lastItem['id']]);
                    foreach ($nextProducts as $key => $product) {
                        $products[] = $product;
                    }
                }

            }
            $shopifyApiCache->set('products', $products);
        }

        return $products;

    }

    public static function getProductsFromCollection($collectionId)
    {

        if (!self::$shopify) {
            \KirbyShopify\App::init();
        }

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $products        = $shopifyApiCache->get('collection-'.$collectionId);

        if ($products === null) {
            $products      = [];
            $productsCount = self::$shopify->Product->count(['published_status' => 'published', 'status' => 'active', 'collection_id' => $collectionId]);

            if ($productsCount > 0) {

                $products = self::$shopify->Product->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active', 'collection_id' => $collectionId]);

                while (count($products) < $productsCount) {
                    $lastItem     = array_values(array_slice($products, -1))[0];
                    $nextProducts = self::$shopify->Product->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active', 'since_id' => $lastItem['id'], 'collection_id' => $collectionId]);
                    foreach ($nextProducts as $key => $product) {
                        $products[] = $product;
                    }
                }

            }
            $shopifyApiCache->set('collection-'.$collectionId, $products);
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
            $smartCollections = self::getSmartCollections();
            $customCollections = self::getCustomCollections();
            $collections      = array_merge($smartCollections, $customCollections);
            $shopifyApiCache->set('collections', $collections);
        }

        return $collections;

    }

    public static function getCustomCollections()
    {

        if (!self::$shopify) {
            \KirbyShopify\App::init();
        }

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $collections     = $shopifyApiCache->get('collections');

        if ($collections === null) {
            $collections      = [];
            $collectionsCount = self::$shopify->CustomCollection->count(['published_status' => 'published', 'status' => 'active']);

            if ($collectionsCount > 0) {

                $collections = self::$shopify->CustomCollection->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active']);

                while (count($collections) < $collectionsCount) {
                    $lastItem        = array_values(array_slice($collections, -1))[0];
                    $nextCollections = self::$shopify->CustomCollection->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active', 'since_id' => $lastItem['id']]);
                    foreach ($nextCollections as $key => $collection) {
                        $collections[] = $collection;
                    }
                }

            }
            $shopifyApiCache->set('collections', $collections);
        }

        return $collections;

    }

    public static function getSmartCollections()
    {

        if (!self::$shopify) {
            \KirbyShopify\App::init();
        }

        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $collections     = $shopifyApiCache->get('collections');

        if ($collections === null) {
            $collections      = [];
            $collectionsCount = self::$shopify->SmartCollection->count(['published_status' => 'published', 'status' => 'active']);

            if ($collectionsCount > 0) {

                $collections = self::$shopify->SmartCollection->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active']);

                while (count($collections) < $collectionsCount) {
                    $lastItem        = array_values(array_slice($collections, -1))[0];
                    $nextCollections = self::$shopify->SmartCollection->get(['limit' => 250, 'published_status' => 'published', 'status' => 'active', 'since_id' => $lastItem['id']]);
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
