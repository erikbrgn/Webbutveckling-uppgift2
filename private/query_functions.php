<?php 

function get_main_content() {
    $sql_query = "SELECT * FROM content_section "; // query space important at the end of each line
    $sql_query .= "WHERE section_id = 1;";

    $results = db_fetch_single($sql_query);
    //confirm_results($results);
    
    return $results;
}

function get_side_content() {
  $sql_query = "SELECT * FROM content_section "; // query space important at the end of each line
  $sql_query .= "WHERE section_id = 2;";

  $results = db_fetch_single($sql_query);

  return $results;
}

function get_all_content() {
  $sql = "SELECT * FROM content_section";

  $results = db_fetch_all($sql);
  confirm_results($results);
  return $results;
}

function get_content_by_id($id) {
  $sql = "SELECT * FROM content_section ";
  $sql .= "WHERE section_id = '" . $id . "'";

  $results = db_fetch_single($sql);
  confirm_results($results);
  return $results;
}

function update_content($content) {
  // check to see if content id exists
  $check = get_content_by_id($content['section_id']);

  if(!isset($check)) {
    return $error = 'Misslyckades med uppdatering.';
  }
  else {
    $sql = "UPDATE content_section SET ";
    $sql .= "area_name = '" . $content['area_name'] . "', ";
    $sql .= "visible = '" . $content['visible'] . "', ";
    $sql .= "content = '" . $content['content'] . "' ";
    $sql .= "WHERE section_id = '" . $content['section_id'] . "' ";
    $sql .= "LIMIT 1";

    $result = db_execute($sql);

    if($result) {
      return true;
    } else {
      return false;
    }
  }
}

// FAQ

function get_faq() {
  $sql = "SELECT * FROM faq";

  $results = db_fetch_all($sql);
  confirm_results($results);
  return $results;
}

function find_question_by_id ($id) {
    $sql = "SELECT * FROM faq ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = db_fetch_single($sql);
    if(!confirm_results($result)) {
      return false;
    }
    $question = $result; // find first
    return $question; // returns an assoc. array
}

function insert_question ($question) {
  $errors = validate_question($question);
  if (!empty($errors)) {
    return $errors;
  }

  $sql = "INSERT INTO faq (question) ";
  $sql .= "VALUES ('" . h($question['question']) . "');";

  $result = db_execute($sql);

  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    $errors[] = 'Frågan misslyckades.';
    return $errors;
    exit;
  }
}

