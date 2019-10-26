<?php
  session_start(); // turn on sessions
  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public_html');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  define("ALLOWED_TAGS", '<div><img><h1><h2><h3><h4><h5><p><em><address><b><strong><span><ul><li>');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  // define("WWW_ROOT", '/~kevinskoglund/globe_bank/public');
  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], 'public_html');
  $doc_root = substr(PUBLIC_PATH, 0, $public_end);
  define("WWW_ROOT", $doc_root);

  //echo WWW_ROOT;

  require_once('functions.php');
  require_once('db_connector.php');
  require_once('query_functions.php');
  require_once('validation_functions.php');
  require_once('auth_functions.php');

  //initiate_db();

  //$db = db_connect();
  $errors = [];


?>