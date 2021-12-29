<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Bootstrap CSS -->
        <link href="../../public/css/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />


        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>Urejanje prodajalca</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <section>
            <div class="container">
                <div class="row mt-5 text-center">
                    <h3>Uredi prodajalca: <?= $seller["id"] ?></h3>
                    <div class="form container mt-3">
                        <form action="<?= BASE_URL . 'seller/edit' ?>" method="post">
                            <input type="hidden" name="id" value="<?= $seller["id"] ?>"/>
                            <div class="form-group my-3">
                                <label for="name">Ime</label>
                                <input type="text" name="name" value="<?= $seller["ime"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Priimek</label>
                                <input type="text" name="surname" value="<?= $seller["priimek"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Aktiven</label>
                                <input type="checkbox" name="active" <?= $seller["aktiven"] == 1 ? "checked" : "" ?> />
                            </div>
                            <input type="submit" class="btn btn-success mt-2" value="Shrani" />
                        </form>
                        <hr>
                        <form action="<?= BASE_URL . "seller/delete" ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $seller["id"] ?>"  />
                            <input type="submit" class="btn btn-danger my-2" value="Izbriši"/>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>