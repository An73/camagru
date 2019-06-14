let logoutBtn = document.getElementById('logout');
let likeIcon = document.getElementById('like-icon');
let post = document.getElementById('post');
let likeCount = document.getElementById('like-count');
let commentCount = document.getElementById('comment-count');
let likeUrl;
let commentsBlock = document.getElementById('comments');
let submitComment = document.getElementById('submit-comment');
let toMainBtn = document.getElementById('to-main');

function checkSession() {
    let sessionResponse = function(data) {
        let userAvatar = document.getElementById('header-user-avatar');
        let userName = document.getElementById('header-user-name');
        let newCommentDiv = document.getElementById('new-comment-div');
        data = JSON.parse(data);
        if (data['username'] === 'none') {
            userAvatar.style.display = 'none';
            userName.style.display = 'none';
            logoutBtn.style.display = 'none';
            likeIcon.style.display = 'none';
            newCommentDiv.style.display = 'none';
        }
        else {
            userAvatar.style.display = 'block';
            userAvatar.style.content = "url(" + data['avatar'] + ")";
            userName.style.display = 'block';
            userName.innerHTML = data['username'];
            logoutBtn.style.display = 'block';
            likeIcon.style.display = 'block';
            newCommentDiv.style.display = 'flex';
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

function checkComments() {
    comments.innerHTML = '';
    let displayComments = function(data) {
        data = JSON.parse(data);
        data.forEach(element => {
            let commentDivElement = document.createElement('div');
            commentDivElement.className = 'comment-div';
            comments.appendChild(commentDivElement);
            let userCommentElement = document.createElement('div');
            userCommentElement.className = 'user-comment';
            userCommentElement.innerHTML = element['Username'];
            
            let commentElement = document.createElement('div');
            commentElement.className = 'comment';
            commentElement.innerHTML = element['Comment'];

            commentDivElement.appendChild(userCommentElement);
            commentDivElement.appendChild(commentElement);
        });
    }
    let json = {};
    json['id'] = post.getAttribute('data-id');
    json = JSON.stringify(json);
    ajaxTemplate('POST', 'post/comments', json, displayComments);
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

toMainBtn.onclick = function() {
    this.blur();
    location = "/";
}

submitComment.onclick = function() {

    let countResponse = function(data) {
        data = JSON.parse(data);
        commentCount.innerHTML = data['comments'];
    }

    this.blur();
    let newComment = document.getElementById('new-comment');
    let json = {};
    json['id'] = post.getAttribute('data-id');
    json['comment'] = newComment.value;
    json = JSON.stringify(json);
    ajaxTemplate('POST', 'post/newcomment', json, countResponse);
    newComment.value = '';
    location = "/post?idpost=" + post.getAttribute('data-id');
}

checkSession();
checkComments();
checkLikesAndComments();