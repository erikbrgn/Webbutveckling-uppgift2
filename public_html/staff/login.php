<?php require_once('../../private/initialize.php');?>
<?php 
    $errors = [];
    $username = '';
    $password = '';
    
    if(is_post_request()) {
    
      $username = $_POST['username'] ?? '';
      $password = $_POST['password'] ?? '';
    
      // Validations
      if(is_blank($username)) {
        $errors[] = "Användarnamnet kan inte vara tomt";
      }
      if(is_blank($password)) {
        $errors[] = "Lösenordet kan inte vara tomt";
      }
    
      // if there were no errors, try to login
      if(empty($errors)) {

        // Using one variable ensures that msg is the same
        $login_failure_msg = "Inloggningen misslyckades.";
    
        $admin = find_admin_by_username($username);
        if($admin) {
    
          if(password_verify($password, $admin['hashed_password'])) {
            // password matches
            log_in_admin($admin);
            redirect_to(url_for('/staff/index.php'));
          } else {
            // username found, but password does not match
            $errors[] = $login_failure_msg;
          }
    
        } else {
          // no username found
          $errors[] = $login_failure_msg;
        }
    
      }
    
    }
    
?>
<?php include( SHARED_PATH . '/staff_header.php');?>
<div class="login-wrapper">
  <div class="login-container">
    <h1 class="brand-title">Karneportalen</h1>
    <div class="form-holder">
      <form class="login-form" id="login" action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
        <legend>Login</legend>
        <div class="form-field input">
          <label class="field-label" for="username">Username</label>
          <input type="text" name="username" id="username" value="<?php echo h($username); ?>" required maxlength="20">
        </div>
        <div class="form-field input">
          <label class="field-label" for="password">Password</label>
          <input type="password" name="password" id="password" value name="password" required maxlength="20">
        </div>
        <input type="hidden" name="login" value="true">
        <p><?php echo $errors[0]; ?></p>
        <div class="submit-container">
          <a href="<?php echo url_for('index.php');?>">tillbaka</a>
          <input type="submit" value="login">
        </div>

      </form>
    </div>
  </div>

</div>
<?php include( PUBLIC_PATH . '/template/resources.php');?>