<header>
    <div class="header-user">
        <div id="header-user-avatar" class="header-user-avatar"></div>
        <div id="header-user-name" class="header-user-name"></div>
    </div>
    <div class="header-logo">Camagru</div>
    <div class="header-tomain">
        <button class="header-button" id="to-main">To Main</button>
        <button class="header-button" id="logout">Log Out</button>
    </div>
</header>

<div id="post" class="post" data-id="<?php echo $post['ID'] ?>">
    <img width="640", height="480"
        src="<?php echo 'public/resource/posts/' . $post['Post'] ?>">
</div>

<style type="text/css">
    .user-avatar-i {
        content: url(<?php echo $post['Avatar'] ?>);
    }         
</style>

<div class="info-block">
    <div class="user-date">
        <div class="user-i">
            <div class="user-avatar-i"></div>
            <div class="user-name-i"><?php echo $post['Username'] ?></div>
        </div>
        <div class="date-i">
            <div class="date-title-i">Date:</div>
            <div class="date-post"><?php echo $post['Dat'] ?></div>
        </div>
    </div>

    <div class="count-likes-comments">
        <div class="likes">
            <div id="like-icon" class="like-icon"></div>
            <div class="like-title">Likes:</div>
            <div id="like-count" class="like-count"></div>
        </div>
        <div class="comments-count">
            <div class="like-title">Comments:</div>
            <div id="comment-count" class="like-count"></div>
        </div>
    </div>
    <div class="new-comment-div">
        <textarea class="input-comment" type=text require autocomplete="off" maxlength="180" placeholder="New Comment"></textarea>
        <button id="submit-comment" class="submit-comment">Submit</button>
    </div>
    <div class="comments">
        <div class="comment-div">
            <div class="user-comment">Cama:</div>
            <div class="comment">ASdas dsf akjsdfl jal kdjasfl jsadfadsfsadf adsf jkdsf kdsh gkdhsfkj ghdfskj ghjksdf hgk</div>
        </div>
        <div class="comment-div">
            <div class="user-comment">Cama:</div>
            <div class="comment">ASdas dsf akjsdfl jal kdjasfl jsadfadsfsadf adsf jkdsf kdsh gkdhsfkj ghdfskj ghjksdf hgk</div>
        </div>
        <div class="comment-div">
            <div class="user-comment">Cama:</div>
            <div class="comment">ASdas dsf akjsdfl jal kdjasfl jsadfadsfsadf adsf jkdsf kdsh gkdhsfkj ghdfskj ghjksdf hgk</div>
        </div>
    </div>
</div>