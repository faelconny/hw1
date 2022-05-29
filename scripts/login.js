function validateLoginForm(event)
{
    if (login_form['login-username'].value.length == 0 ||
        login_form['login-password'].value.length == 0) {
        document.querySelector('#login-error').classList.remove('hidden');
        const error = document.querySelector('#failed-login');
        if (error != null) {
            error.classList.add('hidden');
        }
        event.preventDefault();
    }
}

const login_form = document.forms['login-form'];
login_form.addEventListener('submit', validateLoginForm);

function signUpClick(event)
{
    const overlay = document.querySelector('#login .overlay');
    overlay.classList.remove('hidden');
    overlay.classList.add('center-signup');
}

const signup_button = document.querySelector('#signup-button');
signup_button.addEventListener('click', signUpClick);

let show = false;

function closeSignUp(event)
{
    const overlay = document.querySelector('#login .overlay');
    overlay.classList.add('hidden');
    overlay.classList.remove('center-signup');
    if (show) {
        info.classList.add('hidden');
        show = false;
    }
}

const close_button = document.querySelector('#close-icon img');
close_button.addEventListener('click', closeSignUp);

function passwordInfo(event)
{
    const info = document.querySelector('#info');
    if (!show) {
        info.classList.remove('hidden');
        show = true;
    } else {
        info.classList.add('hidden');
        show = false;
    }
}

const info_button = document.querySelector('#password-info');
info_button.addEventListener('click', passwordInfo);

function onResponse(response)
{
    return response.json();
}

let res = false;

function validateSignUpForm(event)
{
    const error = document.querySelector('#form-error');
    if (signup_form['name'].value.length == 0 ||
        signup_form['surname'].value.length == 0 ||
        signup_form['signup-username'].value.length == 0 ||
        signup_form['signup-password'].value.length == 0 ||
        signup_form['confirm-password'].value.length == 0 ||
        signup_form['email'].value.lenght == 0) {
        error.classList.remove('hidden');
        event.preventDefault();
    } else {
        error.classList.add('hidden');
    }
    if (res) {
        event.preventDefault();
    }
    if (signup_form['name'].value.length != 0 &&
        signup_form['surname'].value.length != 0) {
        let aux = signup_form['name'].value.split(" ");
        signup_form['name'].value = "";
        for (let i = 0; i < aux.length; i++) {
            aux[i] = aux[i].charAt(0).toUpperCase() + aux[i].slice(1);
            if (i != aux.length - 1) {
                signup_form['name'].value += aux[i] + " ";
            } else {
                signup_form['name'].value += aux[i];
            }
        }
        aux = signup_form['surname'].value.split(" ");
        signup_form['surname'].value = "";
        for (let i = 0; i < aux.length; i++) {
            aux[i] = aux[i].charAt(0).toUpperCase() + aux[i].slice(1);
            if (i != aux.length - 1) {
                signup_form['surname'].value += aux[i] + " ";
            } else {
                signup_form['surname'].value += aux[i];
            }
        }
    }
}

const signup_form = document.forms['signup-form'];
signup_form.addEventListener('submit', validateSignUpForm);

function checkEmail(event)
{
    const invalid = document.querySelector('#invalid-email');
    var exp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!email.value.match(exp) && email.value.length != 0) {
        invalid.classList.remove('hidden');
        email.parentNode.classList.add('error');
        event.preventDefault();
        return;
    } else {
        invalid.classList.add('hidden');
        email.parentNode.classList.remove('error');
    }
    if (email.value.length != 0) {
        const duplicate = document.querySelector('#duplicate-email');
        fetch("check_email.php?q=" + email.value)
        .then(onResponse)
        .then(present => {
            if (present) {
                res = true;
                duplicate.classList.remove('hidden');
                email.parentNode.classList.add('error');
            } else {
                res = false;
                duplicate.classList.add('hidden');
                email.parentNode.classList.remove('error');
            }
        });
    }
}

const email = document.querySelector('#email');
email.addEventListener('blur', checkEmail);

function checkUsername(event)
{
    const invalid = document.querySelector('#invalid-username');
    var exp = /^[a-z0-9_\.]+$/;
    if (!username.value.match(exp) && username.value.length != 0) {
        invalid.classList.remove('hidden');
        username.parentNode.classList.add('error');
        event.preventDefault();
        return;
    } else {
        invalid.classList.add('hidden');
        username.parentNode.classList.remove('error');
    }
    if (username.value.length != 0) {
        const duplicate = document.querySelector('#duplicate-username');
        fetch("check_username.php?q=" + username.value)
        .then(onResponse)
        .then(present => {
            if (present) {
                res = true;
                duplicate.classList.remove('hidden');
                username.parentNode.classList.add('error');
            } else {
                res = false;
                duplicate.classList.add('hidden');
                username.parentNode.classList.remove('error');
            }
        });
    }
}

const username = document.querySelector('#username');
username.addEventListener('blur', checkUsername);

function checkPassword(event)
{
    const error = document.querySelector('#password-error');
    var exp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
    if (!password.value.match(exp) && password.value.length != 0) {
        error.classList.remove('hidden');
        password.parentNode.classList.add('error');
        event.preventDefault();
    } else {
        error.classList.add('hidden');
        password.parentNode.classList.remove('error');
    }
}

const password = document.querySelector('#password');
password.addEventListener('blur', checkPassword);

function checkConfirmPassword(event)
{
    const error = document.querySelector('#confirm-password-error')
    if (signup_form['signup_password'].value != signup_form['confirm_password'].value &&
        signup_form['confirm_password'].value.length != 0) {
        error.classList.remove('hidden');
        signup_form['confirm_password'].parentNode.classList.add('error');
        event.preventDefault();
    } else {
        error.classList.add('hidden');
        signup_form['confirm_password'].parentNode.classList.remove('error');
    }
}

const confirm_password = document.querySelector('#confirm-password');
confirm_password.addEventListener('blur', checkConfirmPassword);