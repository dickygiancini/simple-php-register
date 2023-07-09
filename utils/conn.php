<?php
// conn.php

// MySQL server configuration
$hostname = 'localhost';
$username = 'root';
$password = 'password';
$database = 'php-test';

// Create a connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}