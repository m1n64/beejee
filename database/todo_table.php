<?php
ini_set('display_errors', 1);

include "../app/Core/DatabaseConnection.php";
include "../app/Core/Migration.php";

use Beejee\App\Core\Migration;

echo Migration::create("todo_list", [
    "name"=>"VARCHAR(255)",
    "email"=>"VARCHAR(255)",
    "text"=>"TEXT",
    "is_done"=>"INT DEFAULT 0",
]);