<?php
// ini_set( "display_errors", true );
// date_default_timezone_set( "Europe/Stockholm" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=my06s.sqlserver.se;dbname=4003497-db11" );
define("DB_HOST", "mysql:host=my06s.sqlserver.se");
define("DB_USERNAME", "4003497_yx43716");
define("DB_PASSWORD", "fPFEdMaE7");
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "password" );
require( CLASS_PATH . "/article.php" );

// SHITY ERROR HANDLING
// function handleException( $exception ) {
//   echo "Sorry, a problem occurred. Please try again later.";
//   error_log( $exception->getMessage() );
// }

// set_exception_handler( 'handleException' );








// $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

// $conn = null;

?>