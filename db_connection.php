<?php
// get the cradentials to use for database connections
  require_once('db_credentials.php');

  // Used to connect to database
  function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
  }

  // ensure connection to database is closed
  function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }


  // verify the connection to database is valid, if not display error message
  function confirm_db_connect() {
    if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }


  // make sure the query returned a result set
  function confirm_result_set($result_set) {
    if (!$result_set) {
    	exit("Database query failed.");
    }
  }


  // used to help prevent sql injection
  function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
  }
?>
