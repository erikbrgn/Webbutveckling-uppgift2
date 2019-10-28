<?php 
require_once('../../../private/initialize.php');

require_login();

$errors = [];

if(is_post_request()) {
    switch ($_POST['action']) {

        case 'search' :
            $id = $_POST['student_id'];
            $result = find_student_by_id($id);
            if ($result === false) {
                $errors[] = 'En student med det personnummret finns inte.';
            } else {
                $student = $result;
            }

        break;
        case 'view' :

        // UPDATE STUDENT
        // DELETE STUDENT

        break;

    }
}





if(!isset($_GET['id'])) {
    $message = 'Ingen student visas för tillfället.';
} else {
    $id = $_GET['id'];
    $student = find_student_by_id($id);
}

$students = get_all_students();

?>

<?php $page_title = "Karnevalister"; ?>
<?php include( SHARED_PATH . '/staff_header.php');?>
<div class="staff-wrapper">
    <?php include( SHARED_PATH . '/staff_nav.php'); ?>
    <div class="staff-content">
        <div class="message-container">
            <?php if (!empty($errors)) { ?>
            <div class="alert alert-warning alert-dismissible <?php echo 'show fade';?>" role="alert">
                <?php foreach($errors as $error) { echo $error;}?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
        </div>
        <div class="block-1">
            <h1 class="brand-title">Karnevalister</h1>
        </div>
        <div class="block-2">
            <form class="search-form" action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="action" value="search">
                <div class="form-field input">
                    <input placeholder="Personnummer" type="text" value name="student_id" required
                        pattern="^([0-9][0-9])((0[1-9])|(1[0-2]))(0[1-9]|[12][0-9]|3[01])-?([0-9][0-9][0-9][0-9])">
                </div>
                <input type="submit" value="Sök">
            </form>
        </div>
        <div class="block-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Personnummer</th>
                        <th>Förnamn</th>
                        <th>Efternamn</th>
                        <th>E-mail</th>
                        <th>Telefonnummer</th>
                        <th>Sektion</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $student_row) { ?>
                    <tr>
                        <td><?php echo h($student_row['student_id']);?></td>
                        <td><?php echo h($student_row['student_first_name']);?></td>
                        <td><?php echo h($student_row['student_surname']);?></td>
                        <td><?php echo h($student_row['student_email']);?></td>
                        <td><?php echo h($student_row['student_phone_number']);?></td>
                        <td><?php echo h($student_row['section_name']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/karnevalister/index.php?id=' . h(u($student_row['student_id']))); ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
        <div class="block-4">
            <?php if(!is_blank($student['student_id'])) { ?>
            <form id='form' action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="action" value="view">
                <input type="hidden" name="id" value="<?php echo $student['student_id'];?>">
                <div class="form-field select">
                    <label class="field-label" for="view_action">Vad vill du göra med
                        "<?php echo $student['student_first_name'] ." " . $student['student_surname']; ?>"?</label>
                    <select name="view_action" id="action" required size=>
                        <option value></option>
                        <option value="1">Ändra</option>
                        <option value="2">Ta bort</option>
                    </select>
                </div>
                <div class="form-field select visually-hidden">
                    <label class="field-label" for="section">Önskad sektion</label>
                    <select name="section" required size=>
                        <option value selected></option>
                        <option value="<?php echo 1; ?>" <?php if($student['section_id'] == 1) { ?> selected
                            <?php } ?>>Administer IT</option>
                        <option value="<?php echo 2; ?>" <?php if($student['section_id'] == 2) { ?> selected
                            <?php } ?>>Biljonsen</option>
                        <option value="<?php echo 3; ?>" <?php if($student['section_id'] == 3) { ?> selected
                            <?php } ?>>Blädderiet</option>
                        <option value="<?php echo 4; ?>" <?php if($student['section_id'] == 4) { ?> selected
                            <?php } ?>>Dansen</option>
                        <option value="<?php echo 5; ?>" <?php if($student['section_id'] == 5) { ?> selected
                            <?php } ?>>Nöjen</option>
                        <option value="<?php echo 6; ?>" <?php if($student['section_id'] == 6) { ?> selected
                            <?php } ?>>Tåget</option>
                    </select>
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="student_id">Personnummer ex. 941121-xxxx</label>
                    <input type="text" value="<?php echo h($student['student_id']);?>" name="student_id" required
                        pattern="^([0-9][0-9])((0[1-9])|(1[0-2]))(0[1-9]|[12][0-9]|3[01])-?([0-9][0-9][0-9][0-9])">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="first_name">Förnamn</label>
                    <input type="text" value="<?php echo h($student['student_first_name']);?>" name="first_name"
                        required pattern="^[^\d]+$">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="last_name">Efternamn</label>
                    <input type="text" value="<?php echo h($student['student_surname']);?>" name="last_name" required
                        pattern="^[^\d]+$">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="email">E-mail</label>
                    <input type="email" value="<?php echo h($student['student_email']);?>" name="email" required>
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="telephone_number">Telefonnummer</label>
                    <input type="tel" value="<?php echo h($student['student_phone_number']);?>" name="telephone_number"
                        required minlength="8" maxlength="10">
                </div>
                <input type="submit" value="Ansök">
            </form>
            <?php } else {?>
            <h2 class="mt-2"><?php echo $message; ?></h2>
            <?php } ?>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>