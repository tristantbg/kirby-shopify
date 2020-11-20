<?php $productImages = $page->shopifyImages()->toStructure() ?>

<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "<?= $page->shopifyTitle()->escape() ?>",
  "url": "<?= $page->url() ?>",
  <?php if ($productImages->count()): ?>
    "image": [
      "<?= $productImages->first()->src() ?>"
    ],
  <?php endif ?>
  "description": "<?= Escape::html(Str::unhtml($page->shopifyDescriptionHTML())) ?>",
  "brand": {
    "@type": "Thing",
    "name": "<?= $page->shopifyVendor()->escape() ?>"
  },
  <?php if ($page->shopifyVariants()->toStructure()->count()): ?>
    "offers": [
      <?php foreach ($page->shopifyVariants()->toStructure() as $key => $variant): ?>
        {
          "@type" : "Offer",
          "availability" : "http://schema.org/<?= r($page->isAvailable(), 'InStock', 'OutOfStock') ?>",
          "price" : "<?= $variant->price() ?>",
          "priceCurrency" : "EUR",
          "url" : "<?= $variant->url() ?>",
          "itemOffered" :
          {
              "@type" : "Product",
              "name" : "<?= $variant->title()->escape() ?>",
              <?php if ($variant->sku()->isNotEmpty()): ?>
                "sku": "<?= $variant->sku() ?>",
              <?php endif ?>
              <?php if ($variant->weight()): ?>
                "weight": {
                  "@type": "QuantitativeValue",
                  <?php if ($variant->weight_unit()->isNotEmpty()): ?>
                    "unitCode": "<?= $variant->weight_unit() ?>",
                  <?php endif ?>
                  "value": "<?= $variant->weight().r($variant->weight_unit()->isNotEmpty(), ' '.$variant->weight_unit()) ?>"
                },
              <?php endif ?>
          }
        },
      <?php endforeach ?>
    ]
  <?php endif ?>
}
</script>
