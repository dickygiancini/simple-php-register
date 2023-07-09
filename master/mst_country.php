<?php

require '../utils/conn.php';

$query = "SELECT id, country_name FROM mst_country";
$result = $mysqli->query($query);

$countries = [];

if($result) {
    if($result->num_rows > 0) {
        $countries = $result->fetch_all(MYSQLI_ASSOC);

        $result->close();
    }
}

$mysqli->close();

echo json_encode($countries);
?>