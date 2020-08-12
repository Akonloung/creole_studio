<?php

$mysql_connection = mysqli_connect("localhost", "root", "", "creole_studio");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}