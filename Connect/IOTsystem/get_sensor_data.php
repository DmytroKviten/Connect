<?php
$host = 'localhost'; // або інший хост
$dbname = 'iot_database'; // ваше ім'я бази даних
$user = 'root'; // ваше ім'я користувача бази даних
$pass = ''; // ваш пароль бази даних
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Отримання останніх даних з таблиці sensor_data
    $stmt = $pdo->query("SELECT temperature, humidity, battery_state, temp_unit FROM sensor_data ORDER BY timestamp DESC LIMIT 1");
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>