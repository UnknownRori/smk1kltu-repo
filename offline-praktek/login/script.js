const form = document.querySelector('form');
const usernameError = document.querySelector('#username-error');
const passwordError = document.querySelector('#password-error');
const username = "Sapi";
const password = "Sapi";

form.addEventListener('submit', event => {
    event.preventDefault();

    const formData = new FormData(event.target);

    if (formData.get('username') != username) {
        usernameError.className = "";
    } else {
        usernameError.className = "hidden";
    }

    if (formData.get('password') != password) {
        passwordError.className = "";
    } else {
        passwordError.className = "hidden";
    }
})
