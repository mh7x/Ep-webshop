arr = window.location.pathname.split("/");
baseUrl = window.location.protocol + "//" + window.location.host + "";
for (let i = 0; i < arr.length-1; i++){
    baseUrl += arr[i] + "/"
}

function changePassword(){
    let password1 = $("#password1").val();
    let password2 = $("#password2").val();

    let obj = {
        "password": password1
    };

    if (verifyPassword(password1, password2)){
        $.post(baseUrl + "change_password", obj,
            function (data) {
                $("#password1").val("");
                $("#password2").val("");
            }
        );
    }
}

function verifyPassword(password1, password2){
    if (password1 === password2){
        return true;
    }
    else
        return false;
}

function updateUser(){
    let name = $("#name");
    let surname = $("#surname");
    let email = $("#email");

    let obj = {
        "name": name,
        "surname": surname,
        "email": email
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "update_user",
        data: obj,
        success: function (response) {
            
        }
    });
}

$(document).ready(function () {
    console.log(baseUrl);
    $("#change_password").click(changePassword);
    $("#update_user").click(updateUser);
});