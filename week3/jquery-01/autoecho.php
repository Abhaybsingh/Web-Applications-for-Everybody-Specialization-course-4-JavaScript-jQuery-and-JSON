<?php
  if ( !isset($_POST['val']) ) return;
  // sleep for 5\ seconds
  sleep(5);
  //  print somepost data 
  echo('You sent: '.$_POST['val']);

