# Meat-Shop
เป็นระบบการสั่งซื้อเนื้อออนไลน์

## สมาชิกในกลุ่ม
* นาย อิศเรศน์   สิงห์ทวีศักดิ์ 6010450802
* นาย ภัทรพล   พลตะคุ    6010450586
* นาย ศิขริน    กาดีโรจน์   6010450713

## เครื่องมือที่ใช้
* Laragon
* Atom

## ภาษาที่ใช้
* HTML
* CSS
* PHP
* JavaScript

## Framework
* Laravel Framework

## ขั้นตอนการติดตั้ง
* ติดตั้งไฟล์   C:\laragon\www\
* เปิด laragon แล้วใช้คำสั่ง cd ไปที่ folder Meat-Shop 
* กดรัน Mysql
* เปิด Mysql จาก laragon ขึ้นมา
* สร้าง Database ชื่อ project ตั้ง Collation เป็น utf8mb4_unicode_ci
* เปิด Terminal ของ Laragon
* ใช้คำสั่ง php artisan migrate:refresh --seed
* ใช้คำสั่ง php artisan serve
* พร้อมใช้งาน

## User สำหรับการเข้าใช้
* USERNAME : admin     PASSWORD : 123456  ROLE : (ADMIN)
* USERNAME : customer  PASSWORD : 123456  ROLE : (CUSTOMER)
