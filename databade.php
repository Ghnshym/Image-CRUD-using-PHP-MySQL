<?php
// please run single time 
// Replace these variables with your MySQL server credentials
$hostname = 'localhost';
$username = 'root';
$password = '';

// Connect to MySQL server
$connection = new mysqli($hostname, $username, $password);

// Check for connection errors
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Create the database
$databaseName = 'image_crud';
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

if ($connection->query($createDatabaseQuery) === TRUE) {
    echo "Database created successfully.\n";
} else {
    echo "Error creating database: " . $connection->error . "\n";
}

// Select the database
$connection->select_db($databaseName);

// Create the table
$createTableQuery = "
CREATE TABLE IF NOT EXISTS image_crud (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    stud_name VARCHAR(100),
    stud_class VARCHAR(50),
    stud_phone VARCHAR(15),
    stud_image VARCHAR(100)
)";

if ($connection->query($createTableQuery) === TRUE) {
    echo "Table created successfully.\n";
} else {
    echo "Error creating table: " . $connection->error . "\n";
}

// Close the connection
$connection->close();
?>


