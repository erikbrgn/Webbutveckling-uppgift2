<?php include 'template/head-tag-content.php';?>
<div class="login-wrapper">
    <?php include 'template/nav.php';?>
    <div class="login-container">
        <form class="login-form" id="login" action="backend/admin.php?action=login" method="post">
            <legend>Login</legend>
            <div class="form-field input">
                <label class="field-label" for="username">Username</label>
                <input type="text" name="username" id="username" value required maxlength="20">
            </div>
            <div class="form-field input">
                <label class="field-label" for="password">Password</label>
                <input type="password" name="password" id="password" value name="password" required maxlength="20">
            </div>
            <input type="hidden" name="login" value="true">
            <input type="submit" value="login">

        </form>
    </div>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/resources.php';?>