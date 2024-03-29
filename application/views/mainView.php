<div id="modal-signup">
			<div class="modal-signup-content">
                <div class="header-signup-modal">Sign Up</div>
                <div id="error-signup" class="error-signup-modal">This email is busy</div>
                <form id="form-signup" class="form-signup-modal" name="signup">
                    <input class="input-signup-modal" required autocomplete="off" type="email" name="email" placeholder="Email">
                    <input class="input-signup-modal" required autocomplete="off" type="text" name="username" placeholder="Username">
                    <input class="input-signup-modal" required autocomplete="off" type="password" name="passwd1" placeholder="Password">
                    <input class="input-signup-modal" required autocomplete="off" type="password" name="passwd2" placeholder="Password">
                    <input id="submit-signup" class="submit-signup-modal" type="submit" value="Sign Up">
                </form>
            </div>
</div>

<div id="modal-confirm-email">
    <div class="message-confirm">You should confirm his account via a unique link sent at the you email address
    </div>
</div>

<div id="modal-signin">
			<div class="modal-signup-content">
                <div class="header-signup-modal">Sign In</div>
                <div id="error-signin" class="error-signup-modal"></div>
                <form id="form-signin" class="form-signup-modal">
                    <input class="input-signup-modal" required autocomplete="off" type="text" name="username" placeholder="Username">
                    <input class="input-signup-modal" required autocomplete="off" type="password" name="passwd" placeholder="Password">
                    <input id="submit-signin" class="submit-signup-modal" type="submit" value="Sign In">
                </form>
                <button id="forgot-passwd-btn" class="submit-signup-modal">I forgot password</button>
            </div>
</div>

<div id="modal-resend-email">
    <div class="message-confirm">A new password has been sent to your email</div>
</div>

<div id="modal-resend-passwd">
    <div class="modal-signup-content">
        <div class="header-signup-modal">Resend Password</div>
        <div id="error-resend" class="error-signup-modal"></div>
        <form id="form-resend" class="form-signup-modal">
            <input class="input-signup-modal" required autocomplete="off" type="email" name="email" placeholder="Email">
            <input id="submit-resend" class="submit-signup-modal" type="submit" value="Resend Password">
        </form>
    </div>
</div>


<header>
    <div class="header-user">
        <div id="header-user-avatar" class="header-user-avatar"></div>
        <div id="header-user-name" class="header-user-name">Username</div>
    </div>
    <div class="header-logo">Camagru</div>
    <div id="header-sign" class="header-sign">
        <button class="header-button" id="sign-up-id">Sign Up</button>
        <button class="header-button" id="sign-in-id">Sign In</button>
    </div>
    <div id="header-session" class="header-session">
        <button class="header-button" id="logout">Log Out</button>
        <button class="header-button" id="edit-profile">Edit Profile</button>
        <button class="header-button" id="shot-btn">Shot</button>
    </div>
</header>
<div class="photo-place">
    <?php foreach ($posts as $val): ?>
        <div class="post" tabindex="0">
            <img width="300" height="225" 
                src="<?php echo 'public/resource/posts/' . $val['Post'] ?>" 
                data-id="<?php echo $val['ID']?>">
        </div>
    <?php endforeach; ?>
</div>