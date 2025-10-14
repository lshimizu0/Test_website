<?php

$username = $_POST['username'];
$password = $_POST['password'];
$terms_and_conditions = filter_input(INPUT_POST, 'terms-and-conditions', FILTER_VALIDATE_BOOLEAN);

$host = "localhost";
$dbname ="accounts";
$server_username = "ucalgary";
$server_password = "oop";