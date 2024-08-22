<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<title>Connect</title>

</head>
<body>

<div class="header">
    <?php if (isset($_SESSION['user'])): ?>
        <div class="left">
            <a href="IOTsystem/IOT.html" class="button">DEMO</a>
        </div>
        <div class="center">
            <span>Вітаємо, <?php echo htmlspecialchars($_SESSION['user']); ?>!</span>
        </div>
        <div class="right">
            <a href="registration/logout.php" class="button">Вийти</a>
        </div>
    <?php else: ?>
        <div class="left">
            <button class="button" id="demo" disabled>DEMO</button>
        </div>
        <div class="right">
            <a href="Registration/logi.php" class="button" id="login">LOG IN</a>
            <a href="Registration/reg.html" class="button" id="register">REGISTER</a>
        </div>
    <?php endif; ?>
</div>

<div class="branding">
    <img src="image/krest.png" alt="icon">
    <h1>Connect</h1>
    <p class="tagline">Connected to the Future: Your One-Stop Portal to Innovative Internet of Things (IoT) Solutions</p>
</div>

<div class="buttons-container">
    <button class="custom-button" onclick="playVideo('video-1')">Air Quality Monitoring</button>
    <button class="custom-button" onclick="playVideo('video-2')">Asset Management</button>
</div>

<div id="video-container">
    <video id="video-1" loop autoplay muted>
      <source src="image/air.mp4" type="video/mp4">
      Ваш браузер не підтримує відео тег.
    </video>
    <video id="video-2" loop muted style="display: none;">
      <source src="image/run.mp4" type="video/mp4">
      Ваш браузер не підтримує відео тег.
    </video>
</div>

<script src="script.js"></script>
<script>
function activateDemo() {
    // Логіка активації демо
}
</script>
</body>
</html>
