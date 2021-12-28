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
            <div class="cart-body list-group">
                <?php foreach ($orders as $order): ?>
                    <div class="list-group-item px-10 py-4 d-flex justify-content-between align-items-center">
                        <div class="mb-0 d-flex align-items-center">
                            <h4 class="cart-product-name mb-0">#<?= $order["id"]?> naročilo</h4>
                        </div>
                        <div class="mb-0 mx-5 d-flex align-items-center">
                            <h5 class="mb-0 mx-3">Skupna cena: <?= $order["orderPrice"]?>€</h5>
                        </div>
                        <div class="mb-0 mx-5 d-flex align-items-center">
                            <h5 class="mb-0 mx-3">Datum: <?= $order["date"]?></h5>
                            <h5 class="mb-0 mx-3">Status: <?= $order["status"]?></h5>
                        </div>
                        <div class="mb-0 mx-5 d-flex align-items-center">
                            <details>
                                <summary>Artikli</summary>
                                <ul>
                                    <?php foreach($order["items"] as $item): ?>
                                        <li>Naziv: <?= $item["name"] ?>, Količina: <?= $item["quantity"] ?>, cena: <?= $item["price"]?></li>
                                    <?php endforeach ?>
                                </ul>
                            </details>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <?php include("layout/footer.php") ?>
    </body>