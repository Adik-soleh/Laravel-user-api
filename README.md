# **User API - Laravel 12**

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
git clone https://github.com/username/user-api.git
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
     -d '{"name": "John Doe", "email": "john@example.com", "age": 25}'
```


