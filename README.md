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

## Make Shopify update your Kirby products list

Set a Shopify webhook for "Product create", "Product update", "Product delete" with value:
```
https://your-kirby.com/kirby-shopify/api/cache/clear
```

## Frontend

An easy way would be to use Shopify Buy Button on top of Kirby to take care of the cart.
You can either display everything with it or choose to use Kirby to display the element more customly.

Shop JS script:

```
const Shop = {
  scriptURL: 'https://sdks.shopifycdn.com/buy-button/latest/buy-button-storefront.min.js',
  options: {
    "product": {
        iframe: false,
        variantId: "all",
        events: {
            afterRender: _ => {}
        },
        text: {
            button: 'Add to cart'
        },
        "contents": {
            "img": true,
            "title": true,
            "imgWithCarousel": false,
            "variantTitle": false,
            "description": true,
            "buttonWithQuantity": false,
            "quantity": false
        }
    },
    "cart": {
        iframe: true,
        startOpen: true,
        popup: true,
        "contents": {
            "button": true
        }
    },
    "lineItem": {},
    "toggle": {
        iframe: false,
        "contents": {
            "title": true,
            "icon": false
        },
        "text": {
            title: "Cart"
        },
    },
    "modalProduct": {
        "contents": {
            "img": false,
            "imgWithCarousel": true,
            "variantTitle": false,
            "buttonWithQuantity": true,
            "button": false,
            "quantity": false
        },
    },
    "productSet": {}
},
  init: _ => {
    if (window.ShopifyBuy) {
      if (window.ShopifyBuy.UI) {
        Shop.ShopifyBuyInit();
      } else {
        loadScript();
      }
    } else {
      loadScript();
    }

    function loadScript() {
      var script = document.createElement('script');
      script.async = true;
      script.src = Shop.scriptURL;
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(script);
      script.onload = Shop.ShopifyBuyInit;
    }
  },
  ShopifyBuyInit: _ => {
    Shop.client = ShopifyBuy.buildClient({
      domain: 'xxx.myshopify.com',
      storefrontAccessToken: 'xxxxxxx',
      appId: '6',
    });
    const items = document.querySelectorAll('[data-product]')
    items.forEach(el => {
      Shop.createButton(el.dataset.product)
    })
  },
  createButton: id => {
    const node = document.getElementById('product-component-' + id)
    ShopifyBuy.UI.onReady(Shop.client).then(function(ui) {
      ui.createComponent('product', {
        id: [id],
        node: node,
        moneyFormat: '{{amount_with_comma_separator}} €',
        options: Shop.options
      });
    });
  }
}

export default Shop;
```

`shopify.product` template:

```
// Creates product in JS
<div data-product="<?= $page->shopifyID() ?>"></div>

// Display values with Kirby if you want
<img src="<?= $page->shopifyFeatured() ?>" />
<?= $page->yourCustomField() ?>
<?= $page->shopifyPrice() ?>
<?= $page->shopifyDescriptionHTML() ?>
<?= $page->shopifyType() ?>
<?= $page->shopifyVendor() ?>

<?php foreach ($page->shopifyTags()->split(',') as $key => $tag): ?>
  <?= $tag ?>
<?php endforeach ?>
```

## Options

WIP

## API

```
\KirbyShopify\App::init()
\KirbyShopify\App::getProducts()
\KirbyShopify\App::clearCache()
```

## License

MIT

## Credits

- [Tristan Bagot](https://github.com/tristantbg)
