<?php

require __DIR__ . '/class/Produce.php';
require __DIR__ . '/class/CeoInterface.php';
require __DIR__ . '/class/Manufacturered.php';
require __DIR__ . '/class/Product.php';
require __DIR__ . '/class/Manufacturer.php';
require __DIR__ . '/class/Ceo.php';

use ProjectStore\Ceo;
use ProjectStore\Manufacturer;
use ProjectStore\Product;

$ceo =  new Ceo("Edem Fernando Bastos","28-11-2000");
$manufacturer = new Manufacturer("Agência de valor","Edução EAD");
$manufacturer->setAddress("Avenida Maia",22,"Litorânea");
$manufacturer->setCeo($ceo);

$products = [];
$products[0] = new Product("Sistema PDV","730.50",$manufacturer);

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Class Product and Manufacturer</title>
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style/boot.css">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <header class="header_main">
            <h1><?=$manufacturer->getName() ;?></h1>
            <h2>CEO <?=$manufacturer->showNameCeo() ;?></h2>
        </header>

        <main>
            <article>
                <header>
                    <h2>Localização <?=$manufacturer->showAddress();?></h2>
                </header>
            </article>

            <section>

                <header>
                    <h2>Produtos</h2>
                </header>

                <article>
                    <header>
                        <h3> <?=$products[0]->getDescription() ;?> </h3>
                        <p>R$ <?=$products[0]->showFormatPrice() ;?> </p>
                    </header>
                </article>
            </section>
        </main>
    </body>
</html>
