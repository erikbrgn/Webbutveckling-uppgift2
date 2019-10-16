<?php include 'template/head-tag-content.php';?>
<div class="wrapper">
    <div id="adminHeader">
        <h2>Widget News Admin</h2>
        <p>You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. <a
                href="admin.php?action=logout" ?>Log out</a></p>

        <?php if (!is_writable(session_save_path())) {
  print 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}?>
    </div>

</div>
<?php include 'template/resources.php';?>