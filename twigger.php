<?php

// Load our autoloader
require_once __DIR__.'/vendor/autoload.php';

$MainViews = __DIR__.'/views';

$ViewsBlog = __DIR__.'/views/blog';

$ViewsContact = __DIR__.'/views/contact';

$ViewsFooter = __DIR__.'/views/footer';

$ViewsGallery = __DIR__.'/views/gallery';

$ViewsHead = __DIR__.'/views/head';

$ViewsHeader = __DIR__.'/views/header';

$ViewsParts = __DIR__.'/views/parts';

$ViewsProduct = __DIR__.'/views/product';

$ViewsProductBlinds = __DIR__.'/views/product/blinds';

$ViewsProductConservatory = __DIR__.'/views/product/blinds/conservatory';

$ViewsProductElectric = __DIR__.'/views/product/blinds/electric';

$ViewsProductCurtains = __DIR__.'/views/product/curtains';

$ViewsProductShutters = __DIR__.'/views/product/shutters';

$ViewsProductBlocks = __DIR__.'/views/product/blocks';

$ViewsShop = __DIR__.'/views/shop';

$ViewsShopArchive = __DIR__.'/views/shop/archive';

$ViewsShopCatalog = __DIR__.'/views/shop/catalog';

$ViewsShopSingle = __DIR__.'/views/shop/single';

$ViewsShopSections = __DIR__.'/views/shop/single/sections';

// Specify our Twig templates location
$loader = new Twig_Loader_Filesystem(array( $MainViews, $ViewsBlog, $ViewsContact, $ViewsFooter, $ViewsGallery, $ViewsHead, $ViewsHeader, $ViewsParts, $ViewsProduct, $ViewsProductBlinds, $ViewsProductConservatory, $ViewsProductElectric, $ViewsProductCurtains, $ViewsProductShutters, $ViewsProductBlocks, $ViewsShop, $ViewsShopArchive, $ViewsShopCatalog, $ViewsShopSingle, $ViewsShopSections ));

$SiteTitle = 'Solaris Blinds & Curtains';

$SiteDescription = 'We will at all times strive to provide you with and after sale service to all our products, Not just for 1 year but for all the years to come.';

$SiteLocation = 'Lorem | Ipsum | Dolor | Consequeteur';

$SiteCopyright = 'Some other stuff';

$SiteLogo = '/wp-content/themes/solaris-theme/assets/img/logo.png';

$GoogleMapsURL = '#';

$SiteEmail = 'info@example.com';

$SiteNumber = '1800 111 2222';

$Address1 = 'Street / Road';

$Address2 = 'City / Town';

$Address3 = 'State / County';

$Address4 = 'Country';

// Instantiate our Twig
$twig = new Twig_Environment($loader);
$twig->addGlobal('SiteTitle', $SiteTitle);
$twig->addGlobal('SiteLogo', $SiteLogo);
$twig->addGlobal('SiteLocation', $SiteLocation);
$twig->addGlobal('SiteCopyright', $SiteCopyright);
$twig->addGlobal('SiteDescription', $SiteDescription);
$twig->addGlobal('GoogleMapsURL', $GoogleMapsURL);
$twig->addGlobal('SiteEmail', $SiteEmail);
$twig->addGlobal('SiteNumber', $SiteNumber);
$twig->addGlobal('Address1', $Address1);
$twig->addGlobal('Address2', $Address2);
$twig->addGlobal('Address3', $Address3);
$twig->addGlobal('Address4', $Address4);