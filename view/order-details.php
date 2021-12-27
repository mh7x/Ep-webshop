<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="../public/css/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>Naročilo</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <section>
            <div class="container">
                <div class="text-center mt-4">
                    <h3 class="mt-5">Povzetek naročila</h3>
                    <h6>Številka naročila: <?= $order["id"] ?></h6>
                    <hr>
                    <?php $stranka = UserDB::getUserById(["id" => $order["stranka"]]) ?>
                    <h4>Stranka: <?= $stranka["ime"] . " " . $stranka["priimek"] ?></h4>
                    <h5><?= $order["status"] ?></h5>
                    <i><?= $order["date"] ?></i>
                    <?php
                    $items = OrderDB::getItems(["id" => $order["id"]]);
                    foreach ($items as $item) {
                        $article = ArticleDB::get(["id" => $item["article"]])
                        ?>
                        <div class = "cart-body list-group my-3">
                            <div class = "list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                                <div class = "mb-0 d-flex align-items-center">
                                    <img class = "cart-image" src = "../public/assets/<?= $article["photo"] ?>">
                                    <h4 class = "cart-product-name mb-0 mx-2"><?= $article["title"] ?></h4>
                                </div>
                                <div class = "mb-0 mx-2 d-flex align-items-center">
                                    <div class="cart-prices">
                                        <h6 class = "mb-2 mx-3">Cena enote: <?= $article["price"] ?> €</h6>
                                        <h6 class="mb-2 mx-3">Število enot: <?= $item["quantity"] ?> </h6>
                                        <h4 class="mb-0 mx-3">Cena: <?= $article["price"] * $item["quantity"] ?> €</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }; ?>
                    <a class="btn btn-outline-dark" href="<?= BASE_URL . "control-panel-seller" ?>">Nazaj</a>
                </div>
            </div>

        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>