<?php

use PHPMailer\PHPMailer\Exception;

try {
    $db = new PDO(
        "mysql:
        host=localhost;
        dbname=database;
        port=8889",
        "root",
        "root"
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Unable to connect";
    echo $e->getMessage();
    exit;
}
