<?php
$host = 'localhost';
$dbname = 'sait';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'] ?? '';
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';

        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        $stmt = $pdo->prepare("SELECT * FROM reg WHERE login = ?");
        $stmt->execute([$login]);

        if ($stmt->rowCount() > 0) {
            echo "Користувач з таким логіном вже існує.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            $stmt = $pdo->prepare("INSERT INTO reg (login, name, pass) VALUES (?, ?, ?)");
            $stmt->execute([$login, $name, $hashed_password]);
        
            // Встановлюємо повідомлення про успішну реєстрацію у сесії
            session_start();
            $_SESSION['registration_success'] = 'Користувача успішно зареєстровано! Будь ласка, увійдіть.';
        
            // Перенаправлення на сторінку входу
            header("Location: Logi.php"); // Переконайтесь, що ви змінили розширення файлу на .php
            exit;
        }
    }

    session_start();
// після успішної аутентифікації або реєстрації
$_SESSION['user'] = $name; // або інша унікальна ідентифікація користувача

} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>

