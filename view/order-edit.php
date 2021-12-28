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
                    <h3 class="mt-5">Spremeni status naročila</h3>
                    <h6>Številka naročila: <?= $order["id"] ?></h6>
                    <hr>
                    <?php $stranka = UserDB::getUserById(["id" => $order["stranka"]]) ?>
                    <h4>Stranka: <?= $stranka["ime"] . " " . $stranka["priimek"] ?></h4>
                    <h5><?= $order["status"] ?></h5>
                    <i><?= $order["date"] ?></i>
                    <?php $items = OrderDB::getItems(["id" => $order["id"]]); ?>
                    <div class="row d-flex justify-content-center my-3">
                        <div class="col-2">
                            <form action="<?= BASE_URL . "order-edit" ?>" method="post">
                                <input type="hidden" name="id" value="<?= $order["id"] ?>"  />
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="V obdelavi"
                                    <?php
                                    echo($order["status"] == "V obdelavi") ? "checked" : "";
                                    echo($order["status"] == "Potrjeno") ? "disabled" : "";
                                    ?>>
                                    <label class="form-check-label" for="v-obdelavi">
                                        V obdelavi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Potrjeno" <?php echo($order["status"] == "Potrjeno") ? "checked" : "" ?>>
                                    <label class="form-check-label" for="potrjeno">
                                        Potrdi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Preklicano" <?php
                                    echo($order["status"] == "Preklicano") ? "checked" : "";
                                    echo($order["status"] == "Potrjeno") ? "disabled" : "";
                                    ?>>
                                    <label class="form-check-label" for="preklicano">
                                        Prekliči
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="Stornirano" <?php echo($order["status"] == "Stornirano") ? "checked" : "" ?>>
                                    <label class="form-check-label" for="stornirano">
                                        Storniraj
                                    </label>
                                </div>
                                <button class="btn btn-outline-dark mt-2">Potrdi</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>