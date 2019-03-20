<?php

use \PHPShopify\ShopifySDK;
use \Dotenv\Dotenv;

require 'helpers.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 2));
$dotenv->load();

namespace TristanB\KirbyShopify;

class KirbyShopify
{	
	private static $config = [];
	private static $shopify;

	public static function init() {

		self::$config = [
		  'ApiKey' => $_ENV['API_KEY'],
		  'Password' => $_ENV['API_PASSWORD'],
		  'ShopUrl' => $_ENV['SHOP_URL']
		];

		self::$shopify = new PHPShopify\ShopifySDK(self::$config);

		dump($shopify->Product->get());
	}

}
