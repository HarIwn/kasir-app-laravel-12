import cv2
from pyzbar.pyzbar import decode
import pandas as pd
import datetime
import time
import os

from playsound import playsound
from api.dataHandler import kirim_ke_laravel

CHECK_VERSION_APP = "v1.0"
window_header = f"Kasirku - Scan Barcode {CHECK_VERSION_APP}"
AUDIO_PATH = "src/aud/trigger.mp3"
EXCEL_PATH = "src/data/database_barcode_update_2021.xlsx"

def baca_excel_barcode(file_path):
    if not os.path.exists(file_path):
        print(f"File Excel tidak ditemukan: {file_path}")
        return {}

    try:
        df = pd.read_excel(file_path, header=None, dtype={0: str}) # Membaca file Excel tanpa header spesifik
        df[0] = df[0].astype(str).str.strip() # Menghapus spasi di awal/akhir

        if df.shape[1] < 2:  # Minimal 2 kolom barcode dan nama produk
            print("Excel harus punya minimal 2 kolom: barcode dan nama produk.")
            return {}

        return dict(zip(df[0], df[1]))  # {barcode: nama_produk}
    except Exception as e: # menangkap kesalahan saat membaca file Excel
        print("Gagal membaca file Excel:", e)
        return {}

def detect_and_decode_barcode(image, barcode_list=None):
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY) # Mengubah gambar ke grayscale
    barcodes = decode(gray) # Mendeteksi barcode

    for barcode in barcodes: # Mendapatkan informasi barcode
        barcode_data = barcode.data.decode("utf-8")
        barcode_type = barcode.type
        print_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")

        print(f"\n------ {print_time} ------")
        print("Barcode Data:", barcode_data)
        print("Barcode Type:", barcode_type)

        if barcode_list and barcode_data in barcode_list:
            nama_produk = barcode_list[barcode_data]
            print(f"Barcode terdaftar: {nama_produk}")

            if os.path.exists(AUDIO_PATH):
                try:
                    playsound(AUDIO_PATH)
                except Exception as e:
                    print("Gagal memutar audio:", e)
            else:
                print("File audio tidak ditemukan:", AUDIO_PATH)

            kirim_ke_laravel(barcode_data, barcode_type)
        else:
            print("Barcode tidak ditemukan di daftar Excel.")

        x, y, w, h = barcode.rect # Mendapatkan koordinat dan ukuran barcode
        cv2.rectangle(image, (x, y), (x + w, y + h), (0, 255, 0), 2)
        cv2.putText(image, f"{barcode_data} ({barcode_type})",
                    (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 0), 2)

        draw_grid(image, x, y, w, h) # Menggambar grid pada area barcode
        show_green_window(image, x, y, w, h) # Menampilkan jendela hijau pada area barcode

    return image

def draw_grid(image, x, y, w, h, grid_size=10): # Menggambar grid pada area barcode
    for i in range(w // grid_size + 1):
        start_x = x + i * grid_size
        cv2.line(image, (start_x, y), (start_x, y + h), (0, 0, 255), 1)
    for i in range(h // grid_size + 1):
        start_y = y + i * grid_size
        cv2.line(image, (x, start_y), (x + w, start_y), (0, 0, 255), 1)

def show_green_window(image, x, y, w, h, durasi=3): # Menampilkan jendela hijau pada area barcode
    end_time = time.time() + durasi
    while time.time() < end_time:
        temp_image = image.copy()
        cv2.rectangle(temp_image, (x, y), (x + w, y + h), (0, 255, 0), -1)
        cv2.imshow(window_header, temp_image)
        cv2.waitKey(1)

def scan_from_camera(): # Fungsi utama untuk memindai barcode dari kamera
    barcode_list = baca_excel_barcode(EXCEL_PATH)

    if not barcode_list:
        print("Tidak ada data barcode yang bisa digunakan.")

    cap = cv2.VideoCapture(0) # 0 untuk webcam internal, 1 untuk eksternal
    cap.set(cv2.CAP_PROP_FRAME_WIDTH, 640)
    cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 640)

    if not cap.isOpened(): # Mengecek apakah kamera bisa dibuka
        print("Tidak bisa mengakses kamera.")
        return

    print("Tekan 'q' untuk keluar.")

    while True: # Loop untuk membaca frame dari kamera
        ret, frame = cap.read()
        if not ret:
            break

        frame = cv2.resize(frame, (640, 640))
        frame = detect_and_decode_barcode(frame, barcode_list=barcode_list)
        cv2.imshow(window_header, frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    cap.release()
    cv2.destroyAllWindows()

if __name__ == "__main__": # Menjalankan fungsi utama
    scan_from_camera()
