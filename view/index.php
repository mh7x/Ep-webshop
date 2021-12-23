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
        <title>JKTS trgovina</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL . "" ?>">Domov</a></li>
                    <?php if (isset ($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) { ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . "profile" ?>">Profil</a></li>
                    <?php } else {?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . "signin" ?>">Prijava</a></li>
                    <?php }?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nadzorna plošča</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item active" href="<?= BASE_URL . "control-panel" ?>">Informacije</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL . "add-article"?>">Dodaj artikel</a></li>
                        </ul>
                    </li>
                    <?php if (isset ($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) { ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . "logout" ?>">Odjava</a></li>
                    <?php }?>
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-dark" href="<?= BASE_URL . "cart" ?>" data-toggle="modal" data-target="#exampleModal">
                        <span class="bi-cart-fill"></span>
                        Košarica
                        <span class="badge">0</span>
                    </a>
                </form>
            </div>
        </nav>

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
                <div class="col">
                    <input class="sign form-control form-control-lg form-control-borderless" type="search"
                           placeholder="Išči artikle">
                </div>
                <div class="col">
                    <button class="btn btn-outline-dark" type="submit">Išči</button>
                </div>
            </div>
        </div>

        <div class="container px-4 px-lg-5 mt-5">
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
                                            <?php $empty = 5 - $article["review"];
                                            for ($i = 0; $i < $article["review"]; $i++) {
                                                echo '<div class="bi-star-fill"></div>';
                                            }
                                            for ($i = 0; $i < $empty; $i++) {
                                                echo '<div class="bi-star"></div>';
                                            } ?>
                                        </div>
                                        <!-- Product price-->
                                        <h5 class="card-price"><?= $article["price"] ?>€</h5>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer py-3">
                                    <btn class="btn btn-outline-dark" href="#">V košarico</btn>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <footer class="bg-dark">
            <p class="footer-text py-3">Made with <span class="text-danger">♥</span></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>

</html>