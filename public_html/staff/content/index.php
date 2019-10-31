<?php 
require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {
    switch ($_POST['action']) {

    case 'edit' :
    $content['section_id'] = $_POST['section_id'];
    $content['area_name'] = $_POST['area_name'] ?? '';
    $content['visible'] = $_POST['visible'] ?? '';
    $content['content'] = $_POST['content'] ?? '';

    $result = update_content($content);
    if ($result === true) {
        $errors[0] = "Innehållet har uppdaterats";
        unset($content);
    } elseif ($result === false) {
        $errors[0] = 'Oväntat fel'; 
    } else {
        $errors[0] = $result;
    }
        break;
    }
}

$content_set = get_all_content();

if(!isset($_GET['id'])) {
    $message = 'Inget innehåll visas för tillfället.';
} else {
    $id = $_GET['id'];
    $content = get_content_by_id($id);
}

?>

<?php $page_title = "Innehåll"; ?>
<?php include( SHARED_PATH . '/staff_header.php');?>
<div class="staff-wrapper">
    <?php include( SHARED_PATH . '/staff_nav.php'); ?>
    <div class="staff-content">
        <div class="message-container">
            <?php if (!empty($errors)) { ?>
            <div class="alert alert-warning alert-dismissible <?php echo 'show fade';?>" role="alert">
                <?php foreach($errors as $value) { echo $value;}?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
        </div>
        <div class="block-1">
            <h1 class="brand-title">Innehåll</h1>
        </div>
        <div class="block-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Namn</th>
                        <th>Synlig</th>
                        <th>Innehåll</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($content_set)) { foreach($content_set as $row) { ?>
                    <tr>
                        <td><?php echo h($row['section_id']);?></td>
                        <td><?php echo h($row['area_name']);?></td>
                        <td><?php if (h($row['visible'])== 0) {echo 'Nej';} else { echo 'Ja';}?></td>
                        <td><?php echo h($row['content']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/content/index.php?id=' . h(u($row['section_id']))); ?>">Edit</a>
                        </td>
                    </tr>
                    <?php } }?>
                </tbody>

            </table>

        </div>
        <div class="block-full">
            <?php if(isset($content)) { ?>
            <form id='content_edit_form' action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="section_id" value="<?php echo $content['section_id'];?>">
                <div class="form-field input">
                    <label class="field-label" for="area_name">Namn</label>
                    <input type="text" value="<?php echo h($content['area_name']);?>" name="area_name" required
                        pattern="^[^\d]+$">
                </div>
                <div class="form-field select">
                    <label class="field-label" for="visible">Synlig</label>
                    <select name="visible" id="visible" required size=>
                        <option value="<?php echo 0; ?>" <?php if($content['visible'] == 0) { ?> selected <?php } ?>>Nej
                        </option>
                        <option value="<?php echo 1; ?>" <?php if($content['visible'] == 1) { ?> selected <?php } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="form-field">
                    <textarea name="content" id="content" cols="30"
                        rows="10"><?php echo h($content['content']); ?></textarea>
                </div>
                <script>
                    CKEDITOR.replace('content');
                </script>
                <div class="d-flex">
                    <input id="view_submit" type="submit" value="Spara">
                </div>
            </form>
            <?php } else {?>
            <h2 class="mt-2"><?php echo $message; ?></h2>
            <?php } ?>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>