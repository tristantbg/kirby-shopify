<?php

use Kirby\Data\Data;
use Kirby\Data\Yaml;

class ShopifyProductsPage extends Page
{
    public function children()
    {
        $shopifyApiCache = kirby()->cache('tristanb.kirby-shopify.api');
        $products        = $shopifyApiCache->get('products');
        $kirbyProducts   = site()->index()->filterBy('intendedTemplate', 'shopify.product');

        if ($products === null) {
            $products = \KirbyShopify\App::getProducts();
            $shopifyApiCache->set('products', $products);
        }

        $pages = [];

        foreach ($products as $key => $product) {

            $kirbyProductRoot = page('products')->root() . '/' . Str::slug($product['handle']) . '/shopify.product.txt';
            $kirbyProduct     = F::exists($kirbyProductRoot) ? new \Kirby\Toolkit\Collection(\Kirby\Data\Data::read($kirbyProductRoot)) : false;

            $shopifyProduct = [
                'title'                  => $product['title'],
                'shopifyTitle'           => $product['title'],
                'shopifyID'              => $product['id'],
                'shopifyHandle'          => $product['handle'],
                'shopifyFeaturedImage'   => count($product['images']) > 0 ? \Kirby\Data\Yaml::encode($product['images'][0]) : '',
                'shopifyImages'          => \Kirby\Data\Yaml::encode($product['images']),
                'shopifyDescriptionHTML' => $product['body_html'],
                'shopifyType'            => $product['product_type'],
                'shopifyTags'            => $product['tags'],
                'shopifyVariants'        => \Kirby\Data\Yaml::encode($product['variants']),
            ];

            $pages[] = [
                'slug'     => Str::slug($product['handle']),
                'template' => 'shopify.product',
                'model'    => 'shopify.product',
                'content'  =>
                $kirbyProduct
                ?
                array_merge($kirbyProduct->toArray(), $shopifyProduct)
                :
                $shopifyProduct,
            ];
        }

        return Pages::factory($pages, $this);
    }
}
