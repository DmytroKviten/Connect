// Прикладний JavaScript код, який може бути використаний для взаємодії на сторінці
document.addEventListener('DOMContentLoaded', () => {
    // Додайте тут логіку для взаємодії з формою підписки та іншими елементами
    const subscribeButton = document.querySelector('button[type="submit"]');
    
    subscribeButton.addEventListener('click', (event) => {
        event.preventDefault();
        alert('Функція підписки в розробці!');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetchSensorData();
});

function fetchSensorData() {
    fetch('http://localhost/Test1/IOTsystem/get_sensor_data.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('displayTemperature').textContent = data.temperature + '°C';
            document.getElementById('displayHumidity').textContent = data.humidity + '%';
        })
        .catch(error => console.error('Error fetching data:', error));
}

document.getElementById('connect-device-button').addEventListener('click', function(event) {
    event.preventDefault();
    fetch('run_python_script.php')
        .then(response => response.text())
        .then(data => {
            console.log('Python script executed:', data);
        })
        .catch(error => {
            console.error('Error executing Python script:', error);
        });
});