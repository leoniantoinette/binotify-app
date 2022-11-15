const debounce = (func, delay = 100) => {
    let debounceTimer;
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(context, args), delay);
    }
};

var usernameInput = document.getElementById("username");
var errorMsgUsername = document.getElementById("errorMsgUsername");
usernameInput.addEventListener("input", function() {
    var username = usernameInput.value;
    if (username.length > 0) {
        if (/^(?=.{1,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/.test(username)) {
            checkIsUsernameAvailable(username);
            usernameInput.style.border = "2px solid green";
            errorMsgUsername.style.display = "none";
            isUsernameInputValid = true;
        } else {
            usernameInput.style.border = "2px solid red";
            errorMsgUsername.style.display = "block";
            errorMsgUsername.style.color = "red";
            errorMsgUsername.innerHTML = "Username must be 1-20 characters long and can only contain letters, numbers, underscores and periods.";
            isUsernameInputValid = false;
        }
    } else {
        usernameInput.style.border = "2px solid red";
        errorMsgUsername.style.display = "block";
        errorMsgUsername.style.color = "red";
        errorMsgUsername.innerHTML = "Username is required";
        isUsernameInputValid = false;
    }
})

var emailInput = document.getElementById("email");
emailInput.addEventListener("input", function() {
    var email = emailInput.value;
    var errorMsgEmail = document.getElementById("errorMsgEmail");

    if (email.length > 0) {
        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
            emailInput.style.border = "2px solid green";
            errorMsgEmail.style.display = "none";
            isEmailInputValid = true;
        } else {
            emailInput.style.border = "2px solid red";
            errorMsgEmail.style.display = "block";
            errorMsgEmail.style.color = "red";
            errorMsgEmail.innerHTML = "Email is invalid";
            isEmailInputValid = false;
        }
    } else {
        emailInput.style.border = "2px solid red";
        errorMsgEmail.style.display = "block";
        errorMsgEmail.style.color = "red";
        errorMsgEmail.innerHTML = "Email is required";
        isEmailInputValid = false;
    }
});

var passwordInput = document.getElementById("password_1");
var passwordConfirmInput = document.getElementById("password_2");
var errorMsgPassword = document.getElementById("errorMsgPassword1");
var errorMsgPasswordConfirm = document.getElementById("errorMsgPassword2");

passwordInput.addEventListener("input", function() {
    var password = passwordInput.value;
    if (password.length > 0) {
        passwordInput.style.border = "2px solid green";
        errorMsgPassword.style.display = "none";
        isPasswordInputValid = true;
        if (passwordConfirmInput.value.length > 0) {
            if (password != passwordConfirmInput.value) {
                passwordConfirmInput.style.border = "2px solid red";
                errorMsgPasswordConfirm.style.display = "block";
                errorMsgPasswordConfirm.style.color = "red";
                errorMsgPasswordConfirm.innerHTML = "Passwords do not match";
                isPasswordConfirmInputValid = false;
            } else {
                passwordConfirmInput.style.border = "2px solid green";
                errorMsgPasswordConfirm.style.display = "none";
                isPasswordConfirmInputValid = true;
            }
        }
    } else {
        passwordInput.style.border = "2px solid red";
        errorMsgPassword.style.display = "block";
        errorMsgPassword.style.color = "red";
        errorMsgPassword.innerHTML = "Password is required";
        isPasswordInputValid = false;
    }
});

function checkUniq(field, value) {
    var req = new AjaxRequest();
    req.setMethod('POST');
    var params = "table=table&field=" + encodeURIComponent(field) + "&value=" + encodeURIComponent(value);
    req.loadXMLDoc("checkuniq.php", params);
}

passwordConfirmInput.addEventListener("input", function() {
    var passwordConfirm = passwordConfirmInput.value;
    if (passwordConfirm.length > 0) {
        if (passwordConfirm === passwordInput.value) {
            passwordConfirmInput.style.border = "2px solid green";
            errorMsgPasswordConfirm.style.display = "none";
            isPasswordConfirmInputValid = true;
        } else {
            passwordConfirmInput.style.border = "2px solid red";
            errorMsgPasswordConfirm.style.display = "block";
            errorMsgPasswordConfirm.style.color = "red";
            errorMsgPasswordConfirm.innerHTML = "Passwords do not match";
            isPasswordConfirmInputValid = false;
        }
    } else {
        passwordConfirmInput.style.border = "2px solid red";
        errorMsgPasswordConfirm.style.display = "block";
        errorMsgPasswordConfirm.style.color = "red";
        errorMsgPasswordConfirm.innerHTML = "Password confirmation is required";
        isPasswordConfirmInputValid = false;
    }
});

function checkIsUsernameAvailable(username) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var errorMsgUsername = document.getElementById("errorMsgUsername");
            var usernameInput = document.getElementById("username");
            if (data.isAvailable) {
                usernameInput.style.border = "2px solid green";
                errorMsgUsername.style.display = "none";
                isUsernameInputValid = true;
            } else {
                usernameInput.style.border = "2px solid red";
                errorMsgUsername.style.display = "block";
                errorMsgUsername.style.color = "red";
                errorMsgUsername.innerHTML = "Username is already taken";
                isUsernameInputValid = false;
            };
            xmlhttp.open("GET", "../php/registerBE.php?data=" + username, true);
            xmlhttp.send();
        }
    }
};

function checkIsEmailAvailable(email) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var errorMsgEmail = document.getElementById("errorMsgEmail");
            var emailInput = document.getElementById("email");
            if (data['isEmailAvailable'] == false) {
                emailInput.style.border = "2px solid red";
                errorMsgEmail.style.display = "block";
                errorMsgEmail.style.color = "red";
                errorMsgEmail.innerHTML = `Email ${data['email']} already taken`;
                isEmailInputValid = false;
            } else {
                emailInput.style.border = "2px solid green";
                errorMsgEmail.style.display = "block";
                errorMsgEmail.style.color = "green";
                errorMsgEmail.innerHTML = `Email ${data['email']} is available`;
                isEmailInputValid = true;
            }
        }
    };
    xmlhttp.open("GET", "../../core/ajax/signup.php?email=" + email, true);
    xmlhttp.send();
}