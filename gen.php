<?php 

require_once("keys.php");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


$handle = fopen("Text.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        $query = "insert into gympl (id, text, published) values (NULL, ?, 0)";
        $sql = $conn->prepare($query);
        $sql->bind_param("s", $line);

        if ($sql->execute()) {
            echo "OK<br>";
        } else {
            echo "Error: " . $sql->error . "<br>";
        }
    }
    fclose($handle);
}
?>