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
        <link href="../public/css/style.css" rel="stylesheet" type="text/css"/>
        

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>Dodaj stranko</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Nova stranka</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Vnesi podatke za novo stranko</p>
                </div>
            </div>
        </header>

        <div class="contrainer">
            <div class="form container px-4 px-lg-5 mt-5">
                <form action="<?= BASE_URL . "add-seller"?>" method="POST">
                    <div class="form-row my-3">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="sign form-control" placeholder="Ime">
                        </div>
                        <div class="form-group">
                            <input type="text" name="surname" id="surname" class="sign form-control" placeholder="Priimek">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <input type="email" id="email" name="email" class="sign form-control" placeholder="E-pošta">
                    </div>
                    <div class="form-group my-3">
                        <input type="password" id="password" name="password" class="sign form-control" placeholder="Geslo">
                    </div>
                    <div class="form-group my-3">
                    <?php if (isset($data["sporocilo"])){ ?>
                        <p> <?= $data['sporocilo'] ?> </p>
                    <?php } ?>
                    </div>
                    <div class="form-group my-3">
                        <input type="submit" class="btn btn-success" value="Dodaj">
                    </div>                
                </form>
            </div>
        </div>
        <?php include("layout/footer.php") ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </body>

</html>