<?php
session_start();
$host = 'localhost'; // або інший хост
$dbname = 'sait'; // ваше ім'я бази даних
$user = 'root'; // ваше ім'я користувача бази даних
$pass = ''; // ваш пароль бази даних
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM reg WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['pass'])) {
            $_SESSION['user'] = $user['name']; // або інше поле, яке ідентифікує користувача
            header("Location: ../index.php"); // Вийти на один рівень вище до кореневої папки
            exit;
        } else {
            // Додайте обробку помилки, якщо логін або пароль невірні
            echo "Неправильний логін або пароль.";
        }
    }
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>