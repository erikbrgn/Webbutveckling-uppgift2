<?php require_once("../../private/initialize.php"); 
    require_login();
?>

<?php $page_title = "Staff Menu"; ?>
<?php include( SHARED_PATH . '/staff_header.php');?>
<div class="staff-wrapper">
    <?php include( SHARED_PATH . '/staff_nav.php');?>
    <div class="staff-content">
        <div class="message-container">
            <h1 class="brand-title mb-3">Karnevalpersonal</h1>
            <h2>Välkommen till dashboarden, <?php echo $_SESSION['username'];?></h2>
        </div>
        <div class="recent-activity">
            <p><em>Det finns inget att se för tillfället.</em></p>
        </div>
    </div>
    <?php include(SHARED_PATH . '/staff_footer.php'); ?>