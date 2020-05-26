<?php

require __DIR__ . '/vendor/autoload.php';

$ceo = new \Source\People\Ceo("Edem Fernando Bastos", "28-11-2000");
$ceo->setDescription(
        "Começei minha carreira na programação com os jogos de consoles antigos. "
        . "Após aprofundar os conhecimentos fui para o ramo da WEB. E me apaixonei!"
);
$ceo->setFacebookAccount("<script>https://www.facebook.com/edem.fernando.7</script>");
$ceo->setInstagramAccount("<script>https://www.instagram.com/e.fernando123/</script>");

$manufacturer = new \Source\Company\Manufacturer("Core Company", "Edução EAD");
$manufacturer->setAddress("Avenida Maia", 22, "Litorânea");
$manufacturer->setCeo($ceo);

$products = [];
$products[0] = new Source\Company\Product("PHPFullStack", "730.50", $manufacturer);
$products[1] = new Source\Company\Product("HTML5 e CSS3", '249.55', $manufacturer);
$products[2] = new Source\Company\Product("jQuery", '349.99', $manufacturer);
$products[3] = new Source\Company\Product("Bootstrap", '249.55', $manufacturer);


$new_ceo = new \Source\Models\Ceo();
$user_ceo = $new_ceo->searchById(1);

$tutor = new \Source\Models\Tutor();
$user_tutor = $tutor->searchByName("Edem Fernando");
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Core Company</title>
        <link rel="stylesheet" type="text/css" href="assets/style/fonticon.css">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/style/boot.css">
        <link rel="stylesheet" type="text/css" href="assets/style/style.css">
    </head>
    <body>
        <?php
        require __DIR__ . "/assets/views/header.php";
        ?>
        <main>
            <?php
            require __DIR__ . "/assets/views/products.php";
            require __DIR__ . "/assets/views/optin.php";
            require __DIR__ . "/assets/views/school.php";
            require __DIR__ . "/assets/views/tutor.php";
            ?>
        </main>

        <?php
        require __DIR__ . "/assets/views/footer.php";
        require __DIR__ . "/assets/views/rights.php";
        ?>

        <script src="assets/script/jquery.js"></script>
        <script src="assets/script/script.js"></script>
    </body>
</html>