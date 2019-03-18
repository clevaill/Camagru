<?php

namespace config;

use Library\DbConnection;

class Setup {
  require 'database.php';
  try {
    $conn = new PDO("mysql:host=$DB_DSN", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE Camagru";
    $conn->exex($sql);
  }
}
