<?php 
require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

    switch ($_POST['action']) {

        case 'send_email' :
            $id = $_POST['section_id'];
            $email['subject'] = $_POST['subject'];
            $email['message'] = $_POST['email'];
            $result = compose_email($id, $email);
            if ($result === false) {
                $errors[] = 'E-mailet kunde inte skickas.';
            } elseif ($result === true) {
                $errors[] = "E-mailet har skickats.";
            }

        break;
    }

}

if(!isset($_GET['id'])) {
    $message = 'Ingen sektion visas för tillfället.';
} else {
    $id = $_GET['id'];
    $find_section = find_section($id);
    $section_students = find_section_students($id);
}

$sections = get_all_sections();
?>
<?php $page_title = "Sektioner"; ?>
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
            <h1 class="brand-title">Sektioner</h1>
        </div>
        <div class="block-2">

        </div>
        <div class="block-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Namn</th>
                        <th>Antal platser</th>
                        <th>Lediga platser</th>
                        <th>Beskrivning</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sections as $section) { ?>
                    <tr>
                        <td><?php echo h($section['section_id']);?></td>
                        <td><?php echo h($section['section_name']);?></td>
                        <td><?php echo h($section['max_pos']);?></td>
                        <td><?php echo section_nr_available($section);?></td>
                        <td><?php echo h($section['section_desc']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/sektioner/index.php?id=' . h(u($section['section_id']))); ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="block-full">
            <?php if(empty($section_students)) { ?> <h2 class="mt-2"><?php echo $message; ?></h2><?php }
            else { ?>
            <h3 class="mt-2"><?php echo $find_section['section_name'];?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Personnummer</th>
                        <th>Förnamn</th>
                        <th>Efternamn</th>
                        <th>E-mail</th>
                        <th>Telefonnummer</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($section_students as $student) { ?>
                    <tr>
                        <td><?php echo h($student['student_id']);?></td>
                        <td><?php echo h($student['student_first_name']);?></td>
                        <td><?php echo h($student['student_surname']);?></td>
                        <td><?php echo h($student['student_email']); ?></td>
                        <td><?php echo h($student['student_phone_number']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/karnevalister/index.php?id=' . h(u($student['student_id']))); ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
        <div class="block-full">
            <button class="k-btn k-btn-primary" onclick="toggleComposeEmail();">Mailutskick</button>
            <form id='compose_email' class="float-form visually-hidden" action="<?php echo h($_SERVER['PHP_SELF']); ?>"
                method="post" style="margin-top: 35px;">
                <input type="hidden" name="action" value="send_email">
                <div class="form-field select">
                    <label class="field-label" for="section_id">Sektion</label>
                    <select name="section_id" required size=>
                        <option value selected></option>
                        <option value="<?php echo 1; ?>" <?php if($find_section['section_id'] == 1) { ?> selected
                            <?php } ?>>Administer IT</option>
                        <option value="<?php echo 2; ?>" <?php if($find_section['section_id'] == 2) { ?> selected
                            <?php } ?>>Biljonsen</option>
                        <option value="<?php echo 3; ?>" <?php if($find_section['section_id'] == 3) { ?> selected
                            <?php } ?>>Blädderiet</option>
                        <option value="<?php echo 4; ?>" <?php if($find_section['section_id'] == 4) { ?> selected
                            <?php } ?>>Dansen</option>
                        <option value="<?php echo 5; ?>" <?php if($find_section['section_id'] == 5) { ?> selected
                            <?php } ?>>Nöjen</option>
                        <option value="<?php echo 6; ?>" <?php if($find_section['section_id'] == 6) { ?> selected
                            <?php } ?>>Tåget</option>
                    </select>
                </div>
                <div class="form-field input">
                    <label class="field-label" for="subject">Ämne</label>
                    <input type="text" value name="subject"
                        required maxlength="30">
                </div>
                <div class="form-field textarea ">
                    <textarea name="email" id="content" cols="30" rows="10" required></textarea>
                </div>
                <script>
                    CKEDITOR.replace('content');
                </script>
                <div class="d-flex">
                    <input class="ml-0" type="reset" value="Återställ">
                    <input type="submit" value="Skicka">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="Confirmation" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title">Bekräfta</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Du håller nu på att göra ett mail-utskick till'<?php if (isset($find_section)) {echo $find_section['section_name'];} ?>'. <br><br>
                    Vill du fortsätta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="k-btn k-btn-secondary" data-dismiss="modal">Avbryt</button>
                    <button type="button" class="k-btn k-btn-primary" onclick="sendEmail();">Fortsätt</button>
                </div>
            </div>
        </div>
    </div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>