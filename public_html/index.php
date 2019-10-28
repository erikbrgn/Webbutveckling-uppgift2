<?php include 'template/head-tag-content.php';?>
<?php $main_content = get_main_content(); ?>
<div class="wrapper">
    <?php include 'template/nav.php';?>
    <?php include 'template/header.php';?>
    <?php include 'template/section.php';?>
    <div class="main d-flex flex-column">
        <?php 
        if(isset($main_content)) {
            echo strip($main_content['content']);
        }
        ?>
        <div class="mt-auto"><small><em>Senast uppdaterad <?php echo h($main_content['updated_on']);?></em></small></div>
    </div>
    <?php include 'template/side.php';?>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/lightbox.php';?>
<?php include 'template/resources.php';?>