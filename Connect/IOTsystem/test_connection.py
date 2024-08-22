import requests

url = "https://openapi.tuyaeu.com/v1.0/iot-01/associated-users/actions/authorized-login"

try:
    response = requests.get(url)
    print("Статус-код відповіді:", response.status_code)
    print("Відповідь:", response.text)
except requests.exceptions.RequestException as e:
    print("Виникла помилка:", e)