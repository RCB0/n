<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "file_upload_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$file_path = '';
if ($_FILES['file']['name']) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $file_path = $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$text = $_POST['text'] ?? '';

$sql = "INSERT INTO posts (text, file_path) VALUES ('$text', '$file_path')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
