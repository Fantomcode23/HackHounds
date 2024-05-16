<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate and sanitize uploaded file
  $allowedExtensions = ['pdf', 'docx', 'doc', 'txt']; // Allowed file types
  $fileName = $_FILES['documentFile']['name'];
  $fileSize = $_FILES['documentFile']['size'];
  $fileTmpPath = $_FILES['documentFile']['tmp_name'];
  $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

  // Check for errors and allowed file types
  if (in_array($fileType, $allowedExtensions) && $fileSize <= 1000000) { // Adjust size limit as needed
    // Generate a unique filename (optional)
    $newFileName = uniqid('', true) . '.' . $fileType;

    // Define a folder to store uploaded documents (create it if necessary)
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true); // Create directory with appropriate permissions
    }

    // Move uploaded file to the destination folder
    $destination = $uploadDir . $newFileName;
    if (move_uploaded_file($fileTmpPath, $destination)) {
      echo '{"success": true, "message": "File uploaded successfully!"}'; // JSON response for successful upload
    } else {
      echo '{"success": false, "message": "Failed to upload file."}'; // JSON response for upload failure
    }
  } else {
    echo '{"success": false, "message": "Invalid file type or size."}'; // JSON response for invalid file
  }
} else {
  echo '{"success": false, "message": "Invalid request method."}'; // JSON response for non-POST request
}

?>
