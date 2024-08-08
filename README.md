
# Interview Test Sagala

Article Service adalah sebuah web service untuk mengelola artikel. Web service ini dibangun menggunakan Laravel dan mendukung pembuatan, pengambilan, dan pencarian artikel dengan fitur caching untuk menahan request banyak dan mendadak secara tiba-tiba.

## Fitur
- Membuat artikel baru
- Mendapatkan daftar artikel
- Mendapatkan artikel berdasarkan ID dengan caching
- Pencarian artikel berdasarkan keyword di title dan body
- Filter artikel berdasarkan author

## Teknologi yang Digunakan
- PHP 8.2 atau keatas
- Laravel 11.x
- MySQL / PostgreSQL / SQLite (Anda bisa menggunakan database apapun)
- PHPUnit (untuk testing)

## Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Database (MySQL, PostgreSQL, atau SQLite)

### Langkah-langkah Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/pradho/sagala-test.git
   cd sagala-test
   ```
2. Install dependensi menggunakan Composer:
   ```bash
   composer install
   ```
3. Salin file .env.example menjadi .env dan sesuaikan konfigurasi database:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
6. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## Penggunaan

### Endpoint API
- **[POST] /api/articles** - Membuat artikel baru
    - Body:
      ```json
      {
        "author": "Dadang Supriatna",
        "title": "Buku Dongeng",
        "body": "Ini isi buku dongeng"
      }
      ```

- **[GET] /api/articles** - Mendapatkan daftar artikel
    - Query Parameters:
        - `query` (opsional) - mencari keyword pada artikel body dan title
        - `author` (opsional) - filter berdasarkan nama author

- **[GET] /api/articles/{id}** - Mendapatkan artikel berdasarkan ID

### Contoh Request Menggunakan cURL

1. Membuat artikel baru:
   ```bash
   curl -X POST http://localhost:8000/api/articles    -H "Content-Type: application/json"    -d '{
     "author": "Dadang Supriatna",
     "title": "Buku Dongeng",
     "body": "Ini adalah buku dongeng."
   }'
   ```

2. Mendapatkan daftar artikel:
   ```bash
   curl http://localhost:8000/api/articles
   ```

3. Mendapatkan artikel berdasarkan ID:
   ```bash
   curl http://localhost:8000/api/articles/1
   ```

## Testing

### Menjalankan Testing
Untuk menjalankan semua test, gunakan perintah berikut:
```bash
php artisan test
```

### Menambahkan Data Dummy untuk Testing
Untuk mempermudah testing, Anda bisa menggunakan factory yang sudah disediakan:
- Factory file: `database/factories/ArticleFactory.php`

Contoh penggunaan factory di testing:
```php
$article = Article::factory()->create(['title' => 'Unique Article']);
```
