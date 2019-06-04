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

let btnToMain = document.getElementById('btn-to-main');
let btnLogout = document.getElementById('btn-logout');

btnToMain.onclick = function() {
    this.blur();
    location = "/";
}

btnLogout.onclick = function() {
    this.blur();
    ajaxTemplate('POST', '/account/logout', null, null);
    location = "/";
}

checkSession();