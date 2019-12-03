<?php

/**
 * Configuration for database connection
 *
 */
 
$db = parse_url($_ENV["CLEARDB_DATABASE_URL"]);

global $host;
global $username;
global $password;
global $options;
global $dbname;
global $dsn;

$host       = $db["host"];
$username   = $db["user"];
$password   = $db["pass"];
$dbname     = trim($db["path"],"/");
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );