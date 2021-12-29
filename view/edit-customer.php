<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="../public/css/style.css" rel="stylesheet" type="text/css"/>
        

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>Urejanje stranke</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <section>
            <div class="container">
                <div class="row mt-5 text-center">
                    <h3>Uredi stanko: <?= $customer["id"] ?></h3>
                    <div class="form container mt-3">
                        <form action="<?= BASE_URL . 'customer-edit' ?>" method="post">
                            <input type="hidden" name="id" value="<?= $customer["id"] ?>"/>
                            <div class="form-group my-3">
                                <label for="name">Ime</label>
                                <input type="text" name="name" value="<?= $customer["ime"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Priimek</label>
                                <input type="text" name="surname" value="<?= $customer["priimek"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Email</label>
                                <input type="text" name="email" value="<?= $customer["email"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Naslov</label>
                                <input type="text" name="address" value="<?= $customer["naslov"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Poštna številka</label>
                                <input type="number" min="1000" max="9999" name="post_number" value="<?= $customer["stevilka"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <label for="surname">Kraj</label>
                                <input type="text" name="city" value="<?= $customer["kraj"] ?>" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-success mt-2" value="Shrani" />
                        </form>
                        <hr>
                        <form action="<?= BASE_URL . "customer-delete" ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $customer["id"] ?>"  />
                            <input type="submit" class="btn btn-danger my-2" value="Izbriši"/>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </body>

</html>