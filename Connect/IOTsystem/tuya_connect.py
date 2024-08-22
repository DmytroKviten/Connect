import requests
import json
import time
import hmac
import hashlib

# Налаштування Tuya API
ACCESS_ID = 'mkm9rfrq8edwr8rcja8c'
ACCESS_KEY = '1a6898ca13874149859c978fca9f5208'
API_ENDPOINT = 'https://openapi.tuyaeu.com'  # URL для Європейського регіону

# Функція для генерації підпису
def generate_signature(access_id, access_key, timestamp, nonce, http_method, url, access_token=None):
    content_sha256 = hashlib.sha256(b'').hexdigest()  # Порожнє тіло запиту
    string_to_sign = f"{http_method}\n{content_sha256}\n\n{url}"
    if access_token:
        message = f"{access_id}{access_token}{timestamp}{nonce}{string_to_sign}"
    else:
        message = f"{access_id}{timestamp}{nonce}{string_to_sign}"
    signature = hmac.new(access_key.encode('utf-8'), msg=message.encode('utf-8'), digestmod=hashlib.sha256).hexdigest().upper()
    return signature

# Отримання поточного часу
timestamp = str(int(time.time() * 1000))

# Генерація nonce (унікального ідентифікатора запиту)
nonce = str(int(time.time() * 1000))

# Генерація підпису для отримання токена
http_method = "GET"
url_path = "/v1.0/token?grant_type=1"
signature = generate_signature(ACCESS_ID, ACCESS_KEY, timestamp, nonce, http_method, url_path)

# Заголовки для запиту токена
headers = {
    'client_id': ACCESS_ID,
    'sign': signature,
    't': timestamp,
    'sign_method': 'HMAC-SHA256',
    'nonce': nonce
}

# Виконання запиту для отримання токена
url = f"{API_ENDPOINT}{url_path}"
response = requests.get(url, headers=headers)
token_response = response.json()

if token_response['success']:
    access_token = token_response['result']['access_token']
    print("Токен доступу отримано:", access_token)
else:
    print("Не вдалося отримати токен доступу")
    print("Відповідь від API:", token_response)
    exit()

# Виконання запиту для отримання даних з датчика
device_id = 'bfea7838726f885481awsk'  # 
url_path = f"/v1.0/iot-03/devices/{device_id}/status"
http_method = "GET"
timestamp = str(int(time.time() * 1000))
nonce = str(int(time.time() * 1000))
signature = generate_signature(ACCESS_ID, ACCESS_KEY, timestamp, nonce, http_method, url_path, access_token)

# Заголовки для запиту даних з датчика
headers = {
    'client_id': ACCESS_ID,
    'sign': signature,
    't': timestamp,
    'sign_method': 'HMAC-SHA256',
    'nonce': nonce,
    'access_token': access_token
}

# Виконання запиту для отримання даних з датчика
url = f"{API_ENDPOINT}{url_path}"
response = requests.get(url, headers=headers)
sensor_data_response = response.json()

# Виведення деталей запиту і підпису для діагностики
print("Заголовки для запиту даних з датчика:", headers)
print("URL:", url)
print("Підпис:", signature)

if sensor_data_response['success']:
    sensor_data = sensor_data_response['result']
    print("Дані з датчика:", sensor_data)

    # Відправка даних на локальний сервер
    site_url = 'http://localhost/Test1/IOTsystem/your_php_script.php'  # Введіть URL вашого локального PHP-скрипта
    response = requests.post(site_url, json=sensor_data)
    if response.status_code == 200:
        print("Дані успішно відправлені на сайт")
    else:
        print("Помилка при відправці даних на сайт:", response.status_code)
else:
    print("Помилка при отриманні даних з датчика:", sensor_data_response)

