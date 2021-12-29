<?php

require_once("model/ArticleDB.php");
require_once("model/UserDB.php");
require_once("ViewHelper.php");

class UserController {

    public static function signin() {
        echo ViewHelper::render("view/signin.php");
    }

    public static function signup() {
        echo ViewHelper::render("view/signup.php");
    }

    public static function verifySignIn() {

        $rules = [
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $params = ["email" => $filteredData["email"]];
        $user = UserDB::getLoginUser($params);
        if ($user == NULL) {
            $data = ["sporocilo" => "Uporabnik s tem e-naslovom ne obstaja."];
            echo ViewHelper::render("view/signin.php", ["data" => $data]);
        } else {
            if (($user["id"] == 1 && $user["geslo"] === $filteredData["password"]) || password_verify($filteredData["password"], $user["geslo"])) {
                // preverimo če je user aktiven
                if ($user["aktiven"] == true){
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["userId"] = $user["id"];
                    $_SESSION["userEmail"] = $user["email"];
                    $_SESSION["userStatus"] = $user["status"];
                    echo ViewHelper::redirect(BASE_URL);
                }
                else{
                    $data = ["sporocilo" => "Ta uporabnik je začasno deaktiviran."];
                    echo ViewHelper::render("view/signin.php", ["data" => $data]);
                }

            } else {
                $data = ["sporocilo" => "Vnesli ste napačno geslo."];
                echo ViewHelper::render("view/signin.php", ["data" => $data]);
            }
        }
    }

    public static function logout() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            $_SESSION["loggedIn"] = false;
            #session_unset("userId");
            #session_unset("userEmail");
            #session_unset("userStatus");
            $_SESSION["userId"] = "";
            $_SESSION["userEmail"] = "";
            $_SESSION["userStatus"] = "";
        }

        #$data = ArticleDB::getAll();
        #echo ViewHelper::render("view/index.php", ["articles" => $data]);
        echo ViewHelper::redirect(BASE_URL);
    }

    public static function profile() {
        $id = $_SESSION["userId"];
        $params = ["id" => $id];
        if($_SESSION["userStatus"] === "stranka"){
            $user = UserDB::getCustomerById($params);
        }else{
            $user = UserDB::getUserById($params);
        }
        echo ViewHelper::render("view/profile.php", ["user" => $user]);
    }

    public static function change_password() {
        $rules = [
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $hashedPassword = password_hash($filteredData["password"], PASSWORD_DEFAULT);
        $params = ["id" => $_SESSION["userId"], "password" => $hashedPassword];
        $user = UserDB::changePassword($params);
        return json_encode($user);
    }

    public static function update_user() {
        $rules = [
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $params = ["name" => $filteredData["name"], "surname" => $filteredData["surname"], "email" => $filteredData["email"], "id" => $_SESSION["userId"]];
        $user = UserDB::updateUser($params);
        return json_encode($user);
    }

    public static function update_customer() {
        $rules = [
            "address" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "post_number" => [
                'filter' => FILTER_VALIDATE_INT
            ],
            "city" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $params = ["address" => $filteredData["address"], "post_number" => $filteredData["post_number"], "city" => $filteredData["city"], "id" => $_SESSION["userId"]];
        $customer = UserDB::updateCustomer($params);
        return $customer;
    }

    public static function create_user() {
        $rules = [
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            "address" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "post_number" => [
                'filter' => FILTER_VALIDATE_INT
            ],
            "post_city" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "status" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $password = $filteredData["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $filteredData["password"] = $hashedPassword;
        $user = UserDB::createUser($filteredData);
    }

    public static function addSeller(){
        $rules = [
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $password = $filteredData["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $filteredData["password"] = $hashedPassword;
        $filteredData["aktiven"] = true;
        $filteredData["status"] = "prodajalec";
        
        $loginParams = ["email" => $filteredData["email"]];
        $user = UserDB::getLoginUser($loginParams);
        if ($user != NULL){
            // uporabnik s tem e-naslovom že obstaja
            $data = ["sporocilo" => "Uporabnik s tem e-naslovom že obstaja."];
            echo ViewHelper::render("view/add-seller.php", ["data" => $data]);
        }
        else{
            $seller = UserDB::createSeller($filteredData);
            $data = ["sporocilo" => "Uspešno ustvarjen prodajalec."];
            echo ViewHelper::render("view/add-seller.php", ["data" => $data]);
        }
    }

    public static function editForm(){
        $rules = [
            "id" => [
                "filter" => FITLER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        $seller = UserDB::getUserById($data);
        echo ViewHelper::render("view/edit-seller.php", ["seller" => $seller]);
    }

    public static function editSeller() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT
            ],
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "active" => [
                'filter' => FILTER_REQUIRE_SCALAR
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $active = 1;
        if ($filteredData["active"] == NULL) {
            $active = 0;
        }
        $filteredData["active"] = $active;
        $user = UserDB::updateSeller($filteredData);
        echo ViewHelper::redirect(BASE_URL . "control-panel-admin");
    }

    public static function deleteSeller() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $success = UserDB::deleteSeller($filteredData);
        echo ViewHelper::redirect(BASE_URL . "control-panel-admin");
    }

    public static function editCustomerView() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT
            ]
        ];
        $filteredData = filter_input_array(INPUT_GET, $rules);
        $customer = UserDB::getCustomerById($filteredData);
        echo ViewHelper::render("view/edit-customer.php", ["customer" => $customer]);
    }

    public static function editCustomer() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT
            ],
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            "address" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "post_number" => [
                'filter' => FILTER_VALIDATE_INT
            ],
            "city" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $params = ["name" => $filteredData["name"], "surname" => $filteredData["surname"], "email" => $filteredData["email"], "id" => $filteredData["id"]];
        $user = UserDB::updateUser($params);

        $params = ["address" => $filteredData["address"], "post_number" => $filteredData["post_number"], "city" => $filteredData["city"], "id" => $filteredData["id"]];
        $customer = UserDB::updateCustomer($params);

        echo ViewHelper::redirect("control-panel-seller");
    }

    public static function deleteCustomer() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $success = UserDB::deleteCustomer($filteredData);
        echo ViewHelper::redirect("control-panel-seller");
    }
}
