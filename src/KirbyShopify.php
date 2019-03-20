<?php

namespace TristanB;

use \PHPShopify\ShopifySDK;
use \Dotenv\Dotenv;

require 'helpers.php';

class KirbyShopify
{	
	private static $config = [];
	private static $shopify = null;

	public static function init() {

		if (self::$shopify === null) {

			$dotenv = new \Dotenv\Dotenv(__DIR__ . str_repeat(DIRECTORY_SEPARATOR . '..', 1));
			$dotenv->load();

			self::$config = [
			  'ApiKey' => $_ENV['API_KEY'],
			  'Password' => $_ENV['API_PASSWORD'],
			  'ShopUrl' => $_ENV['SHOP_URL']
			];

			self::$shopify = new \PHPShopify\ShopifySDK(self::$config);

		}

		return self::$shopify;

	}

	public static function getProducts() {
		
		\TristanB\KirbyShopify::init();

		return self::$shopify->Product->get();
	}

}