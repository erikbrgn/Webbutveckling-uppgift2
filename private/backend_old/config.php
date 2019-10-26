<?php
// ini_set( "display_errors", true );
// date_default_timezone_set( "Europe/Stockholm" );  // http://www.php.net/manual/en/timezones.php

// real db
// define( "DB_DSN", "mysql:host=my06s.sqlserver.se;dbname=4003497-db11" );
// define("DB_USERNAME", "4003497_yx43716");
// define("DB_PASSWORD", "fPFEdMaE7");

// local db
define( "DB_DSN", "mysql:host=127.0.0.1;dbname=test" );
define("DB_USERNAME", "root");
define("DB_PASSWORD", "Jagheterolle123!");

define("DB_HOST", "mysql:host=my06s.sqlserver.se");

define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "password" );
require( CLASS_PATH . "/article.php" );

//SHITY ERROR HANDLING
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try again later.";
  error_log( $exception->getMessage() );
}

set_exception_handler( 'handleException' );


$conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";

// try {

// $sql = "CREATE TABLE articles (
//   id              smallint unsigned NOT NULL auto_increment,
//   publicationDate date NOT NULL,                            
//   title           varchar(255) NOT NULL,                     
//   summary         text NOT NULL,                              
//   content         mediumtext NOT NULL,                        

//   PRIMARY KEY     (id)
// );";

// // use exec() because no results are returned
// $conn->exec($sql);
// echo "Table 'articles' created successfully";
// } catch(PDOException $e)
// {
// echo $sql . "<br>" . $e->getMessage();
// }

// try {
//     $sql = "CREATE TABLE `accounts` (
//         `account_id` int(10) UNSIGNED NOT NULL,
//         `account_name` varchar(255) NOT NULL,
//         `account_passwd` varchar(255) NOT NULL,
//         `account_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//         `account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
//       ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      
//       --
//       -- Indexes for table `accounts`
//       --
//       ALTER TABLE `accounts`
//         ADD PRIMARY KEY (`account_id`),
//         ADD UNIQUE KEY `account_name` (`account_name`);
      
//       --
//       -- AUTO_INCREMENT for table `accounts`
//       --
//       ALTER TABLE `accounts`
//         MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;";

//         $conn->exec(($sql));
//         echo "table accounts created succesfully";
// } catch(PDOException $e)
// {
// echo $sql . "<br>" . $e->getMessage();
// }
    try {
        $sql = "CREATE TABLE `account_sessions` (
            `session_id` varchar(255) NOT NULL,
            `account_id` int(10) UNSIGNED NOT NULL,
            `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          
          --
          -- Indexes for table `account_sessions`
          --
          ALTER TABLE `account_sessions`
            ADD PRIMARY KEY (`session_id`);";
        
        $conn->exec($sql);
        echo 'succesfully created account_sessions';
    } catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

 $conn = null;

?>