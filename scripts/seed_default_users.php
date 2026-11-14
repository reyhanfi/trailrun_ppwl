<?php

$db = new PDO('sqlite:database/database.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("INSERT OR IGNORE INTO users (name, email, password, level, created_at, updated_at) VALUES ('Admin Jatrilrun', 'admin@jatrilrun.com', '" . password_hash('admin123', PASSWORD_BCRYPT) . "', 'admin', datetime('now'), datetime('now'))");
$db->exec("INSERT OR IGNORE INTO users (name, email, password, level, created_at, updated_at) VALUES ('User Jatrilrun', 'user@jatrilrun.com', '" . password_hash('user123', PASSWORD_BCRYPT) . "', 'user', datetime('now'), datetime('now'))");

$stmt = $db->query("SELECT email, level FROM users ORDER BY level");
foreach ($stmt as $row) {
    echo $row['email'] . ' | ' . $row['level'] . PHP_EOL;
}
