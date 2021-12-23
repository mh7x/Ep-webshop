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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= BASE_URL . "" ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . "signin" ?>">Sign in</a></li>
                    <!--<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#!">All Products</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                    <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                                </ul>
                            </li>
                    -->
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-dark" href="<?= BASE_URL . "cart" ?>" data-toggle="modal" data-target="#exampleModal">
                        <span class="bi-cart-fill"></span>
                        Cart
                        <span class="badge">0</span>
                    </a>
                </form>
            </div>
        </nav>

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
                    <li class="breadcrumb-item"><a href="<?= BASE_URL . "" ?>">Products</a></li>
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


        <footer class="bg-dark">
            <p class="footer-text py-3">Made with <span style="color: red">♥</span></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    </body>