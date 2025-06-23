<?php
function getDBConnection() {
    $conn = new mysqli("localhost", "root", "", "visitor");

    if ($conn->connect_error) {
        return null;
    }

    return $conn;
}
?>
