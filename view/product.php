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
        <title><?= $article["title"] ?></title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder"><?= $article["title"] ?></h1>
                </div>
            </div>
        </header>

        <div class="container container-product px-4 px-lg-5 mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL . "" ?>">Artikli</a></li>
                    <li class="breadcrumb-item active"><?= $article["title"] ?></li>
                </ol>
            </nav>
            <section class="mb-5 pb-5">
                <div class="product-row my-5 py-5">
                    <div class="product-image pt-5">
                        <img src="../public/assets/<?= $article["photo"] ?>">
                    </div>
                    <div class="product-description">
                        <p class="pt-4"><?= $article["description"] ?>
                        </p>
                        <h5 class="my-3"><?= $article["price"] ?>€</h5>
                        <div class="product-rating mb-4">
                            <span>Ocena: </span>
                            <div class="product-stars mx-2">
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
                        </div>
                        <hr>
                        <btn class="btn btn-outline-dark my-2" href="#">Add to cart</btn>
                    </div>
                </div>
            </section>
        </div>

        <?php include("layout/footer.php") ?>
    </body>
</html>