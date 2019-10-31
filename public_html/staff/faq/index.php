<?php 
require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {
    switch ($_POST['action']) {
        case 'view' :
            $question['id'] = $_POST['id'] ?? '';
            if($_POST['view_action'] === '0') {
                $question['answer'] = $_POST['answer'] ?? '';

                $result = insert_answer($question);
                if ($result === true) {
                $errors[0] = "Frågan har blivit besvarad.";
                } else {
                $errors = $result;
                }
            } else if ($_POST['view_action'] === '1') {
                $question['question'] = $_POST['question'] ?? '';
                $question['answer'] = $_POST['answer'] ?? '';

                $result = update_question($question);
                if ($result === true) {
                $errors[0] = "Frågan har uppdaterats.";
                } else {
                $errors = $result;
                }
            } else if ($_POST['view_action'] === '2') {
                $result = delete_question($question);
                if ($result === true) {
                    $errors[0] = 'Frågan har blivit borttagen.';
                } else {
                    $errors[0] = 'Oväntat fel. Frågan är sannolikt kvar.';
                }
            }
        break;
    }
}


if(!isset($_GET['id'])) {
    $message = 'Ingen fråga visas för tillfället.';
} else {
    $id = $_GET['id'];
    $find_question = find_question_by_id($id);
}

$questions = get_faq();
?>
<?php $page_title = "FAQ"; ?>
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
            <h1 class="brand-title">FAQ</h1>
        </div>
        <div class="block-2">
        </div>
        <div class="block-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fråga</th>
                        <th>Besvarad</th>
                        <th>Ställd</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($questions as $question) { ?>
                    <tr>
                        <td><?php echo h($question['id']);?></td>
                        <td><?php echo h($question['question']);?></td>
                        <td><?php if(!is_blank(h($question['answer']))) { echo 'Ja'; } else { echo 'Nej'; }?></td>
                        <td><?php echo h($question['created_on']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/faq/index.php?id=' . h(u($question['id']))); ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
        <div class="block-full">
            <?php if(!is_blank($find_question['id'])) { ?>
            <form id="form" method="post" action="<?php echo h($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="action" value="view">
                <input type="hidden" name="id" value="<?php echo $find_question['id'];?>">
                <div class="form-field select">
                    <label class="field-label" for="view_action">Vad vill du göra med frågan?</label>
                    <select name="view_action" id="action" required size=>
                        <option value></option>
                        <option value="0">Besvara</option>
                        <option value="1">Redigera</option>
                        <option value="2">Ta bort</option>
                    </select>
                </div>
                <div class="form-field textarea visually-hidden">
                    <textarea placeholder="T.ex. hur länge har karnevalen funnits?" name="question" id="question"
                        cols="30" rows="5" maxlength="255"
                        required><?php echo h($find_question['question']); ?></textarea>
                </div>
                <div class="form-field textarea textarea_answer visually-hidden">
                    <textarea name="answer" id="content" cols="30"
                        rows="10"><?php echo h($find_question['answer']); ?></textarea>
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
<!-- Modal -->
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
                Du håller nu på att ta bort frågan:<br><br><span
                    class="lead">'<?php if (isset($find_question)) {echo $find_question['question'];} ?>'</span><br><br>
                Är du säker?
            </div>
            <div class="modal-footer">
                <button type="button" class="k-btn k-btn-secondary" data-dismiss="modal">Avbryt</button>
                <button id="btn_confirm" type="button" class="k-btn k-btn-primary">Fortsätt</button>
            </div>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>