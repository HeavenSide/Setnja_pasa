<?php
define("DB", [
    'HOST' => 'localhost',
    'USER' => 'four2',
    'PASSWORD' => '6pxxIS2mnrjtjIz',
    'NAME' => '42'
]);

try 
{
    $dbh = new PDO("mysql:host=" . DB['HOST'] . ";
    dbname=" . DB['NAME'], DB['USER'], DB['PASSWORD'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"]);
} 
catch (PDOException $e) 
{
    exit("Error: " . $e->getMessage());
}