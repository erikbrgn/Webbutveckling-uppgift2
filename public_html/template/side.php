<?php $side_content = get_side_content(); ?>
<div class="side">
<?php 
        if(isset($side_content)) {
            echo strip($side_content['content']);
        }
        ?>
</div>