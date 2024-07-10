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
    
    // รับค่าที่จะอัปเดต
    $P_id = $_POST['P_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    
    // เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูลใน person
    $stmt_person = $pdo->prepare("UPDATE person SET name = ?, age = ? WHERE P_id = ?");
    $stmt_person->execute([$name, $age, $P_id]);
    
    // เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูลใน address
    $stmt_address = $pdo->prepare("UPDATE address SET street = ?, city = ?, state = ?, postalCode = ? WHERE A_id = (SELECT A_id FROM person WHERE P_id = ?)");
    $stmt_address->execute([$street, $city, $state, $postalCode, $P_id]);
    
    echo "อัปเดตข้อมูลเรียบร้อยแล้ว<br>";
    echo "<a href='index.php'>กลับไปที่หน้าตารางหลัก</a>"; // เพิ่มลิงก์หรือปุ่มย้อนกลับ
} catch (PDOException $e) {
    die("เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $e->getMessage());
}
?>
