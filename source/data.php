<?php

// Load configuration
require_once('../source/config.php');
require_once('../source/dummy.php');

// Create connection
$conn = new mysqli("db2", DB_USERNAME, DB_PASSWORD, "voorbeeld_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Used for debugging
//$conn->query("DROP TABLE music; DROP TABLE users");

// Fetch music
try {
    $music = $conn->query("SELECT * FROM music");
} catch(Exception $e) {

    // Table doesn't exist yet, create it
    $conn->query("CREATE TABLE music (
        artist varchar(35),
        title varchar(25),
        genre varchar(25),
        year varchar(4),
        duration varchar(6),
        image varchar(100)
    )");  

    // Insert dummy data
    foreach ($dummy_data as $song) {
        $prep = $conn->prepare("INSERT INTO music (artist, title, genre, year, duration, image) VALUES (?, ?, ?, ?, ?, ?)");
        $prep->bind_param(
            "ssssss", 
            $song["artist"], 
            $song["title"], 
            $song["genre"], 
            $song["year"], 
            $song["duration"], 
            $song["img"]
        );

        $prep->execute();
    }

    // Now, reSELECT the items
    $music = $conn->query("SELECT * FROM music");
}