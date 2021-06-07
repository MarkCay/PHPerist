<?php

use Requtize\QueryBuilder\Connection;
use Requtize\QueryBuilder\QueryBuilder\QueryBuilderFactory;
use Requtize\QueryBuilder\ConnectionAdapters\PdoBridge;

// Somewhere in our application we have created PDO instance
$hostname = Config::HOSTNAME;
$username = Config::USERNAME;
$password = Config::PASSWORD;
$database = Config::DATABASE;
// debug($username);
$pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

// Build Connection object with PdoBridge ad Adapter
$conn = new Connection(new PdoBridge($pdo));

// Pass this connection to Factory
$qbf = new QueryBuilderFactory($conn);