<?php
header('Content-Type: application/json; charset=utf-8');

$host = "localhost";     // เซิร์ฟเวอร์
$user = "root";          // ชื่อผู้ใช้ MySQL
$pass = "";              // รหัสผ่าน
$db   = "datacenter";    // ชื่อฐานข้อมูล (ตั้งเองใน Navicat)

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => "เชื่อมต่อฐานข้อมูลไม่ได้"]));
}

// ตัวอย่างตาราง: sensor_data (id, temperature, humidity, created_at)
$sql = "SELECT temperature, humidity, created_at FROM sensor_data ORDER BY created_at ASC LIMIT 50";
$result = $conn->query($sql);

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
