<?php
header('Content-Type: application/json; charset=utf-8');

function response(array $data)
{
    die(json_encode($data));
}
function url()
{
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);
    $hostName = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';

    return $protocol . $hostName;
}