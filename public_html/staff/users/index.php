<?php

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {
    switch ($_POST['action']) {

    case 'search' :
        $value = $_POST['id'];
        if (is_numeric($value)) {
            $admin = find_admin_by_id($value);
        } else {
            $admin = find_admin_by_username($value);
        }
        break;
        
    case 'view' : 
        if ($_POST['view_action'] === '1') {
            $admin['id'] = $_POST['id'];
            $admin['first_name'] = $_POST['first_name'] ?? '';
            $admin['email'] = $_POST['email'] ?? '';
            $admin['username'] = $_POST['username'] ?? '';
            $admin['password'] = $_POST['password'] ?? '';
            $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

            $result = update_admin($admin);
            if ($result === true) {
                $errors[0] = "Användaren har updaterats";
            } else {
                $errors = $result;
            }

        } else if ($_POST['view_action'] === '2') {
            $admin['id'] = $_POST['id'];
            $result = delete_admin($admin);
            $admin = [];
        }        

    break;
    
    case 'add' : 
        $admin['first_name'] = $_POST['first_name'] ?? '';
        $admin['email'] = $_POST['email'] ?? '';
        $admin['username'] = $_POST['username'] ?? '';
        $admin['password'] = $_POST['password'] ?? '';
        $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

        $result = insert_admin($admin);
        if($result === true) {
            $errors[0] = 'Användaren har lagts till.';
        } else {
        $errors = $result;
        }
        break;
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

$admin_set = find_all_admins();

?>
<?php $page_title = "Users"; ?>
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
            <h1 class="brand-title">Användare<h1>
        </div>
        <div class="block-2">
            <form class="search-form" action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="action" value="search">
                <div class="form-field input">
                    <input placeholder="ID / Användarnamn" type="text" value name="id" required>
                </div>
                <input type="submit" value="Sök">
            </form>
        </div>
        <div class="block-3">
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
        <div class="block-4">
            <?php if(!is_blank($admin['id'])) { ?>
            <form id='form' action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
                <!-- <h3>Vald användare: "<?php echo $admin['username']; ?>"</h3> -->
                <input type="hidden" name="action" value="view">
                <input type="hidden" name="id" value="<?php echo $admin['id'];?>">
                <div class="form-field select">
                    <label class="field-label" for="view_action">Vad vill du göra med
                        "<?php echo $admin['username']; ?>"?</label>
                    <select name="view_action" id="action" required size=>
                        <option value></option>
                        <option value="1">Ändra</option>
                        <option value="2">Ta bort</option>
                    </select>
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="username">Användarnamn</label>
                    <input type="text" value="<?php echo $admin['username'];?>" name="username" required
                        pattern="^[^\d]+$">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="password">Lösenord</label>
                    <input type="password" name="password" id="password" value name="password" required maxlength="20">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="confirm_password">Bekräfta lösenord</label>
                    <input type="password" name="confirm_password" id="confirm_password" value name="password" required
                        maxlength="20" oninput="check(this, 'password');">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="firstname">Förnamn</label>
                    <input type="text" value="<?php echo $admin['first_name'];?>" name="first_name" required
                        pattern="^[^\d]+$">
                </div>
                <div class="form-field input visually-hidden">
                    <label class="field-label" for="email">E-mail</label>
                    <input type="email" value="<?php echo $admin['email'];?>" name="email" required>
                </div>
                <div class="visually-hidden d-flex">
                    <input id="view_submit" type="submit" value="">
                </div>
            </form>
            <?php } else {?>
            <h2 class="mt-2"><?php echo $message; ?></h2>
            <?php } ?>
        </div>
        <div class="block-5">
            <button class="k-btn k-btn-primary" onclick="toggleForm();">Ny användare</button>
            <form id='add_user_form' class="float-form visually-hidden" action="<?php echo h($_SERVER['PHP_SELF']); ?>"
                method="post" style="margin-top: 35px;">
                <input type="hidden" name="action" value="add">
                <div class="form-field input">
                    <label class="field-label" for="username">Användarnamn</label>
                    <input type="text" value name="username" required pattern="^[^\d]+$">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="password">Lösenord</label>
                    <input type="password" name="password" id="add_password" value name="password" required
                        maxlength="20">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="confirm_password">Bekräfta lösenord</label>
                    <input type="password" name="confirm_password" id="confirm_password" value name="password" required
                        maxlength="20" oninput="check(this, 'add_password');">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="firstname">Förnamn</label>
                    <input type="text" value name="first_name" required pattern="^[^\d]+$">
                </div>
                <div class="form-field input">
                    <label class="field-label" for="email">E-mail</label>
                    <input type="email" value name="email" required>
                </div>
                <div class="d-flex">
                    <input class="ml-0" type="reset" value="återställ">
                    <input id="view_submit" type="submit" value="Lägg till">
                </div>
            </form>
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
                    Du håller nu på att ta bort '<?php if (isset($admin)) {echo $admin['username'];} ?>' som
                    användare.<br><br>
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