<?php
$host = 'localhost'; // або інший хост
$dbname = 'iot_database'; // ваше ім'я бази даних
$user = 'root'; // ваше ім'я користувача бази даних
$pass = ''; // ваш пароль бази даних
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Прийом даних з POST-запиту
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        // Виведення даних для діагностики
        file_put_contents('php://stderr', print_r($data, TRUE));

        // Перетворення значення температури
        $temperature = $data[0]['value'] / 10;
        $humidity = $data[1]['value'];
        $battery_state = $data[2]['value'];
        $temp_unit = $data[3]['value'];

        // Обробка даних та збереження в базу даних
        $stmt = $pdo->prepare("INSERT INTO sensor_data (temperature, humidity, battery_state, temp_unit) VALUES (?, ?, ?, ?)");
        $stmt->execute([$temperature, $humidity, $battery_state, $temp_unit]);

        echo "Дані успішно збережено";
    } else {
        echo "Немає даних для збереження";
    }
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>