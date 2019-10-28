<?php include 'template/head-tag-content.php';?>
<?php 

if (is_post_request()) {
    $question['question'] = $_POST['question'] ?? '';
    $result = insert_question($question);

    if ($result === true) {
        $errors[] = "Frågan blev ivägskickad!";
    } else {
        $errors = $result;
    }
}



$faq = get_faq();
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
    <div class="main d-flex flex-column">
        <a class="ml-auto" href="#ask-a-question">Ställ en fråga</a>
        <?php foreach($faq as $row) { ?>
        <div class="card mb-3">
            <div class="card-header">
                <p><strong><?php echo strip($row['question']);?></strong></p>
            </div>
            <div class="card-body">
                <?php if (isset($row['answer'])) { echo strip($row['answer']); }
                 else {?> <small>Frågan inväntar svar.</small> <?php }
                ?>
            </div>
            <div class="card-footer"><small><em>Frågan ställd <?php echo $row['created_on'];?></em></small></div>
        </div>
        <?php } ?>

        <div class="mt-3">
            <h4 id="ask-a-question">Ställ en fråga</h4>

            <form id="form" method="post" action="<?php echo h($_SERVER['PHP_SELF']); ?>">
                <div class="form-field textarea">
                    <textarea placeholder="T.ex. hur länge har karnevalen funnits?" name="question" id="question"
                        cols="30" rows="10" maxlength="255" required></textarea>
                </div>
                <input type="submit" value="Skicka">
            </form>
        </div>
    </div>
    <?php include 'template/side.php';?>
    <?php include 'template/footer.php';?>
</div>
<?php include 'template/lightbox.php';?>
<?php include 'template/resources.php';?>