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
        <title>Nadzorna plošča</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <section>
            <div class="container">
                <div class="row mt-5 text-center">
                    <h2>Informacije</h2>
                    <h4>Vsi artikli</h4>
                </div>
                <div class="cart-body list-group">
                    <?php foreach ($articles as $article): ?>
                        <div class="list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                            <div class="mb-0 d-flex align-items-center">
                                <img class="cp-image" src="../public/assets/<?= $article["photo"] ?>">
                                <h4 class="cart-product-name mb-0"><a href="<?= BASE_URL . "product?id=" . $article["id"] ?>"><?= $article["title"] ?></a></h4>
                            </div>
                            <div class="mb-0 mx-5 d-flex align-items-center">
                                <h5 class="mb-0 mx-3"><?= $article["price"] ?>€</h5>
                                <div class="card-stars">
                                    <div class="text-dark mx-2">Ocena uporabnikov: </div>
                                    <?php
                                    $empty = 5 - $article["review"];
                                    for ($i = 0; $i < $article["review"]; $i++) {
                                        echo '<div class="bi-star-fill"></div>';
                                    }
                                    for ($i = 0; $i < $empty; $i++) {
                                        echo '<div class="bi-star"></div>';
                                    }
                                    ?>
                                </div>
                                <a class="btn btn-warning mx-3" href="<?= BASE_URL . "product/edit?id=" . $article["id"] ?>">Uredi</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="row mt-5 text-center">
                    <h4>Neobdelana naročila</h4>    
                </div>
                <div class="cart-body list-group">
                    <?php
                    foreach ($orders as $order):
                        if ($order["status"] == "V obdelavi") {
                            ?>

                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h6 class="cart-product-name mb-0">Id: #<?= $order["id"] ?></a></h6>
                                    <h6 class="cart-product-name mb-0">Stranka: 
                                        <?php
                                        $stranka = UserDB::getUserById(["id" => $order["stranka"]]);
                                        echo $stranka["ime"] . " " . $stranka["priimek"]
                                        ?>
                                    </h6>
                                </div>
                                <div class="">

                                </div>
                                <div class="d-flex">
                                    <h6 class="mb-0 align-self-center">Status: <?= $order["status"] ?></h6>
                                    <i class="mx-4 align-self-center"><?= $order["date"] ?></i>
                                    <a class="btn btn-warning mx-4" href="<?= BASE_URL . "order-edit?id=" . $order["id"] ?>">Uredi</a>
                                    <a class="btn btn-success" href="<?= BASE_URL . "order-details?id=" . $order["id"] ?>">Preglej</a>

                                </div>
                            </div>
                        <?php } endforeach ?>
                </div>
                <div class="row mt-5 text-center">
                    <h4>Vsa naročila</h4>    
                </div>
                <div class="cart-body list-group">
                    <?php foreach ($orders as $order): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h6 class="cart-product-name mb-0">Id: #<?= $order["id"] ?></a></h6>
                                <h6 class="cart-product-name mb-0">Stranka: 
                                    <?php
                                    $stranka = UserDB::getUserById(["id" => $order["stranka"]]);
                                    echo $stranka["ime"] . " " . $stranka["priimek"]
                                    ?>
                                </h6>
                            </div>
                            <div class="">

                            </div>
                            <div class="d-flex">
                                <h6 class="mb-0 align-self-center">Status: <?= $order["status"] ?></h6>
                                <i class="mx-4 align-self-center"><?= $order["date"] ?></i>
                                <a <?= ($order["status"] == "Stornirano" || $order["status"] == "Preklicano") ? "style='display: none;'" : "" ?>class="btn btn-warning mx-4" href="<?= BASE_URL . "order-edit?id=" . $order["id"] ?>">Uredi</a>
                                <a class="btn btn-success" href="<?= BASE_URL . "order-details?id=" . $order["id"] ?>">Preglej</a>

                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>