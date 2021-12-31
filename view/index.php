<!doctype html>
<html lang="en">

    <head>
        <!--Required meta tags--> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!--Bootstrap CSS--> 
        <link href="../public/css/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />


        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>JKTS trgovina</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Spletna trgovina JKTS</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Kupujte v stilu</p>
                </div>
            </div>
        </header>

        <div class="container mt-5 d-flex justify-content-center">
            <div class="row">
                <form action="<?= BASE_URL ?>" method="POST" class="d-flex">
                    <input class="sign form-control form-control-lg form-control-borderless" type="text" name="search" placeholder="Išči artikle...">
                    <button class="btn btn-outline-dark mx-3 px-4" type="submit">Išči</button>
                </form>
            </div>
        </div>

        <div class="container px-4 px-lg-5 mt-5">
            <?php if (isset($message)) { ?>
                <h4 class="text-center my-4"><?= $message ?></h4>
            <?php } ?>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($articles as $article): ?>
                    <div class="col mb-5">
                        <a href="<?= BASE_URL . "product?id=" . $article["id"] ?>">
                            <div class="card">
                                <!-- Product image-->
                                <img class="card-image pt-3" src="../public/assets/<?= $article["photo"] ?>" />
                                <!-- Product details-->
                                <div class="card-body">
                                    <!-- Product name-->
                                    <h4 class="card-name"><?= $article["title"] ?></h5>
                                        <!-- Product reviews-->
                                        <div class="card-stars">
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
                                        <!-- Product price-->
                                        <h5 class="card-price"><?= $article["price"] ?>€</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php include("layout/footer.php") ?>
    </body>

</html>