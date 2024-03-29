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
let btnEditPasswd = document.getElementById('btn-edit-passwd');
let btnEditEmail = document.getElementById('btn-edit-email');
let btnEditAvatar = document.getElementById('btn-edit-avatar');
let btnEditNotification = document.getElementById('btn-edit-notification');

let editNameDisplay = document.getElementById('edit-name-display');
let btnSubmitEditName = document.getElementById('submit-edit-username');
let btnBackName = document.getElementById('button-back-name');

let editPasswdDisplay = document.getElementById('edit-passwd-display');
let btnBackPasswd = document.getElementById('button-back-passwd');
let btnSubmitEditPasswd = document.getElementById('submit-edit-passwd');

let editEmailDisplay = document.getElementById('edit-email-display');
let btnBackEmail = document.getElementById('button-back-email');
let btnSubmitEditEmail = document.getElementById('submit-edit-email');

let editAvatarDisplay = document.getElementById('edit-avatar-display');
let btnSubmitEditAvatar = document.getElementById('submit-edit-avatar');
let btnBackAvatar = document.getElementById('button-back-avatar');

let editNotificationDisplay = document.getElementById('edit-notification-display');
let btnSendEditNotification = document.getElementById('button-edit-notification');
let btnBackNotification = document.getElementById('button-back-notification');
let notificationInfo = document.getElementById('notification-info');

let editNameResponse = function(data) {
    let errorModal = document.getElementById('error-modal-name');
    if (data === 'OK') {
        checkSession();
        editNameDisplay.style.display = 'none';
        mainDisplay.style.display = 'flex';
    }
    else {
        errorModal.style.display = 'block';
        errorModal.innerHTML = data;
    }
}

btnToMain.onclick = function() {
    this.blur();
    location = "/";
}

btnLogout.onclick = function() {
    this.blur();
    ajaxTemplate('POST', '/account/logout', null, null);
    location = "/";
}

btnBackName.onclick = function() {
    this.blur();
    editNameDisplay.style.display = 'none';
    mainDisplay.style.display = 'flex';
}

btnEditName.onclick = function() {
    let errorModal = document.getElementById('error-modal-name');
    this.blur();
    errorModal.style.display = 'none';
    mainDisplay.style.display = 'none';
    editNameDisplay.style.display = 'flex';

}

btnSubmitEditName.onclick = function(event) {
    let input = document.getElementById('input-edit-name');
    let errorModal = document.getElementById('error-modal-name');
    errorModal.style.display = 'none';
    event.preventDefault();
    this.blur();

    let json = {};
    json['newUsername'] = input.value;
    json = JSON.stringify(json);
    ajaxTemplate('POST', '/account/editname', json, editNameResponse);
}




btnEditPasswd.onclick = function() {
    let errorModal = document.getElementById('error-modal-passwd');
    let content = document.getElementById('content-edit-password');
    this.blur();
    content.style.height = '420px';
    errorModal.style.display = 'none';
    mainDisplay.style.display = 'none';
    editPasswdDisplay.style.display = 'flex';
}

btnBackPasswd.onclick = function() {
    this.blur();
    editPasswdDisplay.style.display = 'none';
    mainDisplay.style.display = 'flex';
}

let editPasswdResponse = function(data) {
    let errorModal = document.getElementById('error-modal-passwd');
    let content = document.getElementById('content-edit-password');
    if (data === 'OK') {
        editPasswdDisplay.style.display = 'none';
        mainDisplay.style.display = 'flex';
    }
    else {
        errorModal.style.display = 'block';
        content.style.height = '370px';
        errorModal.innerHTML = data;
    }
}

btnSubmitEditPasswd.onclick = function(event) {
    let inputPasswd  = document.getElementById('input-edit-passwd');
    let inputNewPasswd1 = document.getElementById('input-edit-passwd1');
    let inputNewPasswd2 = document.getElementById('input-edit-passwd2');
    event.preventDefault();
    let json = {};
    json['passwd'] = inputPasswd.value;
    json['newPasswd1'] = inputNewPasswd1.value;
    json['newPasswd2'] = inputNewPasswd2.value;
    json = JSON.stringify(json);
    ajaxTemplate('POST', '/account/editpasswd', json, editPasswdResponse);
}


btnEditEmail.onclick = function() {
    let errorModal = document.getElementById('error-modal-email');
    this.blur();
    errorModal.style.display = 'none';
    mainDisplay.style.display = 'none';
    editEmailDisplay.style.display = 'flex';
}

btnBackEmail.onclick = function() {
    this.blur();
    editEmailDisplay.style.display = 'none';
    mainDisplay.style.display = 'flex';
}

let editEmailResponse = function(data) {
    let errorModal = document.getElementById('error-modal-email');
    if (data === 'OK') {
        editEmailDisplay.style.display = 'none';
        mainDisplay.style.display = 'flex';
    }
    else {
        errorModal.style.display = 'block';
        errorModal.innerHTML = data;
    }
}

btnSubmitEditEmail.onclick = function(event) {
    let inputEmail = document.getElementById('input-edit-email');
    event.preventDefault();
    let json = {};
    json['newEmail'] = inputEmail.value;
    json = JSON.stringify(json);
    ajaxTemplate('POST', '/account/editemail', json, editEmailResponse);
}



btnEditAvatar.onclick = function() {
    let errorModal = document.getElementById('error-modal-avatar');
    this.blur();
    errorModal.style.display = 'none';
    mainDisplay.style.display = 'none';
    editAvatarDisplay.style.display = 'flex';
}

btnBackAvatar.onclick = function() {
    this.blur();
    editAvatarDisplay.style.display = 'none';
    mainDisplay.style.display = 'flex';
}

btnEditNotification.onclick = function() {
    this.blur();
    mainDisplay.style.display = 'none';
    editNotificationDisplay.style.display = 'flex';

    let notificationResponse = function(data) {
        notificationInfo.innerHTML = 'Notification: ' + data;
    }
    ajaxTemplate('POST', '/account/notinfo', null, notificationResponse);
}


btnSendEditNotification.onclick = function() {
    this.blur();

    let notificationResponse = function(data) {
        notificationInfo.innerHTML = 'Notification: ' + data;
    }
    ajaxTemplate('POST', '/account/editnot', null, notificationResponse);
}

btnBackNotification.onclick = function() {
    this.blur();
    editNotificationDisplay.style.display = 'none';
    mainDisplay.style.display = 'flex';
}

checkSession();