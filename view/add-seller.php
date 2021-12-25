<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Bootstrap CSS -->
        <link href="../../public/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />


        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>Dodaj prodajalca</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <section>
            <div class="container">
                <div class="row mt-5 text-center">
                    <h3>Dodaj Prodajalca</h3>
                    <div class="form container mt-3">
                        <form action="<?= BASE_URL . 'product/add' ?>" method="post">
                            <div class="form-group my-3">
                                <input type="text" name="title" value="<?= $title ?>" class="form-control" placeholder="Naziv">
                            </div>
                            <div class="form-group my-3">
                                <textarea type="text" name="description" value="<?= $description ?>" class="form-control form-textarea" placeholder="Opis"></textarea>
                            </div>
                            <div class="input-group my-3">
                                <input type="number" name="price" value="<?= $price ?>" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
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

        <?php include("layout/footer.php") ?>
    </body>

</html>