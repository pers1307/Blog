<?php

$login = $_POST['login'];
$password = $_POST['password'];

$result['login'] = $login;
$result['password'] = $password;

echo json_encode($result);