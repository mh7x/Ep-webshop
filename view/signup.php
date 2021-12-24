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
        <title>Registracija</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Registracija</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Postani član JKTS skupnosti!</p>
                </div>
            </div>
        </header>

        <div class="form container px-4 px-lg-5 mt-5">
            <form>
                <div class="form-row my-3">
                    <div class="form-group">
                        <input type="text" class="sign form-control" placeholder="Ime">
                    </div>
                    <div class="form-group">
                        <input type="text" class="sign form-control" placeholder="Priimek">
                    </div>
                </div>
                <div class="form-group my-3">
                    <input type="email" class="sign form-control" placeholder="E-pošta">
                </div>
                <div class="form-group my-3">
                    <input type="password" class="sign form-control" placeholder="Geslo">
                </div>
                <div class="form-group my-3">
                    <input type="password" class="sign form-control" placeholder="Potrdi geslo">
                </div>
            </form>
            <button class="btn btn-outline-dark mt-4 mb-3">Registracija</button>
            <span>Že registriran uporabnik? <a href="<?= BASE_URL . "signin" ?>">Prijava</a></span>
        </div>

        <?php include("layout/footer.php") ?>
    </body>
</html>