# Sun Alba

## Kebutuhan Sebelum Instalasi
Berikut ini aplikasi dan layanan yang perlu dimiliki sebelum menjalankan 
aplikasi utama:
- docker desktop
- RajaOngkir API key, [daftar dulu](https://rajaongkir.com/akun/daftar) untuk mendapatkan API key
- simpan API key yang didapatkan didalam file `.env` pada variable `RAJA_ONGKIR`
- jalankan composer autoload agar nilai env RAJA_ONGKIR terbaca,  
gunakan command `composer dump-autoload`

## Cara Instalasi dengan Docker
- pastikan docker desktop terinstall di sistem dan sudah running
- gunakan command `docker-compose up -d` untuk proses install aplikasi dalam docker
- tunggu 10 detik atau lebih setelah proses install selesai, lalu gunakan command di bawah ini untuk menjalankan database migration
    ```sh
    docker exec  web php artisan migrate
    ```
- setelah itu, gunakan command di bawah ini untuk menjalankan database seeding dengan data dummy
    ```sh
    docker exec web php artisan db:seed
    ```

## Cara Penggunaan Aplikasi dengan Postman
### User Auth
- **Get All User** kunjungi alamat `localhost:8000/users` dengan method `GET` untuk mendapatkan data email dummy. Data email ini nanti akan diperlukan untuk login ke dalam sistem.
- **User Register** kunjungi alamat `localhost:8000/register` dengan method `POST` untuk register user baru. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "name": "hello",
        "email": "hello@example.com",
        "password": "hello_password"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "data created"
    }
    ```
- **User Login** Kunjungi alamat `localhost:8000/login` dengan method `POST` untuk login dengan email dan password yang telah terdaftar. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "email": "hello@example.com",
        "password": "hello_password"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "logged in"
    }
    ```
- **User Logout** Kunjungi alamat `localhost:8000/logout` dengan method `POST` untuk logout dengan email dan password yang telah terdaftar. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "email": "hello@example.com",
        "password": "hello_password"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "logged out"
    }
    ```
### Categories
- **Login** diperlukan sebelum bisa mengakses data categories. Silakan gunakan data dummy users yang sudah digenerate sebelumnya maupun yang sudah dibuat sendiri. Data dummy user bisa digunakan untuk login dengan menggunakan akun email manapun yang terdaftar di sistem. Sementara itu, untuk password seluruh data dummy adalah `password`.
- **Get Categories** untuk menayangkan seluruh data kategori. Kunjungi alamat `localhost:8000/categories` dengan method `GET`
- **Post Categories** untuk menambah data kategori. Kunjungi alamat `localhost:8000/categories` dengan method `POST`. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "name": "Valentino Rossi"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "category created"
    }
    ```
- **Put Categories** untuk mengubah/update data kategori berdasarkan id-nya. Kunjungi alamat `localhost:8000/categories/11` untuk mengupdate kategori dengan id `11` dengan method `PUT`. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "name": "Lionel Messi"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "category updated"
    }
    ```
- **Delete Categories** untuk menghapus kategori berdasarkan id-nya. Kunjungi alamat `localhost:8000/categories/11` untuk menghapus kategori dengan id `11` dengan method `DELETE`. Jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "category deleted"
    }
    ```
### Tags
- **Login** diperlukan sebelum bisa mengakses data tags. Silakan gunakan data dummy users yang sudah digenerate sebelumnya maupun yang sudah dibuat sendiri. Ddata dummy user bisa digunakan untuk login dengan menggunakan akun email manapun yang terdaftar di sistem. 
Sementara itu, untuk password seluruh data dummy adalah `password`.
- **Get Tags** untuk menayangkan seluruh data tag. Kunjungi alamat `localhost:8000/tags` dengan method `GET`
- **Post Tags** untuk menambah data tag. Kunjungi alamat `localhost:8000/tags` dengan method `POST`. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "name": "tag_abc"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "tag created"
    }
    ```
- **Put Tags** untuk mengubah/update data tag berdasarkan id-nya. Kunjungi alamat `localhost:8000/tags/2` untuk mengupdate tag dengan id `2` dengan method `PUT`. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "name": "tag_bcd"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "tag updated"
    }
    ```
