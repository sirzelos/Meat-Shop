# Meat-Shop

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
* clone project จาก git hub ลง folder www ของ laragon ด้วยคำสั่ง git clone https://github.com/sirzelos/Meat-Shop.git
* เปิด laragon แล้วใช้คำสั่ง cd ไปที่ folder project ที่ clone มา
* ใช้คำสั่ง composer install  
* ใช้คำสั่ง composer dump-autoload 
* ใช้คำสั่ง cp .env.example .env
* ใช้คำสั่ง php artisan key:generate
* เปิด Mysql จาก laragon ขึ้นมา
* สร้าง Database ชื่อ project ขึ้นมาโดยใช้ user เป็น root ชั่วคราว (ไม่มีรหัส)
* ใช้คำสั่ง php artisan migrate:refresh --seed
* ใช้คำสั่ง php artisan serve
* พร้อมใช้งาน

## User สำหรับการเข้าใช้
* USERNAME : admin     PASSWORD : 123456  ROLE : (ADMIN)
* USERNAME : customer  PASSWORD : 123456  ROLE : (CUSTOMER)
