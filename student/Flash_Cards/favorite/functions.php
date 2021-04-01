<?php

  // test if a card is favorite or not
  // you can set the option to test if the card is
  //favorite for a specific Student (['student' => StudentID])
  function is_favorite($conn, $id, $userID){
    $sql = "SELECT COUNT(card_id) FROM users_favorite WHERE card_id = '" . $id . "' AND StudentID = '" . $userID . "'";
    // test if the student option is set
 
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $number = $row[0];
    mysqli_free_result($query);
    if($number == 1)
      return true;
    return false;
  }
?>
