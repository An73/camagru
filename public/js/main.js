function signButton() {
    let signUpButton = document.getElementById('sign-up-id');
    let signInButton = document.getElementById('sign-in-id');
    let signUpError = document.getElementById('error-signup');
    let signInError = document.getElementById('error-signin');

    signUpButton.onclick = function() {
        this.blur();
        signUpError.style.display = 'none';
        modalWindow('modal-signup');
    }
    signInButton.onclick = function() {
        this.blur();
        signInError.style.display = 'none';
        modalWindow('modal-signin');
    }
}

function checkSession() {
    let sessionResponse = function(data) {
        let signModul = document.getElementById('header-sign');
        let sessionModul = document.getElementById('header-session');
        let avatar = document.getElementById('header-user-avatar');
        let username = document.getElementById('header-user-name');
        console.log(data);
        data = JSON.parse(data);
        if (data['username'] === 'none') {
            signModul.style.display = 'flex';
            sessionModul.style.display = 'none';
            avatar.style.display = 'none';
            username.style.display = 'none';
        }
        else {
            signModul.style.display = 'none';
            sessionModul.style.display = 'flex';
            avatar.style.display = 'block';
            avatar.style.content = "url(" + data['avatar'] + ")";
            username.innerHTML = data['username'];
            username.style.display = 'block';
        }
    };
    ajaxTemplate('POST', 'account/session', null, sessionResponse);
}

let signupResponse = function (data) {
    let signUpError = document.getElementById('error-signup');
    let modalSignUp = document.getElementById('modal-signup');
    if (data !== 'OK') {
        signUpError.style.display = 'block';
        signUpError.innerHTML = data;
    }
    else {
        modalSignUp.style.display = 'none';
        modalWindow('modal-confirm-email');
    }
}

let signinResponse = function(data) {
    let signInError = document.getElementById('error-signin');
    let modalSignIn = document.getElementById('modal-signin');
    if (data !== 'OK') {
        signInError.style.display = 'block';
        signInError.innerHTML = data;
    }
    else {
        modalSignIn.style.display = 'none';
        checkSession();
    }
}


let submitSignUp = document.getElementById('submit-signup');
let submitSignIn = document.getElementById('submit-signin');
let logOutButton = document.getElementById('logout');
let editProfileButton = document.getElementById('edit-profile');
let avatar = document.getElementById('header-user-avatar');
let username = document.getElementById('header-user-name');

submitSignUp.onclick = function(event) {
    event.preventDefault();
    this.blur();
    let signUpError = document.getElementById('error-signup');
    signUpError.style.display = 'none';
    let formData = new FormData(document.getElementById('form-signup'));
    let json = {};
    formData.forEach(function(value, key){
        json[key] = value;
    });
    json = JSON.stringify(json);
    ajaxTemplate('POST', '/account/signup', json, signupResponse);
    console.log(json);
}

submitSignIn.onclick = function(event) {
    event.preventDefault();
    this.blur();
    let signInError = document.getElementById('error-signin');
    signInError.style.display = 'none';
    let formData = new FormData(document.getElementById('form-signin'));
    let json = {};
    formData.forEach(function(value, key){
        json[key] = value;
    });
    json = JSON.stringify(json);
    ajaxTemplate('POST', '/account/signin', json, signinResponse);
}

logOutButton.onclick = function(event) {
    event.preventDefault();
    this.blur();
    ajaxTemplate('POST', '/account/logout', null, checkSession);
}

editProfileButton.onclick = function() {
    this.blur();
    location = "/account/edit/";
}

avatar.onclick = function() {
    this.blur();
    location = "/account/edit/";
}

username.onclick = function() {
    this.blur();
    location = "/account/edit/";
}

checkSession();
signButton();