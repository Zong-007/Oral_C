<?php
$servername = "y0nkiij6humroewt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
$username = "iu55u4jwe71fr074";
$password = "zg432644ej6s6w4p";
$dbname = "r3en3wy6qhopkprr";

try {
    // สร้างการเชื่อมต่อฐานข้อมูล
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// รับข้อมูลจาก URL
$SODIUM = isset($_GET['sodium_level']) ? $_GET['sodium_level'] : null;
$NaCl = isset($_GET['nacl_level']) ? $_GET['nacl_level'] : null;

// ตรวจสอบค่าที่ถูกส่งมา
if ($SODIUM !== null) {
    echo "sodium_level: " . htmlspecialchars($SODIUM) . "<br>";
}
if ($NaCl !== null) {
    echo "nacl_level: " . htmlspecialchars($NaCl) . "<br>";
}

// ตรวจสอบว่ามีค่าใดค่าหนึ่งถูกส่งมา
if ($SODIUM !== null || $NaCl !== null) {
    // เตรียม statement และผูก parameter
    $stmt = $conn->prepare("INSERT INTO sodiumdata (sodium_level, nacl_level) VALUES (:sodium_level, :nacl_level)");
    $stmt->bindParam(':sodium_level', $SODIUM);
    $stmt->bindParam(':nacl_level', $NaCl);

    // ดำเนินการ statement
    if ($stmt->execute()) {
        echo "เพิ่มข้อมูลสุขภาพเรียบร้อยแล้ว.";
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลสุขภาพ.";
    }
} else {
    die("โปรดส่งค่าของ sodium_level หรือ nacl_level อย่างน้อยหนึ่งค่า.");
}

// ปิดการเชื่อมต่อ
$conn = null;
?>