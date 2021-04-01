<?php
session_start(); 
  require_once "connect.php";
  require_once "functions.php";

  /* Example of using is_favorite function
  if(is_favorite($conn, 1, ['student' => 5]))
    echo "favorite";
  else {
    echo "not favorite";
  }*/
	
  /* Add the card to favorite */
  function make_favorite($conn, $card_id, $student_id,$courseID){
     
	$sql = "INSERT INTO users_favorite (card_id, StudentID,courseID)";
    $sql .= " VALUES ('" . $card_id . "', '" . $student_id . "', '" . $courseID . "');";
    return mysqli_query($conn, $sql);
  }

    /* Remove card from favorites */
  function make_unfavorite($conn, $card_id, $student_id){
    $sql = "DELETE FROM users_favorite";
    $sql .= " WHERE card_id = '" . $card_id ."' AND StudentID = '" . $student_id . "'";
    $sql .= " LIMIT 1"; // to prevent deleting the hole table if an error occurs
    return mysqli_query($conn, $sql);
  }

  /***** Handling the Ajax Request ********************************************/

  // test if it's a ajax request
  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) { exit; }

  //retrieving the id of the card("favorite-id")
  $raw_card_id = isset($_POST['card_id']) ? $_POST['card_id'] : '';
  $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
  $courseID = isset($_POST['courseID']) ? $_POST['courseID'] : '';
  if(preg_match("/favorite-(\d+)/", $raw_card_id, $matches_card) && is_numeric($student_id)){

    $card_id = $matches_card[1];
    // test if the card is favorite
    if(is_favorite($conn, $card_id,$student_id)){
      make_unfavorite($conn, $card_id, $student_id);
      echo 'unfavorite';
    }
    else {
      make_favorite($conn, $card_id, $student_id,$courseID);
      echo 'favorite';
    }
  }
?>
