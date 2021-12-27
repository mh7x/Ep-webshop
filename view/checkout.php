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

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Informacije o nakupu</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Skupna cena <?php echo(count($_SESSION["cart"])) ?> artiklov: <?= $total_price ?> €</p>
                </div>
            </div>
        </header>

        <?= var_dump($_SESSION) ?>
        <?= var_dump($user) ?>
        <section>
            <div class="form container my-5 py-5">
                <form action="<?= BASE_URL . "summary" ?>" method="post" >
                    <div class="form-row my-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ime" value="<?php echo(($_SESSION["loggedIn"] == true) ? $user["ime"] : '') ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Priimek" value="<?php echo(($_SESSION["loggedIn"] == true) ? $user["priimek"] : '') ?>">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <input type="email" class="form-control" placeholder="E-pošta" value="<?php echo(($_SESSION["loggedIn"] == true) ? $user["email"] : '') ?>">
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="Telefonska števila">
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="Naslov">
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="Poštna številka">
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="Mesto">
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="Država">
                    </div>
                    <input type="checkbox" class="mb-4" id="terms" value="">
                    <label class="form-check-label" for="terms">
                        Sprejmite pogoje uporabe
                    </label>
                    <br>
                    <button class="btn btn-success mb-4">Oddaj naročilo</button>
                </form>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>