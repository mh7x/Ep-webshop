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
                    <h4>Vsi prodajalci</h4>
                </div>
                <div class="cart-body list-group">
                    <?php foreach ($sellers as $seller): ?>
                        <div class="list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                            <div class="mb-0 mx-5 d-flex align-items-center">
                            <h4 class="cart-product-name mb-0"><a href="<?= BASE_URL . "product?id=" . $seller["id"] ?>"><?= $seller["id"] ?></a></h4>
                            </div>
                            <div class="mb-0 mx-5 d-flex align-items-center">
                                <h5 class="mb-0 mx-5"><?= $seller["ime"] . " " . $seller["priimek"] ?></h5>
                                <h6 class="mb-0 mx-2"><?= $seller["email"] ?></h6>
                                <h6 class="mb-0 mx-2"><?= $seller["aktiven"] == 1 ? "Aktiven" : "Neaktiven" ?></h6>
                                <a class="btn btn-warning mx-3" href="<?= BASE_URL . "seller/edit?id=" . $seller["id"] ?>">Uredi</a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>