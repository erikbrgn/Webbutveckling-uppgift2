<div class="hamburger-container">
    <button id="hamburger" class="hamburger hamburger--squeeze" type="button">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button>
</div>
<div id="link-container" class="staff-nav">
    <div class="brand-container">
        <h2 class="mb-4">Menu</h2>
    </div>
    <ul>
        <li><a href="<?php echo url_for('/staff/content/index.php');?>">Sidinnehåll</a></li>
        <li><a href="<?php echo url_for('/staff/karnevalister/index.php');?>">Karnevalister</a></li>
        <li><a href="<?php echo url_for('/staff/sektioner/index.php');?>">Sektioner</a></li>
        <li><a href="<?php echo url_for('/staff/faq/index.php');?>">FAQ</a></li>
        <li><a href="<?php echo url_for('/staff/users/index.php');?>">Evenemang</a></li>
        <li><a href="<?php echo url_for('/staff/users/index.php');?>">Användare</a></li>
    </ul>

    <div class="logout-container">
        <a class="logout" href="<?php echo url_for('/staff/logout.php'); ?>">Logout&nbsp;<img class="logout-icon"
                src="<?php echo url_for('assets/img/log-out.png'); ?>"></a>
    </div>

</div>