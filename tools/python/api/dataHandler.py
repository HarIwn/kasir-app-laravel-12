import requests
import datetime

print_time = datetime.datetime.now()

url = 'http://127.0.0.1:8000/api/dataCustomer'

def kirim_ke_laravel(barcode_data, barcode_type):
    print(f"DEBUG: barcode_data={repr(barcode_data)}, barcode_type={repr(barcode_type)}")  # Tambahkan debug

    params = {
        'barcode_data': barcode_data,
        'barcode_type': barcode_type
    }

    try:
        # Debug sebelum request
        print(f"DEBUG: Mengirim request ke URL: {url} dengan params: {params}")
        
        response = requests.get(url, params=params)
        
        print("----------------------" + str(print_time) + "----------------------")
        print("Status:", response.status_code)
        print("Response dari Laravel:", response.text)
    except Exception as e:
        print("Error saat mengirim request ke Laravel:", e)
