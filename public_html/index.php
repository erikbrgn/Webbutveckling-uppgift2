<?php require_once('../private/initialize.php'); ?>
<?php $main_content = get_main_content(); ?>
<?php include 'template/head-tag-content.php';?>
<div class="wrapper">
    <?php include 'template/nav.php';?>
    <?php include 'template/header.php';?>
    <?php include 'template/section.php';?>
    <div class="main">
        <?php 
        if(isset($main_content)) {
            echo strip($main_content);
        }
        ?>
    </div>
    <?php include 'template/side.php';?>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/lightbox.php';?>
<?php include 'template/resources.php';?>