<?php
    require_once('db_credentials.php');

    function db_connect() {
        try {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //sets the default to return 'named' properties in array.
        return $conn;
        } catch (PDOException $Exception) {
            $msg = "Unable to connect to database.";
            exit($msg);
        }
    }
    function db_fetch_all($query) {
        $conn = db_connect();

        $sth = $conn->prepare($query);
        $sth->execute();


        $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
        db_disconnect($conn);
        return $results;

    }
    function db_fetch_single($query) {
        $conn = db_connect();

        $sth = $conn->prepare($query);
        $sth->execute();

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        db_disconnect($conn);
        return $result;
    }

    function db_disconnect($conn) {
        $conn = null;
    }
    
    function confirm_results($result_set) {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }

?>