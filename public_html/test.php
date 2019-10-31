<?php 
require_once('../private/initialize.php');

set_admin();
echo '<br>';
initiate_db();
echo '<br>';
check_version();
echo '<br>';

echo $_SERVER['HTTP_HOST'];
?>