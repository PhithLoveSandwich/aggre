<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มข้อมูลใหม่</title>
</head>
<body>
    <h2>เพิ่มข้อมูลใหม่</h2>
    <form action="add_process.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="age">Age:</label>
        <input type="text" id="age" name="age"><br><br>
        
        <label for="street">Street:</label>
        <input type="text" id="street" name="street"><br><br>
        
        <label for="city">City:</label>
        <input type="text" id="city" name="city"><br><br>
        
        <label for="state">State:</label>
        <input type="text" id="state" name="state"><br><br>
        
        <label for="postalCode">Postal Code:</label>
        <input type="text" id="postalCode" name="postalCode"><br><br>
        
        <input type="submit" value="เพิ่มข้อมูล">
    </form>
</body>
</html>
