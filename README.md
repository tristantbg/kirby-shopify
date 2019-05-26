# Kirby 3 Shopify Plugin

****

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-shopify`.

### Git submodule

```
git submodule add https://github.com/tristantbg/kirby-shopify.git site/plugins/kirby-shopify
```

### Composer

```
composer require tristantbg/kirby-shopify
```

## Setup

Set your `.env` file inside the plugin folder using the `.env.example` one with your Storefront credentials.
Add manually a page called `products` with the template `shopify.products` in the content folder. (like shown in "example")

## Options

WIP

## API

####\KirbyShopify\App::init()
####\KirbyShopify\App::getProducts()
####\KirbyShopify\App::clearCache()


## License

MIT

## Credits

- [Tristan Bagot](https://github.com/tristantbg)
