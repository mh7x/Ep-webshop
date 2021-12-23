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
        <title>Ep - webshop</title>
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
                            <li><a class="dropdown-item" href="<?= BASE_URL . "control-panel" ?>">Informacije</a></li>
                            <li><a class="dropdown-item active" href="<?= BASE_URL . "add-article" ?>">Dodaj artikel</a></li>
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
                    <h3>Dodaj artikel</h3>
                    <div class="form container mt-3">
                        <form action="<?= BASE_URL . 'add-article' ?>" method="post">
                            <div class="form-group my-3">
                                <input type="text" name="title" value="<?= $title ?>" class="form-control" placeholder="Naziv">
                            </div>
                            <div class="form-group my-3">
                                <textarea type="text" name="description" value="<?= $description ?>" class="form-control" placeholder="Opis"></textarea>
                            </div>
                            <div class="form-group my-3">
                                <input type="number" name="price" value="<?= $price ?>" class="form-control" placeholder="Cena">
                            </div>
                            <div class="form-group">
                                <input type="file" name="photo" value="<?= $photo ?>" class="form-control-file" id="photoInput" accept=".jpg,.jpeg,.png">
                            </div>
                            <button class="btn btn-success my-4">Dodaj</button>
                        </form>

                    </div>
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