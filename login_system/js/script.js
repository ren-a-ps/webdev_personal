$(document).ready(function () { //checks if everything is loaded
    // var for password eye
    var getShowPassword = $("#showPassword");
    var getHidePassword = $("#hidePassword");
    var getInputPsw = $("#psw");

    // var for multiple show password in change_pw.php
    var getShowPsw = $("#checkboxShowPsw");

    // var for dark mode
    var body = $("body");
    var form = $("form");
    var toggleDarkMode = $("#avatar_img");

    // var for remembering if dark mode is toggled
    var getMode = localStorage.getItem("mode");

    // var for form submit
    var form_message = $("#form_message");

    // For when Dark Mode is toggled
    function isDarkMode(isDarkMode) {
        var linksCont_a = $(".links_container a");
        var innerText_span = $(".innertext span");
        var inputCont_i = $(".input_container i");
        
        if (isDarkMode) {
            toggleDarkMode.attr("src", "./rss/ninja_avatar_dm.png");
            innerText_span.css("background-color", "#3a3b3c");
            linksCont_a.css("color", "#fbead2");
            inputCont_i.css("color", "black");
            localStorage.setItem("mode", "darkMode");
        }
        else {
            toggleDarkMode.attr("src", "./rss/ninja_avatar.png");
            innerText_span.css("background-color", "#ffffff");
            linksCont_a.css("color", "#18191a");
            localStorage.setItem("mode", "lightMode");
        }
    };

    // Toggles Dark Mode
    toggleDarkMode.click(function () {
        body.toggleClass("darkMode");
        form.toggleClass("darkMode");
        isDarkMode(body.hasClass("darkMode"));
    });

    // Remembers if Dark Mode is toggled
    if (getMode && getMode === "darkMode"){
        console.log("save DM");
        body.toggleClass("darkMode");
        form.toggleClass("darkMode");
        isDarkMode(body.hasClass("darkMode"));
    }

    // For password eye
    getShowPassword.click(function () {
            getInputPsw.attr("type", "text");
            getShowPassword.hide();
            getHidePassword.show();
    });

    getHidePassword.click(function () {
            getInputPsw.attr("type", "password");
            getHidePassword.hide();
            getShowPassword.show();
    });

    // For multiple show password in change_pw.php
    getShowPsw.click(function () {
        if (getShowPsw.is(":checked")) {
            $("#temp_psw, #psw, #re_psw").attr("type", "text");
        }
        else {
            $("#temp_psw, #psw, #re_psw").attr("type", "password");
        }
    }); 

    //Sign Up Form Submit
    $("#signUpForm").submit(function (event) {
        event.preventDefault(); // Prevents form from calling its method
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var username = $("#uname").val();
        var email = $("#email").val();
        var password = $("#psw").val();
        var submit = $("#signUpButton").val();

        form_message.load("php/action_signup.php", {
            // Passing the variable to php file
            firstname: firstname,
            lastname: lastname,
            username: username,
            email: email,
            password: password,
            submit: submit
        });
    });

    //Login Form Submit
    $("#loginForm").submit(function (event) {
        event.preventDefault(); // Prevents form from calling its method
        var username = $("#username").val();
        var password = $("#psw").val();
        var submit = $("#loginButton").val();

        form_message.load("php/action_login.php", {
            username: username,
            password: password,
            submit: submit
        });
    });

    //Forgot Password Form Submit
    $("#forgotPasswordForm").submit(function (event) {
        event.preventDefault(); // Prevents form from calling its method
        var username = $("#username").val();
        var email = $("#email").val();
        var submit = $("#forgotPasswordButton").val();

        form_message.load("php/action_forgotPw.php", {
            username: username,
            email: email,
            submit: submit
        });
    });

    //Change Password Form Submit
    $("#changePasswordForm").submit(function (event) {
        event.preventDefault(); // Prevents form from calling its method
        var temp_psw = $("#temp_psw").val();
        var psw = $("#psw").val();
        var re_psw = $("#re_psw").val();
        var submit = $("#changePasswordButton").val();

        form_message.load("php/action_changePw.php", {
            temp_psw: temp_psw,
            psw: psw,
            re_psw: re_psw,
            submit: submit
        });
    });
});

