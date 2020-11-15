<?php

use Kirby\Data\Data;
use Kirby\Data\Yaml;

class ShopifyProductsPage extends Page
{
    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }

    public function children()
    {

        $products = \KirbyShopify\App::getProducts();
        $productsPage = \KirbyShopify\App::$productsPage;
        $pages = [];

        foreach ($products as $key => $product) {
            $slug = Str::slug($product['handle']);
            $kirbyProductRoot = $productsPage->root() . '/' . $product['id'] . '_' . $slug . '/shopify.product.txt';
            $kirbyProduct     = F::exists($kirbyProductRoot) ? new \Kirby\Toolkit\Collection(\Kirby\Data\Data::read($kirbyProductRoot)) : false;
            if($kirbyProduct) $kirbyProduct = $kirbyProduct->toArray();
            // $kirbyProduct = $this->subpages()->find($slug);
            // $kirbyProduct = $kirbyProduct ? $kirbyProduct->toArray() : null;

            $shopifyProduct = [
                'title'                       => $product['title'],
                'shopifyTitle'                => $product['title'],
                'shopifyID'                   => $product['id'],
                'shopifyCreatedAt'            => $product['created_at'],
                'shopifyUpdatedAt'            => $product['updated_at'],
                'shopifyPublishedAt'          => $product['published_at'],
                'shopifyHandle'               => $product['handle'],
                'shopifyVendor'               => $product['vendor'],
                'shopifyFeaturedImage'        => count($product['images']) > 0 ? \Kirby\Data\Yaml::encode([$product['images'][0]]) : '',
                'shopifyImages'               => \Kirby\Data\Yaml::encode($product['images']),
                'shopifyDescriptionHTML'      => $product['body_html'],
                'shopifyPrice'                => count($product['variants']) > 0 ? $product['variants'][0]['price'] : '',
                'shopifyCompareAtPrice'       => count($product['variants']) > 0 ? $product['variants'][0]['compare_at_price'] : '',
                'shopifyType'                 => $product['product_type'],
                'shopifyTags'                 => $product['tags'],
                'shopifyVariants'             => \Kirby\Data\Yaml::encode($product['variants']),
            ];

            if ($kirbyProduct) {
              foreach ($shopifyProduct as $k => $value) {
                unset($kirbyProduct[strtolower($k)]);
              }
            }

            $pages[] = [
                'slug'     => $slug,
                'num'      => $product['id'],
                'template' => 'shopify.product',
                'model'    => 'shopify.product',
                'content'  =>
                $kirbyProduct
                ?
                ($shopifyProduct + $kirbyProduct)
                :
                $shopifyProduct,
            ];
        }

        return Pages::factory($pages, $this);
    }
}
