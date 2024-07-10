<?php
// ข้อมูลสำหรับการเชื่อมต่อ MySQL Database
$host = 'localhost'; // เปลี่ยนเป็น Host ของ MySQL Server ของคุณ
$dbname = 'my_database'; // ชื่อของฐานข้อมูลที่คุณต้องการเชื่อมต่อ
$username = 'root'; // ชื่อผู้ใช้ MySQL
$password = ''; // รหัสผ่าน MySQL

try {
    // เชื่อมต่อฐานข้อมูล MySQL โดยใช้ PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // รับค่าที่จะเพิ่มเข้าไปใน person
    $name = $_POST['name'];
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    
    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลใน address และรับ A_id ที่เพิ่มเข้าไปใน person
    $stmt_address = $pdo->prepare("INSERT INTO address (street, city, state, postalCode) VALUES (?, ?, ?, ?)");
    $stmt_address->execute([$street, $city, $state, $postalCode]);
    $A_id = $pdo->lastInsertId(); // รับ A_id ที่เพิ่มเข้าไปใน address
    
    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลใน person โดยใช้ A_id ที่ได้จาก address
    $stmt_person = $pdo->prepare("INSERT INTO person (name, age, A_id) VALUES (?, ?, ?)");
    $stmt_person->execute([$name, $age, $A_id]);
    
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว<br>";
    echo "<a href='index.php'>กลับไปที่หน้าตารางหลัก</a>"; // เพิ่มลิงก์หรือปุ่มย้อนกลับ
} catch (PDOException $e) {
    die("เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $e->getMessage());
}
?>
