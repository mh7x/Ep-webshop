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
        <title>Prijava</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Prijava</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Prijavite se, da lahko spremljate svoja naročila</p>
                </div>
            </div>
        </header>

        <div class="form container px-4 px-lg-5 mt-5">
            <form>
                <div class="form-group my-3">
                    <input type="email" class="sign form-control" placeholder="E-pošta">
                </div>
                <div class="form-group my-3">
                    <input type="password" class="sign form-control" placeholder="Gesol">
                </div>
            </form>
            <button class="btn btn-outline-dark mt-4 mb-3">Prijava</button>
            <span>Še nisi registriran uporabnik? <a href="<?= BASE_URL . "signup" ?>">Registracija</a></span>
        </div>
    </header>

    <div class="form container px-4 px-lg-5 mt-5">
        <form action="signin" method="POST" id="signin_form">
            <div class="form-group my-3">
                <input type="email" name="email" class="sign form-control" placeholder="E-pošta">
            </div>
            <div class="form-group my-3">
                <input type="password" name="password" class="sign form-control" placeholder="Geslo">
            </div>
        </form>
        <?php if (isset($data["sporocilo"])){ ?>
            <p> <?= $data['sporocilo'] ?> </p>
        <?php } ?>
        <input type="submit" form="signin_form" class="btn btn-outline-dark mt-4 mb-3" value="Prijava"/>
        <span>Še nisi registriran uporabnik? <a href="<?= BASE_URL . "signup" ?>">Registracija</a></span>
    </div>

    <footer class="bg-dark">
        <p class="footer-text py-3">Made with <span style="color: red">♥</span></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

        <?php include("layout/footer.php") ?>
    </body>
</html>