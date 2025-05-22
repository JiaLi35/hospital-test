<?php   

  if (!isUserLoggedIn()){
    header("Location: /");
    exit;
  }
  
?>