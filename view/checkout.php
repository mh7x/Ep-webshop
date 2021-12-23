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
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nadzorna plošča</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item active" href="<?= BASE_URL . "control-panel" ?>">Informacije</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL . "add-article" ?>">Dodaj artikel</a></li>
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
                    <h1 class="display-4 fw-bolder">Informacije o nakupu</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Skupna cena x artiklov: 420,69€</p>
                </div>
            </div>
        </header>

        <section>
            <div class="form container my-5 py-5">
                <form>
                    <div class="form-row my-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ime">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Priimek">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <input type="email" class="form-control" placeholder="E-pošta">
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
                </form>
                <button class="btn btn-success mb-4">Oddaj</button>
            </div>
        </section>

        <footer class="bg-dark">
            <p class="footer-text py-3">Made with <span style="color: red">♥</span></p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    </body>