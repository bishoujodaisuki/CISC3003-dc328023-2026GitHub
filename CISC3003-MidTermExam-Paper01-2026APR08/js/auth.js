/**
 * CISC3003 Mid-Term Paper 01 Part 04 — toggles Sign In / Sign Up panels.
 */
(function () {
    "use strict";

    var card = document.getElementById("authCard");
    var signUpBtn = document.getElementById("btnShowSignUp");
    var signInBtn = document.getElementById("btnShowSignIn");
    var loginForm = document.getElementById("formSignIn");
    var registerForm = document.getElementById("formSignUp");

    function setInputsDisabled(form, disabled) {
        if (!form) {
            return;
        }
        var inputs = form.querySelectorAll("input, button[type='submit']");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = disabled;
        }
    }

    function setMode(signIn) {
        if (signIn) {
            card.classList.remove("auth-card--signup");
            card.classList.add("auth-card--signin");
            setInputsDisabled(loginForm, false);
            setInputsDisabled(registerForm, true);
        } else {
            card.classList.remove("auth-card--signin");
            card.classList.add("auth-card--signup");
            setInputsDisabled(loginForm, true);
            setInputsDisabled(registerForm, false);
        }
    }

    if (signUpBtn) {
        signUpBtn.addEventListener("click", function () {
            setMode(false);
        });
    }

    if (signInBtn) {
        signInBtn.addEventListener("click", function () {
            setMode(true);
        });
    }

    setMode(true);
})();