- **Delete Tags** untuk menghapus tag berdasarkan id-nya. Kunjungi alamat `localhost:8000/tags/6` untuk menghapus tag dengan id `6` dengan method `DELETE`. Jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "tag deleted"
    }
    ```
### Posting
- **Login** diperlukan sebelum bisa mengakses data Blog Posting. Silakan gunakan data dummy users yang sudah digenerate sebelumnya maupun yang sudah dibuat sendiri. Data dummy user bisa digunakan untuk login dengan menggunakan akun email manapun yang terdaftar di sistem. 
Sementara itu, untuk password seluruh data dummy adalah `password`.
- **Get Posting** untuk menayangkan seluruh data posting . Kunjungi alamat `localhost:8000/posts` dengan method `GET`
- **Post Posting** untuk menambah data posting. Kunjungi alamat `localhost:8000/posts` dengan method `POST`. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "title": "Indonesia Merdeka",
        "content": "proklamasi 17 agustus 1945",
        "categories": "[8,2,1,4]",
        "tags": "[4,5]"
    }
    ```
    Pastikan sebelumnya bahwa id categories dengan nilai 8, 2, 1, dan 4 telah ada di dalam database, dan id tags dengan nilai 4 dan 5 juga terdaftar di database agar bisa menambahkan posting baru.  
    jika penambahan posting berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "post created"
    }
    ```
- **Put Posting** untuk mengubah/update data posting berdasarkan id-nya. Kunjungi alamat `localhost:8000/posts/6` untuk mengupdate posting dengan id `6` dengan method `PUT`. Pilih `Body > raw > JSON` dan isi data yang dibutuhkan seperti contoh di bawah ini:
    ```json
    {
        "title": "Indonesia Merdeka",
        "content": "Bandung Lautan API, ayo rebut kembali",
        "categories": "[8,2,1,3]",
        "tags": "[4,2]"
    }
    ```
    jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "post updated"
    }
    ```
- **Delete Posting** untuk menghapus posting berdasarkan id-nya. Kunjungi alamat `localhost:8000/posts/6` untuk menghapus kategori dengan id `6` dengan method `DELETE`. Jika berhasil, maka akan mendapatkan response seperti di bawah ini:
    ```json
    {
        "message": "post deleted"
    }
    ```
- **View Blog Post** untuk melihat posting dengan blog view. Kunjungi `http://localhost:8000` pada browser untuk melihatnya.
### Shipping
- **Login** diperlukan sebelum bisa mengakses API Shipping. Silakan gunakan data dummy users yang sudah digenerate sebelumnya maupun yang sudah dibuat sendiri. Data dummy user bisa digunakan untuk login dengan menggunakan akun email manapun yang terdaftar di sistem. **Mulai dari sini, Akan menggunakan API RAJA ONGKIR**. Jadi, pastikan sudah menjalankan instruksi mengenai RAJA_ONGKIR
Sementara itu, untuk password seluruh data dummy adalah `password`.
- **Get Province** untuk menayangkan seluruh data provinsi . Kunjungi alamat `localhost:8000/shipping/province` dengan method `GET`
- **Get City** untuk menayangkan seluruh data Kota berdasarkan provinsi dengan **id=1** . Kunjungi alamat `localhost:8000/shipping/city/1` dengan method `GET`
- **Get Costs** untuk mendapatkan data shipping cost. Contohnya ingin memperoleh shipping cost dengan pengiriman dari `city_id: 17` ke `city_id:32` dengan nilai berat `10`, maka kunjungi alamat `localhost:8000/shipping/costs` dengan method `GET`, pilih `Body > raw > JSON` lalu isi dengan json di bawah ini:
```json
{
    "origin": 17,
    "destination": 32,
    "weight": 10
}
```