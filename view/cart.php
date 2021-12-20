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
    <title>Cart</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="./index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="./signin.html">Sign in</a></li>
                <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    -->
            </ul>
            <form class="d-flex">
                <a class="btn btn-outline-dark" href="cart.html" data-toggle="modal" data-target="#exampleModal">
                    <span class="bi-cart-fill"></span>
                    Cart
                    <span class="badge">0</span>
                </a>
            </form>
        </div>
    </nav>

    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Cart</h1>
                <p class="lead fw-normal text-white-50 mb-0">Total price of x products: 420,69€</p>
            </div>
        </div>
    </header>
    <section class="my-5 py-5">
        <div class="container">
            <div class="row">
                <div class="cart-header d-flex justify-content-between mx-3">
                    <p>X products in cart</p>
                    <a class="cart-remove-all" href="#">Remove all products from cart</a>
                </div>
                <div class="cart-body list-group">
                    <div class="list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                        <div class="mb-0 d-flex align-items-center">
                            <img class="cart-image" src="../public/assets/product.jpg">
                            <h4 class="cart-product-name mb-0"><a href="./product.html">Cras justo odio</a></h4>
                        </div>
                        <div class="mb-0 mx-5 d-flex align-items-center">
                            <h5 class="mb-0 mx-3">10,23€</h5>
                            <input class="cart-product-counter" type="number" value="3">
                            <button class="btn btn-warning mx-3">Update</button>
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                    <div class="list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                        <div class="mb-0 d-flex align-items-center">
                            <img class="cart-image" src="../public/assets/product.jpg">
                            <h4 class="cart-product-name mb-0"><a href="./product.html">Brt</a></h4>
                        </div>
                        <div class="mb-0 mx-5 d-flex align-items-center">
                            <h5 class="mb-0 mx-3">0,23€</h5>
                            <input class="cart-product-counter" type="number" value="3">
                            <button class="btn btn-warning mx-3">Update</button>
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                    <div class="list-group-item px-2 py-4 d-flex justify-content-between align-items-center">
                        <div class="mb-0 d-flex align-items-center">
                            <img class="cart-image" src="../public/assets/product.jpg">
                            <h4 class="cart-product-name mb-0"><a href="./product.html">Asd</a></h4>
                        </div>
                        <div class="mb-0 mx-5 d-flex align-items-center">
                            <h5 class="mb-0 mx-3">120,23€</h5>
                            <input class="cart-product-counter" type="number" value="3">
                            <button class="btn btn-warning mx-3">Update</button>
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
                <div class="cart-footer m-3">
                    <h4 class="cart-price">Total price: 420,69€</h4>
                    <a class="btn btn-outline-dark my-2" href="./checkout.html">Checkout</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark">
        <p class="footer-text py-3">Made with <span style="color: red">♥</span></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>