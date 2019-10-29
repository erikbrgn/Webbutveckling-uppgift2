<?php

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function strip($string) {
    return strip_tags($string, ALLOWED_TAGS);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function strip_character ($string, $character) {
  $string = str_replace($character, "", $string);
  return $string;
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    foreach($errors as $error) {
      $output .= h($error);
    }
  }
  return $output;
}

function compose_email($id, $email) {
  $status = false;
  $section_students = find_section_students($id);
  $to = '';
  foreach ($section_students as $student) {
    $to .= $student['student_email'] . ", ";
  }
  $subject = $email['subject'];
  $message = $email['message'];
  $headers = 'MIME-Version: 1.0' . "\r\n" .
    'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
    'From: info@kanalkarneval.se' . "\r\n" .
    'Reply-To: info@kanalkarneval.se' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  if (isset($email['subject']) && isset($email['message'])) {
    $status = mail($to, $subject, $message, $headers);
  }
  return $status;
}
?>