<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'bunny_test';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);