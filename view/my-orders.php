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

        <link rel="icon" type="image/x-icon" href="../public/assets/favicon.ico" />
        <title>Profil</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder"> Moja naročila </h1>
                    <p class="lead fw-normal text-white-50 mb-0">Preglejte vsa vaša naročila</p>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="cart-body list-group my-5">
                <?php
                if ($orders == null) { ?>
                    <h3>Ni naročil!</h3>
                <?php } else { ?>
                    <h3>Naročila:</h3>
                    <?php foreach ($orders as $order):
                    ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <h6 class="cart-product-name mb-0">Id: #<?= $order["id"] ?></a></h6>
                            </h6>
                        </div>
                        <div class="">

                        </div>
                        <div class="d-flex">
                            <h6 class="mb-0 align-self-center">Status: <?= $order["status"] ?></h6>
                            <i class="mx-4 align-self-center"><?= $order["date"] ?></i>
                            <a class="btn btn-success" href="<?= BASE_URL . "order-details?id=" . $order["id"] ?>">Preglej</a>
                        </div>
                    </div>
                    <?php
                    endforeach;
                }
                ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <?php include("layout/footer.php") ?>
    </body>