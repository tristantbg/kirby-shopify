<?php

use Kirby\Data\Data;
use Kirby\Data\Yaml;

class ShopifyCollectionsPage extends Page
{
    public function children()
    {
        $collections = \KirbyShopify\App::getCollections();
        $pages = [];

        foreach ($collections as $key => $collection) {

            $kirbyCollectionRoot = page('collections')->root() . '/' . Str::slug($collection['handle']) . '/shopify.collection.txt';
            $kirbyCollection     = F::exists($kirbyCollectionRoot) ? new \Kirby\Toolkit\Collection(\Kirby\Data\Data::read($kirbyCollectionRoot)) : false;

            $shopifyCollection = [
                'title'                  => $collection['title'],
                'shopifyTitle'           => $collection['title'],
                'shopifyID'              => $collection['id'],
                'shopifyHandle'          => $collection['handle'],
                'shopifyFeaturedImage'   => !empty($collection['image']) ? $collection['image']['src'] : '',
                'shopifyDescriptionHTML' => $collection['body_html']
            ];

            $pages[] = [
                'slug'     => Str::slug($collection['handle']),
                'num'      => $key+1,
                'template' => 'shopify.collection',
                'model'    => 'shopify.collection',
                'content'  =>
                $kirbyCollection
                ?
                array_merge($kirbyCollection->toArray(), $shopifyCollection)
                :
                $shopifyCollection,
            ];
        }

        return Pages::factory($pages, $this);
    }
}
