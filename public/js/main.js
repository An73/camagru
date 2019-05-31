function signButton() {
    let signUpButton = document.getElementById('sign-up-id');
    let signInButton = document.getElementById('sign-in-id');
    let signUpError = document.getElementById('error-signup');

    signUpButton.onclick = function() {
        this.blur();
        signUpError.style.display = 'none';
        modalWindow('modal-signup');
    }
    signInButton.onclick = function() {
        this.blur();
        modalWindow('modal-signin');
    }
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

let submitSignUp = document.getElementById('submit-signup');

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

signButton();