<?php
// ข้อมูลสำหรับการเชื่อมต่อ MySQL Database
$host = 'localhost'; // เปลี่ยนเป็น Host ของ MySQL Server ของคุณ
$dbname = 'my_database'; // ชื่อของฐานข้อมูลที่คุณต้องการเชื่อมต่อ
$username = 'root'; // ชื่อผู้ใช้ MySQL
$password = ''; // รหัสผ่าน MySQL

try {
    // เชื่อมต่อฐานข้อมูล MySQL โดยใช้ PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // ตั้งค่า PDO เพื่อให้แสดงข้อผิดพลาดเมื่อเกิดข้อผิดพลาด
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // แสดงข้อความเมื่อเชื่อมต่อสำเร็จ
    echo "เชื่อมต่อฐานข้อมูล $dbname สำเร็จ";
} catch (PDOException $e) {
    // แสดงข้อผิดพลาดเมื่อเชื่อมต่อไม่สำเร็จ
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>
