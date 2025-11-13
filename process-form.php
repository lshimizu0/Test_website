<?php


//phpinfo();


$username = $_POST['username'];
$password = $_POST['password'];
$terms_and_conditions = filter_input(INPUT_POST, 'terms-and-conditions', FILTER_VALIDATE_BOOLEAN);




$server_name = "SHUNGUIPC";

$dbname ="Website_Test";
$server_username = "ucalgary";
$server_password = "oop";

$connection_options = [
    "Database" => $dbname,
    "Uid" => $server_username,
    "PWD" => $server_password
    ];



$conn = sqlsrv_connect($server_name, $connection_options);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
    //echo("Connection FUCKED");
}else{
    $sql = "INSERT INTO accounts (username, password) VALUES (?, ?)";
    $params = array($username, $password);
    $stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

}

?>