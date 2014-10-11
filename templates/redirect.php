<?php

  if ( isset($_POST['oldVersions']) && !empty($_POST['oldVersions']) ) {
    header("Location: ".$_POST['oldVersions']."");
  } else{
    echo "This file is not available.";
  }

?>
