<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="../public/css/style.css" rel="stylesheet" />

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
                        <input type="text" id="name" class="sign form-control" placeholder="Ime">
                    </div>
                    <div class="form-group">
                        <input type="text" id="surname" class="sign form-control" placeholder="Priimek">
                    </div>
                </div>
                <div class="form-group my-3">
                    <input type="email" id="email" class="sign form-control" placeholder="E-pošta">
                </div>
                <div class="form-group my-3">
                    <input type="password" id="password1" class="sign form-control" placeholder="Geslo">
                </div>
                <div class="form-group my-3">
                    <input type="password" id="password2" class="sign form-control" placeholder="Potrdi geslo">
                </div>
                <div class="form-group my-3">
                    <input type="text" id="address" class="sign form-control" placeholder="Hišni naslov">
                </div>
                <div class="form-group my-3">
                    <div>
                        <input type="text" id="post_city"  class="sign form-control" placeholder="Kraj" style="width: 100px">
                    </div>
                    <div class="mt-3">
                        <input type="number" min="1000" max="9999 " id="post_number" class="sign form-control" placeholder="Pošta">
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <h5>Potrditev, da niste robot:</h5>
                </div>
                <div class="form-group my-3">
                    <div>
                        <input type="text" id="captcha_code" class="form-control" readonly onselectstart="return false" oncut="return false" oncopy="return false" onpaste="return false" ondrag="return false" ondrop="return false">
                    </div>
                    <div class="mt-2">
                        <input type="text" id="captcha_input" onselectstart="return false" onpaste="return false" class="form-control sign" placeholder="Vnesi kodo">
                    </div>
                </div>
            </form>
            <p id="message"></p>
            <button class="btn btn-outline-dark mb-3" id="submit_registration">Registracija</button>
            <span>Že registriran uporabnik? <a href="<?= BASE_URL . "signin" ?>">Prijava</a></span>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="../public/js/registration.js"></script>

        <?php include("layout/footer.php") ?>
    </body>
</html>
