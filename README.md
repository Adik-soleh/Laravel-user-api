# **User API - Laravel 12**
Proyek ini adalah RESTful API User Management menggunakan Laravel 12 dan MySQL. API ini memungkinkan pengguna untuk melakukan operasi CRUD 
(Create, Read, Update, Delete) validasi, logging, dan dokumentasi menggunakan Swagger. pada entitas User dengan atribut berikut:

id (UUID)
name (string)
email (string, unique)
age (number)
API sederhana untuk mengelola data pengguna dengan fitur CRUD, validasi, logging, dan dokumentasi menggunakan Swagger.

## **Fitur**
- ✅ **CRUD User** (Create, Read, Update, Delete)
- ✅ **Validasi Input** menggunakan Middleware
- ✅ **Logging Request**
- ✅ **Dokumentasi API dengan Swagger**
- ✅ **Pengujian dengan Jest**

---

## **Instalasi dan Menjalankan Secara Lokal**

### **1. Clone Repository**
```bash
git clone https://github.com/Adik-soleh/Laravel-user-api.git
cd user-api
```

### **2. Install Dependency**
```bash
composer install
```

### **3. Konfigurasi Environment**
- Duplikasi file `.env.example` menjadi `.env`
- Atur konfigurasi database di `.env`
  ```ini
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=user_db
  DB_USERNAME=root
  DB_PASSWORD=
  ```

### **4. Generate APP_KEY**
```bash
php artisan key:generate
```

### **5. Jalankan Migrasi Database**
```bash
php artisan migrate
```

### **6. Jalankan Server**
```bash
php artisan serve
```
Aplikasi berjalan di `http://127.0.0.1:8000`

---

## **Pengujian API**
Gunakan **Postman** atau **cURL** untuk mencoba endpoint:

### **1. Mendapatkan Semua User**
```bash
curl -X GET http://127.0.0.1:8000/api/users
```

### **2. Menambahkan User Baru**
```bash
curl -X POST http://127.0.0.1:8000/api/users \
     -H "Content-Type: application/json" \
     -d '{"name": "Panjul", "email": "panjul@example.com", "age": 25}'
```

---

## Menjalankan Swagger UI
Swagger digunakan untuk mendokumentasikan API.

1. **Jalankan Perintah untuk Generate Dokumentasi**
   ```bash
   php artisan l5-swagger:generate
   ```

2. **Akses Swagger UI**
   Setelah server berjalan, buka browser dan akses:
   ```
   http://127.0.0.1:8000/api/documentation
   ```

## **Menjalankan Pengujian dengan Jest**

Aplikasi ini menggunakan **Jest** untuk menguji endpoint API.

### **1. Pindah Directory**

```bash
cd test-jest
```

### **2. Install Jest**

```bash
npm install --save-dev jest supertest
```

### **3. Menjalankan Tes**

```bash
npm test
```

Pastikan server Laravel sudah berjalan sebelum menjalankan pengujian.

---
