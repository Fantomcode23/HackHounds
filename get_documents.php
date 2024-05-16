<?php

// Define the upload directory (replace with your actual path)
$uploadDir = 'uploads/';

$documents = array();
if (is_dir($uploadDir)) {
  $files = scandir($uploadDir); // Get files in the directory
  foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') { // Ignore . and ..
      $documents[] = $file;
    }
  }
}

echo json_encode($documents);

?>
