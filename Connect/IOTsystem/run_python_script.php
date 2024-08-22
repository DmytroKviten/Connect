<?php
// Запуск Python-скрипта
$output = shell_exec('python C:\\xampp\\htdocs\\Test1\\IOTsystem\\tuya_connect.py 2>&1');

// Виведення результату
echo "<pre>$output</pre>";
?>