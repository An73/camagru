function signButton() {
    let signUpButton = document.getElementById('sign-up-id');
    let signInButton = document.getElementById('sign-in-id');

    signUpButton.onclick = function() {
        this.blur();
        modalWindow('modal-signup');
    }
    signInButton.onclick = function() {
        this.blur();
        modalWindow('modal-signin');
    }
}
let submitSignUp = document.getElementById('submit-signup');

submitSignUp.onclick = function(event) {
    event.preventDefault();
    this.blur();
    let formData = new FormData(document.getElementById('form-signup'));
    let json = {};
    formData.forEach(function(value, key){
        json[key] = value;
    });
    json = JSON.stringify(json);
    ajaxTemplate('POST', '/account/signup', json, null);
    console.log(json);
}

signButton();