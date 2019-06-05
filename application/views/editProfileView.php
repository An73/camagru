<div id="main-edit">
    <div class="modal-main">
        <div class="area-top-bttns">
            <button id="btn-to-main" class="top-button">To main</button>
            <button id="btn-logout" class="top-button">Logout</button>
        </div>
        <div class="menu-modal">

            <div id="main-display">
                <div class="avatar-side">
                    <div id="avatar" class="avatar"></div>
                    <div id="user-name" class="user-name">Username</div>
                </div>
                <div class="menu-side">
                    <button id="btn-edit-name" class="button-menu">Edit Name</button>
                    <button id="btn-edit-passwd" class="button-menu">Edit Password</button>
                    <button class="button-menu">Edit Email</button>
                    <button class="button-menu">Edit Avatar</button>
                </div>
            </div>

            <div id="edit-name-display">
                <div class="title-display">Edit Name</div>
                <div id="error-modal-name" class="error-modal"></div>
                <div class="content-edit">
                    <input id="input-edit-name" class="input-form" autocomplete="off" type="text" name="username" placeholder="New Username">
                    <input id="submit-edit-username" class="button-menu" type="submit" value="Edit Name">
                    <button id="button-back-name" class="button-back">Back</button>
                </div>
            </div>

            <div id="edit-passwd-display">
                <div class="title-display">Edit Password</div>
                <div id="error-modal-passwd" class="error-modal"></div>
                <div id="content-edit-password" class=content-edit>
                    <input id="input-edit-passwd" class="input-form" autocomplete="off" type="password" name="passwd" placeholder="Your Password">
                    <input id="input-edit-passwd1" class="input-form" autocomplete="off" type="password" name="newPasswd1" placeholder="New Password">
                    <input id="input-edit-passwd2" class="input-form" autocomplete="off" type="password" name="newPasswd2" placeholder="New Password">
                    <input id="submit-edit-passwd" class="button-menu" type="submit" value="Edit Password">
                    <button id="button-back-passwd" class="button-back">Back</button>
                </div>
            </div>

            <div id="edit-email-display">
                <div class="title-display">Edit Email</div>
                <div id="error-modal-email" class="error-modal"></div>
                <div class="content-edit">
                    <input id="input-edit-email" class="input-form" autocomplete="off" type="text" name="email" placeholder="New Email">
                    <input id="submi-edit-email" class="button-menu" type="submit" value="Edit Email">
                    <button id="button-back-email" class="button-back">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>