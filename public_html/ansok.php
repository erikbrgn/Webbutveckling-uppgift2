<?php include 'template/head-tag-content.php';?>
<?php 
if (is_post_request()) {
    $student['student_id'] = $_POST['student_id'] ?? '';
    $student['student_email'] = $_POST['email'] ?? '';
    $student['student_first_name'] = $_POST['first_name'] ?? '';
    $student['student_surname'] = $_POST['last_name'] ?? '';
    $student['student_phone_number'] = $_POST['telephone_number'] ?? '';
    $student['student_section'] = $_POST['section'] ?? '';

    $result = register_student($student);

    if ($result === true) {
       $errors[] = "Du har registrerat dig.";
       $student = [];
       $student['student_email'] = '';
        $student['student_first_name'] = '';
        $student['student_surname'] = '';
        $student['student_phone_number'] = '';
        $student['student_section'] = '';
    } else {
        $errors = $result;
    }

} else {
    $student = [];
    $student['student_email'] = '';
    $student['student_first_name'] = '';
    $student['student_surname'] = '';
    $student['student_phone_number'] = '';
    $student['student_section'] = '';
}

?>
<div class="wrapper">
    <?php include 'template/nav.php';?>
    <?php include 'template/header.php';?>
    <div class="message">
        <?php if (!empty($errors)) { ?>
        <div class="alert alert-warning alert-dismissible <?php echo 'show fade';?>" role="alert">
            <?php foreach($errors as $error) { echo $error;}?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } ?>
    </div>
    <?php include 'template/section.php';?>
    <div class="main">
        <h2>Ansök till Kanalkarnevalen</h2>
        <form id="form" method="post" action="<?php echo h($_SERVER['PHP_SELF']); ?>">
            <div class="form-field select">
                <label class="field-label" for="section">Önskad sektion</label>
                <select name="section" required size=>
                    <option value selected></option>
                    <option value="1">Administer IT</option>
                    <option value="2">Biljonsen</option>
                    <option value="3">Blädderiet</option>
                    <option value="4">Dansen</option>
                    <option value="5">Nöjen</option>
                    <option value="6">Tåget</option>
                </select>
            </div>
            <div class="form-field input">
                <label class="field-label" for="student_id">Personnummer ex. 941121-xxxx</label>
                <input type="text" value="<?php echo h($student['student_id']);?>" name="student_id" required
                    pattern="^([0-9][0-9])((0[1-9])|(1[0-2]))(0[1-9]|[12][0-9]|3[01])-?([0-9][0-9][0-9][0-9])">
            </div>
            <div class="form-field input">
                <label class="field-label" for="first_name">Förnamn</label>
                <input type="text" value="<?php echo h($student['student_first_name']);?>" name="first_name" required
                    pattern="^[^\d]+$">
            </div>
            <div class="form-field input">
                <label class="field-label" for="last_name">Efternamn</label>
                <input type="text" value="<?php echo h($student['student_surname']);?>" name="last_name" required
                    pattern="^[^\d]+$">
            </div>
            <div class="form-field input">
                <label class="field-label" for="email">E-mail</label>
                <input type="email" value="<?php echo h($student['student_email']);?>" name="email" required>
            </div>
            <div class="form-field input">
                <label class="field-label" for="telephone_number">Telefonnummer</label>
                <input type="tel" value="<?php echo h($student['student_phone_number']);?>" name="telephone_number"
                    required minlength="8" maxlength="10">
            </div>
            <input type="submit" value="Ansök">
        </form>

    </div>
    <?php include 'template/side.php';?>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/lightbox.php';?>
<?php include 'template/resources.php';?>