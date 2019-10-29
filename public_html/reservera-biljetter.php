<?php include 'template/head-tag-content.php';?>
<?php 
if (is_post_request()) {
    $reservation['reservation_name'] = $_POST['reservation_name'] ?? '';
    $reservation['number_of_reserved_seats'] = $_POST['number_of_reserved_seats'] ?? '';
    $reservation['event_name'] = $_POST['event_name'] ?? '';

    $result = insert_reservation($reservation);

    if ($result) {
       $errors[] = "Du har lagt en reservation.";
       $reservation = [];
       $reservation['reservation_name'] = '';
       $reservation['number_of_reserved_seats'] = '';
       $reservation['event_name'] = '';
    } else if (!$result){
        $errors[] = "Reservationen misslyckades.";
    }
    else {
        $errors = $result;
    }

} else {
    $reservation = [];
    $reservation['reservation_name'] = '';
    $reservation['number_of_reserved_seats'] = '';
    $reservation['event_name'] = '';
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
        <h2>Reservera biljetter</h2>
        <form id="form" method="post" action="<?php echo h($_SERVER['PHP_SELF']); ?>">
            <div class="form-field select">
                <label class="field-label" for="event_name">Evenemang</label>
                <select name="event_name" required size=>
                    <option value selected></option>
                    <option value="Spexet">Spexet</option>
                    <option value="Dansen">Dansen</option>
                    <option value="Revyn">Revyn</option>
                    <option value="Kabarén">Kabarén</option>
                </select>
            </div>
            <div class="form-field input">
                <label class="field-label" for="reservation_name">Namn på reservationen</label>
                <input type="text" value="<?php echo h($reservation['reservation_name']);?>" name="reservation_name" required>
            </div>
            <div class="form-field input">
                <label class="field-label" for="number_of_reserved_seats">Önskat antal platser (Max 5)</label>
                <input type="number" value="<?php echo h($reservation['number_of_reserved_seats']);?>" name="number_of_reserved_seats" required max="5">
            </div>
            <input type="submit" value="Reservera">
        </form>
    </div>
    <?php include 'template/side.php';?>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/lightbox.php';?>
<?php include 'template/resources.php';?>