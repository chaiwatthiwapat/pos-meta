## ขั้นตอนติดตั้ง

1. รันคำสั่ง Terminal:

```shell script
$ composer install
$ npm install
```
2. Database อยู่ในโฟลเดอร์ database & ติดตั้ง database ให้เรียบร้อย (MySQL)

3. ถ้าภาพแสดงผิด ถ้ามี public/storage ให้ลบ storage ก่อน รันคำสั่ง Terminal:
```bash
php artisan storage:link
```

4. รันคำสั่ง Terminal 1:
```shell script
$ php artisan serve
```

5. รันคำสั่ง Terminal 2:
```shell script
$ npm run dev
```

6. หากติดปัญหา รันคำสั่ง Terminal ต่อไปนี้
```shell script
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```
