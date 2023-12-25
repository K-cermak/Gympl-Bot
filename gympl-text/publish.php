<?php

require_once("keys.php");
require_once(__DIR__ . "/../vendor/autoload.php");


//get text from db
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$query = "SELECT id, text from gympl WHERE published = 0 ORDER BY id ASC LIMIT 1 ";

$sql = $conn->prepare($query);
$sql->execute();
$result = $sql->get_result();
$sql->close();

//get text
$row = $result->fetch_assoc();
$text = $row['text'];
$id = $row['id'];


//update
$query = "UPDATE gympl SET published = 1 WHERE id = ?";
$sql = $conn->prepare($query);
$sql->bind_param("s", $id);
$sql->execute();


//publish tweet
$credentials = array(
    'consumer_key' => CONSUMER_KEY,
    'consumer_secret' => CONSUMER_SECRET,
    'token_identifier' => ACCESS_TOKEN,
    'token_secret' => ACCESS_TOKEN_SECRET,
);

$twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);
$tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text($text);
$twitter->tweets()->tweet($tweet);

echo "Tweeted: " . $text . "<br>";

?>