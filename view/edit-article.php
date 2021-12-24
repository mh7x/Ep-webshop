<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Bootstrap CSS -->
        <link href="../../public/css/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />


        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <title>Urejane artikla</title>
    </head>

    <body>
        <?php include("layout/navbar.php") ?>

        <section>
            <div class="container">
                <div class="row mt-5 text-center">
                    <h3>Uredi artikel: <?= $article["title"] ?></h3>
                    <div class="form container mt-3">
                        <form action="<?= BASE_URL . 'product/edit' ?>" method="post">
                            <input type="hidden" name="id" value="<?= $article["id"] ?>"  />
                            <div class="form-group my-3">
                                <input type="text" name="title" value="<?= $article["title"] ?>" class="form-control">
                            </div>
                            <div class="form-group my-3">
                                <textarea type="text" name="description" class="form-control form-textarea"><?= $article["description"] ?></textarea>
                            </div>
                            <div class="input-group my-3">
                                <input type="number" name="price" value="<?= $article["price"] ?>" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                            <button class="btn btn-success mt-2">Potrdi</button>
                        </form>
                        <hr>
                        <form action="<?= BASE_URL . "product/delete" ?>" method="post">
                            <input type="hidden" name="id" value="<?= $article["id"] ?>"  />
                            <label>Izbris artikla? <input type="checkbox" name="delete_confirmation" /></label>
                            <br>
                            <button type="submit" class="btn btn-danger my-2">Izbriši</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>