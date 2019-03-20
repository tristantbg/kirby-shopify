<?php

@include_once __DIR__ . '/vendor/autoload.php';

if (!class_exists('TristanB\KirbyShopify')) {
    require_once __DIR__ . '/src/KirbyShopify.php';
}

Kirby::plugin('tristanb/kirby-shopify', [
    // \TristanB\KirbyShopify::init();
]);