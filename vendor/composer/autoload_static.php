<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite4673e38b8d4402e7a200a551b4faac0
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'P' => 
        array (
            'PHPShopify\\' => 11,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'PHPShopify\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpclassic/php-shopify/lib',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static $classMap = array (
        'Dotenv\\Dotenv' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Dotenv.php',
        'Dotenv\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/ExceptionInterface.php',
        'Dotenv\\Exception\\InvalidCallbackException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php',
        'Dotenv\\Exception\\InvalidFileException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/InvalidFileException.php',
        'Dotenv\\Exception\\InvalidPathException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/InvalidPathException.php',
        'Dotenv\\Exception\\ValidationException' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Exception/ValidationException.php',
        'Dotenv\\Loader' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Loader.php',
        'Dotenv\\Parser' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Parser.php',
        'Dotenv\\Validator' => __DIR__ . '/..' . '/vlucas/phpdotenv/src/Validator.php',
        'Kirby\\ComposerInstaller\\CmsInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/CmsInstaller.php',
        'Kirby\\ComposerInstaller\\Installer' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Installer.php',
        'Kirby\\ComposerInstaller\\Plugin' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Plugin.php',
        'Kirby\\ComposerInstaller\\PluginInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/PluginInstaller.php',
        'PHPShopify\\AbandonedCheckout' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/AbandonedCheckout.php',
        'PHPShopify\\ApplicationCharge' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ApplicationCharge.php',
        'PHPShopify\\Article' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Article.php',
        'PHPShopify\\Asset' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Asset.php',
        'PHPShopify\\AuthHelper' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/AuthHelper.php',
        'PHPShopify\\Balance' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Balance.php',
        'PHPShopify\\Batch' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Batch.php',
        'PHPShopify\\Blog' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Blog.php',
        'PHPShopify\\CarrierService' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/CarrierService.php',
        'PHPShopify\\Collect' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Collect.php',
        'PHPShopify\\Collection' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Collection.php',
        'PHPShopify\\Comment' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Comment.php',
        'PHPShopify\\Country' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Country.php',
        'PHPShopify\\CurlRequest' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/CurlRequest.php',
        'PHPShopify\\CurlResponse' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/CurlResponse.php',
        'PHPShopify\\Currency' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Currency.php',
        'PHPShopify\\CustomCollection' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/CustomCollection.php',
        'PHPShopify\\Customer' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Customer.php',
        'PHPShopify\\CustomerAddress' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/CustomerAddress.php',
        'PHPShopify\\CustomerSavedSearch' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/CustomerSavedSearch.php',
        'PHPShopify\\Discount' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Discount.php',
        'PHPShopify\\DiscountCode' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/DiscountCode.php',
        'PHPShopify\\Dispute' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Dispute.php',
        'PHPShopify\\DraftOrder' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/DraftOrder.php',
        'PHPShopify\\Event' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Event.php',
        'PHPShopify\\Exception\\ApiException' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Exception/ApiException.php',
        'PHPShopify\\Exception\\CurlException' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Exception/CurlException.php',
        'PHPShopify\\Exception\\ResourceRateLimitException' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Exception/ResourceRateLimitException.php',
        'PHPShopify\\Exception\\SdkException' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Exception/SdkException.php',
        'PHPShopify\\Fulfillment' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Fulfillment.php',
        'PHPShopify\\FulfillmentEvent' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/FulfillmentEvent.php',
        'PHPShopify\\FulfillmentService' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/FulfillmentService.php',
        'PHPShopify\\GiftCard' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/GiftCard.php',
        'PHPShopify\\GraphQL' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/GraphQL.php',
        'PHPShopify\\HttpRequestGraphQL' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/HttpRequestGraphQL.php',
        'PHPShopify\\HttpRequestJson' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/HttpRequestJson.php',
        'PHPShopify\\InventoryItem' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/InventoryItem.php',
        'PHPShopify\\InventoryLevel' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/InventoryLevel.php',
        'PHPShopify\\Location' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Location.php',
        'PHPShopify\\Metafield' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Metafield.php',
        'PHPShopify\\Multipass' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Multipass.php',
        'PHPShopify\\Order' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Order.php',
        'PHPShopify\\OrderRisk' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/OrderRisk.php',
        'PHPShopify\\Page' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Page.php',
        'PHPShopify\\Payouts' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Payouts.php',
        'PHPShopify\\Policy' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Policy.php',
        'PHPShopify\\PriceRule' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/PriceRule.php',
        'PHPShopify\\Product' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Product.php',
        'PHPShopify\\ProductImage' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ProductImage.php',
        'PHPShopify\\ProductListing' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ProductListing.php',
        'PHPShopify\\ProductVariant' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ProductVariant.php',
        'PHPShopify\\Province' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Province.php',
        'PHPShopify\\RecurringApplicationCharge' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/RecurringApplicationCharge.php',
        'PHPShopify\\Redirect' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Redirect.php',
        'PHPShopify\\Refund' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Refund.php',
        'PHPShopify\\Report' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Report.php',
        'PHPShopify\\ScriptTag' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ScriptTag.php',
        'PHPShopify\\ShippingZone' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ShippingZone.php',
        'PHPShopify\\Shop' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Shop.php',
        'PHPShopify\\ShopifyPayment' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ShopifyPayment.php',
        'PHPShopify\\ShopifyResource' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ShopifyResource.php',
        'PHPShopify\\ShopifySDK' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/ShopifySDK.php',
        'PHPShopify\\SmartCollection' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/SmartCollection.php',
        'PHPShopify\\TenderTransaction' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/TenderTransaction.php',
        'PHPShopify\\Theme' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Theme.php',
        'PHPShopify\\Transaction' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Transaction.php',
        'PHPShopify\\Transactions' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Transactions.php',
        'PHPShopify\\UsageCharge' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/UsageCharge.php',
        'PHPShopify\\User' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/User.php',
        'PHPShopify\\Webhook' => __DIR__ . '/..' . '/phpclassic/php-shopify/lib/Webhook.php',
        'Symfony\\Polyfill\\Ctype\\Ctype' => __DIR__ . '/..' . '/symfony/polyfill-ctype/Ctype.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite4673e38b8d4402e7a200a551b4faac0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite4673e38b8d4402e7a200a551b4faac0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite4673e38b8d4402e7a200a551b4faac0::$classMap;

        }, null, ClassLoader::class);
    }
}
