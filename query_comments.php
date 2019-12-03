<?php


// query database based on contents requested in the "$condition" variable

function query_comments($condition) {
    global $db;

    $sql = "SELECT * FROM sweetwater_test ";
    $sql .= "WHERE comments LIKE '" . "%" . db_escape($db, $condition) . "%" . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  //Query all records, not good for large datasets
  function query_all_comments() {
    global $db;

    $sql = "SELECT * FROM sweetwater_test ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  // Set the shipdate_expected column to the date in the comments and change the comments.
  function set_date($orderid, $date, $new_comment) {
      global $db;

      $sql = "UPDATE sweetwater_test SET ";
      $sql .= "shipdate_expected = '" . db_escape($db, $date) . "', ";
      $sql .= "comments = '" . db_escape($db, $new_comment) . "' ";
      $sql .= "WHERE orderid = '" . db_escape($db, $orderid) . "' ";
      $sql .= "LIMIT 1";
      $result = mysqli_query($db, $sql);
      // For UPDATE statements, $result is true/false
      if($result) {
        return true;
      } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
  }
  }
  ?>