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
        <title>Košarica</title>
    </head>

    <body>
        <?php include("layout/navbar.php"); ?>


        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Košarica</h1>
                </div>
            </div>
        </header>

        <section class="my-5 py-5">
            <div class="container">
                <div class = "cart-header d-flex justify-content-between mx-3 my-2">
                    <p><?= ($isEmpty == false) ? count($_SESSION["cart"]) . " artiklov v košarici" : "" ?> </p>
                    <?php
                    if ($isEmpty == false) {
                        ?><form method="post" action="<?= BASE_URL . "cart" ?>">
                            <button class="btn btn-outline-dark" name="do" value="purge_cart">Izprazni košarico</button>
                        </form>
                        <?php
                    } else {
                        echo "";
                    }
                    ?>
                </div>
                <?php
                if ($isEmpty == false) {
                    foreach ($cart_articles as $article):
                        ?>
                        <div class = "cart-body list-group">
                            <div class = "list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                                <div class = "mb-0 d-flex align-items-center">
                                    <img class = "cart-image" src = "../public/assets/<?= $article["photo"] ?>">
                                    <h4 class = "cart-product-name mb-0 mx-2"><a href = "<?= BASE_URL . "product?id=" . $article["id"] ?>"><?= $article["title"] ?></a></h4>
                                </div>
                                <div class = "mb-0 mx-2 d-flex align-items-center">
                                    <div class="cart-prices">
                                        <h5 class = "mb-0 mx-3"><?= $article["price"] ?> €</h5>
                                        <h6 class="mb-0 mx-3">Skupna cena: <?= $article["price"] * $values[$article["id"]] ?> €</h6>
                                    </div>
                                    <form method="post" action="<?= BASE_URL . "cart" ?>">
                                        <input class="cart-product-counter" type="number" name="quantity" value="<?= $values[$article["id"]] ?>">
                                        <input type="hidden" name="id" value="<?= $article["id"] ?>">
                                        <button class="btn btn-warning mx-3" name="do" value="update_cart">Posodobi</button>
                                    </form>
                                    <form method="post" action="<?= BASE_URL . "cart" ?>">
                                        <input type="hidden" name="id" value="<?= $article["id"] ?>">
                                        <button name="do" value="remove_item" class="btn btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class = "cart-footer m-3">
                        <h4 class = "cart-price">Skupna cena z DDV: <?= $total_price ?> €</h4>
                        <a class = "btn btn-outline-dark my-2" href = "<?= BASE_URL . "checkout" ?>">Na blagajno</a>
                    </div>
                <?php } else if ($isEmpty == true) { ?>
                    <h3>Košarica je prazna!</h3>
                <?php } ?>
            </div>
        </section>

        <?php include("layout/footer.php") ?>
    </body>

</html>