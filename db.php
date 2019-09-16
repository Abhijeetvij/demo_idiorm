<?php
require_once 'idiorm/idiorm.php';


$host = 'localhost';
$database = 'demodatabase';
$user = 'root';
$password = '';

$connection =  ORM::configure(array(
    'connection_string' => 'mysql:host='.$host.';dbname='.$database,
    'username' => $user,
    'password' => $password
),true);


