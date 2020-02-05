<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$user_ip = $_SERVER['REMOTE_ADDR'];
$server_ip = $_SERVER["SERVER_ADDR"];

echo $server_ip;
echo $user_ip;
echo $user_agent;
?>