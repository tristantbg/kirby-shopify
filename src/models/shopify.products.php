<?php

use Kirby\Data\Yaml;

class ShopifyProductsPage extends Page
{
    public function children()
    {
        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $products = $shopifyApiCache->get('products');
        $kirbyProducts = site()->index()->filterBy('intendedTemplate', 'shopify.product');

        if ($products === null) {
          $products = \KirbyShopify\App::getProducts();
          $shopifyApiCache->set('products', $products, 30);
        }

        $pages   = [];

        foreach ($products as $key => $product) {

            $kirbyProduct = $kirbyProducts->findBy('shopifyID', strval($product['id']));
            // $kirbyProduct = null;

            $pages[] = [
                'slug'     => Str::slug($product['handle']),
                'num'      => $key+1,
                'template' => 'shopify.product',
                'model'    => 'shopify.product',
                'content'  => [
                    'title'    => $product['title'],
                    'test'    => $kirbyProduct ? $kirbyProduct->test() : '',
                    'shopifyTitle' => $product['title'],
                    'shopifyID' => $product['id'],
                    // 'shopifyURL' => $product['url'],
                    'shopifyHandle' => $product['handle'],
                    // 'shopifyCurrentPrice' => $product['price'],
                    // 'shopifyCompareAtPrice' => $product['compareAtPrice'],
                    // 'shopifyAvailable' => $product['available'] == 1 ? 'true' : 'false',
                    'shopifyFeaturedImage' => count($product['images']) > 0 ? \Kirby\Data\Yaml::encode($product['images'][0]) : '',
                    'shopifyImages' => \Kirby\Data\Yaml::encode($product['images']),
                    'shopifyDescriptionHTML' => $product['body_html'],
                    'shopifyType' => $product['product_type'],
                    'shopifyTags' => $product['tags']
                ]
            ];
        }

        return Pages::factory($pages, $this);
    }
}
