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
    
    // รับค่า P_id ที่จะแก้ไข
    $P_id = $_POST['P_id'];
    
    // คำสั่ง SQL เพื่อดึงข้อมูล person และ address โดยระบุ P_id
    $stmt = $pdo->prepare("SELECT person.P_id, person.name, person.age, address.A_id, address.street, address.city, address.state, address.postalCode
                           FROM person
                           INNER JOIN address ON person.A_id = address.A_id
                           WHERE person.P_id = ?");
    $stmt->execute([$P_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$row) {
        die("ไม่พบข้อมูลที่ต้องการแก้ไข");
    }
    
    // แสดงฟอร์มสำหรับแก้ไขข้อมูล
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<title>แก้ไขข้อมูล</title>";
    echo "</head>";
    echo "<body>";
    echo "<h2>แก้ไขข้อมูล</h2>";
    echo "<form action='update.php' method='post'>";
    echo "<input type='hidden' name='P_id' value='{$row['P_id']}'>";
    echo "<label for='name'>Name:</label>";
    echo "<input type='text' id='name' name='name' value='{$row['name']}'><br><br>";
    
    echo "<label for='age'>Age:</label>";
    echo "<input type='text' id='age' name='age' value='{$row['age']}'><br><br>";
    
    echo "<label for='street'>Street:</label>";
    echo "<input type='text' id='street' name='street' value='{$row['street']}'><br><br>";
    
    echo "<label for='city'>City:</label>";
    echo "<input type='text' id='city' name='city' value='{$row['city']}'><br><br>";
    
    echo "<label for='state'>State:</label>";
    echo "<input type='text' id='state' name='state' value='{$row['state']}'><br><br>";
    
    echo "<label for='postalCode'>Postal Code:</label>";
    echo "<input type='text' id='postalCode' name='postalCode' value='{$row['postalCode']}'><br><br>";
    
    echo "<input type='submit' value='อัปเดต'>";
    echo "</form>";
    echo "</body>";
    echo "</html>";
    
} catch (PDOException $e) {
    die("เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $e->getMessage());
}
?>
