let logoutBtn = document.getElementById('logout');
let likeIcon = document.getElementById('like-icon');
let post = document.getElementById('post');
let likeCount = document.getElementById('like-count');
let commentCount = document.getElementById('comment-count');
let likeUrl;

function checkSession() {
    let sessionResponse = function(data) {
        let userAvatar = document.getElementById('header-user-avatar');
        let userName = document.getElementById('header-user-name');
        data = JSON.parse(data);
        if (data['username'] === 'none') {
            userAvatar.style.display = 'none';
            userName.style.display = 'none';
            logoutBtn.style.display = 'none';
            likeIcon.style.display = 'none';
        }
        else {
            userAvatar.style.display = 'block';
            userAvatar.style.content = "url(" + data['avatar'] + ")";
            userName.style.display = 'block';
            userName.innerHTML = data['username'];
            logoutBtn.style.display = 'block';
            likeIcon.style.display = 'block';
        }
    };
    ajaxTemplate('POST', 'account/session', null, sessionResponse);
}

function checkLikesAndComments() {
    let countResponse = function(data) {
        data = JSON.parse(data);
        likeCount.innerHTML = data['likes'];
        commentCount.innerHTML = data['comments'];
        if (data['session_user'] !== undefined) {
            if (data['session_user'] == true) {
                likeIcon.style.content = "url(public/resource/like-active.png)";
                likeUrl = "url(public/resource/like-active.png)";
            }
            else {
                likeIcon.style.content = "url(public/resource/like.png)";
                likeUrl = "url(public/resource/like.png)";
            }
        }
        console.log(data);
    }
    let json = {};
    json['id'] = post.getAttribute('data-id');
    json = JSON.stringify(json);
    ajaxTemplate('POST', 'post/count', json, countResponse);
}

likeIcon.onmouseover = function() {
    likeIcon.style.content = "url(public/resource/like-hover.png)";
}

likeIcon.onmouseout = function() {
    likeIcon.style.content = likeUrl;
}

likeIcon.onclick = function() {
    let likeResponse = function() {
        checkLikesAndComments();
    }
    let json = {};
    json['id'] = post.getAttribute('data-id');
    json = JSON.stringify(json);
    ajaxTemplate('POST', 'post/like', json, likeResponse);
}

logoutBtn.onclick = function() {
    this.blur();
    ajaxTemplate('POST', '/account/logout', null, checkSession);
}

checkSession();
checkLikesAndComments();