function insert_answer($question) {
    $sql = "UPDATE faq SET ";
    $sql .= "answer='" . $question['answer'] . "' ";
    $sql .= "WHERE id = '" . h($question['id']) . "';";

    $result = db_execute($sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
}

function update_question($question) {
  $sql = "UPDATE faq SET ";
    $sql .= "answer='" . h($question['answer']) . "', question = '" . h($question['question']) ."' ";
    $sql .= "WHERE id = '" . h($question['id']) . "';";

    $result = db_execute($sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
}

function delete_question($question) {
  $sql = "DELETE FROM faq ";
    $sql .= "WHERE id='" . $question['id'] . "' ";
    $sql .= "LIMIT 1;";
    $result = db_execute($sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
}

function validate_question ($question) {
  if (is_blank($question['question'])) {
    $errors[] = 'Du kan inte ställa en tom fråga.';
  } elseif (!is_unique_question($question['question'])) {
    $errors[] = "Frågan har redan blivit ställd.";
  }

  return $errors;
}

// SECTIONS

function find_section($id) {
  $sql = "SELECT * FROM section ";
  $sql .= "WHERE section_id = '" . $id . "';";

  $result = db_fetch_single($sql);
  confirm_results($result);
  return $result;
}

function get_all_sections() {
  $sql = "SELECT * FROM section";

  $result = db_fetch_all($sql);
  return $result;
}

function find_section_students($id) {
  $sql = "SELECT * FROM section s JOIN student c ON s.section_id = c.student_section WHERE s.section_id = '" . $id ."';";

  $result = db_fetch_all($sql);
  return $result;
}

function section_nr_available($section) {
  $sql = "SELECT count(*) FROM student s ";
  $sql .= "JOIN section c ON s.student_section = c.section_id ";
  $sql .= "WHERE s.student_section = '" . h($section['section_id']) . "';";

  $count = db_count($sql);
  if ($count <= h($section['max_pos'])) {
    $available = $section['max_pos'] - $count;
  } else {
    $available = 'Fullt';
  }
  return $available;
}


// EVENTS

function get_all_events() {
  $sql = "SELECT * FROM event";

  $result = db_fetch_all($sql);
  return $result;
}
function find_event($event_name) {
  $sql = "SELECT * FROM event WHERE event_name = '" . $event_name . "';";
  $result = db_fetch_single($sql);
  return $result;
}
function find_reservations_by_event_name($event_name) {
  $sql = "SELECT * FROM reservation r JOIN event e ON r.event_name = e.event_name ";
  $sql .= "WHERE e.event_name = '" . h($event_name) . "';";

  $result = db_fetch_all($sql);
  return $result;
}

// RESERVATIONS

function insert_reservation($reservation) {
  $event = find_event($reservation['event_name']);
  if(empty($event)) {
    return false;
  }

  // Before registering student, check nr of students currently in section
  $sql = "SELECT count(*) FROM reservation r ";
  $sql .= "JOIN event e ON r.event_name = e.event_name ";
  $sql .= "WHERE r.event_name = '" . $reservation['event_name'] . "';";

  $count = db_count($sql);
  if ($count >= h($event['number_of_seats'])) {
    $errors[] = 'Evenemanget är fullbokat, prova ett annat.';
    return $errors;
  }

  // Attempt to register student
  $sql = "INSERT INTO reservation (reservation_name, number_of_reserved_seats, event_name) VALUES ";
  $sql .= "('" . h($reservation['reservation_name']) . "', '" . h($reservation['number_of_reserved_seats']) . "', '" . h($reservation['event_name']) . "');";

  $result = db_execute($sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
}
function delete_reservation ($id) {
  $sql = "DELETE FROM reservation WHERE reservation_id = '" . $id . "' LIMIT 1";
    $result = db_execute($sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
}

// STUDENT REGISTRATION

function get_all_students() {
  $sql = "SELECT * FROM student s JOIN section c ";
  $sql .= "ON s.student_section = c.section_id;";

  $results = db_fetch_all($sql);
  confirm_results($results);
  return $results;
}

function find_student_by_id($id) {
    $sql = "SELECT * FROM student s JOIN section c ";
    $sql .= "ON s.student_section = c.section_id ";
    $sql .= "WHERE s.student_id = '" . h($id) . "' ";
    $sql .= "LIMIT 1;";
    $result = db_fetch_single($sql);
    if(!confirm_results($result)) {
      return false;
    }
    $student = $result; // find first
    return $student; // returns an assoc. array
}

function register_student ($student) {
  $errors = validate_student ($student, true);
  if (!empty($errors)) {
    return $errors;
  }

  $section = find_section($student['student_section']);
  if(empty($section)) {
    return false;
  }

  // Before registering student, check nr of students currently in section
  $sql = "SELECT count(*) FROM student s ";
  $sql .= "JOIN section c ON s.student_section = c.section_id ";
  $sql .= "WHERE s.student_section = '" . $student['student_section'] . "';";

  $count = db_count($sql);
  if ($count >= h($section['max_pos'])) {
    $errors[] = 'Sektionen är full, prova en annan.';
    return $errors;
  }

  // Attempt to register student
  $sql = "INSERT INTO student VALUES ";
  $sql .= "('" . h(strip_character(($student['student_id']), "-")) . "', '" . h($student['student_email']) . "', '" . h($student['student_first_name']) . "', ";
  $sql .= "'" . h($student['student_surname']) . "', '" . h($student['student_phone_number']) . "', ";
  $sql .= "'" . h($student['student_section']) . "');";

  $result = db_execute($sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo 'error';
      exit;
    }
}

function update_student($student) {
  $errors = validate_student($student, false);
  if (!empty($errors)) {
    return $errors;
  }

  $section = find_section($student['student_section']);
  if(empty($section)) {
    return false;
  }

  // Before registering student, check nr of students currently in section
  $sql = "SELECT count(*) FROM student s ";
  $sql .= "JOIN section c ON s.student_section = c.section_id ";
  $sql .= "WHERE s.student_section = '" . $student['student_section'] . "';";

  $count = db_count($sql);
  if ($count >= h($section['max_pos'])) {
    $errors[] = 'Sektionen är redan full, prova en annan.';
    return $errors;
  }

  $sql = "UPDATE student SET ";
  $sql .= "student_id = '" . h(strip_character(($student['student_id']), "-")) . "', student_email = '" . h($student['student_email']) . "', student_first_name = '" . h($student['student_first_name']) . "', ";
  $sql .= "student_surname = '" . h($student['student_surname']) . "', student_phone_number = '" . h($student['student_phone_number']) . "', ";
  $sql .= "student_section = '" . h($student['student_section']) . "' ";
  $sql .= "WHERE student_id = '" . h(strip_character(($student['student_id']), "-")) . "' LIMIT 1";

  $result = db_execute($sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }

}

function delete_student ($student) {
  $sql = "DELETE FROM student ";
    $sql .= "WHERE student_id='" . $student['student_id'] . "' ";
    $sql .= "LIMIT 1;";
    $result = db_execute($sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
}

function validate_student ($student, $new_student) {

  if (is_blank($student['student_id'])) {
    $errors[] = "Personnummer får inte vara tomt.";
  } elseif (!has_valid_student_id($student['student_id'])) {
    $errors[] = "Personnumret är inte giltigt.";
  } else if ($new_student) { 
    if (!has_unique_id($student['student_id'])){
    $errors[] = "En student med det personnumret är redan registrerad.";
    }
  }
    
  if (is_blank($student['student_email'])) {
    $errors[] = "Email får inte vara tomt.";
  } elseif (!has_length($student['student_email'], array('max' => 255))) {
    $errors[] = "Email måste vara kortare än 255 tecken";
  } elseif (!has_valid_email_format($student['student_email'])) {
    $errors[] = "Email måste vara i 'email-format'";
  } elseif ($new_student) {
    if (!has_unique_email($student['student_email'])) {
    $errors[] = "Emailen är redan registrerad.";
    }
  }

  if(is_blank($student['student_first_name'])) {
    $errors[] = "Förnamn kan inte vara tomt.";
  } elseif (!has_length($student['student_first_name'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Förnamn måste vara minst 2 tecken.";
  }

  if(is_blank($student['student_surname'])) {
    $errors[] = "Efternamn kan inte vara tomt.";
  } elseif (!has_length($student['student_surname'], array('min' => 2, 'max' => 255))) {
    $errors[] = "Efternamn måste vara minst 2 tecken.";
  }

  if(is_blank($student['student_phone_number'])) {
    $errors[] = "Telefonnumret får inte vara tomt.";
  } elseif (!has_length($student['student_phone_number'], array('min' => 8, 'max' => 10))) {
    $errors[] = "Telefonnumret måste minst vara 8 och max 10 siffror.";
  }

  return $errors;

}

// ADMIN FUNCTIONS

function find_all_admins() {
    $sql = "SELECT * FROM user ";
    $sql .= "ORDER BY username ASC";
    $results =  db_fetch_all($sql);
    confirm_results($results);
    return $results;
}

  function find_admin_by_id($id) {
    $sql = "SELECT * FROM user ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = db_fetch_single($sql);
    if(!confirm_results($result)) {
      return false;
    }
    $admin = $result; // find first
    return $admin; // returns an assoc. array
  }

  function find_admin_by_username($username) {
    $sql = "SELECT * FROM user ";
    $sql .= "WHERE username='" . $username . "' ";
    $sql .= "LIMIT 1";
    $result = db_fetch_single($sql);
    if(!confirm_results($result)) {
      return false;
    }
    $admin = $result; // find first
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin) {

    $password_required = true;

    if(is_blank($admin['first_name'])) {
      $errors[] = "Förnamn kan inte vara tomt.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Förnamn måste vara minst 2 tecken.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email kan inte vara tomt.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Email måste vara kortare än 255 tecken";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email måste vara i 'email-format'";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Användarnamn kan inte vara tomt";
    } elseif (!has_length($admin['username'], array('min' => 4, 'max' => 255))) {
      $errors[] = "Användarnamnet måste vara minst 4 tecken";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Användarnamnet är inte tillåtet. Prova ett annat.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Lösenordet kan inte vara tomt.";
      } elseif (!has_length($admin['password'], array('min' => 6))) {
        $errors[] = "Lösenordet måste innehålla minst 6 tecken.";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "'Bekräfta lösenord' får inte vara tomt.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Lösenorden måste matcha.";
      }
    }

    return $errors;
  }

  function insert_admin($admin) {
    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO user ";
    $sql .= "(username, hashed_password, first_name, email) ";
    $sql .= "VALUES (";
    $sql .= "'" . $admin['username'] . "',";
    $sql .= "'" . $hashed_password . "',";
    $sql .= "'" . $admin['first_name'] . "',";
    $sql .= "'" . $admin['email'] . "'";
    $sql .= ");";
    $result = db_execute($sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo 'error';
      exit;
    }
  }

  function update_admin($admin) {

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE user SET ";
    $sql .= "first_name='" . $admin['first_name'] . "', ";
    $sql .= "email='" . $admin['email'] . "', ";
    if($password_sent) {
      $sql .= "hashed_password='" . $hashed_password . "', ";
    }
    $sql .= "username='" . $admin['username'] . "' ";
    $sql .= "WHERE id='" . $admin['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = db_execute($sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
  }

  function delete_admin($admin) {

    $sql = "DELETE FROM user ";
    $sql .= "WHERE id='" . $admin['id'] . "' ";
    $sql .= "LIMIT 1;";
    $result = db_execute($sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      return false;
    }
  }









  // ONE TIME QUERY

//   function initiate_db() {
//     $sql_query = "SET FOREIGN_KEY_CHECKS=0; DROP TABLE IF EXISTS test; CREATE TABLE test (updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";

//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "DROP TABLE IF EXISTS content_section;
//     CREATE TABLE content_section (
//         section_id int(11) NOT NULL AUTO_INCREMENT,
//         area_name varchar(255) NOT NULL,
//         visible tinyint(1) DEFAULT 0,
//         content text,
//         updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//         PRIMARY KEY (section_id),
//         UNIQUE (area_name));";

//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "INSERT INTO content_section (area_name, visible, content) VALUES('main', 1, '<p>test</p>');";
//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "INSERT INTO content_section (area_name, visible, content) VALUES('side', 1, '<h2>Evenemang</h2>');";
//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "DROP TABLE IF EXISTS student;
//     CREATE TABLE student (
//         student_id bigint(10) NOT NULL,
//         student_email varchar(255) NOT NULL,
//         student_first_name varchar(255) NOT NULL,
//         student_surname varchar(255) NOT NULL,
//         student_phone_number bigint(10) NOT NULL,
//         student_section int(11) NOT NULL,
//         PRIMARY KEY (student_id),
//         UNIQUE (student_email),
//         FOREIGN KEY (student_section) REFERENCES section(section_id)
//     );
//     DROP TABLE IF EXISTS section; 
//     CREATE TABLE section (
//         section_id int(11) NOT NULL AUTO_INCREMENT,
//         section_name varchar(255) NOT NULL,
//         max_pos int(2) NOT NULL,
//         section_desc text,
//         PRIMARY KEY (section_id),
//         UNIQUE (section_name)
//     );
    
//     INSERT INTO section VALUES(1, 'Administer IT', 2, 'IT och grejs.');
//     INSERT INTO section VALUES(2, 'Biljonsen', 40, 'Biljetter och grejs.');
//     INSERT INTO section VALUES(3, 'Blädderiet', 35, 'Bläddring och grejs.');
//     INSERT INTO section VALUES(4, 'Dansen', 60, 'Dans och grejs.');
//     INSERT INTO section VALUES(5, 'Nöjen', 100, 'Nöjen och grejs.');
//     INSERT INTO section VALUES(6, 'Tåget', 100, 'Tåget och grejs.');";

//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "ALTER TABLE `reservation` 
//     DROP FOREIGN KEY `reservation_ibfk_1`;
//     DROP TABLE event; 
//     CREATE TABLE event (
//       event_name varchar(255) NOT NULL,
//       number_of_seats int(4) NOT NULL,
//       PRIMARY KEY (event_name)
//   );

//     INSERT INTO event (event_name, number_of_seats) VALUES ('Spexet', 100);
//     INSERT INTO event (event_name, number_of_seats) VALUES ('Dansen', 400);
//     INSERT INTO event (event_name, number_of_seats) VALUES ('Revyn', 60);
//     INSERT INTO event (event_name, number_of_seats) VALUES ('Kabarén', 100);";
//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "DROP TABLE IF EXISTS reservation;
//     CREATE TABLE reservation (
//         reservation_id int(11) NOT NULL AUTO_INCREMENT,
//         reservation_name varchar(255) NOT NULL,
//         number_of_reserved_seats int(2) NOT NULL,
//         event_name varchar(255),
//         PRIMARY KEY (reservation_id),
//         FOREIGN KEY (event_name) REFERENCES event(event_name)
//     );";
//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     $sql_query = "DROP TABLE IF EXISTS faq;
//     CREATE TABLE faq (
//         id int(11) NOT NULL AUTO_INCREMENT,
//         created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//         question varchar(255) NOT NULL,
//         answer text,
//         PRIMARY KEY (id),
//         UNIQUE (question)
//     );
    
//     INSERT INTO faq (question, answer) VALUES ('Hur är man karnevalist?', '<p>Jo, man är karnevalist genom att vara en Lundastudent och är sugen på att kröka.</p>');
//     INSERT INTO faq (question, answer) VALUES ('Hur hittar man till Karnevalen?', '<p>Gå till \"Om Karnevalen\" och sedan tryck på \"Hitta hit\". <a href=\"hitta-oss.html\">Här är en länk ifall du inte
//                     hittar.</a></p>');
//     INSERT INTO faq (question, answer) VALUES ('Varför måste man köa?', '<p>Sverige är uppbyggt med hjälp av kössystemet. Utan det hade vi fortfarande bott i grottor.</p>');
//     INSERT INTO faq (question, answer) VALUES ('Hur köar man?', '<p>Släng på dig en vuxenblöja (likt man gör på nyårsafton vid Times Square). Gå till Lundagård, still dig i kö
//                 och håll ut! <br><small>Tips: Ta med dig en flaska Stroh för att hålla värmen.</small></p>');
                
//     SET FOREIGN_KEY_CHECKS=1;";
    
//     $conn = db_connect();
//     $results[] = $conn->exec($sql_query);

//     foreach ($results as $query) {
//       if($query === 0) {
//         echo 'success <br>';
//       } else {
//         echo 'fail <br>';
//       }
//     }
// }

// function set_admin () {
//   $sql_query = "DROP TABLE IF EXISTS user;
//     CREATE TABLE user (
//         id int(11) NOT NULL AUTO_INCREMENT,
//         username varchar(255) NOT NULL,
//         hashed_password varchar(255) NOT NULL,    
//         first_name varchar(255),
//         email varchar(255) NOT NULL,
//         PRIMARY KEY (id),
//         KEY index_username (username)
//     );
    
//     INSERT INTO user VALUES(1, 'admin', '" . password_hash('hejsan123', PASSWORD_BCRYPT) . "', 'Erik Berggren', 'psy13eb4@student.lu.se');";

//     $conn = db_connect();
//     $results = $conn->exec($sql_query);

//     echo $results;
// }

function check_version() {
  $sql = "select version()";
  
  $results = db_fetch_single($sql);
  echo $results['version()'] . '<br>';

  $sql = "show tables;";
  $results = db_fetch_all($sql);
  var_dump($results);
  echo '<br>';

  $sql = "SELECT * FROM event";
  $results = db_fetch_all($sql);
  foreach ($results as $result) {
    echo $result['event_name'] . '<br>';
  }
}
?>