<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>แสดงข้อมูลและ CRUD</title>
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
        .add-button {
            text-align: right;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="add-button">
        <form action="add.php" method="post">
            <input type="submit" value="เพิ่มข้อมูลใหม่">
        </form>
    </div>
    
    <h2>ข้อมูลจากฐานข้อมูล my_database</h2>
    <table>
        <thead>
            <tr>
                <th>P_id</th>
                <th>Name</th>
                <th>Age</th>
                <th>A_id</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
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
                
                // คำสั่ง SQL เพื่อดึงข้อมูล person และ address โดยรวมกัน
                $stmt = $pdo->query("SELECT person.P_id, person.name, person.age, address.A_id, address.street, address.city, address.state, address.postalCode
                                     FROM person
                                     INNER JOIN address ON person.A_id = address.A_id");
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // วนลูปแสดงผลข้อมูล
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>{$row['P_id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['age']}</td>";
                    echo "<td>{$row['A_id']}</td>";
                    echo "<td>{$row['street']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['state']}</td>";
                    echo "<td>{$row['postalCode']}</td>";
                    echo "<td>";
                    
                    // สร้างลิงก์หรือปุ่มสำหรับแก้ไข
                    echo "<form action='edit.php' method='post'>";
                    echo "<input type='hidden' name='P_id' value='{$row['P_id']}'>";
                    echo "<input type='submit' value='แก้ไข'>";
                    echo "</form>";
                    
                    // สร้างลิงก์หรือปุ่มสำหรับลบ
                    echo "<form action='delete.php' method='post'>";
                    echo "<input type='hidden' name='P_id' value='{$row['P_id']}'>";
                    echo "<input type='submit' value='ลบ' onclick=\"return confirm('คุณต้องการลบข้อมูลนี้?')\">";
                    echo "</form>";
                    
                    echo "</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                die("เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $e->getMessage());
            }
            ?>
        </tbody>
    </table>
</body>
</html>
