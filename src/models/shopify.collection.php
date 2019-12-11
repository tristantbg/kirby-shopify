<?php

class ShopifyCollectionPage extends Page
{
    public function children()
    {
        $products = \KirbyShopify\App::getProductsFromCollection($this->shopifyID()->value(), $this->shopifyHandle()->value());
        $productsPage = \KirbyShopify\App::$productsPage;
        $pages = [];

        foreach ($products as $key => $product) {
            $kirbyProduct = null;
            // $kirbyProductRoot = $productsPage->root() . '/' . Str::slug($product['handle']) . '/shopify.product.txt';
            // $kirbyProduct     = F::exists($kirbyProductRoot) ? new \Kirby\Toolkit\Collection(\Kirby\Data\Data::read($kirbyProductRoot)) : false;
            // if($kirbyProduct) $kirbyProduct = $kirbyProduct->toArray();

            $shopifyProduct = [
                'title'                  => $product['title'],
                // 'shopifyTitle'           => $product['title'],
                'shopifyID'              => $product['id'],
                'shopifyHandle'          => $product['handle'],
                // 'shopifyFeaturedImage'   => count($product['images']) > 0 ? $product['images'][0]['src'] : '',
                // 'shopifyImages'          => \Kirby\Data\Yaml::encode($product['images']),
                // 'shopifyDescriptionHTML' => $product['body_html'],
                // 'shopifyPrice'           => count($product['variants']) > 0 ? $product['variants'][0]['price'] : '',
                // 'shopifyCompareAtPrice'  => count($product['variants']) > 0 ? $product['variants'][0]['compare_at_price'] : '',
                // 'shopifyType'            => $product['product_type'],
                // 'shopifyTags'            => $product['tags'],
                // 'shopifyVariants'        => \Kirby\Data\Yaml::encode($product['variants']),
            ];

            if ($kirbyProduct) {
              foreach ($shopifyProduct as $k => $value) {
                unset($kirbyProduct[strtolower($k)]);
              }
            }

            $pages[] = [
                'slug'     => Str::slug($product['handle']),
                'num'      => $key+1,
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
