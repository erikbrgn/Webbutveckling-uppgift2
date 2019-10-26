<?php

require_once('../../../private/initialize.php');

require_login();

$admin_set = find_all_admins();

if(is_post_request()) {
    $action = $_POST['action'];
    if ($action = 'search' ) {
        $value = $_POST['id'];
        if (is_numeric($value)) {
            $admin = find_admin_by_id($value);
        } else {
            $admin = find_admin_by_username($value);
        }
        
    } else if ($action = 'view') {

    }


    // $result = delete_admin($id);
    // $_SESSION['message'] = 'Admin deleted.';
    // redirect_to(url_for('/staff/admins/index.php'));
  }

if(!isset($_GET['id'])) {
    $message = 'Ingen användare visas för tillfället.';
} else {
    $id = $_GET['id'];
    $admin = find_admin_by_id($id);
}

?>
<?php $page_title = "Users"; ?>
<?php include( SHARED_PATH . '/staff_header.php');?>
<div class="staff-wrapper">
    <?php include( SHARED_PATH . '/staff_nav.php'); ?>
    <div class="staff-content">
        <div class="message-container">
            <h1>Användare<h1>
        </div>
        <div class="search-container">
            <form class="search-form" action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="action" value="search">
                <div class="form-field input">
                    <input placeholder="ID / Användarnamn" type="text" value name="id" required>
                </div>
                <input type="submit" value="Sök">
            </form>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Användarnamn</th>
                        <th>Namn</th>
                        <th>E-mail</th>
                        <th class="empty"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($admin_set as $row) { ?>
                    <tr>
                        <td><?php echo h($row['id']);?></td>
                        <td><?php echo h($row['username']);?></td>
                        <td><?php echo h($row['first_name']);?></td>
                        <td><?php echo h($row['email']);?></td>
                        <td class="empty"><a class="action"
                                href="<?php echo url_for('/staff/users/index.php?id=' . h(u($row['id']))); ?>">View</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
        <div class="user-container">
            <?php if(isset($admin)) { ?>
            <form id='form' action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <!-- <h3>Vald användare: "<?php echo $admin['username']; ?>"</h3> -->
                <input type="hidden" name="action" value="view">
                <div class="form-field select">
                    <label class="field-label" for="view_action">Vad vill du göra med
                        "<?php echo $admin['username']; ?>"?</label>
                    <select name="view_action" id="action" required size=>
                        <option value selected></option>
                        <option value="0">Lägg till</option>
                        <option value="1">Ändra</option>
                        <option value="2">Ta bort</option>
                    </select>
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="username">Användarnamn</label>
                    <input type="text" value name="username" required pattern="^[^\d]+$">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="password">Lösenord</label>
                    <input type="password" name="password" id="password" value name="password" required maxlength="20">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="confirm_password">Bekräfta lösenord</label>
                    <input type="password" name="confirm_password" id="confirm_password" value name="password" required
                        maxlength="20">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="firstname">Förnamn</label>
                    <input type="text" value name="firstname" required pattern="^[^\d]+$">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="email">E-mail</label>
                    <input type="email" value name="email" required>
                </div>


            </form>
            <?php } else {?>
            <h2><?php echo $message; ?></h2>
            <?php } ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="modal" tabindex="-1" role="dialog"
        aria-labelledby="Confirmation" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you'd like to delete '<?php if (isset($admin)) {echo $admin['username'];} ?>'
                </div>
                <div class="modal-footer">
                    <button type="button" class="k-btn k-btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="btn_confirm" type="button" class="k-btn k-btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include(SHARED_PATH . '/staff_footer.php'); ?>