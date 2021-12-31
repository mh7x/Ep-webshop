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
        <title>Profil</title>
    </head>

    <body>
        <?php include("layout/navbar.php"); var_dump($_SESSION)?>

        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder"> <?= $user["ime"] . " " . $user["priimek"] ?> </h1>
                    <p class="lead fw-normal text-white-50 mb-0"><?php if($user["status"] == "admin") echo "Administrator";
                    else if($user["status"] == "stranka") echo "Stranka"; 
                    else if($user["status"] == "prodajalec") echo "Prodajalec"; ?>
                    </p>
                </div>
            </div>
        </header>

        <div class="form container px-4 px-lg-5 mt-5">
            <form>
                <div class="form-group my-3">
                    <h3>Osnovni podatki</h3>
                </div>             
                <div class="form-group my-3">
                    <input type="text" name="ime" id="name" class="sign form-control" value="<?=$user["ime"]?>">
                </div>
                <div class="form-group my-3">
                    <input type="text" id="surname" class="sign form-control" value="<?=$user["priimek"]?>">
                </div>
                <div class="form-group my-3">
                    <input type="email" id="email" class="sign form-control" value="<?=$user["email"]?>">
                </div>
                <?php if ($user["status"] === "stranka") {?>
                <div class="form-group my-3">
                    <input type="text" id="address" class="sign form-control" value="<?=$user["naslov"]?>">
                </div>  
                <div class="form-group my-3">
                    <input type="number" id="post_number" class="sign form-control" value="<?=$user["posta"]?>">
                </div>
                <div class="form-group my-3">
                    <input type="email" id="city" class="sign form-control" value="<?=$user["kraj"]?>">
                </div>             
                <?php } ?>
            </form>
            <button class="btn btn-outline-dark mt-4 mb-3" id="<?= $user["status"] === "stranka" ? "update_customer" : "update_user" ?>">Shrani</button>
        </div>

        <div class="form container px-4 px-lg-5 mt-5">
            <form>
                <div class="form-group my-3">
                    <h3>Spremeni geslo</h3>
                </div>             
                <div class="form-group my-3">
                    <input type="password" id="password1" class="sign form-control" placeholder="Vnesi geslo">
                </div>
                <div class="form-group my-3">
                    <input type="password" id="password2" class="sign form-control" placeholder="Ponovno vnesi geslo">
                </div>
            </form>
            <button class="btn btn-outline-dark mt-4 mb-3" id="change_password">Spremeni</button>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="../public/js/profile.js"></script>

        <?php include("layout/footer.php") ?>
    </body>