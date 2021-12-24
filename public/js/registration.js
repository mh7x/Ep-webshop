'use strict'

let arr = window.location.pathname.split("/");
let baseUrl = window.location.protocol + "//" + window.location.host + "";
for (let i = 0; i < arr.length-1; i++){
    baseUrl += arr[i] + "/"
}

let captchaCode = "";

function registerUser() {
    let name = $("#name").val();
    let surnmae = $("#surname").val();
    let email = $("#email").val();
    let password1 = $("#password1").val();
    let password2 = $("#password2").val();
    let captcha_input = $("#captcha_input").val();
    let address = $("#address").val();
    let post_number = $("#post_number").val();
    let post_city = $("#post_city").val();

    if (verifyPassword(password1, password2)){
        // gesli se ujemata
        if (verifyCaptcha(captcha_input)){
            // captcha je pravilna

            let obj = {
                "name": name,
                "surname": surname,
                "email": email,
                "password": password1,
                "status": "stranka",
                "address": address,
                "post_number": post_number,
                "post_city": post_city
            };
            $.ajax({
                type: "POST",
                url: baseUrl + "signup",
                data: obj,
                success: function (response) {
                    console.log(response);
                }
            });
        }
        else{
            $("#message").text("Koda ni pravilna.");
            loadCaptcha();
        }
    }
    else {
        $("#message").text("Gesli se ne ujemata.");
    }

}

function verifyPassword(pass1, pass2) {
    if (pass1 == null || pass2 == null || pass1 !== pass2){
        return false;
    }
    return true;
}

let allCharacters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
                     'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd',
                     'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
                     't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
function getCaptcha(){
    let result = "";

    for (let i = 0; i < 6; i++) {
        let randomCharacter = allCharacters[Math.floor(Math.random() * allCharacters.length)];
        result += randomCharacter;
    }
    return result;
}

function loadCaptcha() {
    captchaCode = getCaptcha();
    $("#captcha_code").val(captchaCode);
    $("#captcha_input").val("");
}

function verifyCaptcha(captcha) {
    if (captchaCode !== captcha) {
        return false;
    }
    return true;
}

$(document).ready(function () {
    loadCaptcha();
    $("#submit_registration").click(registerUser);
});