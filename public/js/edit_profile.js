function checkSession() {
    let sessionResponse = function(data) {
        let username = document.getElementById('user-name');
        let avatar = document.getElementById('avatar');
        data = JSON.parse(data);
        if (data['username'] !== 'none') {
            username.innerHTML = data['username'];
            avatar.style.content = "url(" + data['avatar'] + ")";
        }
    }
    ajaxTemplate('POST', '/account/session', null, sessionResponse);
}

let mainDisplay = document.getElementById('main-display');
let btnToMain = document.getElementById('btn-to-main');
let btnLogout = document.getElementById('btn-logout');
let btnEditName = document.getElementById('btn-edit-name');
let btnBack = document.getElementsByClassName('button-back')[0];
let editNameDisplay = document.getElementById('edit-name-display');

btnToMain.onclick = function() {
    this.blur();
    location = "/";
}

btnLogout.onclick = function() {
    this.blur();
    ajaxTemplate('POST', '/account/logout', null, null);
    location = "/";
}

btnBack.onclick = function() {
    this.blur();
    editNameDisplay.style.display = 'none';
    mainDisplay.style.display = 'flex';
}

btnEditName.onclick = function() {
    this.blur();
    mainDisplay.style.display = 'none';
    editNameDisplay.style.display = 'flex';
}

checkSession();