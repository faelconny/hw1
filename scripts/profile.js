function onResponse(response)
{
    return response.json();
}

function onSubmit(event)
{
    const error = document.querySelector('#empty-error');
    if (form['old-password'].value.length == 0 ||
        form['new-password'].value.length == 0 ||
        form['confirm-password'].value.length == 0) {
        event.preventDefault();
        error.classList.remove('hidden');
    } else {
        error.classList.add('hidden');
    }
    checkPassword(event);
    checkConfirmPassword(event);
}

const form = document.forms['change-password'];
form.addEventListener('submit', onSubmit);

function checkPassword(event)
{
    const error = document.querySelector('#password-error');
    var exp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;
    if (!new_password.value.match(exp) && new_password.value.length != 0) {
        error.classList.remove('hidden');
        event.preventDefault();
    } else {
        error.classList.add('hidden');
    }
}

const new_password = document.querySelector('#new-password');
new_password.addEventListener('blur', checkPassword);

function checkConfirmPassword(event)
{
    const error = document.querySelector('#confirm-password-error');
    if (new_password.value != confirm_password.value &&
        confirm_password.value.length != 0) {
        error.classList.remove('hidden');
        event.preventDefault();
    } else {
        error.classList.add('hidden');
    }
}

const confirm_password = document.querySelector('#confirm-password');
confirm_password.addEventListener('blur', checkConfirmPassword);

function onMenuClick(event)
{
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.add('open');
    close_area.classList.remove('hidden');
    const page = document.querySelector('.page');
    page.classList.add('opacity');
}

const menu = document.querySelector('#menu');
menu.addEventListener('click', onMenuClick);

function onCloseSidebar(event)
{
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.remove('open');
    close_area.classList.add('hidden');
    const page = document.querySelector('.page');
    page.classList.remove('opacity');
}

const close_img = document.querySelector('.sidebar img');
close_img.addEventListener('click', onCloseSidebar);

const close_area = document.querySelector('.close-sidebar');
close_area.addEventListener('click', onCloseSidebar);