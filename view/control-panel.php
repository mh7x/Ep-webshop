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
        <title>Nadzorna plošča</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="<?= BASE_URL . "" ?>">Domov</a></li>
                    <?php if (isset ($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) { ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . "profile" ?>">Profil</a></li>
                    <?php } else {?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL . "signin" ?>">Prijava</a></li>
                    <?php }?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nadzorna plošča</a>
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

        <section>
            <div class="container">
                <div class="row mt-5 text-center">
                    <h2>Informacije</h2>
                    <h4>Vsi artikli</h4>
                </div>
                <div class="cart-body list-group">
                    <?php foreach ($articles as $article): ?>
                        <div class="list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                            <div class="mb-0 d-flex align-items-center">
                                <img class="cp-image" src="../public/assets/<?= $article["photo"] ?>">
                                <h4 class="cart-product-name mb-0"><a href="<?= BASE_URL . "product?id=" . $article["id"] ?>"><?= $article["title"] ?></a></h4>
                            </div>
                            <div class="mb-0 mx-5 d-flex align-items-center">
                                <h5 class="mb-0 mx-3"><?= $article["price"] ?>€</h5>
                                <div class="card-stars">
                                    <div class="text-dark mx-2">Ocena uporabnikov: </div>
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
                                <button class="btn btn-warning mx-3">Uredi</button>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>

        <footer class="bg-dark">
            <p class="footer-text py-3">Made with <span class="text-danger">♥</span></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>

</html>