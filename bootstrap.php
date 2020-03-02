<?php
// include autoload
include 'autoload.php';
// array with parameters for db connection
$config = require('config.php');

// connect to database
$db = Connection::connect($config["databases"]);

$query_builder = new QueryBuilder($db);